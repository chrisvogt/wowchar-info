<?php
/**
 * Character model
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       WowCharInfo.Model.Character
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       WowCharInfo.Model.Character
 */
class Character extends AppModel {

/**
 * recursive
 *
 * @var int
 */
	public $recursive = -1;

/**
 * behaviors used by model
 *
 * @var array
 */
	public $actsAs = ['Containable'];

	public $useTable = false;

	/**
	 * Generates mock Character data to feed to the view for scaffolding.
	 *
	 * @return array
	 */
	public function getMock() {
		return [
			'name' 		=> 'Carilliya',
			'type'		=> 'Human Hunter',
			'level'		=> 71,
			'achiev_pts' => 905,
			'last_seen'	 => 1428295037000,
			'realm'		=> 'Emerald Dream',
			'link'		=> 'http://us.battle.net/wow/en/character/emerald-dream/Carilliya/simple'
		];
	}

}
