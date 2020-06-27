<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php empty($orders) and show_404() or breadcrumb_start('Orders', 'list/orders', 'order_list'); ?>
<div class="row" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6 shadow">
			<form class="p-3" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<?php foreach ($orders as $val) {
							$product[] = $val->product_id;
						} ?>
						<div class="form-group">
							<label>Products</label>
							<select class="form-control withoutTagging" multiple="multiple" data-tags="true" data-placeholder="Select Products" name="product[]">
								<?php if (is($products, 'array'))
									foreach ($products as $value) : ?>
									<option <?php in_array($value->id, $product) and print('selected'); ?> value="<?php is($value->id, 'show'); ?>">
										<?php is($value->title, 'showCapital'); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<!-- Status -->
					<div class="col-md-6">
						<div class="form-group mb-4">
							<select class="selectpicker form-control" name="status" data-live-search="true" title=" Select A Status">
								<?php foreach ($delivery as $key => $value) : ?>
									<option <?php check_selected($key, $orders['0']->delivery_status, 'selected') ?> value="<?php is($key, 'show'); ?>">
										<?php is($value, 'showCapital'); ?>
									</option>
								<?php endforeach; ?>
							</select>

							<select class="mt-3 selectpicker form-control" name="paymentStatus" data-live-search="true" title=" Select A Payment Status">
								<?php foreach ($payments as $key => $value) : ?>
									<option <?php check_selected($key, $orders['0']->payment_status, 'selected') ?> value="<?php is($key, 'show'); ?>">
										<?php is($value, 'showCapital'); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<!-- Customer -->
					<div class="col-md-6">
						<div class="form-group mb-4">
							<select class="selectpicker form-control" name="user" data-live-search="true" title=" Select A Customer">
								<?php if (is($users, 'array'))
									foreach ($users as $value) : ?>
									<option <?php check_selected($value->id, $orders['0']->user_id, 'selected') ?> value="<?php is($value->id, 'show'); ?>">
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
								<option <?php check_selected('online', $orders['0']->payment_mode, 'selected') ?> value="online">Online</option>
								<option <?php check_selected('cod', $orders['0']->payment_mode, 'selected') ?> value="cod">COD</option>
							</select>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

					<div class="col-md-12">
						<!-- Order Remarks -->
						<div class="form-group">
							<textarea name="remark" id="remark" rows="3" class="form-control" placeholder="Order Remarks"><?php is($orders['0']->remark, 'show'); ?></textarea>
							<small class="form-text text-muted">
								<span class="text-danger mr-1">*</span>Required Fields
							</small>
						</div>
					</div>

				</div>
				<button type="submit" name="editOrder" value="dyhkiw3r" class="btn btn-primary mt-4">Update Order</button>
			</form>
		</div>
	</div>
</div>