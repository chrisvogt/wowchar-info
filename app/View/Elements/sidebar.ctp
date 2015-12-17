<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
	<a class="navmenu-brand text-center" href="#">
		<?php echo $this->Html->link($this->Html->image('http://res.cloudinary.com/chrisvogt/image/upload/v1428239895/projects/wowchar/img/touch-icon-ipad.png', ['alt' => 'WoW Character Info']), '/', ['escape' => false, 'class' => 'nav-brand hvr-grow-rotate']); ?>
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
			<?php echo $this->Form->submit('Load character', ['class' => 'btn btn-block btn-primary']); ?>
			<?php echo $this->Form->end(); ?>
		</fieldset>
		</form>
	</div>
	<div class="col-md-10 col-md-offset-1">
		<form style="margin-top: 48px;">
            <label for="txtLink">Copy &amp; paste link:</label>
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
