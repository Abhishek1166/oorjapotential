<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($PostData) and show_404() or breadcrumb_start('post', 'list/posts', 'post_list');
?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3 py-5" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="title" value="<?php is($PostData->title, 'show') ?>" placeholder="Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>

					<div class="col-md-6">
						<select class="selectpicker form-control tagging" name="category" data-live-search="true" title=" Select Category ">
							<?php if (is($category, 'array'))
								foreach ($category as $value) : ?>
								<option <?php check_selected($value->id, $PostData->category_id, 'selected') ?> value="<?php is($value->id, 'show'); ?>">
									<?php is($value->title, 'showCapital'); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<textarea class="form-control" rows="0" id="editor1" name="description" placeholder="Description"><?php is($PostData->description, 'show') ?></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
						<div class="mb-4">
							<?php checkbox_input(
								'postCheck',
								'1',
								'Pin Post',
								is($PostData->is_pinned) and $PostData->is_pinned === '1',
								'warning'
							); ?>

							<small>
								Tick The Box For Pinned This Post.
							</small>
						</div>
					</div>
				</div>

				<!-- Category Image -->
				<?php file_input('postImg', true, $PostData->post_image); ?>

				<div class="ml-xl-5">
					<button type="submit" name="editPost" value="sfddsfs" class="ml-xl-4 btn btn-primary mt-4">Update Post</button>
				</div>
			</form>
		</div>
	</div>
</div>
