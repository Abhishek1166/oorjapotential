<?php breadcrumb_start('leads', 'list/leads', 'lead_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email address *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="mobile" name="mobile" minlength="10" maxlength="10" placeholder="Mobile Number *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
						<div class="form-group">
							<input type="text" name="requirement" id="requirement" cols="30" rows="4" class="form-control" placeholder="Lead's Requirement *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Select Next FollowUp Date" name="followDate" id="myFlatDate">
						</div>
						<div class="form-group">
							<textarea name="comment" id="comment" cols="30" rows="3" class="form-control" placeholder="Comments For Lead"></textarea>
						</div>
						<div class="form-group">
							<input type="text" name="leadFrom" id="leadFrom" cols="30" rows="4" class="form-control" placeholder="Lead From">
						</div>
					</div>
				</div>

				<button type="submit" name="addLeads" value="adfedsfe" class="btn btn-primary mt-4">Add Lead</button>
			</form>
		</div>
	</div>
</div>
