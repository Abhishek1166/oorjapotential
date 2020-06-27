<div class="container py-5">
	<h1 class="text-center font-weight-bold text-uppercase text-warning">Gallery</h1>
	<div class="row py-5">
		<?php if (is($data) and is($data['gallery'], 'array')) : ?>
			<?php foreach ($data['gallery'] as $key => $value) : ?>
				<div class="col-md-4 mx-3 p-5 mb-4" style="border-radius: 10px; background: linear-gradient(#0050, #000000000050), url(/assets/img/blog-banner.png)">
					<a href="<?php echo SITE_URL . 'gallery-images/' . str_replace(' ', '-', $value->img_group); ?>">
						<div class="text-center text-white py-5">
							<h3 class="mb-5">
								<?php is($value->img_group, 'showCapital'); ?>
							</h3>
							<h5><i class="fa fa-image"></i> &nbsp; <?php is($value->count, 'show') ?> Photos</h5>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
