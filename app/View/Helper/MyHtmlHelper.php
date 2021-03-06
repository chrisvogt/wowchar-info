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
App::uses('HtmlHelper', 'View/Helper');

/**
 * Character Open Graph meta helper.
 *
 * @package       app.View.Helper
 */
class MyHtmlHelper extends HtmlHelper {

    /**
     * Renders a body class attribute based on the location.
     *
     * @param String
     * @return String
     */
    public function renderBodyClass($here) {
        $class = '';
        if ($here === '/') {
            $class = 'page-home';
        } else {
            $class = 'page-character';
        }
        return $class;
    }
}
