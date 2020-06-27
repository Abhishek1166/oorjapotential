<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($propertyData->type) or breadcrumb_start($propertyData->type, 'add/property', 'property_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th class="text-left">Name</th>
							<th class="text-center" style="width: 10%">Image</th>
							<th>Price</th>
							<th>size</th>
							<th>Project</th>
							<th class="text-center">Category</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php if (is($propertyData, 'json') and is($propertyData->data, 'array')) :
							$i = 1;
							foreach ($propertyData->data as $key => $value) : ?>
								<tr>
									<td><?php echo $i++; ?>.</td>

									<td class="text-left pb-4">
										<span class="pr-3 mt-3 py-0 d-block position-relative">
											<p class="align-self-center pt-2 mb-0 admin-name">
												<?php is($value->title, 'showCapital'); ?>
											</p>
											<?php if (is($value->is_featured) and $value->is_featured === '1') : ?>
												<span class="badge counter" style="right: 15px">
													<div class="t-dot bg-primary" data-toggle="tooltip" data-placement="top" title="Featured" data-original-title="Featured"></div>
												</span>
											<?php endif; ?>
											<?php if (is($value->on_deal) and $value->on_deal === '1') : ?>
												<span class="badge counter">
													<div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="Hot Deal" data-original-title="Hot Deal"></div>
												</span>
											<?php endif; ?>
										</span>
										<sub class="mt-1 badge badge-light badge-pill shadow-sm">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="var(--warning)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fav-note text-warning p-1">
												<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
											</svg>
											<?php is($value->avg_rate) and print ($value->avg_rate . ' | ') or print '0 | '; ?>
											<?php is($value->rating_count) and print ($value->rating_count . ' Ratings') or print('0 Ratings'); ?>
										</sub>
									</td>

									<td>
										<div class="mr-2 mx-auto rounded-lg">
											<?php if (is($value->image)) : ?>
												<img src="<?php is($value->image, 'show'); ?>" class="img-fluid shadow rounded-lg" style="border: 2px solid #d3d3d3" alt="<?php is($value->title, 'show'); ?>">
											<?php else : ?>
												<p>Image Not Found</p>
											<?php endif; ?>
										</div>
									</td>

									<td class="text-center">
										<p class="text-<?php is($value->sell_price) and print ('danger') or print('success') ?> bs-tooltip rounded" data-delay="200" data-toggle="tooltip" data-placement="top" title="Minimum Price" data-original-title="Minimum Price">
											<?php is($value->regular_price, 'price'); ?>
										</p>
										<?php if (is($value->sell_price)) : ?>
											<p class="text-success bs-tooltip rounded" data-delay="200" data-toggle="tooltip" data-placement="top" title="Maximum Price" data-original-title="Maximum Price">
												<?php is($value->sell_price, 'price'); ?>
											</p>
										<?php endif; ?>
									</td>

									<td>
										<?php is($value->extra_field, 'show'); ?>
									</td>

									<td>
										<p class="mb-0 admin-name">
											<?php is($value->project, 'showCapital'); ?>
										</p>
									</td>

									<td class="text-center">
										<?php is($value->category, 'showCapital'); ?>
									</td>

									<td class="text-center">
										<p class="mb-0 admin-name">
											<?php is($value->created_by, 'showCapital'); ?>
										</p>
									</td>
									<td class="text-center">
										<span class="badge px-2 py-1 badge-<?php is(get_status($value->status)->class, 'show'); ?>">
											<?php is(get_status($value->status)->title, 'show'); ?>
										</span>
									</td>
									<td>
										<?php is($value->created_date, 'datetime'); ?>
									</td>
									<td class="text-center">
										<ul class="table-controls">
											<li>
												<a href="<?php echo SITE_URL . 'property/' . $value->slug; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-6 mb-1">
														<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
														<circle cx="12" cy="12" r="3" />
													</svg>
												</a>
											</li>

											<?php if (user_can('property_edit')) : ?>
												<li>
													<a href="<?php echo SITE_URL . 'edit/property/' . $value->slug; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
															<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
															</path>
														</svg>
													</a>
												</li>
											<?php endif; ?>

											<?php if (user_can('property_delete')) : ?>
												<li>
													<a href="<?php echo SITE_URL . 'delete/property/' . $value->slug; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
															<polyline points="3 6 5 6 21 6"></polyline>
															<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
															</path>
														</svg>
													</a>
												</li>
											<?php endif; ?>
										</ul>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr class="text-center">
							<th>#</th>
							<th class="text-left">Name</th>
							<th class="text-center">Image</th>
							<th>Price</th>
							<th>size</th>
							<th>Project</th>
							<th class="text-center">Category</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
