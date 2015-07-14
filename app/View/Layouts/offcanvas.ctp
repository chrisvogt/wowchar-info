<?php
/**
 * Off Canvas Layout
 *     for WoW Character Info
 *
 * Licensed under The MIT License
 *
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.View.Layout.offcanvas
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */ ?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
<!--
      brought to you by...
 ██████╗ ██╗██╗   ██╗ ██████╗
██╔════╝███║██║   ██║██╔═████╗
██║     ╚██║██║   ██║██║██╔██║
██║      ██║╚██╗ ██╔╝████╔╝██║
╚██████╗ ██║ ╚████╔╝ ╚██████╔╝
 ╚═════╝ ╚═╝  ╚═══╝   ╚═════╝
     chrisvogt.me | @c1v0
   -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
    	<?php echo (isset($character)) ? 'Overview of ' . $character['name'] . ' on ' . $character['realm'] : 'WoW Character Viewer Info'; ?>
  	</title>

	<?php echo $this->Html->meta(['name' => 'description', 'content' => 'Find and share your World of Warcraft character stats online with this free, open-source tool.']); ?>
	<?php echo $this->Html->meta(['name' => 'author', 'content' => '@C1V0']); ?>
	<?php echo $this->Html->meta(['name' => 'robots', 'content' => 'index, follow']); ?>
	<?php echo $this->Html->meta(['name' => 'theme-color', 'content' => '#579568']); ?>
  <?php
    if (isset($character)) :
			echo $this->CharOg->build($character);
		else:
			echo $this->Html->meta(['property' => 'og:image', 'content' => $this->Html->Url('/img/og-banner.jpg', true)]);
			echo $this->Html->meta(['property' => 'og:description', 'content' => 'Find and share your World of Warcraft character stats online with this free, open-source tool.']);
			echo $this->Html->meta(['property' => 'og:author', 'content' => 'C1V0']);
			echo $this->Html->meta(['name' => 'twitter:card', 'content' => 'summary_large_image']);
			echo $this->Html->meta(['name' => 'twitter:site', 'content' => 'http://wowchar.info']);
			echo $this->Html->meta(['name' => 'twitter:creator', 'content' => '@C1V0']);
			echo $this->Html->meta(['name' => 'twitter:title', 'content' => 'World of Warcraft character sharing tool']);
			echo $this->Html->meta(['name' => 'twitter:description', 'content' => 'Find and share your World of Warcraft character stats online with this free, open-source tool.']);
			echo $this->Html->meta(['name' => 'twitter:image', 'content' => $this->Html->Url('/img/og-banner.jpg', true)]);
		endif; ?>

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">

		<?php echo $this->Html->css([
			'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css',
			'/components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css',
			'http://fonts.googleapis.com/css?family=Titillium+Web:300',
			'wowchar',
			'/components/chosen/chosen.min.css',
			'/components/font-awesome/css/font-awesome.min.css',
			'/components/github-fork-ribbon-css/gh-fork-ribbon.css'
		]); ?>

    <!--[if lt IE 9]>
    <?php echo $this->Html->css([
    	'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
    	'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js',
			'/components/github-fork-ribbon-css/gh-fork-ribbon.ie.css'
    ]); ?>
    <![endif]-->
  </head>
  <body>
    <?php if ($this->request->here !== '/') echo $this->Element('sidebar'); ?>
    <div id="ghRibbon" class="hidden-xs hiddem-sm github-fork-ribbon-wrapper right">
      <div class="github-fork-ribbon hvr-back-pulse">
          <a href="https://github.com/chrisvogt/wowchar-info">Fork me on GitHub</a>
      </div>
    </div>

		<?php if ($this->request->here == '/') echo $this->Element('jumbotron'); ?>

    <div class="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<footer>
				<p><img class="pull-right" src="http://cakephp.org/img/default/cake-logo-smaller2.png" /> <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a href="https://twitter.com/c1v0">@c1v0</a>.</p>
			</footer>
    </div>

    <script src="components/jquery/dist/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="components/jasny-bootstrap/js/offcanvas.js"></script>
    <script src="components/sharrre/jquery.sharrre.min.js"></script>
    <script src="components/zeroclipboard/dist/ZeroClipboard.min.js"></script>
    <script src="components/chosen/chosen.jquery.min.js"></script>
    <script>
	    $(".chosen-select").chosen({width: "100%"});
	    <?php if ($this->request->here !== '/') : ?>
	    var client = new ZeroClipboard( document.getElementById("copy-button") );
			$('#shareme').sharrre({
			  share: {
			    twitter: true,
			    facebook: true,
			    googlePlus: false
			  },
			  template: '<div class="box"><div class="left">Share</div><div class="middle"><a href="#" class="facebook">f</a><a href="#" class="twitter">t</a></div><div class="right">{total}</div></div>',
			  enableHover: false,
			  enableTracking: true,
			  render: function(api, options){
				  $(api.element).on('click', '.twitter', function() {
				    api.openPopup('twitter');
				  });
				  $(api.element).on('click', '.facebook', function() {
				    api.openPopup('facebook');
				  });
				}
			});
			<?php endif; ?>

    </script>
    <?php echo $this->element('analytics'); ?>
  </body>
</html>
