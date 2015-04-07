<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppHelper', 'Helper');

/**
 * Character Open Graph meta helper.
 *
 * @package       app.View.Helper
 */
class CharOgHelper extends AppHelper {
/**
 * Helpers
 *
 * @var array|string
 */
	public $helpers = ['Html', 'Time'];

/**
 * Html template values.
 *
 * @var array
 */
	public $values = [
		'og:title'		=> '{$name} on {$realm}',
		'og:description' => 'Overview of {$name}, a level {$level} {$type} on {$realm}. Last seen {$last_seen}.',
		'og:image'		=> '{$thumbnail}',
		'og:author'		=> 'WoW Character Info'
	];

	public function build($character) {
		$results = [
			'{$name}' => $character['name'],
			'{$type}' => $character['type'],
			'{$realm}' 		 => $character['realm'],
			'{$level}'		 => $character['level'],
			'{$last_seen}' => $this->Time->timeAgoInWords($character['last_seen']),
			'{$thumbnail}' => $character['thumbnail']
		];
		$meta = '';
		foreach($this->values as $name => $content) {
			$meta .= $this->Html->meta(['name' => $name, 'content' => strtr($content, $results)]) . "\n    ";
		}
		return $meta;
	}
}
