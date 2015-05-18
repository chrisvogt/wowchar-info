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
 */ ?>

<div class="row quick-search">
	<div class="col-md-8">
		<h3>How it works</h3>
		<p>Find and share your World of Warcraft character statistics using this free, open-source tool that queries the World of Warcraft web API for your character information and uses that to build link previews when sharing to common social networks.
	</div>
	<div class="col-md-4">
		<?php echo $this->Element('Widget/search'); ?>
	</div>
</div>

<br>

<?php if ($recent_searches) echo $this->Element('Widget/recent-searches'); ?>
