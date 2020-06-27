<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($galleryData) and show_404() or breadcrumb_start('gallery', 'list/galleries', 'gallery_list');

// var_dump($galleryData);
// die;
?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">

					<div class="col-md-12">
						<div class="form-group">
							<select class="selectpicker form-control " name="img_group" data-live-search="true" title=" Select Image Group ">
								<?php foreach ($gal as $value) : ?>
									<option <?php check_selected($value->img_group, $galleryData->img_group, 'selected') ?> value="<?php echo $value->img_group; ?>">
										<?php echo ucwords($value->img_group); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
				</div>

				<?php file_input('galleryImg', true, $galleryData->image, 60); ?>

				<button type="submit" name="editGallery" value="sfddsfs" class="btn btn-primary mt-4">Update Gallery</button>
			</form>
		</div>
	</div>
</div>
