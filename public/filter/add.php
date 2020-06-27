<?php breadcrumb_start('filters', 'list/filters', 'filter_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-8">
						<!-- Filter Title -->
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="filterTitle" name="filterTitle" placeholder="Filter Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-4">
						<!-- Filter Type -->
						<div class="form-group mb-4">
							<select class="selectpicker form-control" name="postType" data-live-search="true" title=" Select A Filter Type">
								<?php user_can('product_add') and print('<option value="product">Product Filter</option>'); ?>
								<?php user_can('property_add') and print('<option value="property">Property Filter</option>'); ?>
								<?php user_can('event_add') and print('<option value="event">Event Filter</option>'); ?>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>
				<!-- Filter Image -->
				<?php file_input('filterImg', false); ?>

				<!-- Additional Options -->
				<div class="row">
					<div class="col-md-6 text-center">
						<?php checkbox_input('autoAdd', '1', 'Auto Add'); ?>
					</div>
					<div class="col-md-6 text-center">
						<?php checkbox_input('type', '1', 'Multiple'); ?>
					</div>
				</div>

				<button type="submit" name="addFilter" value="dgsdfse" class="btn btn-primary mt-4">Add Filter</button>
			</form>
		</div>
	</div>
</div>