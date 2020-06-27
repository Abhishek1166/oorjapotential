<section class="viewDetail-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<?php if (is($data['SingleProperty']->image, 'array')) : ?>
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php foreach ($data['SingleProperty']->image as $key => $image) : ?>
								<div class="carousel-item <?php $key === 0 and print('active');?>">
									<img src="<?php is($image, 'show');?>" class=" w-100 d-block" alt="<?php is($data['SingleProperty']->slug, 'show') ?>">
								</div>

							<?php endforeach; ?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				<?php else : ?>
					<img src="<?php is($data['SingleProperty']->image, 'show') ?>" alt="<?php is($data['SingleProperty']->slug, 'show') ?>" class="">
				<?php endif; ?>
				<div class="row mt3 xsmt3">
					<div class="col-lg-9 col-md-9 col-sm-6 col-12">
						<div class="mb2 xsmb4 md22 sm22 xs20">
							<?php is($data['SingleProperty']->title, 'showCapital') ?>
						</div>
						<p class="mb2 xsmb4 paragrey-color">
							<?php is($data['SingleProperty']->srt_description, 'showCapital') ?>
						</p>
						<p>
							<i class="fa fa-map-marker pink-color" aria-hidden="true"></i>
							<?php is($data['SingleProperty']->location, 'showCapital'); ?>,&nbsp;
							<span class="pink-color">
								<?php is($data['SingleProperty']->city, 'showCapital'); ?>
							</span>
						</p>
						<p><?php is($data['SingleProperty']->extra_id, 'show')?></p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-12">
						<div class="w600 mb2 xsmb4 text-right pink-color">
							<?php is($data['SingleProperty']->sell_price, 'price') ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<ul class="nav nav-tabs nav-tabs-lisitng" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="config-tab" data-toggle="tab" href="#config" role="tab" aria-controls="config" aria-selected="true">CONFIG</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="amenities-tab" data-toggle="tab" href="#amenities" role="tab" aria-controls="profile" aria-selected="false">AMENITIES</a>
							</li>
						</ul>
						<div class="tab-content custom-tab-lisiting text-dark" id="myTabContent" style="padding: 40px;background: rgb(255, 255, 255);">
							<div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="config-tab">
								<div class="mb2 xsmb4 md22 sm22 xs20">
									<?php is($data['SingleProperty']->title, 'showCapital') ?>
								</div>
								<div class="mb-2 text-primary">
									<?php is($data['SingleProperty']->project, 'showCapital') ?>
								</div>
								<div class="text-left mb2 xsmb2">
									Expert Reviews (<?php is($data['SingleProperty']->rating_count, 'show'); ?>) |
									<?php is($data['SingleProperty']->avg_rate, 'rating'); ?>
								</div>
								<p class="text-justify paragrey-color">
									<?php is($data['SingleProperty']->description, 'showCapital'); ?>
								</p>
								<div class="row">
									<div class="col-sm col-12 mb0 xsmb6">
										<div class="md18 sm18 xs18">Price</div>
										<div class="w600 md22 sm22 xs20">
											<?php if ($data['SingleProperty']->regular_price !== 'on-request') : ?>
												<?php is($data['SingleProperty']->regular_price, 'price'); ?>
											<?php else : ?>
												<a href="javascript:void(0);" class="btn clearAll-btn bradius5" data-toggle="modal" data-target="#freetrial-popup">
													Price on Request
												</a>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-sm col-12 mb0 xsmb6">
										<div class="md18 sm18 xs18">Area</div>
										<div class="w600 md22 sm22 xs20">
											<?php is($data['SingleProperty']->extra_field, 'showCapital') ?>
										</div>
									</div>
									<div class="col-sm col-12 mb0 xsmb6">
										<div class="md18 sm18 xs18">Possession Date</div>
										<div class="w600 md22 sm22 xs20">
											<?php is($data['SingleProperty']->extra_date, 'date') ?>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
								<div class="row">
									<div class="col-12">
										<h3>Amenities :</h3>
									</div>
									<?php if (is($data['filters'], 'array')) ?>
									<?php foreach ($data['filters'] as $key => $value) : ?>
										<?php if ($value->filter === 'amenities') : ?>
											<div class="col-md-6 p-2">
												<!-- <i class="fa fa-star fa-sm" aria-hidden="true"></i> -->
												<span class="text-justify">
													<?php is($value->title, 'showCapital'); ?>
												</span>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<?php getCallBack(); ?>
				<?php searchSide(); ?>
			</div>
		</div>
	</div>
</section>
