<?php breadcrumb_start('comment', 'list/comments', 'comment_list'); ?>
<div class="row" id="cancel-row">

	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3 py-5" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="title" placeholder="Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>

					<div class="col-md-4">
						<select class="selectpicker form-control tagging" name="user_id" data-live-search="true" title=" Select Category ">
							<?php foreach ($users as $value) : ?>
								<option value="<?php echo $value->id;
												?>">
									<?php echo ucwords($value->first_name . ' ' . $value->last_name); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-md-4">
						<select class="selectpicker form-control tagging" name="post_id" data-live-search="true" title=" Select Category ">
							<?php foreach ($blogTitle as $value) : ?>
								<option value="<?php echo $value->id;
												?>">
									<?php echo ucwords($value->title); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<textarea class="form-control" rows="0" id="editor1" name="description" placeholder="Description"></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>

						</div>
						<div class="mb-4">
							<?php //checkbox_input('postCheck', '1', 'Pin Post', '', 'warning'); 
							?>
							<!-- <small>
								Tick The Box For Pinned This Post.
							</small> -->
						</div>
					</div>
				</div>

				<!-- Category Image -->
				<?php //file_input(''); 
				?>

				<!-- <div class="row">
					<div class="col-md-6">
						
					</div>
				</div> -->

				<div class="ml-xl-5">
					<button type="submit" name="addcomment" value="sfddsfs" class="ml-xl-4 btn btn-primary mt-4">Add Slider</button>
				</div>
			</form>
		</div>
	</div>
</div>