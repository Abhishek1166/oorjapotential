<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container sidebar-closed sbar-open" id="container">

	<div class="overlay"></div>
	<div class="cs-overlay"></div>
	<div class="search-overlay"></div>

	<!--  BEGIN SIDEBAR  -->
	<div class="sidebar-wrapper sidebar-theme">

		<nav id="sidebar">

			<ul class="navbar-nav theme-brand flex-row  text-center" style="background: #3a4161">
				<li class="nav-item theme-logo">
					<a href="<?php echo SITE_URL; ?>dashboard">
						<img src="<?php echo SITE_URL; ?>assets/img/logo.svg" class="navbar-logo" alt="logo">
					</a>
				</li>
				<li class="nav-item theme-text">
					<a href="<?php echo SITE_URL; ?>dashboard" class="nav-link">
						<?php echo ucwords(SITE_NAME); ?>
					</a>
				</li>
			</ul>

			<ul class="list-unstyled menu-categories" id="mainMenu">
				<li class="menu active">
					<a href="<?php echo SITE_URL; ?>dashboard" aria-expanded="true" class="dropdown-toggle">
						<div class="">
							<?php echo ICONS['dashboard']; ?>
							<span>Dashboard</span>
						</div>
					</a>
				</li>

				<?php if (user_can('test_list')) : ?>
					<!-- Testings -->
					<li class="menu">
						<a href="<?php echo SITE_URL; ?>list/tests " aria-expanded="false" class="dropdown-toggle">
							<div class="">
								<?php echo ICONS['test']; ?>
								<span>Testings</span>
							</div>
						</a>
					</li>
				<?php endif; ?>

				<?php /** Project & Property */ ?>
				<?php if (user_can('project_list') or user_can('property_list')) : ?>
					<!-- Properties -->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Properties</span>
						</div>
					</li>

					<?php if (user_can('project_list')) : ?>
						<!-- Projects -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/content " aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['project']; ?>
									<span>content</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('property_list')) : ?>
						<!-- Proerties -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/properties " aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['property']; ?>
									<span>Properties</span>
								</div>
							</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php /** Product, Order & Review */ ?>
				<?php if (user_can('product_list') or user_can('order_list') or user_can('review_list')) : ?>
					<!-- Products -->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Products</span>
						</div>
					</li>

					<?php if (user_can('product_list')) : ?>
						<!-- Products -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/products" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['product']; ?>
									<span>Products</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('order_list')) : ?>
						<!-- Orders -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/orders" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['order']; ?>
									<span>Orders</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('review_list')) : ?>
						<!-- Reviews -->
						<li class="menu">
							<a href="#Reviews" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['review']; ?>
									<span>Rating & Reviews</span>
								</div>
							</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php /** Category & Filter */ ?>
				<?php if (user_can('category_list') or user_can('filter_list')) : ?>
					<!----- Categories & Filters ----->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Categories & Filters</span>
						</div>
					</li>

					<?php if (user_can('category_list')) : ?>
						<!-- Categories -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/categories" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['category']; ?>
									<span>Categories</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('filter_list')) : ?>
						<!-- Filters -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/filters" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['filter']; ?>
									<span>Filters</span>
								</div>
							</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php /** Blog & comment */ ?>
				<?php if (user_can('post_list') or user_can('comment_list')) : ?>
					<!----- Blogs ----->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Blogs</span>
						</div>
					</li>

					<?php if (user_can('post_list')) : ?>
						<!-- Blogs -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/posts" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['blog']; ?>
									<span>Blogs</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('comment_list')) :
					?>
						<!-- Comments -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/comments" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['comment']; ?>
									<span>Comments</span>
								</div>
							</a>
						</li>
					<?php endif;
					?>
				<?php endif; ?>

				<?php /** Notification, Customer, User Role, Gallery, Testimonial, & Slider */ ?>
				<?php if (user_can('notification_list') or user_can('user_list') or user_can('user-role_list') or user_can('gallery_list') or user_can('testimonial_list') or user_can('slider_list')) : ?>
					<!----- Managements ----->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Managements</span>
						</div>
					</li>

					<?php if (user_can('notification_list')) : ?>
						<!-- Mail & Notification -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/categories" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['notification']; ?>
									<span>Mail & Notification</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('user_list')) : ?>
						<!-- Customers -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/customers" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['customer']; ?>
									<span>Customers</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('user-role_list')) : ?>
						<!-- User Roles & Modules -->
						<li class="menu">
							<a href="#role" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['userrole']; ?>
									<span>User Roles & Modules</span>
								</div>
								<div>
									<?php echo ICONS['right']; ?>
								</div>
							</a>
							<ul class="collapse submenu list-unstyled" id="role" data-parent="#mainMenu">
								<li>
									<a href="<?php echo SITE_URL; ?>list/roles">User Group Roles</a>
								</li>
								<li>
									<a href="<?php echo SITE_URL; ?>list/assign-users">Assign User Roles</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>

					<?php if (user_can('gallery_list') or user_can('testimonial_list') or user_can('slider_list')) : ?>
						<!-- Miscellaneous -->
						<li class="menu">
							<a href="#miscellaneous" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['misc']; ?>
									<span>Miscellaneous</span>
								</div>
								<div>
									<?php echo ICONS['right']; ?>
								</div>
							</a>
							<ul class="collapse submenu list-unstyled" id="miscellaneous" data-parent="#mainMenu">

								<?php if (user_can('gallery_list')) : ?>
									<li>
										<a href="<?php echo SITE_URL; ?>list/testimonials">Testimonials</a>
									</li>
								<?php endif; ?>

								<?php if (user_can('testimonial_list')) : ?>
									<li>
										<a href="<?php echo SITE_URL; ?>list/galleries">Gallery</a>
									</li>
								<?php endif; ?>

								<?php if (user_can('slider_list')) : ?>
									<li>
										<a href="<?php echo SITE_URL; ?>list/sliders">Slider</a>
									</li>
								<?php endif; ?>
							</ul>
						</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php /** Lead, Log, Trash, & Setting */ ?>
				<?php if (user_can('lead_list') or user_can('log_list') or user_can('trash_list') or user_can('setting_list')) : ?>
					<!-- Site Operations -->
					<li class="menu menu-heading">
						<div class="heading">
							<?php echo ICONS['dot']; ?>
							<span>Site Operations</span>
						</div>
					</li>

					<?php if (user_can('lead_list')) : ?>
						<!-- Leads -->
						<li class="menu">
							<a href="#lead" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['lead']; ?>
									<span>Leads</span>
								</div>
								<div>
									<?php echo ICONS['right']; ?>
								</div>
							</a>
							<ul class="collapse submenu list-unstyled" id="lead" data-parent="#mainMenu">
								<li>
									<a href="<?php echo SITE_URL; ?>list/leads">Leads</a>
								</li>
								<li>
									<a href="<?php echo SITE_URL; ?>list/contact-us">Contact Us Queries</a>
								</li>
								<li>
									<a href="<?php echo SITE_URL; ?>list/scraped">Scraped</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>

					<?php if (user_can('log_list') or user_can('trash_list')) : ?>
						<!-- Site Maintanace  -->
						<li class="menu">
							<a href="#siteMaintance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
								<div class="">
									<?php echo ICONS['operation']; ?>
									<span> Site Mantaintance </span>
								</div>
								<div>
									<?php echo ICONS['right']; ?>
								</div>
							</a>
							<ul class="submenu list-unstyled mini-recent-submenu collapse" id="siteMaintance" data-parent="#mainMenu">
								<li>
									<a href="javascript:void(0);"> Logs </a>
								</li>
								<li>
									<a href="#trashes" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"> Trash
										<?php echo ICONS['right']; ?>
									</a>
									<ul class="list-unstyled sub-submenu collapse show" id="trashes" data-parent="#siteMaintance">
										<li>
											<a href="javascript:void(0);"> Sub-Submenu 1 </a>
										</li>
										<li>
											<a href="javascript:void(0);"> Sub-Submenu 2 </a>
										</li>
										<li>
											<a href="javascript:void(0);"> Sub-Submenu 3 </a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					<?php endif; ?>

					<?php if (user_can('log_list')) : ?>
						<!-- Logs -->
						<li class="menu">
							<a href="#settings" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['log']; ?>
									<span>Logs</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('trash_list')) : ?>
						<!-- Trash -->
						<li class="menu">
							<a href="#trash" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['trash']; ?>
									<span>Trash</span>
								</div>
							</a>
						</li>
					<?php endif; ?>

					<?php if (user_can('setting_list')) : ?>
						<!-- Settings -->
						<li class="menu">
							<a href="<?php echo SITE_URL; ?>list/settings" aria-expanded="false" class="dropdown-toggle">
								<div class="">
									<?php echo ICONS['setting']; ?>
									<span>Setting</span>
								</div>
							</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>

		</nav>

	</div>
	<!--  END SIDEBAR  -->

	<!--  BEGIN CONTENT AREA  -->
	<div id="content" class="main-content">
		<div class="layout-px-spacing">