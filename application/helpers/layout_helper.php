<?php


function searchSide()
{
?>
	<p>Prperties to buy in <span class="orange-color">Your City</span></p>
	<ul class="nav nav-tabs nav-tabs-lisitng nav-tab-50" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BUY</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">RENT</a>
		</li>
	</ul>
	<div class="tab-content custom-tab-lisiting" id="myTabContent" style="padding: 40px;background: rgb(127, 51, 101);">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<div class="input-group">
				<div class="input-group-prepend">
					<select class="form-control selectForm">
						<option>Kota</option>
						<option>Jaipur</option>
						<option>Delhi</option>
						<option>Mumbai</option>
					</select>
				</div>
				<input type="text" class="form-control form-height-40" aria-label="Amount (to the nearest dollar)">
			</div>
			<a href="<?php echo SITE_URL; ?>search/property">
				<button class="btn search-btn w-100 mt4 xsmt4" type="button">Search</button>
			</a>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<div class="input-group">
				<div class="input-group-prepend">
					<select class="form-control selectForm">
						<option>Kota</option>
						<option>Jaipur</option>
						<option>Delhi</option>
						<option>Mumbai</option>
					</select>
				</div>
				<input type="text" class="form-control form-height-40" aria-label="Amount (to the nearest dollar)">
			</div>
			<a href="<?php echo SITE_URL; ?>search/property">
				<button class="btn search-btn w-100 mt4 xsmt4" type="button">Search</button>
			</a>
		</div>
	</div>
<?php
}


function getCallBack()
{ ?>
	<div class="callback-form mb10 xsmb4">
		<div class="text-center">Get a Call Back</div>
		<form action="<?php echo SITE_URL; ?>get-a-call-back" method="post" id="callBack">
			<div class="form-group">
				<label>Name*</label>
				<input type="text" name="name" class="form-control" placeholder="Name*" required>
			</div>
			<div class="form-group">
				<label>Email*</label>
				<input type="email" name="email" class="form-control" placeholder="Email*" required>
			</div>
			<div class="form-group">
				<label>Mobile No.*</label>
				<input type="number" minlength="10" maxlength="10" name="mobile" class="form-control" placeholder="Mobile No.*" required>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<button type="submit" name="submit" value="jhj" class="btn subscribe-btn subscribe-btn-40 bradius5 w-100">
							Submit
						</button>
					</div>
					<div class="col-sm-6">
						<a href="javascript:void(0)" onclick="document.getElementById('callBack').reset();" class="btn w-100 white-color">Reset</a>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php }

function is_page_active(string $pageName = 'home')
{
	return check_current_method($pageName) and print('current active');
}

/*
 * ---------------------------------------------------------------------------------------
 * 								BREADCRUMB_START
 * ---------------------------------------------------------------------------------------
 */
if (!function_exists('breadcrumb_start')) {

	/** `breadcrumb_start`
	 *
	 * Breadcrumb HTML Style
	 *
	 * @param string $title Page Title
	 * @param string $location Btn Redirect Location
	 * @param string $power Current User Power
	 * @param string $btnText Btn label
	 * @return void */
	function breadcrumb_start(string $title = null, string $location = null, string $power = null, string $btnText = null)
	{
		$ci = &get_instance();
		$page = $ci->router->fetch_class();
		$title = ucwords($title);
		if (strtolower($page) !== 'admin') : ?>

			<?php
			// var_dump($ci->router->fetch_class());
			// var_dump($ci->router->fetch_method());
			?><?php $string = explode('_', $ci->router->fetch_method()); ?>
			<div class="page-header d-block d-md-flex py-3 mb-2 mt-3">
				<div class="page-title float-none border-right align-self-center m-0 text-center mr-md-3 pr-md-3">
					<h3><?php is($title, 'show'); ?></h3>
				</div>

				<div class="breadcrumb-four" aria-label="breadcrumb">
					<ul class="breadcrumb">
						<li>
							<a href="<?php echo SITE_URL ?>dashboard">
								<?php echo ICONS['dashboard']; ?>
							</a>
						</li>
						<li class="active">
							<?php $string[1] = str_replace('contactus', 'contact', $string[1]);
							$icon = strtolower($ci->router->fetch_class());
							in_array($icon, ['slider', 'testimonial', 'gallery']) and $icon = 'misc';
							?>
							<a href="javascript:void(0);">
								<?php echo ICONS[$icon]; ?>
								<span><?php echo $title; ?></span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<?php echo ICONS['list']; ?>
								<span>
									<?php echo ucwords($string[1] . ' ' . $string[0]); ?>
								</span>
							</a>
						</li>
					</ul>
				</div>

				<?php if (!is_null($power) and user_can($power)) : ?>
					<a href="<?php echo SITE_URL . $location; ?>" class="ml-auto mr-0">
						<button class="btn btn-primary btn-lg">
							<?php if (!is_null($btnText)) {
								echo $btnText;
							} else {
								(strpos($ci->router->fetch_method(), 'add') !== false and print('Back To ')) or (strpos($ci->router->fetch_method(), 'edit') !== false and print('Back To ')) or print('Add New ');
								echo $title;
							} ?>
						</button>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php }
}

function select_input(string $nameContainer = null, array $options = null, $condition = null, string $title = null, bool $autoAdd = false, bool $multiple = false)
{ ?>
	<div class="form-group">
		<label>
			<?php is($title, 'Capital'); ?>
		</label>
		<select class="form-control <?php is($autoAdd) and print ('tagging') or print('withoutTagging'); ?>" <?php is($multiple) and print('multiple="multiple"'); ?> data-tags="true" data-placeholder="Select a <?php is($title, 'Capital'); ?>" name="<?php is($nameContainer, 'show'); ?>">
			<?php $multiple
				or print('<option selected disabled>Select a ' . ucfirst($title) . '</option>'); ?>

			<?php if (is($options, 'array'))
				foreach ($options as $optionValue) : ?>
				<?php is($condition, 'array')
						and is($condition['filter_id'])
						and $optionValue->filter_key_id === $condition['filter_id']
						and print('<option value="' . ucwords($optionValue->id) . '">' . ucwords($optionValue->filter_value_title) . '</option>'); ?>

				<?php is($condition, 'array')
						or print('<option value="' . ucwords($optionValue->id) . '">' . ucwords($optionValue->title) . '</option>'); ?>
			<?php endforeach; ?>
		</select>
	</div>
<?php
}


function checkbox_input(string $nameConatiner = null, string $value = null, string $checkBoxText = null, string $selected = null, string $layoutClass = 'info')
{ ?>
	<div class="n-chk">
		<label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-<?php is($layoutClass, 'show'); ?>">
			<input type="checkbox" class="new-control-input" name="<?php is($nameConatiner, 'show'); ?>" value="<?php is($value, 'show'); ?>" <?php is($selected) and $selected === $value and print('checked'); ?>>
			<span class="new-control-indicator"></span>
			<span class="new-chk-content h6 mb-0">
				<?php is($checkBoxText, 'showCapital'); ?>
			</span>
		</label>
	</div>
<?php }



function text_input(string $NameContainer = null, bool $Require = true, string $OldValue = null, string $Placeholder)
{ ?>
	<div class="form-group mb-4">
		<input type="text" class="form-control" id="<?php echo $NameContainer; ?>" name="<?php echo $NameContainer; ?>" placeholder="<?php echo $Placeholder; ?> <?php $Require === true and print('*'); ?>" <?php $Require === true and print('required'); ?> value="<?php echo $OldValue; ?>">
		<?php if ($Require === true) : ?>
			<small class="form-text text-muted">
				<span class="text-danger mr-1">*</span>Required Fields
			</small>
		<?php endif; ?>
	</div>
<?php }
/* End of file Layout.php */
