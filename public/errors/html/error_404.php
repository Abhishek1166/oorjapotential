<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Error 404 | <?php echo SITE_NAME; ?> </title>
	<link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>assets/img/icons/android/android-launchericon-48-48.png" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
	<link href="<?php echo SITE_URL; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_URL; ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo SITE_URL; ?>assets/css/pages/error/style-400.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="error404 text-center" style="background: radial-gradient(#7646F9,#36425a)">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 mr-auto mt-5 text-md-left text-center">
				<a href="<?php echo SITE_URL; ?>" class="ml-md-5">
					<img alt="image-404" src="<?php echo SITE_URL; ?>assets/img/logo2.svg" class="theme-logo">
				</a>
			</div>
		</div>
	</div>
	<div class="container-fluid error-content">
		<div class="">
			<h1 class="error-number">
				<?php echo str_replace(' Page Not Found', '', $heading); ?>
			</h1>
			<p class="mini-text text-white-50">Ooops!</p>
			<?php echo str_replace('<p>', '<p class="error-text mb-4 mt-1 text-dark-50">', $message); ?>
			<a href="<?php echo SITE_URL; ?>dashboard" class="btn btn-primary mt-5">Go Back</a>
		</div>
	</div>
</body>

</html>