<?php breadcrumb_start('tests', 'list/tests', 'test_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="testTitle" name="testTitle" placeholder="Test Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
				</div>
				<!-- Test Image -->
				<?php file_input('testImg', false); ?>

				<button type="submit" name="addTest" value="dgsdfse" class="btn btn-primary mt-4">Add Test</button>
			</form>
		</div>
	</div>
</div>
