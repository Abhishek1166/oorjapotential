<?php

/** Show Alert Message */
function show_alert()
{
	if (is($_SESSION['FlashStatus'])) : ?>
		<div class="my-4">
			<div class="alert alert-<?php $_SESSION['FlashStatus'] == 'Success' and print ('success') or print('warning'); ?> alert-dismissible fade show" role="alert">
				<strong>
					<?php is($_SESSION['FlashTitle'], 'showCapital'); ?>,
				</strong>
				<?php is($_SESSION['FlashData'], 'showCapital'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	<?php endif;
}

/** Show Message
 * @return void */
function show_message()
{
	if (isset($_SESSION['FlashStatus']) and !empty($_SESSION['FlashStatus'])) : ?>
		<div class="alert bg-light alert-<?php $_SESSION['FlashStatus'] == 'Success' and print ('success') or print('danger'); ?> alert-dismissible w-lg-25 w-md-50  shadow fade show position-fixed" style="top:8%; right:1%; z-index: 9999;" role="alert">

			<?php if (isset($_SESSION['FlashTitle']) and !empty($_SESSION['FlashTitle'])) : ?>
				<div class="card-header py-3 mt-3 pl-3 border-0 bg-<?php $_SESSION['FlashStatus'] == 'Success' and print ('success') or print('danger'); ?> rounded-lg">
					<h5 class="text-white mb-0"><?= $_SESSION['FlashTitle']; ?></h5>
				</div>
			<?php endif; ?>

			<?php if (isset($_SESSION['FlashData']) and !empty($_SESSION['FlashData'])) : ?>
				<div class="alertMessage card-body ">
					<p class="text-dark font-weight-bold"><?= $_SESSION['FlashData']; ?></p>
				</div>
			<?php endif; ?>
			<button type="button" style="border:none; box-shadow:none; outline:none;" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="flashScreen"></div>
		<script>
			document.querySelector('.flashScreen').setAttribute('style', "position: absolute;top: 0;bottom: 0;left: 0;background: #fffad4;right: 0;z-index: 9998;");
			var audio = new Audio('<?php echo SITE_URL; ?>assets/audio/credulous.ogg');
			audio.play();
			setTimeout(() => {
				document.querySelector('.flashScreen').setAttribute('style', '');
			}, 800);
		</script>
<?php endif;
}

/** `Flash Message`
 *
 *
 * Set Flash Message & Redirect
 *
 * @param string        $location Controller Name without Site_url
 * @param bool          $conditions Check Conditions
 * @param string        $type Success or Unsuccess
 * @param string        $title Title Of Flash Message
 * @param string|null   $msg Optional Detailed Message */
function flash_message($location, $conditions, $type, $title, $msg = null)
{
	$ci = &get_instance();
	if (strtolower($type) == "success") {
		$conditions and $ci->session->set_flashdata('FlashStatus', "Success");
		$conditions and $ci->session->set_flashdata('FlashTitle', $title);
		$conditions and $ci->session->set_flashdata('FlashData', $msg);
		$conditions and redirect(SITE_URL . $location);
	} else {
		$conditions or $ci->session->set_flashdata('FlashStatus', "Unsuccess");
		$conditions or $ci->session->set_flashdata('FlashTitle', $title);
		$conditions or $ci->session->set_flashdata('FlashData', $msg);
		$conditions or redirect(SITE_URL . $location);
	}
}

/* End of file flash.php */
