<div class="form-container">
	<div class="form-image">
		<div class="l-image" style="background-image: url('<?php echo SITE_URL; ?>assets/img/login.svg')">
		</div>
	</div>
	<div class="form-form">
		<div class="form-form-wrap m-0" style="max-width: 100%">
			<div class="form-container">
				<div class="form-content">

					<h1 class="text-center">Log In to
						<a href="<?php echo SITE_URL; ?>">
							<span class="brand-name"><?php echo SITE_NAME; ?></span>
						</a>
					</h1>

					<form class="text-left" method="POST">
						<div class="form">

							<div id="username-field" class="field-wrapper input">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
									<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
									<circle cx="12" cy="7" r="4"></circle>
								</svg>
								<input id="username" name="username" type="text" class="form-control" placeholder="Username, Email Or Mobile Number *" minlength="3">
							</div>

							<div id="password-field" class="field-wrapper input mb-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
									<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
									<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
								</svg>
								<input id="password" name="password" type="password" class="form-control" placeholder="Password *" minlength="3">
							</div>


							<div class="d-sm-flex justify-content-between">
								<div class="field-wrapper toggle-pass">
									<p class="d-inline-block">Show Password</p>
									<label class="switch s-primary">
										<input type="checkbox" id="toggle-password" class="d-none">
										<span class="slider round"></span>
									</label>
								</div>
								<div class="field-wrapper text-center keep-logged-in mt-0">
									<div class="n-chk new-checkbox checkbox-outline-primary">
										<label class="new-control new-checkbox checkbox-outline-primary pt-1">
											<input type="checkbox" name="keepLoggedIn" class="new-control-input">
											<span class="new-control-indicator mt-1"></span>Keep me logged in
										</label>
									</div>
								</div>
							</div>
							<div class="d-sm-flex justify-content-between mt-5">
								<div class="field-wrapper"></div>
								<div class="field-wrapper">
									<button type="submit" name="LoginAdmin" value="sdsdsfe" class="btn btn-lg btn-primary" value="">Log In</button>
								</div>
							</div>
						</div>
					</form>
					<p class="terms-conditions text-center">© 2019 All Rights Reserved.
						<br>
						Made with
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0062" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 feather feather-heart">
							<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
						</svg>
						By <a href="https://twstechnology.com">TWS Technology</a>.</p>

				</div>
			</div>
		</div>
	</div>
</div>
