<?php breadcrumb_start('User Group Roles', 'list/roles', 'user-role_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="roleTitle" name="roleTitle" placeholder="User Group Role Name *">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<?php if (is($modules)) foreach ($modules as $value) : ?>
							<?php if (in_array($value->slug . '_add', $_SESSION['USER_POWER']) or in_array($value->slug . '_list', $_SESSION['USER_POWER']) or in_array($value->slug . '_edit', $_SESSION['USER_POWER']) or in_array($value->slug . '_delete', $_SESSION['USER_POWER'])) : ?>
								<div class="row p-3 mb-3 rounded-lg shadow-sm bg-light">
									<div class="col-md-4 ">
										<h5 class="mb-0">
											<?php is($value->module_title, 'showCapital'); ?>
										</h5>
									</div>
									<div class="col-md-2">
										<?php if (in_array($value->slug . '_add', $_SESSION['USER_POWER'])) {
											checkbox_input('powers[' . $value->slug . ':' . $value->id . '][create]', '1', 'Create',);
										} ?>
									</div>
									<div class="col-md-2">
										<?php if (in_array($value->slug . '_list', $_SESSION['USER_POWER'])) {
											checkbox_input('powers[' . $value->slug . ':' . $value->id . '][read]', '1', 'Read', '', 'success');
										} ?>
									</div>
									<div class="col-md-2">
										<?php if (in_array($value->slug . '_edit', $_SESSION['USER_POWER'])) {
											checkbox_input('powers[' . $value->slug . ':' . $value->id . '][update]', '1', 'Update', '', 'warning');
										} ?>
									</div>
									<div class="col-md-2">
										<?php if (in_array($value->slug . '_delete', $_SESSION['USER_POWER'])) {
											checkbox_input('powers[' . $value->slug . ':' . $value->id . '][delete]', '1', 'Delete', '', 'danger');
										} ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>

				<button type="submit" name="addRole" value="dgsdfse" class="btn btn-primary mt-4">Add User Role</button>
			</form>
		</div>
	</div>
</div>