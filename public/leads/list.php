<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($userData->type) or breadcrumb_start($userData->type, 'add/lead', 'lead_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr>
							<th style="width: 1%">#</th>
							<th style="width: 15%">Name</th>
							<th style="width: 15%">Requirement</th>
							<th style="width: 15%">comment</th>
							<th style="width: 15%">Next FollowUp Date</th>
							<th>Status</th>
							<th>Created date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (is($userData) and is($userData->data, 'array')) :
							$i = 1;
							foreach ($userData->data as $key => $value) :
								$value->status === '0' and $status = ' New ' and $class = 'dark';
								$value->status === '1' and $status = ' CUSTOMER ' and $class = 'primary';
								$value->status === '11' and $status = ' Contacted ' and $class = 'info';
								$value->status === '12' and $status = ' Interested ' and $class = 'success';
								$value->status === '13' and $status = ' Proposal Sent ' and $class = 'secondary';
								$value->status === '14' and $status = ' Not Interested ' and $class = 'danger';
								$value->status === '15' and $status = ' Not Convanced ' and $class = 'warning';
								$value->status === '16' and $status = ' Contact Us ' and $class = 'info';
								if ($value->status !== '14' or $value->status !== '15') : ?>
									<tr>
										<td><?php echo $i++; ?>.</td>
										<td>
											<span class="pr-3 py-0 <?php $i == 1 or print('mt-3'); ?>  d-block position-relative">
												<span>
													<p class="admin-name mb-0">
														<?php is($value->first_name, 'showCapital'); ?>&nbsp;
														<?php is($value->last_name, 'showCapital'); ?>
													</p>
												</span>
												<?php if (is($value->is_pinned) and $value->is_pinned === '1') : ?>
													<span class="badge counter">
														<div class="t-dot bg-primary" data-toggle="tooltip" data-placement="top" title="Pinned" data-original-title="Pinned"></div>
													</span>
												<?php endif; ?>
											</span>
											<?php if (is($value->mobile)) : ?>
												<p class="mb-0 mt-2">
													<a href="tel://+91<?php is($value->mobile, 'show'); ?>">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call text-success br-6 mb-1 p-1">
															<path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
														</svg>
														+91<?php is($value->mobile, 'show'); ?>
													</a>
												</p>
											<?php endif; ?>
										</td>
										<td>
											<span style="word-break: break-all;">
												<?php is($value->requirement, 'showCapital'); ?>
											</span>
										</td>
										<td>
											<?php if (strlen($value->comment) >= 26) : ?>
												<span style="word-break: break-all;">
													<?php echo ucfirst(substr($value->comment, 0, 26)); ?>
												</span>
												<span class="text-warning font-weight-bold pointer" data-toggle="collapse" data-target="#showmore_<?php is($value->id, 'show'); ?>" aria-expanded="false" aria-controls="showmore_<?php is($value->id, 'show'); ?>">
													more...
												</span>

												<div class="collapse" style="word-break: break-all;" id="showmore_<?php is($value->id, 'show'); ?>">
													<?php echo ucfirst(substr($value->comment, 26)) ?>
												</div>
											<?php else :
												is($value->comment, 'showCapital');
											endif; ?>
										</td>
										<td>
											<?php if (is($value->followup_date)) : ?>
												<?php echo date('M d, Y', strtotime($value->followup_date)),
													' At<br>',
													date('h: i A', strtotime($value->followup_date)); ?>
											<?php else : ?>
												Next FollowUp Date Not Set Yet.
											<?php endif; ?>
										</td>
										<td>
											<span class="badge px-2 py-1 badge-<?php is($class, 'show'); ?>">
												<?php is($status, 'showCapital'); ?>
											</span>
										</td>
										<td>
											<?php if (is_numeric($value->created_date)) : ?>
												<?php echo date('M d, Y', $value->created_date),
													' At<br>',
													date('h: i A', $value->created_date); ?>
											<?php else : ?>
												<?php echo date('M d, Y', strtotime($value->created_date)),
													' At<br>',
													date('h: i A', strtotime($value->created_date)); ?>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<ul class="table-controls">
												<?php if (is($value->mobile)) : ?>
													<li class="d-block d-md-none">
														<a href="tel://+91<?php is($value->mobile, 'show'); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="Call" data-original-title="Call">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call p-1 br-6 mb-1">
																<path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (is($value->email)) : ?>
													<li>
														<a href="mailto://<?php is($value->email, 'show'); ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php is($value->email, 'show'); ?>">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail p-1 br-6 mb-1">
																<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
																<polyline points="22,6 12,13 2,6" />
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (user_can('lead_edit')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'edit/lead/' . $value->username; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
																<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
																</path>
															</svg>
														</a>
													</li>
												<?php endif; ?>

												<?php if (user_can('lead_delete')) : ?>
													<li>
														<a href="<?php echo SITE_URL . 'delete/lead/' . $value->username; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
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
							<?php endif;
							endforeach; ?>
						<?php endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Requirement</th>
							<th>comment</th>
							<th>Next FollowUp Date</th>
							<th>Status</th>
							<th>Created date</th>
							<th class="text-center">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>