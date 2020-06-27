<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($settingData->type) or breadcrumb_start($settingData->type, 'add/setting', 'setting_add'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">

			<div class="table-responsive mb-4 mt-4">
				<table id="multi-column-ordering" class="style-3 table table-hover" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th class="text-center" style="width: 30%">Setting Name</th>
							<th class="text-left" style="width: 40%">Setting Value</th>
							<?php if (user_can('setting_edit')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php $i = 1;
						if (is($settingData, 'json') and is($settingData->data, 'array')) :
							foreach ($settingData->data as $key => $value) : ?>
								<tr>
									<td><?php echo $i++; ?>.</td>
									<td class="text-center">
										<p class="align-self-center mb-0 admin-name">
											<?php is($value->option_key) and print(ucwords(str_replace('_', ' ', str_replace('social_', '', str_replace('site_', '', $value->option_key))))); ?>
										</p>
									</td>

									<td class="text-left">
										<div class="mr-2 mx-auto rounded-lg">
											<?php if (is($value->option_value)) : ?>
												<?php if (search_in($value->option_value, ['.jpg', '.png', '.jpeg'])) : ?>
													<div class="w-25">
														<img src="<?php is($value->option_value, 'show'); ?>" class="img-fluid shadow rounded-lg" alt="<?php is($value->key, 'show'); ?>">
													</div>
												<?php elseif (search_in($value->option_value, 'https://maps.google.com')) : ?>
													<iframe width="100%" height="200" id="gmap_canvas" src="<?php is($value->option_value, 'show'); ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
												<?php elseif (search_in($value->option_value, ['https://', 'http://'])) : ?>
													<div class="linkPreview">
														<a href="<?php is($value->option_value, 'show'); ?>"><?php is($value->option_value, 'show'); ?></a>
													</div>
												<?php else : ?>
													<?php is($value->option_value, 'showCapital'); ?>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									</td>
									<?php if (user_can('setting_edit')) : ?>
										<td class="text-center">
											<ul class="table-controls">
												<li>
													<a href="<?php echo SITE_URL . 'edit/setting/' . $value->option_key; ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
															<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
															</path>
														</svg>
													</a>
												</li>
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
							<th>Setting Name</th>
							<th>Setting Value</th>
							<?php if (user_can('setting_edit')) : ?>
								<th>Action</th>
							<?php endif; ?>
						</tr>
					</tfoot>
				</table>
			</div>
