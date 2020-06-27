<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($categoryData) and show_404() or breadcrumb_start('categories', 'list/categories', 'category_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="title" name="title" placeholder="Category Title *" minlength="3" value="<?php is($categoryData->title, 'showCapital'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<?php if (is($cats)) : ?>
						<div class="col-md-4">
							<div class="form-group">
								<select class="selectpicker form-control" id="cat" name="cat" data-live-search="true" title=" Select Perent Category ">
									<?php foreach ($cats as $value) : ?>
										<option <?php check_selected_option($value->id, $categoryData->parent_id); ?>>
											<?php is($value->title, 'showCapital'); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<small class="form-text text-muted">
									<span class="text-danger mr-1">*</span>Required Fields
								</small>
							</div>
						</div>
					<?php else : ?>
						<input type="hidden" name="cat" value="0">
					<?php endif; ?>

					<div class="col-md-4">
						<div class="form-group">
							<select class="selectpicker form-control" id="postType" name="postType" data-live-search="true" title=" Select A Category Type">
								<?php if (user_can('product_add') or user_can('product_edit')) : ?>
									<option value="product" <?php check_selected($categoryData->post_type, 'product', 'selected') ?>>Product Filter</option>
								<?php endif; ?>
								<?php if (user_can('property_add') or user_can('property_edit')) : ?>
									<option value="property" <?php check_selected($categoryData->post_type, 'property', 'selected') ?>>Property Filter</option>
								<?php endif; ?>
								<?php if (user_can('event_add') or user_can('event_edit')) : ?>
									<option value="event" <?php check_selected($categoryData->post_type, 'event', 'selected') ?>>Event Filter</option>
								<?php endif; ?>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>

				<!-- Category Image -->
				<?php file_input('catImg', true, $categoryData->image); ?>

				<button type="submit" name="editCategory" value="sfddsfs" class="btn btn-primary mt-4">Update Category</button>
			</form>
		</div>
	</div>
</div>