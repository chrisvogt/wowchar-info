<?php
/**
 * Off Canvas Layout
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

    <title>WoW Character Viewer Info</title>

    <meta name="description" content="View your WoW characters and generate links to share them on Facebook and other sites.">
    <meta name="author" content="GamertagDB">

    <?php if (isset($character)) echo $this->CharOg->build($character); ?>

    <link rel="shortcut icon" href="favicon.ico">

    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">

    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css" rel="stylesheet">
    <link href="components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
    <link href="components/chosen/chosen.min.css" rel="stylesheet">
    <link href="css/wowchar.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
      <a class="navmenu-brand text-center" href="#">
        <?php echo $this->Html->link($this->Html->image('http://res.cloudinary.com/chrisvogt/image/upload/v1428239895/projects/wowchar/img/touch-icon-ipad.png', ['alt' => 'WoW Character Info']), '/', ['escape' => false, 'class' => 'nav-brand']); ?>
      </a>
      <div class="col-md-10 col-md-offset-1">
        <?php
          echo $this->Form->create('Character', [
            'action' => 's',
            'type' => 'get',
            'class' => 'nav-search',
            'inputDefaults' => [
                'label' => false,
                'div' => [
                    'class' => 'input-group'
                ],
                'class' => 'form-control'
            ]
          ]); ?>
        <h3>Change character</h3>
        <fieldset>
          <div class="input-group">
            <span class="input-group-addon" id="txtRealm"><i class="fa fa-globe"></i></span>
            <?php echo $this->Form->select('realm',
                $realms,
                array('data-placeholder' => 'Realm', 'class' => 'chosen-select', 'aria-describedby' => 'txtRealm')
            ); ?>
            <!-- <input type="text" name="realm" class="form-control" placeholder="Realm" aria-describedby="basic-addon1"> -->
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="txtCharacter"><i class="fa fa-user"></i></span>
            <input type="text" name="character" class="form-control" placeholder="Character" aria-describedby="txtCharacter">
          </div>
          <?php echo $this->Form->submit('Load character', ['class' => 'btn btn-block btn-success']); ?>
          <?php echo $this->Form->end(); ?>
        </fieldset>
        </form>
      </div>
      <div class="col-md-10 col-md-offset-1">
        <form style="margin-top: 48px;">
          <div class="input-group">
            <input type="text" id="txtLink" class="form-control" value="<?php echo Router::reverse($this->request, true); ?>">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" id="copy-button" data-clipboard-target="txtLink"><i class="fa fa-clipboard"></i></button>
            </span>
          </div><!-- /input-group -->
      </div>
    </div>
    <div class="navbar navbar-default navbar-static-top">
      <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>

    <a href="https://github.com/chrisvogt/wowchar-info"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a>

    <div class="container">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="components/jquery/dist/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="components/jasny-bootstrap/js/offcanvas.js"></script>
    <script src="components/share-button/build/share.min.js"></script>
    <script src="components/zeroclipboard/dist/ZeroClipboard.min.js"></script>
    <script src="components/chosen/chosen.jquery.min.js"></script>
    <script>
      $(".chosen-select").chosen({width: "100%"});
      var client = new ZeroClipboard( document.getElementById("copy-button") );
      new Share(".share-button", {
        url: "<?php echo urlencode(Router::reverse($this->request, true)); ?>",
        networks: {
          facebook: {
            app_id: "1593551597530332"
          }
        }
      });
    </script>
    <?php echo $this->element('analytics'); ?>
  </body>
</html>
