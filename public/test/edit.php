<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($filterData) and show_404() or breadcrumb_start('Filters', 'list/filters', 'filter_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row mb-4">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="filterTitle" placeholder="Filter Title *" value="<?php is($filterData->filter_title, 'showCapital'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>
				<!-- Filter Image -->
				<?php file_input('filterImg', false, $filterData->image); ?>
				<div class="row">
					<div class="col-md-6 text-center">
						<?php checkbox_input('autoAdd', '1', 'Auto Add', $filterData->auto_add, 'primary'); ?>
					</div>
					<div class="col-md-6 text-center">
						<?php checkbox_input('type', '1', 'Multiple', $filterData->type, 'primary'); ?>
					</div>
				</div>

				<button type="submit" name="editFilter" value="dgsdfse" class="btn btn-primary mt-4">Update Filter</button>
			</form>
		</div>
	</div>
</div>
