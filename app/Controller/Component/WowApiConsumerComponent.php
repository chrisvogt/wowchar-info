<?php
/**
 * WoW API Consumer Component
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar
 * @package       WowChar.Component.WowApiConsumer
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * WoW API Consumer Component.
 *
 * Makes requests to the Battle.NET World of Warcraft API.
 *
 * @package       WowChar.Component.WowApiConsumer
 * @link https://github.com/chrisvogt/wowchar
 *
 */
class WowApiConsumerComponent extends Component {

/**
 * The base url for the API call.
 *
 * @var string
 */
	public $baseUrl = 'http://us.battle.net/api/wow/';

/**
 * The base URL for thumbnails.
 *
 * @var string
 */
	public $thumbBaseUrl = 'http://us.battle.net/static-render/us/';

/**
 * The base URL for profile links.
 *
 * @var string
 */
	public $profileBaseUrl = 'http://us.battle.net/wow/en/character/';

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
				$data['class'] = $this->classes[$data['class']];
				$data['race'] = $this->races[$data['race']];
			}
			Cache::write($settings['realm'] . '-' . $settings['character'], $data, 'character');
		} else {
			$data = Cache::read($settings['realm'] . '-' . $settings['character'], 'character');
		}
		return $this->sanitize($data);
	}

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
			'link'		=> $this->profileBaseUrl
											. Inflector::slug(strtolower($raw['realm']), '-') . DS
											. strtolower($raw['name']) . '/simple'
		];
		return $data;
	}

	protected function loadResource($type) {
		if (Cache::read($type, 'resource')) {
			return Cache::read($type, 'resource');
		}
		$validResources = ['classes', 'races'];
		if (in_array($type, $validResources)) {
			$requestUrl = $this->baseUrl . 'data/character/' . $type . '?fields=appearance&jsonp=';
			$response = $this->makeRequest($requestUrl);
			Cache::write($type, $this->extractResource($response[$type]), 'resource');
			return $this->extractResource($response[$type]);
		} else {
			throw new InvalidArgumentException('Invalid type passed to loadResource(). Accepts classes or races, you passed: ' . $type);
		}
	}

	protected function extractResource($resources) {
		$extract = [];
		for ($i = 0; $i < count($resources); $i++) {
			$extract[$resources[$i]['id']] = $resources[$i]['name'];
		}
		return $extract;
	}

	public function makeRequest($requestUrl) {
		$HttpSocket = new HttpSocket();
		$results = $HttpSocket->get($requestUrl);
		if ($results->code == 404) {
			return $results;
		}
		return json_decode($results->body, true);
	}

	public function buildQuery($type) {
		switch ($type) {
			case 'character':
				$requestUrl = $this->baseUrl . $type . DS . $this->realmName . DS . $this->characterName . '?jsonp=';
				break;
		}
		return $requestUrl;
	}

	public function parseSettings(array $settings) {
		$this->characterName = $settings['character'];
		$this->realmName		 = $settings['realm'];
	}

	protected function isValidType($type) {
		if (!in_array($type, $this->_validTypes)) {
			throw new InvalidArgumentException('Invalid type passed to get(). Accepts characer or server, you passed: ' . $type);
		}
	}

}
