<?php breadcrumb_start('gallery', 'list/galleries', 'gallery_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">

					<div class="col-md-12">
						<div class="form-group">
							<select class="selectpicker form-control tagging" name="img_group" data-live-search="true" title=" Select Image Group ">
								<?php foreach ($gal as $value) : ?>
									<option value="<?php echo $value->img_group;
													?>">
										<?php echo ucwords($value->img_group); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
				</div>

				<?php file_input('galleryImg[]', true, null, 60, true); ?>

				<button type="submit" name="addGallery" value="sfddsfs" class="btn btn-primary mt-4">Add Gallery</button>
			</form>
		</div>
	</div>
</div>
