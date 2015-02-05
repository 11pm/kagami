<div class="splash">
	<div class="splash-content">
		<?php foreach ($scope->posts as $post): ?>
			<?php echo $post ?>
		<?php endforeach; ?>
		<p><?php echo $scope->subheader ?>.</p>
		<h1><?php echo $scope->post ?></h1>
	</div>
</div>