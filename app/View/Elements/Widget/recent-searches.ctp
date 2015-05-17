<div id="recent" class="well">
	<h3>Recent Searches</h3>
	<div class="row">
		<?php foreach ($recent_searches as $item) : ?>
		<div class="col-xs-4 col-md-2 text-center">
			<?php echo $this->html->link(
					$this->Html->image($item['thumbnail'], ['class' => 'img img-circle']),
					['controller' => '/', 'action' => 's', '?' => [
							'realm' 		=> $item['realm'],
							'character' => $item['character']
					]],
					['escape' => false]
			); ?>
			<p><?php echo $item['character']; ?><span><?php echo $item['realm']; ?></span></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>
