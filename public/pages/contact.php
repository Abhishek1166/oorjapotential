<!--END: NAVIGATION-->


<!-- end: Header -->
<!-- Page title -->
<section id="page-title" data-bg-parallax="<?= SITE_URL ?>assets/img/oorja/5.jpg">
	<div class="container">
		<div class="page-title">
			<h1>Contact Us</h1>
			<span>The most happiest time of the day!.</span>
		</div>
		<div class="breadcrumb">
			<ul>
				<li><a href="#">Home</a> </li>
				<li><a href="#">Pages</a> </li>
				<li class="active"><a href="#">Contact Us</a> </li>
			</ul>
		</div>
	</div>
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h3 class="text-uppercase">Get In Touch</h3>
				<p>The most happiest time of the day!. Suspendisse condimentum porttitor cursus. Duis nec nulla turpis.
					Nulla lacinia laoreet odio, non lacinia nisl malesuada vel. Aenean malesuada fermentum bibendum.</p>
				<div class="m-t-30">
					<form class="widget-contact-form" novalidate action="<?php echo SITE_URL ?>contact" name="sendmail" method="post" id="myForm"">
						<div class=" row">
						<div class="form-group col-md-6">
							<label for="name">Name</label>
							<input type="text" aria-required="true" name="widget-contact-form-name" required class="form-control required name" placeholder="Enter your Name">
						</div>
						<div class="form-group col-md-6">
							<label for="email">Email</label>
							<input type="email" aria-required="true" name="widget-contact-form-email" required class="form-control required email" placeholder="Enter your Email">
						</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="subject">Your Subject</label>
						<input type="text" name="widget-contact-form-subject" required class="form-control required" placeholder="Subject...">
					</div>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea type="text" name="widget-contact-form-message" required rows="5" class="form-control required" placeholder="Enter your Message"></textarea>
				</div>
				<!--    <div class="form-group">
                                    <script src="https://www.google.com/recaptcha/api.js"></script>
                                    <div class="g-recaptcha" data-sitekey="6LddCxAUAAAAAKOg0-U6IprqOZ7vTfiMNSyQT2-M"></div>
                                </div> -->
				<button class="btn" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Send
					message</button>
				</form>
			</div>
		</div>
		<div class="col-lg-6">
			<h3 class="text-uppercase">Address & Map</h3>
			<div class="row">
				<div class="col-lg-6">
					<address>
						<strong><?= $data['site_address'] ?></strong><br>


						<abbr title="Phone">P:</h4><?= $data['site_mobile'] ?>
					</address>
				</div>
				<!-- <div class="col-lg-6">
						<address>
							<strong>Polo Office</strong><br>
							795 Folsom Ave, Suite 600<br>
							San Francisco, CA 94107<br>
							<abbr title="Phone">P:</h4> (123) 456-7890
						</address>
					</div> -->
			</div>
			<!-- Google Map -->
			<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3611.666342973016!2d75.8381129143262!3d25.146968839908983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396f851812e66a6b%3A0xe43b2abb4404e387!2sTWS%20Technology%20-%20Digital%20Marketing%20Company%20in%20Kota%2C%20Custom%20Web%20Design%20designer%20in%20kota!5e0!3m2!1sen!2sin!4v1592922164001!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
			<!-- end: Google Map -->
		</div>
	</div>
	</div>
</section> <!-- end: Content -->
<!-- Footer -->

<!-- end: Footer -->
</div>
<!-- end: Body Inner -->
<!-- Scroll top -->