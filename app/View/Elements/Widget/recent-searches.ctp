<div id="recent" class="card">
	<div class="container">
	<h3><i class="fa fa-history"></i> Recent Searches</h3>
	<div class="row">
		<?php foreach ($recent_searches as $item) : ?>
		<div class="col-xs-4 col-md-2 text-center hvr-grow-shadow">
			<?php echo $this->Html->link(
					$this->Html->image($item['thumbnail'], ['class' => 'img img-circle']),
					['controller' => '/', 'action' => 's', '?' => [
							'realm' 		=> $item['realm'],
							'character' => $item['character']
					]],
					['escape' => false]
			); ?>
			<p><?php echo $item['character']; ?><span><?php echo $realms[$item['realm']]; ?></span></p>
		</div>
		<?php endforeach; ?>
	</div>
	</div>
</div>
