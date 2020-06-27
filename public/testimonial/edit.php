<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($testimonialData) and show_404() or breadcrumb_start('Testimonial', 'list/testimonials', 'testimonial_list');
?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" minlength="3" maxlength="50" id="filterTitle" name="name" value="<?php is($testimonialData->name, 'show') ?>" placeholder="Name *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" minlength="1" maxlength="1" class="form-control" id="filterTitle" name="rating" value="<?php is($testimonialData->rating, 'show') ?>" placeholder="Rating+ *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group mb-4">
							<textarea class="form-control" minlength="5" maxlength="200" rows="4" id="comment" name="comment" placeholder="Review"><?php is($testimonialData->comment, 'show') ?></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>

				<!-- Category Image -->
				<?php file_input('testimonialImg', true, $testimonialData->image); ?>

				<button type="submit" name="edittestimonial" value="sfddsfs" class="btn btn-primary mt-4">Update Testimonial</button>
			</form>
		</div>
	</div>
</div>
