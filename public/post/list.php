<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($PostData->type) or breadcrumb_start($PostData->type, 'add/post', 'post_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th style="width: 2%">#</th>
							<th>Title</th>
							<th>Category</th>
							<th>Description</th>
							<th>Image</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<?php if (user_can('post_edit') or user_can('post_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php $i = 1;
						if (is($PostData, 'json') and is($PostData->data, 'array')) :
							foreach ($PostData->data as $key => $value) : ?>
								<tr>
									<td><?php echo $i++; ?>.</td>

									<td>
										<span class="pr-3 py-0 <?php $i == 1 or print('mt-3'); ?>  d-block position-relative">
											<span>
												<p class="admin-name mb-0">
													<?php is($value->title, 'showCapital'); ?>
												</p>
											</span>
											<?php if (is($value->is_pinned) and $value->is_pinned === '1') : ?>
												<span class="badge counter">
													<div class="t-dot bg-primary" data-toggle="tooltip" data-placement="top" title="Pinned" data-original-title="Pinned"></div>
												</span>
											<?php endif; ?>
										</span>
									</td>

									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php is($value->category_id, 'showCapital'); ?>
										</p>
									</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php if (strlen($value->description) >= 26) : ?>
												<span style="word-break: break-all;">
													<?php echo ucfirst(substr($value->description, 0, 26)); ?>
												</span>
												<span class="text-warning font-weight-bold pointer" data-toggle="collapse" data-target="#showmore_<?php is($value->id, 'show'); ?>" aria-expanded="false" aria-controls="showmore_<?php is($value->id, 'show'); ?>">
													more...
												</span>

												<div class="collapse" style="word-break: break-all;" id="showmore_<?php is($value->id, 'show'); ?>">
													<?php echo ucfirst(substr($value->description, 26)) ?>
												</div>
											<?php else :
												is($value->description, 'showCapital');
											endif; ?>
										</p>
									</td>
									<td>
										<div class="mr-2 mx-auto w-50 rounded-lg">
											<?php if (is($value->post_image)) : ?>
												<img src="<?php is($value->post_image, 'show'); ?>" class="img-fluid shadow rounded-lg" style="border: 2px solid #d3d3d3; height: 80px; width:80px " alt="<?php is($value->title, 'show'); ?>">
											<?php else : ?>
												<p>Image Not Found</p>
											<?php endif; ?>
										</div>
									</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
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
									<?php if (user_can('post_edit') or user_can('post_delete')) : ?>
										<td class="text-center">
											<ul class="table-controls">
												<?php if (user_can('post_edit')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'edit/post/' . $value->id;  ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
																<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
																</path>
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (user_can('post_delete')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'delete/post/' . $value->id;  ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
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
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
					<tfoot class="text-center">
						<tr>
							<th style="width: 2%">#</th>
							<th>Title</th>
							<th>Category</th>
							<th>Description</th>
							<th>Image</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<?php if (user_can('post_edit') or user_can('post_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</tfoot>
				</table>
			</div>
