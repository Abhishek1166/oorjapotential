<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($roleData->type) or breadcrumb_start($roleData->type, 'add/user-role', 'user-role_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th class="text-left">Group Name</th>
							<th class="text-left">Created By</th>
							<th class="text-left">Status</th>
							<th>Created date</th>
							<?php if (user_can('user-role_edit') or user_can('user-role_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php if (!empty($roleData) and !empty($roleData->data)) :
							$i = 1;
							foreach ($roleData->data as $key => $value) :
								$value->status === '0' and $status = ' New ' 	and $class = 'info';
								$value->status === '1' and $status = ' Active ' and $class = 'success';
								$value->status === '2' and $status = ' Draft ' 	and $class = 'dark';
								$value->status === '3' and $status = ' Delete ' and $class = 'danger'; ?>
								<tr>
									<td><?php echo $i++; ?>.</td>
									<td class="text-left">
										<?php if (user_can('admin_list')) : ?>
											<a href="<?php echo SITE_URL . 'list/all/' . $value->slug; ?>">
											<?php endif; ?>
											<p class="align-self-center mb-0 admin-name">
												<?php is($value->group_title, 'showCapital'); ?>
											</p>
											<?php if (user_can('admin_list')) : ?>
											</a>
										<?php endif; ?>
									</td>
									<td class="text-left">
										<p class="align-self-center mb-0 admin-name">
											<?php echo ucwords($value->first_name . ' ' . $value->last_name); ?>
										</p>
									</td>
									<td class="text-left">
										<span class="badge px-2 py-1 badge-<?php is($class, 'show'); ?>">
											<?php is($status, 'show'); ?>
										</span>
									</td>
									<td>
										<?php if (!is_null($value->created_date)) : ?>
											<?php echo date('M d, Y', strtotime($value->created_date)),
												' At<br>',
												date('h: i A', strtotime($value->created_date)); ?>
										<?php endif; ?>
									</td>

									<?php if (user_can('user-role_edit') or user_can('user-role_delete')) : ?>
										<td class="text-center">
											<ul class="table-controls">
												<?php if (user_can('user-role_edit')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'edit/user-role/' . $value->slug; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
																<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
																</path>
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (user_can('user-role_delete')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'delete/user-role/' . $value->slug; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
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
							<th class="text-left">Group Name</th>
							<th class="text-left">Created By</th>
							<th class="text-left">Status</th>
							<th>Created date</th>
							<?php if (user_can('user-role_edit') or user_can('user-role_delete')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</tfoot>
				</table>
			</div>