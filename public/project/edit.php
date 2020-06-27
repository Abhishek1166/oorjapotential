<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($filterData) and show_404() or breadcrumb_start('Projects', 'list/filters'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="filterTitle" placeholder="Project Title *" value="<?php is($filterData->filter_value_title, 'show'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
				</div>
				<!-- Project Image -->
				<?php file_input('filterImg', false, $filterData->image); ?>

				<button type="submit" name="editProject" value="dgsdfse" class="btn btn-primary mt-4">Update Project</button>
			</form>
		</div>
	</div>
</div>
