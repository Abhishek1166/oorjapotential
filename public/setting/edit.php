<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($settingData) and show_404() or breadcrumb_start('settings', 'list/settings', 'setting_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<?php if (search_in($settingData->option_value, ['.jpg', '.png', '.jpeg'])) : ?>
					<?php file_input('option_value', true, $settingData->option_value); ?>
				<?php else : ?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group mb-4">
								<input type="text" class="form-control" id="option_value" name="option_value" placeholder="Setting Value *" minlength="1" value="<?php is($settingData->option_value, 'show'); ?>">
								<small class="form-text text-muted">
									<span class="text-danger mr-1">*</span>Required Fields
								</small>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<button type="submit" name="editSetting" value="sfddsfs" class="btn btn-primary mt-4">Update <?php is($settingData->option_key) and print(ucwords(str_replace('_', ' ', str_replace('social_', '', str_replace('site_', '', $settingData->option_key))))); ?></button>
			</form>
		</div>
	</div>
</div>
