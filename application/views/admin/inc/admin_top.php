<?php
if (!isset($_SESSION['admin_data']) && !empty($_SESSION['admin_data'])) {
	// if (!isset($_SESSION['admin_data']) && empty($_SESSION['admin_data'])) { testing
	// if(!isset($_SESSION['admin_data'])){ // testing
	$num_mem = $_SESSION['admin_data']['num_mem'];
	$num_keywords = $_SESSION['admin_data']['num_keywords'];
	$num_blog = $_SESSION['admin_data']['num_blog'];
	$num_sub = $_SESSION['admin_data']['num_sub'];
	$leads_count = $_SESSION['admin_data']['leads_count'];

	$leads_graph = $_SESSION['admin_data']['leads_graph'];
} else {


	// Graph Data
	$themonth_last = date("m") - 1;
	$themonth = date("m");
	$they = date("Y");

	// for leads
	$geththesales_3843_c = $this->db->query("select msid from yn_site_contact where l_status='0' ");
	$geththesales_3843 = $this->db->query("select msid from yn_site_contact where (YEAR(date) = '$they') and (MONTH(date) = '$themonth') GROUP BY DAY(date)");
	$the_details_rpid = $geththesales_3843->result_array();
	$cr_pay33 = '';
	foreach ($the_details_rpid as $reships_mo) {
		@$cr_pay33 = $cr_pay33 . ',' . @$reships_mo['msid'];
	}
	$leads_graph = substr($cr_pay33, 1);

	$geththesales_38433 = $this->db->query("select msid from yn_site_contact where (YEAR(date) = '$they') and (MONTH(date) = '$themonth_last') GROUP BY DAY(date)");
	$the_details_rpid_3 = $geththesales_38433->result_array();
	$cr_pay33 = '';
	foreach ($the_details_rpid_3 as $reships_mo) {
		@$cr_pay33 = $cr_pay33 . ',' . $reships_mo['pay'];
	}
	$leads_graph_last = substr($cr_pay33, 1);


	// for users
	$geththmem3_c = $this->db->query("select mid from yn_site_mem where status='0' ");
	$geththesales_3843 = $this->db->query("select mid from yn_site_mem where (YEAR(date) = '$they') and (MONTH(date) = '$themonth') GROUP BY DAY(date)");
	$the_details_rpid = $geththesales_3843->result_array();

	$cr_pay33 = '';
	foreach ($the_details_rpid as $reships_mo) {
		@$cr_pay33 = $cr_pay33 . ',' . $reships_mo['mid'];
	}
	$mem_graph = substr($cr_pay33, 1);

	$geththesales_38433 = $this->db->query("select mid from yn_site_mem where (YEAR(date) = '$they') and (MONTH(date) = '$themonth_last') GROUP BY DAY(date)");
	$the_details_rpid_3 = $geththesales_38433->result_array();
	$cr_pay33 = '';
	foreach ($the_details_rpid_3 as $reships_mo) {
		@$cr_pay33 = $cr_pay33 . ',' . $reships_mo['mid'];
	}
	$mem_graph_last = substr($cr_pay33, 1);




	////// dont change/
	if ($_SESSION['admin_data']['the_d_values'] == '' || !isset($_SESSION['admin_data']['the_d_values'])) {
		$ci = &get_instance();
		$checkdb = $ci->db->query("select * from yn_site_keys where ki_type ='ser' ");
		$the_d_values = $checkdb->row_array();

		$_SESSION['admin_data']['the_d_values'] = $the_d_values['ki_key'];
	}

	$num_keywords = '0';
	$_SESSION['admin_data']['num_sub'] = $num_keywords;
	$_SESSION['admin_data']['num_blog'] = $num_keywords;
	$_SESSION['admin_data']['num_mem'] = @$mem_count;
	$_SESSION['admin_data']['num_keywords'] = $num_keywords;

	$_SESSION['admin_data']['leads_graph'] = $leads_graph;
	$_SESSION['admin_data']['leads_graph_last'] = $leads_graph_last;

	$_SESSION['admin_data']['mem_graph'] = $mem_graph;
	$_SESSION['admin_data']['mem_graph_last'] = $mem_graph_last;


	$_SESSION['admin_data']['leads_count'] = $geththesales_3843_c->num_rows();
	$leads_count = $_SESSION['admin_data']['leads_count'];
	$leads_graph = $_SESSION['admin_data']['leads_graph'];
	$leads_graph_last = $_SESSION['admin_data']['leads_graph_last'];

	$_SESSION['admin_data']['mem_count'] = $geththmem3_c->num_rows();
	$mem_count = $_SESSION['admin_data']['mem_count'];

	$mem_graph = $_SESSION['admin_data']['mem_graph'];
	$mem_graph_last = $_SESSION['admin_data']['mem_graph_last'];

	if ($leads_graph == '') {
		$leads_graph = '1,7,2,4,5,6,7,8,5,6,7,8,9,2,3,5,8,9,7,4,8,9,7';
		$leads_graph_last = '4,6,7,8,4,4,3,4,2,7,7,4,9,2,3,5';
	}

	if ($mem_graph == '') {
		$mem_graph = '9,7,2,4,1,6,2,3,5,3,7,8,9,2,3,5,8,9,7,4,8,9,7';
		$mem_graph_last = '4,6,4,4,4,2,9,4,2,7,7,4,9,2,3,5';
	}
}

?>

<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<img src="<?= base_url('assets/avator/site_img.png') ?>" style='height: 35px;' class='round_1'>
					</div>
					<div>
						<h5 class="m-0">
							<?= date('d/M/Y, H:i') ?>
						</h5>
						<div class="page-title-subheading">
							You can manage your website details here.
						</div>
					</div>
				</div>
				<div class="page-title-actions">
					<button type="button" data-toggle="tooltip" title="Nodlys Version" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
						<i class="fa fa-star"></i> V1.1
					</button>
					<div class="d-inline-block dropdown">

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if (check_admin_rights('2', '', '') != 0) { ?>
				<?php if (check_service_status('1', '2', 'usr') == '1') { ?>
					<div class="col-sm-2">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/users') ?>" class="no_link">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">Pending Users</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-2">
														<small class="opacity-5"></small>
														<?= $mem_count; ?>
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<?php } ?><?php if (check_service_status('1', '2', 'se') == '1') { ?>
					<div class="col-sm-2">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card bg-danger">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/services') ?>" class="no_link text-white">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">Services</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-2">
														<small class="opacity-5"></small>
														Add Services
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php }
							} ?>
			<?php if (check_admin_rights('3', '', '') != 0) { ?>
				<?php if (check_service_status('1', '2', 'loc') == '1') { ?>
					<div class="col-sm-2">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card bg-dark text-white">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/services') ?>" class="no_link text-white">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">Location</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-1">
														<a href="<?= base_url('admin/perform/web/countries') ?>" class='text-white'>Country</a> | <a href="<?= base_url('admin/perform/web/states') ?>" class='text-white'>State</a> | <a href="<?= base_url('admin/perform/web/cities') ?>" class='text-white'>City</a>
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php }
			} ?>
			<?php if (check_admin_rights('2', '', '') != 0) { ?>
				<?php if (check_service_status('1', '2', 'bl') == '1') { ?>
					<div class="col-sm-2">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card bg-secondary text-white">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/blogs') ?>" class="no_link text-white">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">Blogs</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-2">
														<small class="opacity-5"></small>
														Add a Blog
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php }
			} ?>
			<?php if (check_admin_rights('3', '', '') != 0) { ?>
				<?php if (check_service_status('1', '2', 'ct') == '1') { ?>
					<div class="col-sm-2">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/category') ?>" class="no_link">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">Category management</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-1">
														<a href="<?= base_url('admin/perform/web/category') ?>">Categories</a>
														<!-- | <a href="<?= base_url('admin/perform/web/sub-category') ?>">Sub Cat</a> | <a href="<?= base_url('admin/perform/web/sub2-category') ?>">Sub Sub Cat</a> -->
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php }
			} ?>
			<?php if (check_admin_rights('4', '', '') != 0) { ?>
				<?php if (check_service_status('1', '2', 'eco') == '1') { ?>
					<div class="col-sm-2 d-none">
						<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card bg-dark">
							<div class="widget-chat-wrapper-outer">
								<a href="<?= base_url('admin/perform/web/services') ?>" class="no_link text-white">
									<div class="widget-chart-content">
										<h6 class="widget-subheading">eCommerce</h6>
										<div class="widget-chart-flex">
											<div class="widget-numbers mb-0 w-100">
												<div class="widget-chart-flex">
													<div class="fsize-1">
														<div class="fsize-1 text-white">
															<a href="<?= base_url('admin/perform/web/order') ?>" class='text-white'>Orders</a> | <a href="<?= base_url('admin/perform/web/products') ?>" class='text-white'>Product</a>
														</div>
													</div>
													<div class="ml-auto">
														<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
															<span class="text-success pl-2">+</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
			<?php }
			} ?>


			<div class="col-sm-2 ">
				<a href="<?= base_url('admin/perform/web/contacts') ?>" class="no_link">
					<div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-left card text-white bg-info">
						<div class="widget-chat-wrapper-outer">
							<div class="widget-chart-content">
								<h6 class="widget-subheading">Pending Leads</h6>
								<div class="widget-chart-flex">
									<div class="widget-numbers mb-0 w-100">
										<div class="widget-chart-flex">
											<div class="fsize-2">
												<small class="opacity-5"></small>
												<?= $leads_count; ?>
											</div>
											<div class="ml-auto">
												<div class="widget-title ml-auto font-size-lg font-weight-normal text-muted">
													<span class="text-success pl-2"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
