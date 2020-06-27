<!-- About Us -->
<section class="ptb50">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<img src="<?php echo SITE_URL; ?>assets/img/why-choose.png" alt="why-choose" class="img-fluid d-block mx-auto">
			</div>
			<div class="col-lg-6 col-sm-6 col-12">
				<h4 class="grey-color lg40 md40 sm40 xs32 mb5 xsmb2 w600">How We <span class="orange-color">WORK</span></h4>

				<p>Prolive is a unique online real estate plat form for all your properties needs. Our staff is the most professional &amp; best trained. During property transaction we follow the process very transparent way. Our buyers are verified and our approach is professional.</p>
				<p>So any complex and time consuming property transactions is made easy &amp; hassle free. We identify properties according to specification and execute the transaction in time bond manner.</p>
				<p class="mb8 xsmb2">We are base from Pune. We are expanding our sub Branches in all over India.</p>

				<a href="#" class="learn-more-btn">
					Get Detail
				</a>
			</div>
		</div>
	</div>
</section>

<!-- Our Testimonials -->
<section class="ptb50 offwhite-bg">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="text-left grey-color lg40 md40 sm40 xs32 mb6 xsmb20 w600">
					Our <span class="orange-color">Testimonials</span>
				</div>
			</div>
		</div>

		<div class="owl-carousel owl-theme owl-our-testimonial">
			<?php if (is($data, 'array') and is($data['testimonial'])) ?>
			<?php show_debug($data); ?>
			<?php show_debug($data['testimonial']); ?>
			<?php foreach ($data['testimonial'] as $value) : ?>
				<div class="item">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 wow fadeInLeft">
							<div class="our-team-profile">
								<img src="<?php is($value->image, 'show'); ?>" alt="<?php is($value->name, 'showCapital'); ?>">
							</div>
							<div class="our-team-section">
								<div class="pink-color w600 text-center sm20 mt4 xsmt4 mb2 xsmb2">
									<?php is($value->name, 'showCapital'); ?>
								</div>
								<!-- <div class="text-center w500 mb6 xsmb4">CEO & Founder</div> -->
								<div class="text-center mb6 xsmb4 px-3">
									<?php is($value->comment, 'showCapital'); ?>
								</div>
								<div class="text-center mt2 mb6 xsmt2 xsmb4">
									<?php is($value->rating, 'rating'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
