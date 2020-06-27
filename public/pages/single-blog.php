<section class="ptb60">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<?php if (is($data, 'json')) : ?>
					<?php $value = $data; ?>
					<div class="card cardBlog">
						<img class="card-img-top" src="<?php is($value->post_image, 'show'); ?>" alt="blogs-img">
						<div class="card-body">
							<h5 class="card-title"><?php is($value->title, 'show'); ?></h5>
							<p class="card-text">
								<?php is($value->description, 'show'); ?>
							</p>
							<ul class="bloglisting-status">
								<li class="mb0 xsmb4 mt0 xsmt4">
									<i class="fa fa-calendar-o fa-lg" aria-hidden="true"></i> <?php echo date('M d, Y', strtotime($value->created_date)) ?>
								</li>
							</ul>
						</div>
					</div>
				<?php endif; ?>

			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<?php getCallBack(); ?>
				<?php searchSide(); ?>
			</div>
		</div>
	</div>
</section>
