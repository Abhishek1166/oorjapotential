<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($contentData->type) or breadcrumb_start($contentData->type, 'add/content', 'category_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th class="text-left">Name</th>
							<th>Course_id</th>
							<th class="w-25">Image</th>
							<th>YT_url</th>
							<th class="text-left">Created On</th>
							<th class="text-left">Status</th>

							<?php if (user_can('content_edit') or user_can('content_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php $i = 1;
						if (is($contentData, 'json') and is($contentData->data, 'array')) :

							foreach ($contentData->data as $key => $value) : ?>
								<tr>
									<td><?php echo $i++; ?>.</td>
									<td class="text-left">
										<p class="align-self-center mb-0 admin-name">
											<?php is($value->title, 'showCapital'); ?>
										</p>
									</td>


									<td class="text-left">
										<p class="align-self-center mb-0 admin-name">
											<?php is($value->course_id, 'show'); ?>
										</p>
									</td>




									<td>
										<div class="mr-2 mx-auto w-50 rounded-lg">
											<?php if (is($value->course_id)) : ?>
												<img src="<?php is($value->course_id, 'show'); ?>" class="img-fluid shadow rounded-lg" alt="<?php is($value->title, 'show'); ?>">
											<?php else : ?>
												<p>Image Not Found</p>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<?php is($value->yt_url, 'show'); ?>
									</td>

									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php is($value->created_on, 'show'); ?>
										</p>
									</td>
									<td class="text-left">
										<span class="badge px-2 py-1 badge-<?php is(get_status($value->status)->class, 'show'); ?>">
											<?php is(get_status($value->status)->title, 'show'); ?>
										</span>
									</td>


									<?php if (user_can('content_edit') or user_can('content_delete')) : ?>
										<td class="text-center">
											<ul class="table-controls">
												<?php if (user_can('content_edit')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'edit/content/' . $value->id; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
																<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
																</path>
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (user_can('content_delete')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'delete/category/' . $value->id; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
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
							<th>#</th>
							<th class="text-left">Name</th>
							<th class="w-25">Image</th>
							<th>Course_id</th>
							<th>YT_url</th>
							<th class="text-left">Created On</th>
							<th class="text-left">Status</th>
							<?php if (user_can('content_edit') or user_can('content_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</tfoot>
				</table>
			</div>