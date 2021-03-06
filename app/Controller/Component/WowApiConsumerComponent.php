<?php
/**
 * WoW API Consumer Component
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info
 * @package       WowCharInfo.Component.WowApiConsumer
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * WoW API Consumer Component.
 *
 * Makes requests to the Battle.NET World of Warcraft API.
 *
 * @package      WowChar.Component.WowApiConsumer
 * @link         https://github.com/chrisvogt/wowchar-info
 */
class WowApiConsumerComponent extends Component {

/**
 * The base url for the API call.
 *
 * @var string
 */
	public $baseUrl = 'https://us.api.battle.net/wow/';

/**
 * The base URL for thumbnails.
 *
 * @var string
 */
	public $thumbBaseUrl = 'https://us.battle.net/static-render/us/';

/**
 * The base URL for profile links.
 *
 * @var string
 */
	public $profileBaseUrl = 'https://us.battle.net/wow/en/character/';

/**
 * Location of the realms data.
 */
	public $realmsUrl = 'https://us.api.battle.net/wow/realm/status';

/**
 * Character classes resource container.
 *
 * @var array
 */
	public $classes = [];

/**
 * Character races resource container.
 *
 * @var array
 */
	public $races = [];

/**
 * Realms resource container.
 *
 * @var array
 */
	public $realms = [];

/**
 * The name of the character to query.
 *
 * @var string
 */
	public $characterName;

/*
 * The name of the server to query.
 *
 * @var string
 */
	public $realmName;

/**
 * Response object container.
 *
 * @var array|object
 */
	public $response = [];

/**
 * Valid consumer request types.
 *
 * @var array
 */
	protected $_validTypes = ['character', 'resource'];

/**
 * Class constructor
 *
 * @param ComponentCollection $collection A ComponentCollection for this component
 * @param array $settings Array of settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
		$this->classes = $this->loadResource('classes');
		$this->races   = $this->loadResource('races');
	}

/**
 * Interface for the consumer component.
 *
 * Start here.
 *
 * @var string $type
 * @var array $settings ['character' => 'foo', 'realm' => 'bar']
 */
	public function get($type, array $settings) {
		$this->isValidType($type);
		$this->parseSettings($settings);
		if (!Cache::read($settings['realm'] . '-' . $settings['character'], 'character')){
			$data = $this->makeRequest($this->buildQuery($type));
			if (isset($data->code) && $data->code == 404) {
				return $data;
			}
			if ($type === 'character') {
				$settings['thumbnail'] = $this->thumbBaseUrl . $data['thumbnail'];
				$this->addRecent($settings); // add to recently searched cache
				$data['class'] = $this->classes[$data['class']];
				$data['race'] = $this->races[$data['race']];
			}
			Cache::write($settings['realm'] . '-' . $settings['character'], $data, 'character');
		} else {
			$data = Cache::read($settings['realm'] . '-' . $settings['character'], 'character');
		}
		return $this->sanitize($data);
	}

	/**
	 * Adds character data to the recently searched cache.
	 *
	 * @return mixed|boolean Whether or not the data was cached.
	 */
		public function addRecent($char) {
			if (Cache::read('recent_searches', 'forever')) {
				$recent = $this->getRecent();
			}
			$path = $char['realm'] . '#' . $char['character'];
			if (isset($recent) && in_array($path, $recent)) {
				return;
			}
			$recent[$path] = serialize($char);
			return Cache::write('recent_searches', $recent, 'forever');
		}

	/**
	 * Retrieves the latest searches from cache.
	 *
	 * @return array
	 */
		public function getRecent($qty = null) {
			$result = Cache::read('recent_searches', 'forever');
			if ($result) {
				$result = array_reverse($result);
				if (isset($qty)) {
					$result = array_slice($result, 0, $qty);
					array_walk($result, function(&$item, $key) {
						$item = unserialize($item);
					});
				}
			}
			return $result;
		}

/**
 * Sanitizes the data array
 *
 * Cleans up the returned data to match what is expected.
 *
 * @return array
 */
	protected function sanitize($raw) {
		$data = [
			'name'		=> $raw['name'],
			'thumbnail'	 => $this->thumbBaseUrl . $raw['thumbnail'],
			'type'		=> $raw['race'] . ' ' . $raw['class'],
			'level'		=> $raw['level'],
			'achiev_pts' => $raw['achievementPoints'],
			'last_seen'	 => $raw['lastModified'] / 1000,
			'realm'			 => $raw['realm'],
			'battlegroup'	=> $raw['battlegroup'],
			'link'			  => $this->buildExtLink($raw['name'], $raw['realm'])
		];
		return $data;
	}

/**
 * Loads the associated data records
 *
 * Loads resources to be joined with the character data, either from cache or API.
 *
 * @throws InvalidArgumentException
 * @return array
 */
	protected function loadResource($type) {
		if (Cache::read($type, 'resource')) {
			return Cache::read($type, 'resource');
		}
		$validResources = ['classes', 'races'];
		if (in_array($type, $validResources)) {
            $apiKey = env('BLIZZARD_API_KEY');
			$requestUrl = $this->baseUrl . 'data/character/' . $type . "?fields=appearance&apikey={$apiKey}&jsonp=";
			$response = $this->makeRequest($requestUrl);
			Cache::write($type, $this->extractResource($response[$type]), 'resource');
			return $this->extractResource($response[$type]);
		} else {
			throw new InvalidArgumentException('Invalid type passed to loadResource(). Accepts classes or races, you passed: ' . $type);
		}
	}

/**
 * Gets the realms resource list
 *
 * This should be moved into loadResource().
 *
 * @return array
 */
	public function getRealms() {
		if (Cache::read('realms', 'resource')) {
			return Cache::read('realms', 'resource');
		} else {
			$res = $this->makeRequest($this->buildQuery('realms'));
			for ($i = 0; $i < count($res['realms']); $i++) {
				$this->realms[$res['realms'][$i]['slug']] = $res['realms'][$i]['name'];
			}
			Cache::write('realms', 'resource');
			return $this->realms;
		}
	}

/**
 * Extracts data from resource sets returned by the Battle.NET API
 *
 * @return array
 */
	protected function extractResource($resources) {
		$extract = [];
		for ($i = 0; $i < count($resources); $i++) {
			$extract[$resources[$i]['id']] = $resources[$i]['name'];
		}
		return $extract;
	}

/**
 * Makes the API call
 *
 * @return array
 */
	public function makeRequest($requestUrl) {
		$HttpSocket = new HttpSocket();
		$HttpSocket->config['ssl_verify_peer'] = false;
		$results = $HttpSocket->get($requestUrl);
		if ($results->code == 404) {
			return $results;
		}
		return json_decode($results->body, true);
	}

/**
 * Builds the API query url based on parameters
 *
 * @return array
 */
	public function buildQuery($type) {
		switch ($type) {
			case 'character':
				$requestUrl = $this->baseUrl . $type . DS . $this->realmName . DS . $this->characterName;
				break;
            case 'realms':
                $requestUrl = $this->realmsUrl ;
                break;
		}

        $apiKey = env('BLIZZARD_API_KEY');
        $requestUrl .= "?apikey={$apiKey}&jsonp=";

		return $requestUrl;
	}

/**
 * Builds the external profile link.
 *
 * @return string
 */
	public function buildExtLink($character, $realm) {
		$fRealm = preg_replace('/[^A-Za-z0-9 -]/', '', $realm);
		$link = $this->profileBaseUrl . strtolower($fRealm) . DS
																  . strtolower($character) . DS . 'simple';
		return $link;
	}

/**
 * Helper method to get class settings
 */
	public function parseSettings(array $settings) {
		$this->characterName = $settings['character'];
		$this->realmName		 = $settings['realm'];
	}

/**
 * Helper method to validate the type of object being requested
 *
 * @throws InvalidArgumentException When an invalid resource type is requested.
 */
	protected function isValidType($type) {
		if (!in_array($type, $this->_validTypes)) {
			throw new InvalidArgumentException('Invalid type passed to get(). Accepts characer or server, you passed: ' . $type);
		}
	}

}
