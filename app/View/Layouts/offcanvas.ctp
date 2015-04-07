<!DOCTYPE html>
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

    <title>WoW Character Viewer - WOWCHAR.info</title>

    <meta name="description" content="View your WoW characters and generate links to share them on Facebook and other sites.">
    <meta name="author" content="http://www.chrisvogt.me">
    <link rel="shortcut icon" href="favicon.png">

    <?php echo $this->CharOg->build($character); ?>

    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css" rel="stylesheet">
    <link href="components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
    <link href="css/wowchar.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
      <a class="navmenu-brand text-center" href="#">
        <img src="http://res.cloudinary.com/chrisvogt/image/upload/v1428239895/projects/wowchar/img/touch-icon-ipad.png" />
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
            <input type="text" name="realm" class="form-control" placeholder="Realm" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="txtCharacter"><i class="fa fa-user"></i></span>
            <input type="text" name="character" class="form-control" placeholder="Character" aria-describedby="basic-addon1">
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

    <a href="https://github.com/chrisvogt/wow-character-viewer" id="ghRibbon" title="WoW Character Viewer on GitHub"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/a6677b08c955af8400f44c6298f40e7d19cc5b2d/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png"></a>

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
    <script>
    var client = new ZeroClipboard( document.getElementById("copy-button") );
      new Share(".share-button", {
        networks: {
          facebook: {
            app_id: "1593551597530332"
          }
        }
      });
    </script>
  </body>
</html>
