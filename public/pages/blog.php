<section class="ptb60">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<?php if (is($data, 'array') and is($data['Blogs']))
					foreach ($data['Blogs'] as $key => $value) : ?>
					<div class="card cardBlog">
						<img class="card-img-top" src="<?php is($value->post_image, 'show'); ?>" alt="blogs-img">
						<div class="card-body">
							<h5 class="card-title"><?php is($value->title, 'show'); ?></h5>
							<p class="card-text">
								<?php is($value->description, 'show'); ?>
							</p>
							<ul class="bloglisting-status">
								<li>
									<img src=" <?php is($value->profile_pic, 'show'); ?>" alt="profile"> by
									<?php is($value->first_name, 'showCapital'); ?>&nbsp;
									<?php is($value->last_name, 'showCapital'); ?>
								</li>
								<li class="mb0 xsmb4 mt0 xsmt4">
									<i class="fa fa-calendar-o fa-lg" aria-hidden="true"></i> <?php echo date('M d, Y', strtotime($value->created_date)) ?>
								</li>
								<li class="mb0 xsmb2">
									<i class="fa fa-bookmark-o fa-lg" aria-hidden="true"></i> Business
								</li>
								<li>
									<a href="<?php echo SITE_URL . 'blog/' . $value->slug; ?>" class="readMore-blog text-white">Read more</a>
								</li>
							</ul>
						</div>
					</div>
				<?php endforeach; ?>

				<!-- <nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
					</ul>
				</nav> -->
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<?php getCallBack(); ?>
				<?php searchSide(); ?>
			</div>
		</div>
	</div>
</section>
