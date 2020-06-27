<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($product) and show_404() or breadcrumb_start('Products', 'list/products', 'product_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div id="MainCtn">
					<!-- Products Details -->
					<div class="card">
						<div class="card-header" id="headFirst">
							<section class="mb-0 mt-0">
								<div role="menu" class="" data-toggle="collapse" data-target="#firstData" aria-expanded="false" aria-controls="firstData">
									Product Details
									<div class="icons">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
											<polyline points="6 9 12 15 18 9"></polyline>
										</svg>
									</div>
								</div>
							</section>
						</div>

						<div id="firstData" class="collapse show" aria-labelledby="headFirst" data-parent="#MainCtn">
							<div class="card-body">

								<div class="row">
									<div class="col-md-8">

										<input type="hidden" name="product_id" value="<?php is($product->id, 'show'); ?>">

										<!-- Product Title -->
										<div class="form-group mb-4">
											<input type="text" class="form-control" id="name" name="name" placeholder="Product Title *" value="<?php is($product->title, 'show'); ?>">
											<small class="form-text text-muted">
												<span class="text-danger mr-1">*</span>Required Fields
											</small>
										</div>

										<!-- Product Short Description -->
										<div class="form-group mb-4">
											<input type="text" class="form-control" id="srtDesc" name="srtDesc" placeholder="Product Tag Line *" value="<?php is($product->srt_description, 'show'); ?>">
											<small class="form-text text-muted">
												<span class="text-danger mr-1">*</span>Required Fields
											</small>
										</div>


									</div>

									<div class="col-md-4">

										<!-- Category -->
										<div class="form-group mb-4">
											<select class="selectpicker form-control" name="cat" data-live-search="true" title=" Select Category ">
												<?php if (is($category))
													foreach ($category as $value) : ?>
													<?php if (is($relation, 'array')) foreach ($relation as $cats); ?>
													<option <?php check_selected($value->id, $cats->category_id, 'selected') ?> value="<?php is($value->id, 'show'); ?>">
														<?php is($value->title, 'showCapital'); ?>
													</option>
												<?php endforeach; ?>
											</select>
											<small class="form-text text-muted">
												<span class="text-danger mr-1">*</span>Required Fields
											</small>
										</div>

										<!-- Offers -->
										<div class="form-group mb-4">
											<input type="text" class="form-control" id="offers" name="offers" placeholder="Additional Offers" value="<?php is($product->offers, 'show'); ?>">
										</div>

									</div>

									<div class="col-md-12">
										<!-- Product Description -->
										<div class="form-group">
											<textarea name="desc" id="desc" cols="30" rows="5" class="form-control" placeholder="Product Description"><?php is($product->description, 'show'); ?></textarea>
											<small class="form-text text-muted">
												<span class="text-danger mr-1">*</span>Required Fields
											</small>
										</div>
									</div>

								</div>
							</div>

						</div>
					</div>

					<!-- Products Filters -->
					<div class="card">
						<div class="card-header" id="headSecond">
							<section class="mb-0 mt-0">
								<div role="menu" class="collapsed" data-toggle="collapse" data-target="#secondData" aria-expanded="true" aria-controls="secondData">
									Filters & Other Stuffs
									<div class="icons">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
											<polyline points="6 9 12 15 18 9"></polyline>
										</svg>
									</div>
								</div>
							</section>
						</div>

						<div id="secondData" class="collapse" aria-labelledby="headSecond" data-parent="#MainCtn">
							<div class="card-body">
								<div class="row">

									<div class="col-md-8">

										<!-- Filters -->
										<div class="row">
											<?php foreach ($filters as $key => $filter) { ?>
												<div class="col-md-6">
													<div class="form-group">
														<label>
															<?php echo ucfirst($filter->filter_title) ?>
														</label>
														<select class="form-control <?php $filter->auto_add === '1' and print ('tagging') or print('withoutTagging'); ?>" <?php $filter->type === '1' and print('multiple="multiple"'); ?> data-tags="true" data-placeholder="Select a <?php echo ucfirst($filter->filter_title) ?>" name="filter[<?php echo $filter->id; ?>][]">
															<?php $filter->type === '1' or print('<option selected hidden disabled>Select a ' . ucfirst($filter->filter_title) . '</option>'); ?>

															<?php foreach ($filterValue as $key => $fvalue) { ?>
																<?php if ($fvalue->filter_key_id == $filter->id) : ?>

																	<?php $filterCheck[] = ''; ?>
																	<?php foreach ($relation as $ffval) {
																		$filterCheck[] = $ffval->value_id;
																	} ?>

																	<option <?php in_array($fvalue->id, $filterCheck) and print('selected'); ?> value="<?php echo (int) $fvalue->id ?>">
																		<?php echo $fvalue->filter_value_title ?>
																	</option>
																<?php endif; ?>
															<?php } ?>
														</select>
													</div>
												</div>
											<?php } ?>

											<!-- Status -->
											<div class="col-md-6">
												<div class="form-group mb-4">
													<label for="">Status</label>
													<select class="selectpicker form-control" name="status" data-live-search="true" title=" Select Status ">
														<option <?php check_selected($value->status, 1, 'selected') ?> value="1">
															Approved
														</option>
														<option <?php check_selected($value->status, 2, 'selected') ?> value="2">
															Draft
														</option>
													</select>
													<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
												</div>
											</div>
										</div>

									</div>

									<div class="col-md-4 mt-4">

										<!-- Price -->
										<div class="mb-4">
											<label class="h5 text-dark">Product Price </label>
											<div class="form-group mb-4">
												<input type="text" class="form-control" id="minPrice" name="minPrice" placeholder="Min Price *" value="<?php is($product->regular_price, 'show') ?>">
												<small class="form-text text-muted">
													<span class="text-danger mr-1">*</span>Required Fields
												</small>
											</div>
											<div class="form-group">
												<input type="text" class="form-control" id="maxPrice" name="maxPrice" placeholder="Max Price " value="<?php is($product->sell_price, 'show') ?>">
											</div>
										</div>

										<!-- Product Addtionals -->
										<div class="mb-4">
											<label class="h5 text-dark"> Products : </label>
											<div class="n-chk">
												<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
													<input type="checkbox" name="featured" class="new-control-input" <?php check_selected('1', $product->is_featured, 'checked') ?>>
													<span class="new-control-indicator"></span> Featured Product
												</label>
											</div>
											<div class="n-chk">
												<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
													<input type="checkbox" name="hotDeals" class="new-control-input" <?php check_selected('1', $product->on_deal, 'checked') ?>>
													<span class="new-control-indicator"></span> Hot Deals
												</label>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!-- Products Images -->
					<div class="card">
						<div class="card-header" id="headThird">
							<section class="mb-0 mt-0">
								<div role="menu" class="collapsed" data-toggle="collapse" data-target="#thirdData" aria-expanded="false" aria-controls="thirdData">
									Product's Images
									<div class="icons">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
											<polyline points="6 9 12 15 18 9"></polyline>
										</svg>
									</div>
								</div>
							</section>
						</div>

						<div id="thirdData" class="collapse" aria-labelledby="headThird" data-parent="#MainCtn">
							<div class="card-body">

								<?php strpos($product->image, '@') and $images = explode('@', $product->image) or $images = $product->image;
								file_input('productImg[]', true, $images, '60', true) ?>

								<button type="submit" name="editProduct" value="dyhkiw3r" class="btn btn-primary mt-4">Update Product</button>
							</div>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>