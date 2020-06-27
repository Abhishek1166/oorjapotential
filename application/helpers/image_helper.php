<?php

/** Helpers Image_helper
 *
 * This Helpers for Upload Single & Multiple Images
 *
 * @package   CodeIgniter
 * @category  Helpers
 * @author    Krishna Gujjjar <krishnagujjjar@gmail.com> */


// -----------------------------------------------------------
// 						UPLOAD FUNCTION
// -----------------------------------------------------------
if (!function_exists('upload')) {
	/** `Upload Function`
	 *
	 * Upload Multiple Images
	 *
	 * @param array $container ['Folder_Name' => 'input_name_container', 'Folder_Name' => 'input_name_container']
	 * @param int|null $limit
	 * @return array
	 *
	 * @example FunctionCalling
	 * `$this->load->helper('image');
	 * upload($this, ['uploads' => 'image', 'uploads/prfff' => 'newDat'], 2);` */
	function upload($container, $limit = null)
	{

		/* Configation of Upload Library */
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['encrypt_name'] = true;

		/* Load Upload Library */
		$ci = &get_instance();
		$ci->load->library('upload') and $files = $_FILES;

		if (is_array($container)) {

			$data = [];

			foreach ($container as $key => $value) {

				/* Create Directory If not Exists */
				file_exists("./$key/") or mkdir("./$key/", 0777, true);

				/* Configations */
				$config['upload_path'] = "./$key/";
				$ci->upload->initialize($config);

				if ($_FILES[$value]['name'] != "") {

					if (is_string($_FILES[$value]['name']) and $_FILES[$value]['name'] != "") {
						if ($ci->upload->do_upload($value)) {
							$upload = $ci->upload->data();
							$data[$value][] = SITE_URL . "$key/" . $upload['file_name'];
						} else {
							$data[$value][] = $ci->upload->display_errors();
						}
					} elseif (is_array($_FILES[$value]['name']) and $_FILES[$value]['name'][0] != '') {

						/* Limited Images */
						(isset($limit) and !empty($limit) and is_int($limit)) and $limit = $limit or $limit = count($files[$value]['name']);

						for ($i = 0; $i < $limit; $i++) {

							$_FILES['userfile']['name']     = $files[$value]['name'][$i];
							$_FILES['userfile']['type']     = $files[$value]['type'][$i];
							$_FILES['userfile']['tmp_name'] = $files[$value]['tmp_name'][$i];
							$_FILES['userfile']['error']    = $files[$value]['error'][$i];
							$_FILES['userfile']['size']     = $files[$value]['size'][$i];

							if ($ci->upload->do_upload()) {
								$upload = $ci->upload->data();
								$data[$value][] = SITE_URL . "$key/" . $upload['file_name'];
							} else {
								$data[$value][] = $ci->upload->display_errors();
							}
						}
					}
				}
			}
			return $data;
		}
	}
}


// -----------------------------------------------------------
// 					FILE_INPUT FUNCTION
// -----------------------------------------------------------
if (!function_exists('file_input')) {
	/** Create File Input Container on HTML Page
	 *
	 * @param string $nameContainer Input Name Container
	 * @param bool $MultipleImages True When Multiple Image Uploads `Default is False`
	 * @return void */
	function file_input(string $nameContainer = null, bool $require = true, $oldImagePath = null, string $ImageHeight = "60", bool $MultipleImages = false)
	{
		if (!vars_exists($nameContainer))
			return print(html_heading_msg('Please Feild Name Container of Image')); ?>
		<div class="row">
			<div class="col-12 <?php is_array($oldImagePath) or print('col-md-2') ?> mb-4" id="place-<?php echo $nameContainer; ?>">
				<?php if (is_array($oldImagePath)) : ?>
					<div class="row">
						<?php foreach ($oldImagePath as $val) : ?>
							<!-- <div class="col-6 col-md-4 col-sm-3 mb-4"> -->
							<div class="col-2 mb-4">
								<img src="<?php echo $val; ?>" class="img-fluid shadow rounded-lg imgReplace ">
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="text-center <?php echo $nameContainer ?>-gallery">
						<img src="<?php empty($oldImagePath) and print ('data:image/png;base64,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') or print($oldImagePath) ?>" class="img-fluid shadow rounded-lg imgReplace" style="height:
					<?php vars_exists($ImageHeight) and print($ImageHeight); ?>px">
					</div>
				<?php endif; ?>
			</div>
			<div class="col-12 <?php is_array($oldImagePath) or print('col-md-10') ?> mb-4" id="input-<?php echo $nameContainer; ?>">
				<div class="form-group">
					<?php if ($require === true) : ?>
						<small class="form-text text-muted">
							<span class="text-danger mr-1">*</span>Required Fields
						</small>
					<?php endif; ?>
					<div class="custom-file">
						<?php if (!empty($oldImagePath)) : ?>
							<?php if (is_array($oldImagePath)) : ?>
								<input type="hidden" name="old<?php echo $nameContainer; ?>" value="<?php echo implode('@', $oldImagePath); ?>">
							<?php else : ?>
								<input type="hidden" name="old<?php echo $nameContainer; ?>" value="<?php echo $oldImagePath; ?>">
							<?php endif; ?>
						<?php endif; ?>
						<input type="file" class="custom-file-input" id="<?php echo $nameContainer; ?>" <?php $MultipleImages and print('multiple'); ?> name="<?php echo $nameContainer; ?>" accept="image/jpg, image/jpeg, image/png">
						<label class="custom-file-label bg-light border border-light" for="<?php echo $nameContainer; ?>">Choose Image</label>
					</div>
				</div>
			</div>
		</div>
	<?php
		$MultipleImages === false and $multiple = false;
		$MultipleImages === true  and $multiple = true;
		file_preview_script($nameContainer, '.imgReplace', $multiple);
	}
}


// -----------------------------------------------------------
// 					FILE_PREVIEW_SCRIPT FUNCTION
// -----------------------------------------------------------
if (!function_exists('file_preview_script')) {
	/** Include Image Preview Script
	 *
	 * @param string $InputNameContainer
	 * @param string $ImgReplacementClass
	 * @return void */
	function file_preview_script(string $InputNameContainer = null, string $ImgReplacementClass = '.imgReplace', bool $multipleImage = false)
	{
		if (!vars_exists($InputNameContainer))
			return print(html_heading_msg('Please Feild Name Container of Image')); ?>
		<?php if ($multipleImage === false) : ?>
			<script>
				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function(event) {
							document.querySelector('<?php echo $ImgReplacementClass; ?>').setAttribute('src', event.target.result);
						}

						reader.readAsDataURL(input.files[0]);
					}
				}

				document.getElementById("<?php echo $InputNameContainer; ?>").addEventListener('change', function() {
					readURL(this);
				});
			</script>
		<?php elseif ($multipleImage === true) : ?>
			<script>
				var imagesPreview = function(input) {

					if (input.files) {
						var filesAmount = input.files.length;
						var mainContainer = document.getElementById('place-<?php echo $InputNameContainer; ?>');
						var inputContainer = document.getElementById('input-<?php echo $InputNameContainer; ?>');
						mainContainer.classList.remove('col-md-2');
						mainContainer.classList.add('col-12');
						inputContainer.classList.remove('col-md-10');
						inputContainer.classList.add('col-12');
						mainContainer.innerHTML = '<div class="row" id="child<?php echo $InputNameContainer; ?>"></div>'
						var childContainer = document.getElementById('child<?php echo $InputNameContainer; ?>');
						for (i = 0; i < filesAmount; i++) {
							var reader = new FileReader();

							reader.onload = function(event) {
								// childContainer.innerHTML += '<div class="col-6 col-md-4 col-sm-3 mb-4"><img src="' + event.target.result + '" class="img-fluid shadow rounded-lg imgReplace "></div>';
								childContainer.innerHTML += '<div class="col-2 mb-4"><img src="' + event.target.result + '" class="img-fluid shadow rounded-lg imgReplace "></div>';
							}

							reader.readAsDataURL(input.files[i]);
						}
					}

				};
				document.getElementById("<?php echo $InputNameContainer; ?>").addEventListener('change', function() {
					imagesPreview(this);
				});
			</script>
		<?php endif; ?>
<?php }
}
/* End of file image.php */
