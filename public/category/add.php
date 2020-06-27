<?php breadcrumb_start('categories', 'list/categories', 'category_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="title" name="title" placeholder="Category Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<?php if (is($cats, 'array')) : ?>
						<div class="col-md-4">
							<div class="form-group">
								<select class="selectpicker form-control" name="cat" data-live-search="true" title=" Select Perent Category ">
									<?php foreach ($cats as $value) : ?>
										<option value="<?php is($value->id, 'show'); ?>">
											<?php is($value->title, 'showCapital'); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php else : ?>
						<input type="hidden" name="cat" value="'000'">
					<?php endif; ?>

					<div class="col-md-4">
						<div class="form-group">
							<select class="selectpicker form-control" name="postType" data-live-search="true" title=" Select Category Type ">
								<?php user_can('product_add') and print('<option value="product">Product Category</option>'); ?>
								<?php user_can('property_add') and print('<option value="property">Property Category</option>'); ?>
								<?php user_can('event_add') and print('<option value="event">Event Category</option>'); ?>
								<?php user_can('post_add') and print('<option value="post">Post Category</option>'); ?>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>

				<!-- Category Image -->
				<?php file_input('catImg'); ?>

				<button type="submit" name="addCategory" value="sfddsfs" class="btn btn-primary mt-4">Add Category</button>
			</form>
		</div>
	</div>
</div>
