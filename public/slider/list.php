<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($sliderData->type) or breadcrumb_start($sliderData->type, 'add/slider', 'slider_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th style="width: 2%">#</th>
							<th>Title</th>
							<th>Redirect Link</th>
							<th>Image</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php $i = 1;
						if (!empty($sliderData) and !empty($sliderData->data)) :

							foreach ($sliderData->data as $key => $value) :
								$value->status === '0' and $status = ' New ' 	and $class = 'info';
								$value->status === '1' and $status = ' Active ' and $class = 'success';
								$value->status === '2' and $status = ' Draft '  and $class = 'dark';
								$value->status === '3' and $status = ' Delete ' and $class = 'danger'; ?>
								<tr>
									<td><?php echo $i++; ?>.</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php echo ucwords($value->title); ?>
										</p>
									</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php echo ucwords($value->redirect_link); ?>
										</p>
									</td>
									<td>
										<div class="mr-2 mx-auto w-50 rounded-lg">
											<?php if (!empty($value->image)) : ?>
												<img src="<?php echo $value->image; ?>" class="img-fluid shadow rounded-lg" style="border: 2px solid #d3d3d3; height: 80px; width:80px " alt="">
											<?php else : ?>
												<p>Image Not Found</p>
											<?php endif; ?>
										</div>
									</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php echo ucwords($value->created_by); ?>
										</p>
									</td>
									<td class="text-center">
										<span class="badge px-2 py-1 badge-<?php echo $class; ?>">
											<?php echo $status; ?>
										</span>
									</td>
									<td>
										<?php if (!is_null($value->created_date)) : ?>
											<?php echo date('M d, Y', strtotime($value->created_date)),
												' At ',
												date('h: i A', strtotime($value->created_date)); ?>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<ul class="table-controls">
											<li>
												<a href="<?php echo SITE_URL . 'edit/slider/' . $value->id;  ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
														<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
														</path>
													</svg>
												</a>
											</li>
											<li>
												<a href="<?php echo SITE_URL . 'delete/slider/' . $value->id;  ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
														<polyline points="3 6 5 6 21 6"></polyline>
														<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
														</path>
													</svg>
												</a>
											</li>
										</ul>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
					<tfoot class="text-center">
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Redirect Link</th>
							<th>Image</th>
							<th class="text-center">Created By</th>
							<th class="text-center">Status</th>
							<th>Created date</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>