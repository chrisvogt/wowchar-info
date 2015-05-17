<?php
/**
 * Home Page template
 *     for WoW Character Info
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.View.Layout.offcanvas
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */ ?><h1>WoW Character Info</h1>

<p class="lead">Quickly share your WoW character's stats.</p>

<p>This app is a toy I built to help share my WoW characters in Facebook comments. After finding your character, post the full address (found in the address bar or the sidebar menu to your left) and Facebook will generate a preview containing your character's avatar and quick stats.</p>

<br>

<?php if ($recent_searches) echo $this->Element('Widget/recent-searches'); ?>
