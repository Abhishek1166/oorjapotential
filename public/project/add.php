<?php breadcrumb_start('projects', 'list/projects'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="projectTitle" name="projectTitle" placeholder="Project Title *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group mb-4">
							<textarea name="projectDesc" id="projectDesc" class="form-control" placeholder="Project Description"></textarea>
							<!-- <small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small> -->
						</div>
					</div>
				</div>
				<!-- Project Image -->
				<?php file_input('projectImg', true); ?>

				<button type="submit" name="addProject" value="dgsdfse" class="btn btn-primary mt-4">Add Project</button>
			</form>
		</div>
	</div>
</div>