<?php breadcrumb_start('orders', 'list/orders', 'order_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Products</label>
							<select class="form-control withoutTagging" multiple="multiple" data-tags="true" data-placeholder="Select Products" name="product[]">
								<?php if (is($products, 'array'))
									foreach ($products as $value) : ?>
									<option value="<?php is($value->id, 'show'); ?>">
										<?php is($value->title, 'showCapital'); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!-- Customer -->
					<div class="col-md-6">
						<div class="form-group mb-4">
							<select class="selectpicker form-control" name="user" data-live-search="true" title=" Select A Customer">
								<?php if (is($users, 'array'))
									foreach ($users as $value) : ?>
									<option value="<?php is($value->id, 'show'); ?>">
										<?php is($value->first_name, 'showCapital'); ?>&nbsp;
										<?php is($value->last_name, 'showCapital'); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<!-- Payment Mode -->
					<div class="col-md-6">
						<div class="form-group mb-4">
							<select class="selectpicker form-control" name="paymentMode" data-live-search="true" title=" Select Payment Mode ">
								<option value="online">Online</option>
								<option value="cod">COD</option>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<div class="col-md-12">
						<!-- Order Remarks -->
						<div class="form-group">
							<textarea name="remark" id="remark" rows="3" class="form-control" placeholder="Order Remarks"></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

				</div>
				<button type="submit" name="addOrder" value="dyhkiw3r" class="btn btn-primary mt-4">Add Order</button>
			</form>
		</div>
	</div>
</div>