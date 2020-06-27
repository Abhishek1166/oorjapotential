<?php breadcrumb_start('categories', 'list/content', 'category_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="title" name="title" placeholder="Video Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<!-- course_id -->
					<br>
					<div class="form-group mb-6">

						<select class="selectpicker form-control" name="course_id" data-live-search="true" title=" Select course_id ">
							<?php if (!empty($product)) foreach ($product as $value) : ?>
								<option value="<?php echo $value->id; ?>">
									<?php echo ucwords($value->title); ?>
								</option>
							<?php endforeach; ?>
						</select>
						<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
					</div>
					<!-- course_id end -->
					<!-- YT_url -->
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="title" name="yt_url" placeholder="YT_url *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<!-- YT_url end -->


				</div>

				<!-- Category Image -->
				<?php file_input('dp_image'); ?>

				<button type="submit" name="addContent" value="sfddsfs" class="btn btn-primary mt-4">Add Content</button>
			</form>
		</div>
	</div>
</div>