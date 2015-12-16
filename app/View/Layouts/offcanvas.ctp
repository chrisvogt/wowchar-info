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
 * @author          CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.View.Layout.offcanvas
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */?><!DOCTYPE html>
<html lang="en">
  <head>
        <?php echo $this->Html->charset() . "\n"; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
    ┬ ┬┌─┐┬ ┬┌─┐┬ ┬┌─┐┬─┐   ┬┌┐┌┌─┐┌─┐
    ││││ │││││  ├─┤├─┤├┬┘───││││├┤ │ │
    └┴┘└─┘└┴┘└─┘┴ ┴┴ ┴┴└─   ┴┘└┘└  └─┘
                              by @c1v0

    https://github.com/chrisvogt/wowchar-info
-->
        <title>
            <?php echo (isset($character)) ? 'Overview of ' . $character['name'] . ' on ' . $character['realm'] . "\n" : 'WoW Character Viewer Info' . "\n"; ?>
        </title>

<?php echo "\t" . $this->Html->meta(['name' => 'description', 'content' => 'Lookup and share WoW profiles including character stats.']) . "\n";
echo "\t" . $this->Html->meta(['name' => 'author', 'content' => '@C1V0']) . "\n";
echo "\t" . $this->Html->meta(['name' => 'robots', 'content' => 'index, follow']) . "\n";
echo "\t" . $this->Html->meta(['name' => 'theme-color', 'content' => '#579568']) . "\n";

if (isset($character)) :
    echo $this->CharOg->build($character);
else:
    echo "\t" . $this->Html->meta(['property' => 'og:image', 'content' => $this->Html->Url('/img/og-banner.jpg', true)]) . "\n";
    echo "\t" . $this->Html->meta(['property' => 'og:description', 'content' => 'Lookup and share WoW profiles including character stats.']) . "\n";
    echo "\t" . $this->Html->meta(['property' => 'og:author', 'content' => 'WOWCHAR.info']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:card', 'content' => 'summary_large_image']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:site', 'content' => 'http://wowchar.info']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:creator', 'content' => '@C1V0']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:title', 'content' => 'WoW character lookup on WOWCHAR.info']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:description', 'content' => 'Lookup and share WoW profiles including character stats.']) . "\n";
    echo "\t" . $this->Html->meta(['name' => 'twitter:image', 'content' => $this->Html->Url('/img/og-banner.jpg', true)]) . "\n";
endif;
?>

        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
    <?php echo $this->Html->css([
        'app.min.css'
    ]); ?>

    <!--[if lt IE 9]><?php echo $this->Html->css([
        'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
        'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'
    ]); ?>
    <![endif]-->
  </head>
  <body>
    <?php if ($this->request->here !== '/') echo $this->Element('sidebar'); ?>
    <?php if ($this->request->here == '/') echo $this->Element('jumbotron'); ?>

    <div class="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
            <footer>
                <p><img class="pull-right" src="http://cakephp.org/img/default/cake-logo-smaller2.png" /> <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a href="https://twitter.com/c1v0">@c1v0</a>.</p>
            </footer>
    </div>

    <a href="https://github.com/chrisvogt/wowchar-info" class="github-corner" title="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#579568; color:#000; position: absolute; top: 0; border: 0; right: 0;z-index:55;"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>

    <?php echo $this->Html->script('libraries'); ?>

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
