<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($orderData->type) or breadcrumb_start($orderData->type, 'add/order', 'order_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th class="text-left">Order ID</th>
							<th class="text-center">Customer</th>
							<th>Price</th>
							<th class="text-center">Payment Mode</th>
							<th class="text-center">Payment Status</th>
							<th class="text-center">Created By</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php if (is($orderData) and is($orderData->data)) :
							$i = 1;
							foreach ($orderData->data as $key => $value) : ?>
								<tr>
									<td><?php echo $i++; ?>.</td>

									<td class="text-left pb-4">
										<?php is($value->order_group_id, 'show'); ?>
									</td>

									<td>
										<?php is($value->first_name, 'showCapital'); ?>&nbsp;
										<?php is($value->last_name, 'showCapital'); ?>
									</td>

									<td class="text-center">
										<p class="text-success bs-tooltip rounded" data-delay="200" data-toggle="tooltip" data-placement="top" title="Total Price" data-original-title="Total Price">
											<?php is($value->price, 'price'); ?>
										</p>
									</td>

									<td class="text-center">
										<?php is($value->payment_mode, 'showCapital'); ?>
									</td>

									<td class="text-center">
										<?php is($value->payment_status, 'showCapital'); ?>
									</td>

									<td class="text-center">
										<p class="mb-0 admin-name">
											<?php is($value->created_by, 'showCapital'); ?>
										</p>
									</td>

									<td>
										<?php if (!is_null($value->created_date)) : ?>
											<?php echo date('M d, Y', strtotime($value->created_date)),
												' At<br>',
												date('h: i A', strtotime($value->created_date)); ?>
										<?php endif; ?>
									</td>

									<td class="text-center">
										<ul class="table-controls">
											<li>
												<a href="<?php echo SITE_URL . 'order/' . $value->order_group_id; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-6 mb-1">
														<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
														<circle cx="12" cy="12" r="3" />
													</svg>
												</a>
											</li>

											<?php if (user_can('order_edit')) : ?>
												<li>
													<a href="<?php echo SITE_URL . 'edit/order/' . $value->order_group_id; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
															<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
															</path>
														</svg>
													</a>
												</li>
											<?php endif; ?>

											<?php if (user_can('order_delete')) : ?>
												<li>
													<a href="<?php echo SITE_URL . 'delete/order/' . $value->order_group_id; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
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
							<th class="text-left">Order ID</th>
							<th class="text-center">Customer</th>
							<th>Price</th>
							<th class="text-center">Payment Mode</th>
							<th class="text-center">Payment Status</th>
							<th class="text-center">Created By</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>