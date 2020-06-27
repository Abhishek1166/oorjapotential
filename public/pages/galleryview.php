<div class="container py-5">
	<h1 class="text-center font-weight-bold text-uppercase text-warning">Gallery</h1>
	<div class="row py-5">
		<?php if (is($data) and is($data['gallery'], 'array')) : ?>
			<?php foreach ($data['gallery'] as $key => $value) : ?>
				<div class="col-md-4 mb-4">
					<a data-fancybox="gallery" href="<?php is($value->image, 'show'); ?>">
						<img src="<?php is($value->image, 'show'); ?>" style="height: 300px" class="w-100 rounded">
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
