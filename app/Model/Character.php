<?php
/**
 * Character model
 *
 * Licensed under The MIT License
 *
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.Model.Character
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Character model Wowchar Info.
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

/**
 * This model does not use a db table.
 */
	public $useTable = false;

}
