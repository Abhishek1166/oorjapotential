<section class="ptb50 ptop-xs">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="filter-section">
					<form action="<?php echo SITE_URL; ?>hot-deals" method="POST" id="myForm">
						<input type="hidden" name="cat" value="<?php is($_POST['cat'], 'show'); ?>">
						<input type="hidden" name="city" value="<?php is($_POST['city'], 'show'); ?>">
						<input type="hidden" name="title" value="<?php is($_POST['title'], 'show'); ?>">
						<?php $first = 1; ?>
						<?php if (is($data['filters'], 'array')) ?>
						<?php foreach ($data['filters'] as $key => $filter) : ?>
							<!-- <?php echo str_replace('-', ' ', ucwords($key)); ?> -->
							<div class="w600 lg20 md20 mb4 xsmb2 pointer" data-toggle="collapse" href="#filter<?php is($key, 'show'); ?>" role="button" aria-expanded="false" aria-controls="filter<?php is($key, 'show'); ?>">
								<?php echo str_replace('-', ' ', ucwords($key)); ?>
								<span class="float-right">
									<i class="fa fa-chevron-down" aria-hidden="true"></i>
								</span>
							</div>
							<div class="d-block">
								<ul class="bedroomslisting tagRadioLabel collapse <?php $first === 1 and print('show'); ?>" id="filter<?php is($key, 'show'); ?>">
									<?php if (is($data['filters'][$key], 'array')) ?>
									<?php foreach ($data['filters'][$key] as $value) : ?>
										<li>
											<input type="checkbox" <?php is($data['selected_filters'], 'array') and in_array($value->id, $data['selected_filters']) and print('checked') ?> name="filter[]" value="<?php is($value->id, 'show'); ?>" id="<?php is($value->id, 'show'); ?>">
											<label for="<?php is($value->id, 'show'); ?>">
												<?php is($value->filter_value_title, 'showCapital'); ?>
											</label>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>

							<div class="listingBottom-line"></div>
							<?php $first++; ?>
						<?php endforeach; ?>

						<div>&nbsp;</div>
						<div>&nbsp;</div>
						<button class="apply-btn" name="search" value="sfsdf" type="submit">Apply</button>
					</form>
				</div>

			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-12">

				<div class="w600 mb3 xsmb3">
					<?php if (is($data['properties']) and is($_POST['cat']) and is($_POST['city'])) : ?>
						<?php echo count($data['properties']); ?>
						result found to
						<?php is($_POST['cat'], 'show'); ?>
						property in
						<?php is($_POST['city'], 'showCapital'); ?>
					<?php endif; ?>
				</div>

				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9 col-12">
						<!-- <ul class="filter-search">
							<li>
								<a href="#"> 1 BHK <i class="fa fa-times"></i></a>
							</li>
							<li>
								<a href="#"> 1 BHK <i class="fa fa-times"></i></a>
							</li>
							<li>
								<a href="#"> 1 BHK <i class="fa fa-times"></i></a>
							</li>
							<li>
								<a href="#"> 1 BHK <i class="fa fa-times"></i></a>
							</li>
						</ul> -->
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-12">
						<a href="<?php echo SITE_URL; ?>search/property">
							<button type="button" class="mb-5 btn clearAll-btn subscribe-btn-40 bradius5 w-100">
								Clear All
							</button>
						</a>
					</div>
				</div>

				<?php if (is($data, 'array') and is($data['properties'])) : ?>
					<?php foreach ($data['properties'] as $key => $value) : ?>
						<!-- Flat Details -->
						<div class="flattype-section">
							<div class="flatDetail-block">
								<img src="<?php is($value->image, 'show'); ?>" alt="<?php is($value->title, 'show'); ?>" class="img-fluid">

								<div class="flatDetail-body">
									<h5 class="w600 mb3 xsmb4">
										<?php is($value->title, 'showCapital'); ?>
									</h5>

									<div class="pink-color float-left sm15">
										<?php is($value->project, 'showCapital'); ?>
									</div>

									<div class="text-right sm15">
										Expert Reviews
										(<?php is($value->rating_count, 'show'); ?>)
										|
										<?php is($value->avg_rate, 'rating'); ?>
									</div>

									<div class="paragrey-color mb2 xsmb4 mt3 xsmt4 sm15 w500">
										<i class="fa fa-map-marker pink-color pink-color" aria-hidden="true"></i>
										<?php is($value->location, 'showCapital') ?>&nbsp;
										<?php is($value->city, 'showCapital') ?>
									</div>
									<div class="mb5 xsmb4 sm15 w500">
										<?php if (is($value->offers)) : ?>
											Offer - <?php is($value->offers); ?>
										<?php endif; ?>
									</div>

									<div class="row">
										<div class="col-md-3 col-sm-3 col-12">
											<div class="sm15">Price</div>
											<div class="w600">
												<?php if ($value->regular_price !== 'on-request') : ?>
													<?php is($value->regular_price, 'price'); ?>
												<?php else : ?>
													<a href="javascript:void(0);" class="btn clearAll-btn bradius5" data-toggle="modal" data-target="#freetrial-popup">
														Price on Request
													</a>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-12 border-lr">
											<div class="sm15">Area</div>
											<div class="w600">
												<?php is($value->extra_field, 'showCapital') ?>
											</div>
										</div>
										<div class="col-md-5 col-sm-5 col-12">
											<div class="sm15">Possession Date</div>
											<div class="w600">
												<?php is($value->extra_date, 'date') ?>
											</div>
										</div>
									</div>

									<div class="mt6 xsmt6 text-right">
										<a href="<?php echo SITE_URL . 'property/' . $value->slug; ?>" class="pink-color w600">
											<u>View Detail</u>
										</a>
										&nbsp;
										<a href="javascript:void(0);" class="btn clearAll-btn bradius5" data-toggle="modal" data-target="#freetrial-popup">
											Contact
										</a>
									</div>

								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="card shadow mt-5 rounded-lg border-0">
						<div class="card-body p-5">
							<h1 class="font-weight-bold">
								<span class="text-warning">Oops, </span>Can't Find Your Property.
							</h1>
							<h4 class="my-4">
								Please Try With Another Keywords.
							</h4>
							<a href="<?php echo SITE_URL; ?>">
								<button class="btn btn-outline-warning">
									Go Back
								</button>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
