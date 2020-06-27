<?php
/* echo '<pre>';
print_r($slider);
echo '</pre>'; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="INSPIRO" />
	<meta name="description" content="Themeforest Template Polo">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Document title -->
	<title>POLO | The Multi-Purpose HTML5 Template</title>
	<!-- Stylesheets & Fonts -->
	<link href="<?php echo SITE_URL ?>assets/css/fe/oorja/plugins.css" rel="stylesheet">
	<link href="<?php echo SITE_URL ?>assets/css/fe/oorja/style.css" rel="stylesheet">
	<!-- <link href="<?php echo SITE_URL ?>assets/css/fe/oorja/fontawesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->

	<!-- model css -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
</head>

<body>

	<!-- Body Inner -->
	<div class="body-inner">

		<!-- Header -->
		<header id="header" data-fullwidth="true">
			<div class="header-inner">
				<div class="container">
					<!--Logo-->
					<div id="logo"> <a href="<?= SITE_URL ?>"><span class="logo-default"><img src="<?= $site['site_logo'] ?>"></span><span class="logo-dark">POLO</span></a> </div>
					<!--End: Logo-->
					<!-- Search -->
					<div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
						<form class="search-form" action="search-results-page.html" method="get">
							<input class="form-control" name="q" type="search" placeholder="Type & Search..." />
							<span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
						</form>
					</div> <!-- end: search -->
					<!--Header Extras-->
					<div class="header-extras">
						<ul>
							<li>
								<div class="p-dropdown"> <a href="#"><i class="icon-user"></i></a>
									<ul class="p-dropdown-content">
										<li><a id="loginModelTrgr">Login</a></li>
									</ul>
								</div>
							</li>
							<li> <a id="btn-search" href="#"><i class="icon-search"></i></a> </li>
							<li>
								<div class="p-dropdown"> <a href="#"><i class="icon-globe"></i><span>EN</span></a>
									<ul class="p-dropdown-content">
										<li><a href="#">Hindi</a></li>
										<li><a href="#">English</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
					<!--end: Header Extras-->
					<!--Navigation Resposnive Trigger-->
					<div id="mainMenu-trigger"> <a class="lines-button x"><span class="lines"></span></a> </div>
					<!--end: Navigation Resposnive Trigger-->
					<!--Navigation-->
					<div id="mainMenu">
						<div class="container">
							<nav>
								<ul>
									<li><a href="<?= SITE_URL ?>">HOME</a></li>
									<li class="dropdown"><a href="#">ABOUT US</a></li>
									<li class="dropdown"><a href="#">SERVICES</a>
										<ul class="dropdown-menu">
											<?PHP
											foreach ($nav_post as $posts) {
											?>
												<li class="dropdown"><a href="<?php echo SITE_URL . 'service/' . $posts->slug ?>"><?= $posts->title ?></a></li>
											<?php
											}
											?>
										</ul>
									</li>
									<li class="">
										<a href="<?= SITE_URL, 'course' ?>">COURSES</a>
									</li>
									<li class=""><a href="#">CONTACT US</a></li>
								</ul>
							</nav>
						</div>
					</div>
					<!--end: Navigation-->
				</div>
			</div>
		</header>
		<!-- end: Header -->

		<!-- Inspiro Slider -->
		<div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-height-xs="360">
			<!-- Slide 1 -->
			<?php
			if (!empty($slider)) {
				foreach ($slider as $key => $value) {
			?>
					<div class="slide kenburns" style="background:url(<?= $value->image ?>)">>

						<div class="bg-overlay">

							<div class="container">
								<div class="slide-captions text-light">
									<!-- Captions -->
									<span data-animate="fadeInUp" data-animate-delay="300" class="strong"><a href="#" class="business"><span class="business"></span></a>
									</span>
									<h1 data-animate=" fadeInUp" data-animate-delay="600">We’re Polo, A Creative<br>Startup Based in Melburne</h1>
									<div data-animate="fadeInUp" data-animate-delay="900">
										<button type="button" class="btn btn-rounded btn-reveal btn-reveal-left"><span>Learn More</span><i class="icon-chevron-right"></i></button>
									</div>
									<!-- end: Captions -->
									<div class="row" style="padding-top:14%;">
										<div class="col-lg-3" data-animate="fadeInUp" data-animate-delay="1200">
											<h4>Highly Customizable</h4>
											<p>Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!.</p>
										</div>
										<div class="col-lg-3" data-animate="fadeInUp" data-animate-delay="1500">
											<h4>Clean Code</h4>
											<p>Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!.</p>
										</div>
										<div class="col-lg-3" data-animate="fadeInUp" data-animate-delay="1800">
											<h4>Heavily Awarded</h4>
											<p>Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!.</p>
										</div>
										<div class="col-lg-3" data-animate="fadeInUp" data-animate-delay="2100">
											<h4>Fast Performance</h4>
											<p>Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<!-- end: Slide 1 -->

		</div>

		<!--end: Inspiro Slider -->