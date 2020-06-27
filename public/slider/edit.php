<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($sliderData) and show_404() or breadcrumb_start('slider', 'list/sliders', 'slider_list');
?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="title" value="<?php is($sliderData->title, 'show') ?>" placeholder="Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
					<div class="col-md-4">
						<div class="form-group mb-4">
							<textarea class="form-control" rows="0" id="comment" name="description" value="" placeholder="D+escription"><?php is($sliderData->description, 'show') ?></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="rederect_link" value="<?php is($sliderData->title, 'show') ?>" placeholder="Redirect Link+ *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
				</div>

				<!-- Category Image -->
				<?php file_input('sliderImg', true, $sliderData->image); ?>

				<button type="submit" name="editSlider" value="sfddsfs" class="btn btn-primary mt-4">Update Slider</button>
			</form>
		</div>
	</div>
</div>