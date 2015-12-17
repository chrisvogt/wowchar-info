<?php
/**
 * Home Page template
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     	  CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info
 * @package       WowCharInfo.View.Layout.offcanvas
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */ ?>

<div class="row quick-search">
	<div class="col-md-8">
		<h3><i class="fa fa-street-view"></i> How it works</h3>
		<p>Search by realm to lookup your WoW character and generate an up-to-date stats card. Share your stats on Facebook and Twitter.</p>
	</div>
	<div class="col-md-4">
		<?php echo $this->Element('Widget/search'); ?>
	</div>
</div>

<?php if ($recent_searches) echo $this->Element('Widget/recent-searches'); ?>
