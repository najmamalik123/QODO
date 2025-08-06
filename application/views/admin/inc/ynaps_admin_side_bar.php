<div class="app-sidebar sidebar-shadow bg-midnight-bloom sidebar-text-light">
	<div class="app-header__logo">
		<div class="logo-src">

		</div>
		<div class="header__pane ml-auto">
			<div>
				<button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
					data-class="closed-sidebar">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<div class="app-header__mobile-menu">
		<div>
			<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</div>
	</div>
	<div class="app-header__menu">
		<span>
			<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
				<span class="btn-icon-wrapper">
					<i class="fa fa-ellipsis-v fa-w-6"></i>
				</span>
			</button>
		</span>
	</div>
	<div class="scrollbar-sidebar">
		<div class="app-sidebar__inner">
			<ul class="vertical-nav-menu">


				<li class="app-sidebar__heading">Dashboards</li>
				<li>
					<a href="<?= base_url('home') ?>" target='_blank'>
						<i class="fa-duotone fa-browser metismenu-icon"></i>
						Browse Website
					</a>
				</li>
				<li>
					<a href="<?= base_url('index.php/admin/dash') ?>">
						<i class="metismenu-icon pe-7s-rocket"></i>
						Dashboard
					</a>
				</li>


				<?php include_once('_admin_side_webx.php') ?>


				<?php if (check_service_status('1', '2', 'usr') == '1') { ?>
					<?php if (check_admin_rights('2', '', '') != 0) { ?>
						<li class="app-sidebar__heading">Users / Business</li>
						<li <?php if (is_tab_selected('users', 1)) {
								echo 'class="mm-active"';
							} ?>>
							<a href="#">
								<i class="fa-duotone fa-user metismenu-icon"></i>
								Users
								<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
							</a>
							<ul>
								<li>
									<a href="<?= base_url('admin/perform/web/users') ?>">
										<i class="metismenu-icon">
										</i>All Users
									</a>

									<!-- <a href="<?= base_url('admin/perform/web/users?paid=1') ?>">
                                    <i class="metismenu-icon">
                                    </i>Paid users
                                </a> -->

								</li>
							</ul>
						</li>

				<?php }
				} ?>

				<li <?php if (is_tab_selected('contacts', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-duotone fa-messages metismenu-icon"></i>
						Leads
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/contacts') ?>">
								<i class="fa-duotone fa-messages metismenu "></i>
								Contact Requests
							</a>
						</li>

						<li>
							<a href="<?= base_url('index.php/admin/perform/web/subscribe') ?>">
								<i class="fa-duotone fa-envelope metismenu"></i> Subscribe
							</a>
						</li>
						<?php if (check_service_status('1', '2', 'rati') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/ratings') ?>">
									<i class="fa-duotone fa-star metismenu"></i> Ratings
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
				<?php if (check_admin_rights('5', '', '') != 0) { ?>
					<li class="app-sidebar__heading">Admins</li>
					<li <?php if (is_tab_selected('admins', 1)) {
							echo 'class="mm-active"';
						} ?>>
						<a href="#">
							<i class="fa-duotone fa-lock metismenu-icon"></i>
							Manage Admin
							<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
						</a>
						<ul>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/add-admin') ?>">
									<i class="metismenu-icon"></i>
									Add Admin
								</a>
							</li>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/admins') ?>">
									<i class="metismenu-icon">
									</i>All Admins
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>
				<?php if (check_admin_rights('3', '', '') != 0) { ?>
					<li <?php if (is_tab_selected('contact-details', 1)) {
							echo 'class="mm-active"';
						} ?>>
						<a href="#">
							<i class="fa-solid fa-screwdriver-wrench metismenu-icon"></i>
							Settings
							<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
						</a>
						<ul>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/contact-details') ?>">
									<i class="fa-duotone fa-phone-arrow-up-right"></i>
									Contact Details
								</a>
							</li>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/social-media') ?>">
									<i class="fa-brands fa-instagram"></i> Social Media
								</a>
							</li>
							<?php if (check_service_status('1', '2', 'app') == '1') { ?>
								<li>
									<a href="<?= base_url('index.php/admin/perform/web/APP') ?>">
										<i class="fa-duotone fa-apple-whole"></i> Applications
									</a>
								</li>
							<?php } ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/about') ?>">
									<i class="fa-duotone fa-address-card"></i> SEO
								</a>
							</li>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/scripts') ?>">
									<i class="fa-sharp fa-solid fa-code"></i> Scripts
								</a>
							</li>
					</li>
			</ul>
			</li>
		<?php  } ?>
		<li class="app-sidebar__heading">Content and Images</li>
		<?php if (check_admin_rights('4', '', '') != 0) { ?>

			<?php if (check_service_status('1', '2', 'ct') == '1') { ?>
				<li <?php if (is_tab_selected('category', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-solid fa-grid-2-plus metismenu-icon"></i>
						Categories
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>

						<li>
							<a href="<?= base_url('index.php/admin/perform/web/category') ?>">
								<i class="metismenu-icon">
								</i>Manage Category
							</a>
						</li>

						<?php if (check_service_status('1', '2', 'sb') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/sub-category') ?>">
									<i class="metismenu-icon">
									</i>Manage Sub Category
								</a>
							</li>
						<?php } ?>
						<?php if (check_service_status('1', '2', 'ssb') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/sub2-category') ?>">
									<i class="metismenu-icon">
									</i>Manage Sub-Sub Category
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>

			<?php if (check_service_status('1', '2', 'tag') == '1') { ?>
				<li <?php if (is_tab_selected('tags', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="metismenu-icon fa fa-tags"></i>
						keywords / Tags
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/tags') ?>" aria-expanded="true">
								<i class="metismenu-icon">
								</i>Manage Tags
							</a>
						</li>
					</ul>
				</li>
			<?php }  ?>
			<?php if (check_service_status('1', '2', 'po') == '1') { ?>
				<li>
					<a href="<?= base_url('index.php/admin/perform/web/popups') ?>">
						<i class="fa-duotone fa-megaphone metismenu-icon"></i> Popups
					</a>
				</li>
			<?php } ?>
			<?php if (check_service_status('1', '2', 'pg') == '1') { ?>
				<li <?php if (is_tab_selected('blocks', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-duotone metismenu-icon fa-page"></i>
						Web Pages
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/c-blocks') ?>">
								<i class="metismenu-icon">
								</i>Manage Pages
							</a>
						</li>
						<?php if (check_service_status('1', '2', 'faq') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/faq') ?>">
									<i class="metismenu-icon">
									</i>FAQs
								</a>
							</li>
						<?php } ?>
						<?php if (check_service_status('1', '2', 'testi') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/testimonials') ?>">
									<i class="metismenu-icon">
									</i>Testimonials
								</a>
							</li>
						<?php } ?>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/page-gallery') ?>">
								<i class="metismenu-icon">
								</i>Videos
							</a>
						</li>
					</ul>
				</li>
			<?php } ?>

			<?php if (check_service_status('1', '2', 'pho') == '1') { ?>
				<li <?php if (is_tab_selected('img', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-duotone fa-image metismenu-icon"></i>
						Photo Manager
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/img-logo') ?>">
								<i class="metismenu-icon">
								</i>Logo
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/img-slider') ?>">
								<i class="metismenu-icon">
								</i>Slider Images
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/img-partners') ?>">
								<i class="metismenu-icon">
								</i>Partners Images
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/img-others?pag_d=team') ?>">
								<i class="metismenu-icon">
								</i>Banners
							</a>
						</li>
						<?php if (check_service_status('1', '2', 'team') == '1') { ?>
							<!-- <li>
                        <a href="<?= base_url('index.php/admin/perform/web/img-others?pag_d=team') ?>">
                            <i class="metismenu-icon">
                            </i>Team.
                        </a>
                    </li> -->
						<?php } ?>
						<?php if (check_service_status('1', '2', 'port') == '1') { ?>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/img-others?pag_d=port') ?>">
									<i class="metismenu-icon">
									</i>Portfolio.
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			<?php if (check_service_status('1', '2', 'csv') == '1') { ?>
				<li <?php if (is_tab_selected('download', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="metismenu-icon fa-duotone fa-file-excel"></i>
						Export Data
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/download?do=mem') ?>">
								<i class="metismenu-icon"></i>
								Download CSV
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>

		<li <?php if (is_tab_selected('assets', 1)) {
				echo 'class="mm-active"';
			} ?>>
			<a href="#">
				<i class="fa-duotone fa-arrow-up-right-from-square metismenu-icon"></i>
				Assets
				<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
			</a>
			<ul>
				<li>
					<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=assets') ?>">
						<i class="metismenu-icon"></i>
						Assets
					</a>
				</li>
			</ul>
		</li>
		<?php if (check_admin_rights('5', '', '') != 0) { ?>
			<?php if (check_service_status('1', '2', 'the') == '1') { ?>
				<li <?php if (is_tab_selected('setup', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-light fa-puzzle-piece-simple metismenu-icon"></i>
						Theme and Plugin
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=theme') ?>">
								<i class="metismenu-icon"></i>
								Theme Manager
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=php') ?>">
								<i class="metismenu-icon">
								</i>Setup Theme
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=widget') ?>">
								<i class="metismenu-icon">
								</i>Widgets
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=css') ?>">
								<i class="metismenu-icon">
								</i>CSS Editor
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=code') ?>">
								<i class="metismenu-icon">
								</i>Code Editor
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/navi?do=navi&l=setup') ?>">
								<i class="metismenu-icon"></i>
								Navigation Manager
							</a>
						</li>




						<li>
							<a href="<?= base_url('index.php/admin/perform/web/form?l=setup') ?>">
								<i class="metismenu-icon">
								</i>Manage Form
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/form2?l=setup') ?>">
								<i class="metismenu-icon">
								</i>Add Fields in Form
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/form3?l=setup') ?>">
								<i class="metismenu-icon">
								</i>Manage field Options
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>
		<?php if (check_admin_rights('3', '', '') != 0) { ?>
			<?php if (check_service_status('1', '2', 'loc') == '1') { ?>
				<li <?php if (is_tab_selected('cities', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="metismenu-icon fa-duotone fa-earth-europe"></i>
						Enable / Disable Places
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/countries') ?>">
								<i class="metismenu-icon">
								</i>Countries
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/states') ?>">
								<i class="metismenu-icon">
								</i>States
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/cities') ?>">
								<i class="metismenu-icon">
								</i>Cities
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/locality') ?>">
								<i class="metismenu-icon">
								</i>Localities
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>
		<?php if (check_admin_rights('2', '', '') != 0) { ?>
			<?php if (check_service_status('1', '2', 'bl') == '1') { ?>
				<li class="app-sidebar__heading">Blogs</li>
				<li <?php if (is_tab_selected('blogs', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="metismenu-icon pe-7s-portfolio"></i>
						Blogs
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/blogs') ?>">
								<i class="metismenu-icon">
								</i>Manage Blogs
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/all_blogs') ?>">
								<i class="metismenu-icon">
								</i>All Blogs
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>

		<?php if (check_admin_rights('3', '', '') != 0) { ?>
			<?php if (check_service_status('1', '2', 'se') == '1') { ?>
				<li <?php if (is_tab_selected('services', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="metismenu-icon  pe-7s-way"></i>
						Services
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/services') ?>">
								<i class="metismenu-icon">
								</i>Manage Services
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/all_services') ?>">
								<i class="metismenu-icon">
								</i>All Services
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>
		<?php if (check_admin_rights('4', '', '') != 0) { ?>
			<?php if (check_service_status('1', '2', 'eco') == '1') { ?>
				<!-- <li class="app-sidebar__heading">Orders / Transactions</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon fa-duotone fa-truck"></i>
                    Manage Order
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= base_url('index.php/admin/perform/web/order') ?>">
                            <i class="metismenu-icon">
                            </i>All Orders
                        </a>
                    </li>


                </ul>
            </li> -->


				<li <?php if (is_tab_selected('products', 1)) {
						echo 'class="mm-active"';
					} ?>>
					<a href="#">
						<i class="fa-duotone metismenu-icon fa-box"></i>
						Membership Plans
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/products') ?>">
								<i class="metismenu-icon">
								</i>Add Membership Plans
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/web/all-products') ?>">
								<i class="metismenu-icon">
								</i>All Plans
							</a>
						</li>
					</ul>
				</li>

				<!-- <li>
                <a href="<?= base_url('index.php/admin/perform/web/feature') ?>">
                    <i class="metismenu-icon fa-solid fa-van-shuttle"></i>
                    Vehicle Features
                </a>
            </li> -->

				<?php if (check_service_status('1', '2', 'coup') == '1') { ?>
					<li <?php if (is_tab_selected('coupon', 1)) {
							echo 'class="mm-active"';
						} ?>>
						<a href="#">
							<i class="metismenu-icon fa-solid fa-badge-percent"></i>
							Coupon
							<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
						</a>
						<ul>
							<li>
								<a href="<?= base_url('index.php/admin/perform/web/coupon') ?>">
									<i class="metismenu-icon">
									</i>Coupon
								</a>
							</li>
						</ul>
					</li>
				<?php }  ?>

		<?php }
		} ?>


		<?php if (check_service_status('1', '2', 'nodl') == '1') { ?>
			<?php if (check_admin_rights('6', '', '') != 0) { ?>
				<li class="app-sidebar__heading">Setup / Settings</li>
				<li>
					<a href="#">
						<i class="fa-duotone fa-wrench metismenu-icon"></i>
						Web Settings
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=1') ?>">
								<i class="metismenu-icon"></i>
								Email Management
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=2') ?>">
								<i class="metismenu-icon">
								</i>SMS and WhatsApp Setup
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=3') ?>">
								<i class="metismenu-icon">
								</i>Captcha
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=6') ?>">
								<i class="metismenu-icon">
								</i>Master Password
							</a>
						</li>
						<li>
							<a href="<?= base_url('index.php/admin/perform/ynaps/setup?do=5') ?>">
								<i class="metismenu-icon">
								</i>Enable Services
							</a>
						</li>
					</ul>
				</li>
		<?php }
		} ?>

		<li class="app-sidebar__heading">Ynaps Help</li>
		<li>
			<a href="https://ynaps.com/contact" target="_blank">
				<i class="fa-regular fa-messages-question fa-beat metismenu-icon"></i>
				Get help from YNAPS
			</a>
		</li>

		</ul>

		<small class="text-muted">
			Nodly's V 1.0, Open Source Project Developed by YNAPS and <a href="https://nodlys.com/team"
				target="_blank">Team</a>.
		</small>
		</div>
	</div>
</div>