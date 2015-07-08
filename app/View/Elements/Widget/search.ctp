<?php echo $this->Form->create('quickSearch', [
		'url' => '/s',
		'id' => 'quickSearchForm',
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
<h3><i class="fa fa-search"></i> Character search</h3>
<fieldset>
	<div class="input-group">
		<span class="input-group-addon" id="txtQuickRealm"><i class="fa fa-globe"></i></span>
		<?php echo $this->Form->select('realm',
				$realms,
				array('data-placeholder' => 'Realm', 'class' => 'chosen-select', 'aria-describedby' => 'txtQuickRealm')
		); ?>
	</div>
	<div class="input-group">
		<span class="input-group-addon" id="txtQuickCharacter"><i class="fa fa-user"></i></span>
		<input type="text" name="character" class="form-control" placeholder="Character" aria-describedby="txtQuickCharacter">
	</div>
	<?php echo $this->Form->submit('Load character', ['class' => 'btn btn-block btn-primary']); ?>
	<?php echo $this->Form->end(); ?>
</fieldset>
</form>
