<?php
/**
 * Characters controller
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.Controller.Characters
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Characters controller
 *
 * Logic for searching and displaying character information.
 *
 * @package       WowCharInfo
 * @link 					https://github.com/chrisvogt/wowchar-info
 */
class CharactersController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Characters';

/**
 * The character name.
 *
* @var string
*/
	public $characterName;

/**
 * The character's realm.
 *
 * @var string
 */
	public $realmName;

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = [];

/**
 * Components this class uses.
 *
 * @var array
 */
	public $components = ['WowApiConsumer'];

/**
 * Helper classes to load.
 *
 * @var array
 */
	public $helpers = ['Time', 'CharOg'];

/**
 * Character search
 *
 * Searches for characters based on passed query parameters.
 */
	public function s() {
		if (isset($this->characterName) && isset($this->realmName)) {
			$character = $this->WowApiConsumer->get('character', [
																		'realm' => $this->realmName,
																		'character' => $this->characterName ]);
			if (isset($character->code) && $character->code == 404) {
				throw new NotFoundException("$this->characterName on $this->realmName was not found");
			}
			$this->set('character', $character);
		} else {
			$this->Session->setFlash('Character name and realm name required for search.');
			$this->redirect('/');
		}
	}

/**
 * beforeFilter() override
 */
	public function beforeFilter() {
	    parent::beforeFilter();
			if (isset($this->request->query['character'])) {
				$this->characterName = Inflector::slug($this->request->query['character'], '-');
			}
			if (isset($this->request->query['realm'])) {
				$this->realmName = $this->request->query['realm'];
			}
	}

}
