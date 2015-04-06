<?php
/**
 * Characters controller.
 *
 * Renders characters
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
 * @package       WowCharInfo.Controller.Characters
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Characers Controller
 *
 * Logic for searching and displaying character information
 *
 * @package       WowCharInfo
 * @link http://github.com/chrisvogt/wowchar-info
 */
class CharactersController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Characters';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = [];

	public function s() {
		$this->set('Character', $this->Character->getMock());
	}

}
