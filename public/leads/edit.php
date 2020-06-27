<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($leadData) and show_404() or breadcrumb_start('leads', 'list/leads', 'lead_list'); ?>

<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name *" value="<?php is($leadData->first_name, 'showCapital'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name *" value="<?php is($leadData->last_name, 'showCapital'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email address *" value="<?php is($leadData->email, 'show'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" minlength="10" maxlength="10" id="mobile" name="mobile" placeholder="Mobile Number *" value="<?php is($leadData->mobile, 'show'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
						<div class="form-group">
							<input type="text" name="requirement" id="requirement" cols="30" rows="4" class="form-control" placeholder="Lead's Requirement *" value="<?php is($leadData->requirement, 'showCapital'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
						<div class="form-group">
							<div class="n-chk form-control border-0">
								<label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
									<input type="checkbox" <?php $leadData->is_pinned === '1' and print('checked'); ?> name="pin" class="new-control-input">
									<span class="new-control-indicator"></span> Pinned
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Select Next FollowUp Date" name="followDate" id="myFlatDate" value="<?php is($leadData->followup_date, 'show'); ?>">
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
						<div class="form-group">
							<textarea name="comment" id="comment" cols="30" rows="3" class="form-control" placeholder="Comments For Lead"><?php is($leadData->comment, 'showCapital'); ?></textarea>
						</div>
						<div class="form-group">
							<input type="text" name="leadFrom" id="leadFrom" cols="30" rows="4" class="form-control" placeholder="Lead From" value="<?php is($leadData->lead_from, 'showCapital'); ?>">
						</div>
						<div class="form-group">
							<select class="selectpicker form-control" name="status" data-live-search="true" title=" Select Status ">
								<option <?php check_selected_option('0', $leadData->status) ?>> New </option>
								<option <?php check_selected_option('11', $leadData->status) ?>> Contacted </option>
								<option <?php check_selected_option('12', $leadData->status) ?>> Interested </option>
								<option <?php check_selected_option('1', $leadData->status) ?>> Customer </option>
								<option <?php check_selected_option('13', $leadData->status) ?>> Propsal Sent </option>
								<option <?php check_selected_option('14', $leadData->status) ?>> Not Interested </option>
								<option <?php check_selected_option('15', $leadData->status) ?>> Not Convanced </option>
							</select>
							<small class="form-text text-muted"><span class="text-danger mr-1">*</span>Required Fields</small>
						</div>
					</div>
				</div>

				<button type="submit" name="editLeads" value="adfedsfe" class="btn btn-primary mt-4">Update Lead</button>
			</form>
		</div>
	</div>
</div>