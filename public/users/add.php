<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php breadcrumb_start('User Group Roles', 'list/roles', 'user-role_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">

				<!-- First Name & Last Name -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="email" name="email" placeholder="Email address *">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number Without Country Code *" minlength="10" maxlength="10">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<?php if (is($roles) and is_array($roles)) : ?>
								<select class="selectpicker form-control" name="userRole" data-live-search="true" title=" Select User Role ">
									<?php foreach ($roles as $key => $value) : ?>
										<?php if ($value->created_by === $_SESSION['USER_ID'] or $value->id === $_SESSION['USER_ROLE']) : ?>
											<option value="<?php is($value->id, 'show'); ?>">
												<?php is($value->group_title, 'showCapital') ?>
											</option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								<small class="form-text text-muted">
									<span class="text-danger mr-1">*</span>Required Fields
								</small>
							<?php else : ?>
								<span class="border-0 text-center bg-light form-control">
									User Group Role Not Exists Yet.
								</span>
							<?php endif; ?>

						</div>
					</div>
				</div>

				<!-- Upload Images -->
				<?php file_input('myImg'); ?>
				<div class="row">
					<div class="col-md-12 mt-3">
						<div class="form-group">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password *" minlength="3">
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-primary mt-4" name="addUsers" value="AddUSers">Add User</button>
			</form>
		</div>
	</div>
</div>