<?php
$pageNum = @$_GET['page'];
if ($pageNum == NULL || $pageNum == '0') {
	$pageNum = 1;
}
$resultsPerPage = '50';
$limit1 = $pageNum * $resultsPerPage - $resultsPerPage;
$limit2 =  $resultsPerPage;

$thecats = $this->db->query("select * from yn_site_catagory");
$thsersftsy = $thecats->result_array();
foreach ($thsersftsy as $thedats_0) {
	$categories[] = array("id" => $thedats_0['ctid'], "val" => $thedats_0['name']);
}

$thecats2 = $this->db->query("select * from yn_site_sub_cat");
$thsersftsy2 = $thecats2->result_array();
foreach ($thsersftsy2 as $thedats_2) {
	$subcats[$thedats_2['sc_ctid']][] = array("id" => $thedats_2['sc_id'], "val" => $thedats_2['sc_name']);
}

$thecats23 = $this->db->query("select * from yn_site_sub2_cat");
$thsersftsys2 = $thecats23->result_array();
foreach ($thsersftsys2 as $thedats_2s) {
	$subcatss[$thedats_2s['mr_sub2_sid']][] = array("id" => $thedats_2s['mr_sub2_id'], "val" => $thedats_2s['mr_sub2_name']);
}

@$jsonCats = json_encode($categories);
@$jsonSubCats = json_encode(@$subcats);
@$jsonSubCats2 = json_encode(@$subcatss);
?>

<div class="row ml-0">
	<?php
	$sub_perform = $this->uri->segment(4);
	switch ($sub_perform) {
		case 'add-admin':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$getalladmins = $this->db->query("select * from yn_admin where aid='$aid'");
				$atheadmins = $getalladmins->row_array();
				$todoedit = $aid;
			}
	?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Add Admin</h5>
					<div>
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/admin',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="todo" value="<?= $todoedit ?>">
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa fa-user mr-2"></span> Name</span> </div>
								<input type="text" class="form-control" name="name" placeholder="Name of Admin"
									value="<?= @$atheadmins['name'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa fa-user-o mr-2"></span> User Name*</span> </div>
								<input type="text" class="form-control" name="u" placeholder="This will be used to login"
									value="<?= @$atheadmins['user'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa fa-lock mr-2"></span> Password*</span> </div>
								<input type="password" class="form-control" name="pass" placeholder="Password" value="">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa fa-envelope mr-2"></span> Email</span> </div>
								<input type="text" class="form-control" name="email" placeholder="Email for refrance only"
									value="<?= @$atheadmins['email'] ?>">
							</div>
							<div class="input-group mt-3 p-0">

								<select name="rights" class="form-control">
									<option value="1">Only View Leads</option>
									<option value="2">View More</option>
									<option value="3">Edit Basic</option>
									<option value="4">Edit All</option>
									<option value="5">Admin</option>
								</select>

							</div>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
			<?php
			$getalladmins = $this->db->query("select * from yn_admin");
			$atheadmins = $getalladmins->result_array();
			?>
			<div class="col-sm-6 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Admins</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Username</th>
									<th>Rights</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($atheadmins as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['aid'] ?></th>
										<td><?= $mess['name'] ?></td>
										<td><?= $mess['email'] ?></td>
										<td><?= $mess['user'] ?></td>
										<td><?= read_me_user('admin', $mess['rights']) ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['aid'] ?>&what=adm">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/add-admin?edit=') ?><?= $mess['aid'] ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>

										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'admins':
			$getalladmins = $this->db->query("select * from yn_admin");
			$atheadmins = $getalladmins->result_array();
		?>
			<div class="col-sm-8 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Admins</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Username</th>
									<th>Rights</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($atheadmins as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['aid'] ?></th>
										<td><?= $mess['name'] ?></td>
										<td><?= $mess['email'] ?></td>
										<td><?= $mess['user'] ?></td>
										<td><?= read_me_user('admin', $mess['rights']) ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['aid'] ?>&what=adm">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/add-admin?edit=') ?><?= $mess['aid'] ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'contact-details':
			$getalladats_amin = $this->db->query("select * from yn_admin_files where asid='1' ");
			$thedata = $getalladats_amin->row_array();
		?>
			<div class="main-card mb-3 card col-sm-6 ml-3">
				<div class="card-body">
					<h5 class="card-title">Contact Details</h5>
					<div>
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/google',this,'error_div','loder_div','#','1','success');">
							<input type='hidden' name='step' value='1'>



							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text">Website URL</span></div>
								<input placeholder="Website URL" type="text" class="form-control" name="web_url"
									value="<?= $thedata['web_url'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Business Name</span></div>
								<input placeholder="Company Name" type="text" class="form-control" name="comp_name"
									value="<?= $thedata['comp_name'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Company Tax</span></div>
								<input placeholder="Company Tax" type="text" class="form-control" name="tax"
									value="<?= $thedata['tax'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Website Name</span></div>
								<input placeholder="Website Domain" type="text" class="form-control" name="web"
									value="<?= $thedata['name'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> YOUR NAME</span></div>
								<input placeholder="Your Name" type="text" class="form-control" name="name"
									value="<?= $thedata['founder'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text">@ YOUR EMAIL</span></div>
								<input placeholder="Email to be shown on website" name="email" type="text" class="form-control"
									value="<?= $thedata['email'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Phone Number</span></div>
								<input placeholder="Phone Number" type="text" name="phone" class="form-control"
									value="<?= $thedata['phone'] ?>">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Phone No. 2 </span></div>
								<input placeholder="Phone Number 2" type="text" name="phone2" class="form-control"
									value="<?= $thedata['phone2'] ?>">
							</div>


							<div class="input-group mb-2">
								<div class="input-group-prepend"><span class="input-group-text"> Address </span></div>
								<!-- <input placeholder="Address" step="1" type="text" class="form-control"> -->
								<textarea name="add" placeholder="address" required=""
									class="form-control"><?= $thedata['address'] ?></textarea>

							</div>

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>
					</div>
				</div>
			</div>

			<div class="main-card mb-3 card col-sm-4 ml-4">
				<div class="card-body">
					<h5 class="card-title">Google Map</h5>
					<small>You can get a map for free from here:
						<br /><b> <a href="https://www.embedgooglemap.net/" target="_blank"> Map Link </a></b>
					</small>
					<div style="overflow: hidden;">
						<form class="form-horizontal mb-3  form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/google',this,'error_div','loder_div','#','1','success');">
							<input type='hidden' name='step' value='1.1'>
							<textarea name="map" placeholder="Google Map" class="form-control"
								style="height: 200px;"><?= $thedata['map'] ?></textarea>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

						<?= $thedata['map'] ?>

					</div>
				</div>
			</div>

		<?php
			break;


		case 'social-media':
			$sm = $this->db->query("select * from yn_admin_socialm");
			$social = $sm->row_array();
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Add your social Media </h5>
					<div>

						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/sm',this,'error_div','loder_div','#','1','success');">

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> <i
											class="fa-brands mr-3 fa-facebook-f"></i> Facebook</span> </div>
								<input type="text" class="form-control" name="fb" placeholder="your Facebook link"
									value="<?= $social['fb'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><i
											class="fa-brands fa-twitter mr-3"></i> Twitter</span> </div>
								<input type="text" class="form-control" name="tw" placeholder="your twitter link"
									value="<?= $social['tw'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-instagram mr-3"></span> Instagram</span> </div>
								<input type="text" class="form-control" name="insta" placeholder="Instagram Link"
									value="<?= $social['insta'] ?>">
							</div>
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-youtube mr-3"></span> YouTube</span> </div>
								<input type="text" class="form-control" name="yt" placeholder="YouTube Link"
									value="<?= $social['yt'] ?>">
							</div>
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><i
											class="fa-brands fa-pinterest mr-3"></i> Pintrest</span> </div>
								<input type="text" class="form-control" name="pint" placeholder="Pintrest"
									value="<?= $social['pint'] ?>">
							</div>
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-telegram mr-3"></span> Telegram</span> </div>
								<input type="text" class="form-control" name="telegram" placeholder="Telegram link"
									placeholder="" value="<?= $social['telegram'] ?>">
							</div>
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><i
											class="fa-light fa-blog mr-3"></i> Blog</span> </div>
								<input type="text" class="form-control" name="blog" placeholder="Blog link" placeholder=""
									value="<?= $social['blog'] ?>">
							</div>
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-linkedin mr-3"></span> Linked In</span> </div>
								<input type="text" class="form-control" name="linkedin" placeholder="linkedin link"
									placeholder="" value="<?= $social['linkedin'] ?>">
							</div>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>

		<?php break;

		case 'APP':
			$sm = $this->db->query("select * from yn_admin_socialm");
			$social = $sm->row_array();
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Add your APPs</h5>
					<div>
						<div style="height: 200px;overflow: hidden;"><img
								src="https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
								class="img-fluid"></div>
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/app',this,'error_div','loder_div','#','1','success');">

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-android mr-2"></span> Android APP</span> </div>
								<input type="text" class="form-control" name="and" placeholder="your Android APP link"
									value="<?= $social['app_and'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa-brands fa-apple mr-2"></span> IOS APP Link</span> </div>
								<input type="text" class="form-control" name="ios" placeholder="your IOS APP Link"
									value="<?= $social['app_ios'] ?>">
							</div>
							<div class="col-12"><input type="submit" name=""
									class="mt-2 btn-warning active btn py-2 text-white text-bold px-4 pull-right"
									value="SAVE DATA">
							</div>
					</div>
				</div>
			</div>

		<?php break;

		case 'about':
			$getbrief = $this->db->query("select * from yn_admin_files where asid='1' ");
			$getbrief_data = $getbrief->row_array();

			$page_data = get_page_data('about', 'na');
		?>
			<div class="main-card mb-3 card col-12">
				<div class="card-body">

					<h5 class="card-title">SEO</h5>
					<div class="row">
						<div class="col-sm-6">
							<form class="form-horizontal row form-label-left"
								onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/google',this,'error_div','loder_div','#','1','success');">
								<input type="hidden" name="step" value="2">
								<div class="form-group mt-3 col-sm-12">


									<div>
										<label>SEO Title</label>
										<input type="text" name="meta_title" placeholder="Meta Title" class="form-control"
											value="<?= $getbrief_data['meta_title'] ?>">
									</div>
									<div>
										<label>SEO Desc</label>
										<input type="text" name="meta_desc" placeholder="Meta Desc" class="form-control"
											value="<?= $getbrief_data['meta_desc'] ?>">
									</div>
									<div>
										<label>SEO Keywords in COma Separated Values</label>
										<input type="text" name="meta_key" placeholder="Meta Keywords" class="form-control"
											value="<?= $getbrief_data['meta_key'] ?>">
									</div>

									<div class="mb-2">
										<label>Home page to be as</label>
										<select class="form-control" name="home_page">
											<option value="" <?php if ($getbrief_data['home_page'] == '') {
																	echo 'selected';
																} ?>>Home</option>
											<option value="blog" <?php if ($getbrief_data['home_page'] == 'blog') {
																		echo 'selected';
																	} ?>>Latest Posts</option>
											<option value="search" <?php if ($getbrief_data['home_page'] == 'search') {
																		echo 'selected';
																	} ?>>Search</option>
											<option value="signup" <?php if ($getbrief_data['home_page'] == 'signup') {
																		echo 'selected';
																	} ?>>Signup</option>
											<option value="login" <?php if ($getbrief_data['home_page'] == 'login') {
																		echo 'selected';
																	} ?>>Login</option>
										</select>
									</div>

									<label>Brief about your company. This may be shown at <b>footer and emails.</b><br />
										<small>220 charecors would be perfect.</small>
										(special charectors will be ignored.)
									</label>

									<textarea name="brief" placeholder="Brief about your company." class="form-control"
										style="height: 150px;"><?= $getbrief_data['brief'] ?></textarea>

									<input type="submit" name=""
										class="mt-2 btn-warning active btn py-2 text-white text-bold px-4 btn-block pull-right"
										value="SAVE DATA">
								</div>
							</form>
						</div>
						<div class="col-sm-6">
							<div class="main-card mb-3 card col-12">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;'
												class='mb-3'>
										</div>
									</div>

									<h5 class="card-title">Refresh properly to see your new logo.</h5>
									<form method="post" action="<?= base_url('admin_action/add_image') ?>"
										onsubmit="return uploadandform('<?= base_url('admin_action/add_image') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
										enctype="multipart/form-data">
										<input type="hidden" name="what" value="logo">
										<input type="hidden" name="imageid" value="">

										<select name="ex" class="form-control col-sm-6 mb-2">
											<option value="sm">SiteMap</option>
											<option value="rb">Robot.txt</option>
											<option value="og">Meta Image</option>
										</select>
										<?php if (isset($_GET['edit']) && $_GET['edit'] != '') {
											echo "You are editing the logo now. <br/>Please select a new logo. <br/>";
										} ?>
										<input type="file" name="file_name"><br />
										<button class="btn mt-2 btn-warning">Change Logo</button>
									</form>

									<div class="col-12 mt-2 p-2 bg-light">
										<h5>Browse</h5>
										<a href="<?= base_url('assets/sitemap.xml') ?>"> sitemap.xml </a><br />
										<a href="<?= base_url('assets/robot.txt') ?>"> robot.txt </a>
									</div>

								</div>
								<div class="card-footer">Good luck!</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'scripts':
			$getbrief = $this->db->query("select * from yn_admin_files where asid='1' ");
			$getbrief_data = $getbrief->row_array();
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Scripts</h5>
					<div>

						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/google',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="step" value="3">
							<div class="form-group mt-3">
								<label><b>All the codes you can to add in head section</b></label>
								<textarea name="f" placeholder="All Html Codes in Head" class="form-control"
									style="height: 100px;"><?= $getbrief_data['f'] ?></textarea>
							</div>
							<div class="form-group mt-3">
								<label><b>Google Analytics</b></label>
								<textarea name="ga" placeholder="GA" class="form-control"
									style="height: 100px;"><?= $getbrief_data['ga'] ?></textarea>
							</div>
							<div class="form-group mt-3">
								<label><b>Live Chat</b></label>
								<textarea name="chat" placeholder="Live chat" class="form-control"
									style="height: 100px;"><?= $getbrief_data['chat'] ?></textarea>
							</div>
							<div class="form-group mt-3">
								<label><b>Javascript funnctions</b></label>
								<textarea name="f2" placeholder="JS codes" class="form-control"
									style="height: 100px;"><?= $getbrief_data['f2'] ?></textarea>
							</div>



							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'users':
			if (isset($_GET['paid']) && $_GET['paid'] == '1') {
				$theusrt = xss_clean($_GET['paid']);
				$getall_mems = $this->db->query("select * from yn_site_mem where amount_paid !='0' order by mid desc limit $limit1, $limit2");
			} else
      if (isset($_GET['utp']) && $_GET['utp'] != '') {
				$theusrt = xss_clean($_GET['utp']);
				$getall_mems = $this->db->query("select * from yn_site_mem where user_type='$theusrt' order by mid desc limit $limit1, $limit2");
			} else {
				$getall_mems = $this->db->query("select * from yn_site_mem order by mid desc limit $limit1, $limit2");
			}
			$members_are = $getall_mems->result_array();
		?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card p-2">
					<div class="card-header border">
						<div class="col-6"><?php
											if (isset($_GET['paid']) && $_GET['paid'] == '1') {
												echo 'Paid Users';
											} else {
												echo 'All Users';
											} ?></div>

						<!-- <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-focus">Last Week</button>
                                                <button class="btn btn-focus">All Month</button>
                                            </div>
                                        </div> -->
					</div>
					<div class="table-responsive-sm">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Date Created / Last Seen </th>
									<th class="text-left">Status</th>
									<th class="text-left">Type</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($members_are as $members) { ?>
									<tr>
										<td class="text-left text-muted">#<?= $members['mid'] ?></td>
										<td>
											<div class="widget-content p-0">
												<div class="widget-content-wrapper">
													<div class="widget-content-left mr-3">
														<div class="widget-content-left">
															<img width="40" class="rounded-circle"
																src="<?= base_url('assets/mem/') ?><?= $members['mid'] ?>/img/<?= $members['photo'] ?>"
																alt="">
														</div>
													</div>
													<div class="widget-content-left flex2">
														<div class="widget-heading">
															<?php if ($members['app_android_tok'] != '') { ?>
																<i class="fa-brands fa-android"></i>
															<?php }
															if ($members['app_ios_tok'] != '') {  ?>
																<i class="fa-brands fa-apple"></i>
															<?php } ?>
															<?= $members['name'] ?>
															<?php echo user_check($members['user_status']); ?>


														</div>
														<div class="widget-subheading opacity-7">
															<a href="<?= base_url('userprofile/' . $members['username']) ?>" class="text-primary" target="_blank">@<?= $members['username'] ?></a> <br />
															<?= $members['email'] ?><br /><?php if ($members['pass_nc'] != '') { ?>Password:
															<?= $members['pass_nc'] ?> <?php } ?>
														</div>
													</div>
												</div>
											</div>
										</td>
										<td class="text-left">
											<i class="fa-regular fa-mobile"></i> <a
												href="tel: <?= $members['contact'] ?>"><?= $members['contact'] ?></a><br />
										</td>
										<td class="text-left"><?= date_format_1($members['date'], 't') ?><br />
											<?= date_format_1($members['last_seen'], 't') ?></td>
										<td class="text-left"><?= read_me_user('user_status', $members['user_status']) ?> <br />
											<?= read_me_user('kyc_status', $members['kyc_status']) ?>
										</td>
										<td class="text-left"><?= read_me_user('user_type_status', $members['user_type']) ?> <br /><?= read_me_user('user_vendor', $members['is_vendor']) ?></td>
										<td class="text-left">
											<div class="mr-2 btn-group">
												<button class="btn btn-outline-secondary">Options</button>
												<button type="button" aria-haspopup="true" aria-expanded="false"
													data-toggle="dropdown"
													class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
														class="sr-only">Toggle Dropdown</span>
												</button>
												<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=active_user">
														<button type="button" tabindex="0" class="dropdown-item">Enable
															User</button></a>

													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=ban_user">
														<button type="button" tabindex="0" class="dropdown-item">Disable
															User</button></a>

													<?php if ($members['is_vendor'] == '0') { ?>
														<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=make_vendor">
															<button type="button" tabindex="0" class="dropdown-item">Make Vendor</button></a>
													<?php } else { ?>
														<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=remove_vendor">
															<button type="button" tabindex="0" class="dropdown-item">Remove Vendor</button></a>
													<?php } ?>



													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=verify_user">
														<button type="button" tabindex="0" class="dropdown-item">Verify
															User</button></a>

													<a href="<?= base_url('admin/perform/web/add-notification') ?>?id=<?= $members['mid'] ?>">
														<button type=" button" tabindex="0" class="dropdown-item">Send
															Message</button></a>

													<?php if ($members['kyc_status'] != '3') { ?>
														<a href="<?= base_url('admin/perform/custom/kyc-requests') ?>?id=<?= $members['mid'] ?>">
															<button type=" button" tabindex="0" class="dropdown-item">KYC Verification</button></a>
													<?php } ?>

													<?php if ($members['is_vendor'] != '0') { ?>
														<a href="<?= base_url('admin/perform/custom/user-shop') ?>?id=<?= $members['mid'] ?>">
															<button type=" button" tabindex="0" class="dropdown-item">View Shop</button></a>
													<?php } ?>

													<!-- <a
															href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=reset_pass">
															<button type="button" tabindex="0" class="dropdown-item">Reset
																Password</button></a> -->

													<div tabindex="-1" class="dropdown-divider"></div>
													<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
														href="<?= base_url('admin_action/delete') ?>?id=<?= $members['mid'] ?>&what=user">
														<button type="button" tabindex="0"
															class="dropdown-item">Delete</button></a>
												</div>
											</div>
										</td>

									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>

		<?php
			break;
		case 'contacts':
			if (isset($_GET['cid']) && $_GET['cid'] > 0) {
				$cid = $_GET['cid'];
				$getallmesgaes = $this->db->query("select * from yn_site_contact left join yn_site_services on con_type = service_id where con_cid='$cid' order by msid desc limit $limit1, $limit2");
			} else
              if (isset($_GET['con_type']) && $_GET['con_type'] > 0) {
				$con_type = $_GET['con_type'];
				$getallmesgaes = $this->db->query("select * from yn_site_contact left join yn_site_services on con_type = service_id where con_type='$con_type' order by msid desc limit $limit1, $limit2");
			} else {
				$getallmesgaes = $this->db->query("select * from yn_site_contact left join yn_site_services on con_type = service_id order by msid desc limit $limit1, $limit2");
			}
			$theallamesages = $getallmesgaes->result_array();
		?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Contact Requests</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Subject</th>
									<th style="max-width: 450px;">Message</th>
									<th>Status</th>
									<th>Contact For</th>
									<th>Date</th>
									<th>IP</th>
									<th>Document/Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['msid'] ?></th>
										<td><?= $mess['name'] ?></td>
										<td><a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a></td>
										<td><?= $mess['phone'] ?></td>
										<td><?= $mess['subject'] ?></td>
										<td style="max-width: 450px;"><?= trim_text($mess['msg'], 300, '...') ?>
											<br />
											<small><a
													href="<?= base_url('admin/perform/web/contacts_det?id=') ?><?= $mess['msid'] ?>">
													Read More </a>
											</small>
										</td>
										<td>
											<?= read_me_user('attention', $mess['l_status']) ?>
										</td>
										<td>
											<?= $mess['service_name'] ?>
										</td>
										<td><?= date_format_1($mess['date'], 1) ?></td>
										<td><?= $mess['ip'] ?></td>
										<td>
											<?php if ($mess['document'] != '') { ?><a
													href="<?= base_url('assets/avator/upload/') ?><?= $mess['document'] ?>"
													download>Document</a><br><?php } ?>

											<div class="mr-2 btn-group">
												<button class="btn btn-outline-secondary">Options</button>
												<button type="button" aria-haspopup="true" aria-expanded="false"
													data-toggle="dropdown"
													class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
														class="sr-only">Toggle Dropdown</span>
												</button>
												<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

													<a
														href="<?= base_url('admin/perform/web/contacts_det') ?>?id=<?= $mess['msid'] ?>">
														<button type="button" tabindex="0" class="dropdown-item">Read
															More</button></a>

													<a
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['msid'] ?>&what=attneed">
														<button type="button" tabindex="0" class="dropdown-item">Attention
															Needed</button></a>

													<a
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['msid'] ?>&what=attended">
														<button type="button" tabindex="0" class="dropdown-item">Mark as
															Attended</button></a>

													<div tabindex="-1" class="dropdown-divider"></div>
													<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
														href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['msid'] ?>&what=msg">
														<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
												</div>
											</div>


										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 5; $x <= $pageNum + 5; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'quotes':
			$getallmesgaes = $this->db->query("select * from `x-quote` order by qid desc limit $limit1, $limit2");
			$theallamesages = $getallmesgaes->result_array();
		?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Quote Requests</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th style="max-width: 450px;">Message</th>
									<!-- <th>Details</th> -->
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['qid'] ?></th>
										<td><?= $mess['name'] ?></td>
										<td><a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a></td>
										<td><?= $mess['phone'] ?></td>
										<td style="max-width: 450px;"><?= $mess['message'] ?>
										</td>
										<td><?= date_format_1($mess['date'], 1) ?></td>
										<td><?php if ($mess['document'] != '') { ?><a
													href="<?= base_url('assets/avator/upload/') ?><?= $mess['document'] ?>"
													download>Document</a><br><?php } ?>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['msid'] ?>&what=msg">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'intrested':
			$getallmesgaes = $this->db->query("select * from `x-intrested-clients` order by id desc limit $limit1, $limit2");
			$theallamesages = $getallmesgaes->result_array();
		?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Intrested Clients</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Product</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['id'] ?></th>
										<td><?= $mess['user_name'] ?></td>
										<td><a href="mailto: <?= $mess['user_email'] ?>"><?= $mess['user_email'] ?></a></td>
										<td><a href="tel:<?= $mess['user_phone'] ?>"><?= $mess['user_phone'] ?></a></td>
										<td><?= $mess['pro_name'] ?></td>
										<td><?= date_format_1($mess['date'], 1) ?></td>
										<td><?php if ($mess['document'] != '') { ?><a
													href="<?= base_url('assets/avator/upload/') ?><?= $mess['document'] ?>"
													download>Document</a><br><?php } ?>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['id'] ?>&what=intrest">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 6; $x <= $pageNum + 6; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;


		case 'contacts_det':
			$msid = $_GET['id'];
			$getallmesgaes = $this->db->query("select * from yn_site_contact where msid='$msid'");
			$mess = $getallmesgaes->row_array();
		?>

			<div class="main-card mb-3 card col-sm-8">
				<div class="card-body">
					<h5 class="card-title">Message</h5>
					<b><?= $mess['name'] ?></b><br />
					<a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a><br />
					<?= $mess['phone'] ?><br />
					<?= $mess['subject'] ?><br />
					<hr /><?= $mess['msg'] ?>
					<hr />
					<td><?= date_format_1($mess['date'], 1) ?></td>
					<br /><?= $mess['ip'] ?><br />
					<br /><?php if ($mess['document'] != '') { ?><a
							href="<?= base_url('assets/avator/upload/') ?><?= $mess['document'] ?>"
							download>Document</a><br><?php } ?>
					<br /> <a onclick="return confirm('Are you sure you want to delete this?');"
						href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['msid'] ?>&what=msg">
						<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
								class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

				</div>
			</div>

		<?php
			break;

		case 'call-backs':
			$getallmesgaes = $this->db->query("select * from site_callback order by clid desc limit $limit1, $limit2");
			$theallamesages = $getallmesgaes->result_array();
		?>
			<div class="col-sm-7 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Call Backs</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Mobile</th>
									<th>Date</th>
									<th>Name</th>
									<th>IP</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['clid'] ?></th>
										<td><?= $mess['cl_mobile'] ?></td>
										<td><?= date_format_1($mess['cl_date'], 1) ?></td>
										<td><?= $mess['cl_name'] ?></td>
										<td><?= $mess['cl_ip'] ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['clid'] ?>&what=clb">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'subscribe':
			$getallmesgaes = $this->db->query("select * from yn_site_subscribe order by sbc_id desc limit $limit1, $limit2");
			$theallamesages = $getallmesgaes->result_array();
		?>
			<div class="col-sm-6 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Subscribers</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Email</th>
									<th>Date</th>
									<th>IP</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['sbc_id'] ?></th>
										<td><?= $mess['sbc_email'] ?></td>
										<td><?= date_format_1($mess['sbc_date'], 1) ?></td>
										<td><?= $mess['sbc_ip'] ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['sbc_id'] ?>&what=subs">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>


			<?php
			$themonth_last = date("m") - 1;
			$themonth = date("m");
			$they = date("Y");

			// for leads
			$geththesales_3843 = $this->db->query("select sbc_id from yn_site_subscribe where (YEAR(sbc_date) = '$they') and (MONTH(sbc_date) = '$themonth') GROUP BY DAY(sbc_date)");
			$the_details_rpid = $geththesales_3843->result_array();

			$cr_pay33 = '';
			foreach ($the_details_rpid as $reships_mo) {
				@$cr_pay33 = $cr_pay33 . ',' . @$reships_mo['sbc_id'];
			}
			$subs_graph = substr($cr_pay33, 1);
			?>


			<div class="col-sm-6 mb-sm-5">
				<div class="card-body  bg-white">
					<h5 class="card-title">Subscribers</h5>
					<div class="table-responsive mt-4" style="max-height:400px;overflow: auto;">
						<canvas id="lineChart"></canvas>
					</div>
				</div>
			</div>

			<script type="text/javascript" src="<?= base_url('assets/admin') ?>/scripts/main.js"></script>
			<script type="text/javascript" src="<?= base_url('assets/admin') ?>/scripts/jquery.form.min.js"></script>
			<script type="text/javascript" src="<?= base_url('assets/admin') ?>/scripts/jquery.form.js"></script>
			<script src="https://cdn.ckeditor.com/4.13.1/standard-all/ckeditor.js"></script>

			<script type="text/javascript">
				//line
				var ctxL = document.getElementById("lineChart").getContext('2d');
				var myLineChart = new Chart(ctxL, {
					type: 'line',
					data: {
						labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16",
							"17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"
						],
						datasets: [{
							label: "Subscribers",
							data: [<?= $subs_graph ?>],
							backgroundColor: [
								'rgba(35, 1, 62, .5)',
							],
							borderColor: [
								'rgba(120, 39, 212, .4)',
							],
							borderWidth: 2
						}]
					},
					options: {
						responsive: true
					}
				});
			</script>

		<?php
			break;
		case 'ratings':
			$getallmesgaes = $this->db->query("select * from yn_site_review, yn_site_mem where lr_user=mid order by lrid desc limit $limit1, $limit2 ");
			$messs = $getallmesgaes->result_array();
		?>

			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Ratings</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th style="max-width: 450px;">Message</th>
									<th>Date</th>
									<th>Course Name</th>
									<th>IP</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $c = 1;
								foreach ($messs as $mess) { ?>
									<tr>
										<th scope="row"><?= $c++ ?></th>
										<td><?= $mess['name'] ?></td>
										<td style="max-width: 450px;"><?= trim_text($mess['cr_message'], 200, '...') ?>
											<a href="<?= base_url('admin/perform/web/rating_det?id=') ?><?= $mess['crid'] ?>"> Read
												More </a>
										</td>
										<td><?= date_format_1($mess['cr_date'], 1) ?></td>
										<td><?= $mess['course_name'] ?></td>
										<td><?= $mess['cr_ip'] ?></td>
										<td><?= read_me_user('rating', $mess['cr_status']) ?></td>
										<td>

											<div class="mr-2 btn-group">
												<button class="btn btn-outline-secondary">Options</button>
												<button type="button" aria-haspopup="true" aria-expanded="false"
													data-toggle="dropdown"
													class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
														class="sr-only">Toggle Dropdown</span>
												</button>
												<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

													<a onclick="return confirm('Are you sure you want to Mark this as Done?');"
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['crid'] ?>&what=rating_done&course_id=<?= $mess['cr_lid'] ?>">
														<button type="button" tabindex="0" class="dropdown-item">Allow</button></a>
													<a onclick="return confirm('Are you sure you want to Mark this as Undone?');"
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['crid'] ?>&what=rating_undone&course_id=<?= $mess['cr_lid'] ?>">
														<button type="button" tabindex="0" class="dropdown-item">Not
															Allowed</button></a>
													<a onclick="return confirm('Are you sure you want to delete this?');"
														href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['crid'] ?>&what=rating&course_id=<?= $mess['cr_lid'] ?>">
														<button class="dropdown-item">Delete</button></a>
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>

		<?php
			break;
		case 'rating_det':
			$msid = $_GET['id'];
			$getallmesgaes = $this->db->query("select * from x_edu_course_review left join x_edu_courses on x_edu_course_review.cr_lid = x_edu_courses.course_id
      left join yn_site_mem on x_edu_course_review.cr_user=yn_site_mem.mid where crid = $msid");
			$mess = $getallmesgaes->row_array();
		?>

			<div class="main-card mb-3 card col-sm-8">
				<div class="card-body">
					<h5 class="card-title">Message</h5>
					<b><?= $mess['name'] ?></b><br />
					<a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a><br />
					<?= $mess['contact'] ?><br />
					<hr /><?= $mess['cr_message'] ?><br /><br />
					<hr />
					<td><?= date_format_1($mess['cr_date'], 1) ?></td>
					<br /><?= $mess['ip'] ?><br />

				</div>
			</div>

		<?php
			break;
		case 'testimonials': ?>
			<?php
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_admin_testimonials where tid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
			?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Testimonials</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_testimonials') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_testimonials') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<input type="hidden" name="todo" value="<?= $todoedit ?>">
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span
											class="fa fa-user mr-2"></span> Name</span> </div>
								<input type="text" class="form-control" name="name" placeholder="Name"
									value="<?= @$atheadmins['name'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Company</span> </div>
								<input type="text" class="form-control" name="company" placeholder="Company"
									value="<?= @$atheadmins['company'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Profile*</span> </div>
								<input type="text" class="form-control" name="desi" placeholder="Profile"
									value="<?= @$atheadmins['role'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Order to show
									</span> </div>
								<input type="text" class="form-control" name="order"
									placeholder="Order (Higher order wIll show first.)" value="<?= @$atheadmins['li'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Star Ratings
									</span> </div>
								<select name="star" class="form-control">
									<option>5</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
								</select>
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text">Text</span> </div>
								<textarea class="form-control" name="text"><?= @$atheadmins['text'] ?></textarea>
							</div>
							<div class="input-group mt-3 p-0">
								<span class="form-control no_border">
									<input type="file" name="image_name" id="image_name no_border">
							</div>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
			<?php
			$gettex = $this->db->query("select * from yn_admin_testimonials order by li asc limit 80");
			$thedatss = $gettex->result_array();
			?>
			<div class="col-sm-12 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Testimonials</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Name</th>
									<th>Message</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($thedatss as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['li'] ?></th>
										<td><img width="40" class="rounded-circle"
												src="<?= base_url('assets/avator/webimg/t/') ?><?= $testimonials['image'] ?>"
												alt=""></td>

										<td style="min-width: 130px;"><?= $testimonials['name'] ?> <br />
											<small><?= $testimonials['company'] ?><br /><?= $testimonials['role'] ?></small>
										</td>
										<td>
											<?= ratings_star($testimonials['star'], 'star'); ?><br />
											<?= $testimonials['text'] ?></td>
										<td><?= read_me_user('test_status', $testimonials['status']) ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['tid'] ?>&what=tst">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/testimonials?edit=') ?><?= $testimonials['tid'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
											<!-- <a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $testimonials['tid'] ?>&what=pending_tm">
                                        <button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i class="fas fa-thumbs-down"></i></button></a>
                                        <a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $testimonials['tid'] ?>&what=approve_tm">
                                        <button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i class="fas fa-thumbs-up"></i></button></a> -->
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php break;

		case 'page-gallery': ?>
			<?php
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from  yn_site_gallery where ygl_id='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
			?>
			<div class="main-card mb-3 card col-sm-4" style="min-width: 300px;">
				<div class="card-body">
					<h5 class="card-title">Add videos to Gallery</h5>
					<a href="<?= base_url('admin_action/reset?do=gala') ?>" onclick="return confirm('Are you sure?');">Reset
						All</a>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_gallery') ?>" onsubmit="return uploadandform('<?= base_url('admin_action/add_gallery') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" method="post"
							enctype="multipart/form-data" id='fomr_id_proile22w'>

							<input type="hidden" name="todo" value="<?= $todoedit ?>">

							<div class="input-group mt-3 col-12 p-0">
								<input type="text" name="ygl_name" value="<?= @$atheadmins['ygl_name'] ?>" class='form-control' placeholder="Enter the video title">
							</div>
							<div class="input-group mt-3 p-0">
								<!-- <span class="form-control"> -->
								<input type="text" class="form-control" name="ygl_tags" placeholder="Enter comma separated tags">
							</div>
							<div class="input-group mt-3 p-0">
								<!-- <span class="form-control"> -->
								<input type="text" class="form-control" name="image_name" placeholder="Enter the youtube video link">
							</div>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
			<?php
			$gettex = $this->db->query("select * from  yn_site_gallery order by ygl_id asc limit $limit1, $limit2");
			$thedatss = $gettex->result_array();
			foreach ($thedatss as $gallery_imag) {
			?>
				<div class="p-2 shadow bg-white ml-1 mb-2" style="width:300px;word-break: break-word;">
					<div style="overflow: hidden;max-height: 250px;">
						<?= convertYoutube($gallery_imag['ygl_img']) ?>
					</div>
					<?= $gallery_imag['ygl_name'] ?> </br>
					<?= $gallery_imag['ygl_img'] ?>
					<hr />
					<a onclick="return confirm('are you sure you want to delete this?');"
						href="<?= base_url('admin_action/delete') ?>?id=<?= $gallery_imag['ygl_id'] ?>&what=image_galls">
						<i class="fa fa-trash mr-1"></i> Delete
					</a>
				</div>
			<?php } ?>
			<div class="col-12">
				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		<?php break;
		case 'page-about':
			$page_data = get_page_data('about', 'na');
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">About your company</h5>
					<div>
						<img src="https://cdn.pixabay.com/photo/2016/05/04/07/56/businessman-1370983_960_720.jpg"
							class="img-fluid">
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/page_data',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="page" value="about">
							<div class="form-group mt-3">
								<hr />
								<label>About us page of your website.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text"
									id='rich_text12_90'><?= $page_data['content'] ?></textarea>
							</div>

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'c-blocks':
			@$the_block = xss_clean($_GET['block']);
			$page_data = get_page_data($the_block, $the_block);
			if (@$_GET['block'] != '') {
				$send_meher = 'page_data';
			} else {
				$send_meher = 'add_page_data';
			}
		?>
			<div class="main-card mb-3 card col-sm-7">
				<div class="card-body">
					<h5 class="card-title">Website Content Blocks </h5>
					<div>


						<div class="bg-light p-2">
							<small>Cannot find your desired Page Name? <br /><a
									href="<?= base_url('admin/perform/web/tags-type?tgt=pg') ?>">Click Here</a> to
								create new Page</small>
						</div>

						<form method="post" action="<?= base_url('admin_action/'); ?><?= $send_meher ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $send_meher ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">
							<!-- <label>Unique Name of the block</label> -->

							<!-- <input type="text" name="page" value="<?= @$page_data['name'] ?>" class="form-control" placeholder="Block Name"> -->

							<label>Page Name</label>
							<?php $getAllKeywordsType = $this->db->query("SELECT * FROM `yn_site_tags_type` where stg_type ='pg' ORDER BY `stst_name` ASC limit 90");
							$keywordsType = $getAllKeywordsType->result_array();
							if (count($keywordsType) > 0) { ?>
								<select class="form-control" name="page">
									<?php foreach ($keywordsType as $kt) { ?>
										<option value="<?= $kt['stst_name'] ?>" <?php if (@$type == $kt['stst_name']) {
																					echo "selected";
																				} ?>><?= ucwords($kt['stst_name']) ?></option>
									<?php } ?>
								</select>
							<?php } ?>


							<input type="hidden" name="page_id" value="<?= @$page_data['pid'] ?>">
							<select class="form-control my-2" name="type2">
								<option value="">Select Content type</option>
								<option value="a" <?php //if($page_data['type']=='a'){echo 'selected';
													?>>Series A</option>
								<option value="b">Series B</option>
								<option value="c">Series C</option>
								<option value="d">Series D</option>
								<option value="e">Series E</option>
								<option value="f">Series F</option>
							</select>

							<label>Upload Content</label>
							<input type="file" name="file_name" class="form-control">

							<!-- <label>Link</label>
                                <input type="text" name="link" value="<?= @$page_data['content_link'] ?>" class="form-control" placeholder="Google Drive Link"> -->

							<div class="row bg-light p-2 m-0 p-0 mt-3">

								<div class="col-sm-6">
									<label>Slug</label>
									<input type="text" name="pg_slug" value="<?= @$page_data['pg_slug'] ?>" class="form-control"
										placeholder="Slug">
								</div>
								<div class="col-sm-6">
									<label>Meta Title</label>
									<input type="text" name="pg_meta_title" value="<?= @$page_data['pg_meta_title'] ?>"
										class="form-control" placeholder="Title">
								</div>

								<div class="col-sm-6">
									<label>Meta Desc</label>
									<input type="text" name="pg_meta_dec" value="<?= @$page_data['pg_meta_dec'] ?>"
										class="form-control" placeholder="Desc">
								</div>

								<div class="col-sm-6">
									<label>Meta Keywords</label>
									<input type="text" name="pg_meta_key" value="<?= @$page_data['pg_meta_key'] ?>"
										class="form-control" placeholder="Keywords">
								</div>

							</div>

							<div class="form-group mt-3">
								<hr />
								<label>Content.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text"
									id='rich_text12_90'><?= @$page_data['content'] ?></textarea>
							</div>



							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold px-5"
								value="SAVE DATA">
						</form>
					</div>
					<div class="mt-3 pull-right">
						<a onclick="return confirm('are you sure you want to delete this?');"
							href="<?= base_url('admin_action/delete') ?>?id=<?= $the_block ?>&what=block_co">
							<i class="fa fa-trash mr-1"></i> Delete
						</a>
					</div>
				</div>
			</div>

			<?php
			$get_all_blocks = $this->db->query("select * from yn_admin_pages where name !='' ");
			$the_pages_data = $get_all_blocks->result_array();
			?>
			<div class="col-sm-4 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Block</h5>
						<div class="row">
							<?php
							foreach ($the_pages_data as $bloks_data) { ?>
								<div class="col-sm-6 text-uppercase py-1" style="border-bottom: 1px solid #eee;">
									<a href="<?= base_url('admin/perform/web/c-blocks?block=') ?><?= $bloks_data['pid'] ?>"><i
											class="fa fa-file mr-2"> </i><?= $bloks_data['name'] ?> <?= $bloks_data['type'] ?></a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'page-terms':
			$page_data = get_page_data('terms', 'na');
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Terms</h5>
					<div>
						<img src="https://cdn.pixabay.com/photo/2017/02/18/02/59/application-2076445_960_720.png"
							class="img-fluid">
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/page_data',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="page" value="terms">
							<div class="form-group mt-3">
								<hr />
								<label>About us page of your website.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text"
									id='rich_text12_90'><?= $page_data['content'] ?></textarea>
							</div>

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'popups':
			@$the_block = xss_clean($_GET['block']);
			$page_data = get_page_data($the_block, $the_block);
			if (@$_GET['block'] != '') {
				$send_meher = 'page_data';
			} else {
				$send_meher = 'add_page_data';
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Popups </h5>
					<div>
						<form method="post" action="<?= base_url('admin_action/'); ?><?= $send_meher ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $send_meher ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">
							<label>Unique Name / Title of the Popup</label>
							<input type="text" name="page" value="<?= @$page_data['name'] ?>" class="form-control"
								placeholder="Popup Name / Title">
							<input type="hidden" name="page_id" value="<?= @$page_data['pid'] ?>">
							<input type="hidden" name="type2" value="popups">
							<!-- <select class="form-control my-2" name="type2" >
                    <option value="">Select Content type</option>
                    <option value="a" <?php //if($page_data['type']=='a'){echo 'selected';
										?>>Series A</option>
                    <option value="b">Series B</option>
                    <option value="c">Series C</option>
                    <option value="d">Series D</option>
                    <option value="e">Series E</option>
                    <option value="f">Series F</option>
                  </select> -->

							<label>Upload Image</label>
							<input type="file" name="file_name" class="form-control">
							<input type="hidden" name="pg_slug" value="YN_PP">
							<label>Link</label>
							<input type="text" name="link" value="<?= @$page_data['content_link'] ?>" class="form-control"
								placeholder="Web Link With HHTPS">

							<div class="form-group mt-3">
								<hr />
								<label>Content.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text"
									id='rich_text12_90'><?= @$page_data['content'] ?></textarea>
							</div>
							<label>Status</label>
							<div class="form-group has-feedback">
								<select name="status" class="form-control" required="">
									<option value="">--Select Status--</option>
									<option value="1" <?php if (@$page_data['status'] == '1') {
															echo 'selected';
														} ?>>Active</option>
									<option value="0" <?php if (@$page_data['status'] == '0') {
															echo 'selected';
														} ?>>In-Active</option>
								</select>
							</div>

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold px-5"
								value="SAVE DATA">
						</form>
					</div>
					<div class="mt-3 pull-right">
						<a onclick="return confirm('are you sure you want to delete this?');"
							href="<?= base_url('admin_action/delete') ?>?id=<?= $the_block ?>&what=block_co">
							<i class="fa fa-trash mr-1"></i> Delete
						</a>
					</div>
				</div>
			</div>

			<?php
			$get_all_blocks = $this->db->query("select * from yn_admin_pages where type='popups' and name !='' ");
			$the_pages_data = $get_all_blocks->result_array();
			?>
			<div class="col-sm-4 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Popups</h5>
						<div class="row">
							<?php
							foreach ($the_pages_data as $bloks_data) { ?>
								<div class="col-12 py-1" style="border-bottom: 1px solid #eee;">
									<img src="<?= base_url('assets/avator/upload/content/') ?><?= $bloks_data['content_file'] ?>"
										class='img-fluid'>
									<small><?= trim_text(strip_tags($bloks_data['content']), 320, '...') ?></small>
									<br /><?= $bloks_data['content_link'] ?>

									<br /><a
										href="<?= base_url('admin/perform/web/popups?type=popups&block=') ?><?= $bloks_data['pid'] ?>"><i
											class="fa fa-pencil mr-2"> </i>Edit <?= $bloks_data['name'] ?></a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'page-privacy':
			$page_data = get_page_data('privacy', 'na');
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Privacy</h5>
					<div>
						<img src="https://cdn.pixabay.com/photo/2017/02/18/02/59/application-2076445_960_720.png"
							class="img-fluid">
						<form class="form-horizontal form-label-left"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/page_data',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="page" value="privacy">
							<div class="form-group mt-3">
								<hr />
								<label>About us page of your website.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text"
									id='rich_text12_90'><?= $page_data['content'] ?></textarea>
							</div>

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
								value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'search':
			$q = $_GET['q'];
		?>
			<?php
			$getall_mems = $this->db->query("select * from yn_site_mem where name LIKE '%$q%' order by mid desc limit $limit1, $limit2");
			$members_are = $getall_mems->result_array();
			?>

			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-header">All Users
						<!-- <div class="btn-actions-pane-right">
                                  <div role="group" class="btn-group-sm btn-group">
                                      <button class="active btn btn-focus">Last Week</button>
                                      <button class="btn btn-focus">All Month</button>
                                  </div>
                              </div> -->
					</div>
					<div class="table-responsive-sm">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Name</th>
									<th class="text-left">Phone</th>
									<th class="text-left">Date Created / Last Seen </th>
									<th class="text-left">Status</th>
									<th class="text-left">Type</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($members_are as $members) { ?>
									<tr>
										<td class="text-left text-muted">#<?= $members['mid'] ?></td>
										<td>
											<div class="widget-content p-0">
												<div class="widget-content-wrapper">
													<div class="widget-content-left mr-3">
														<div class="widget-content-left">
															<img width="40" class="rounded-circle"
																src="<?= base_url('assets/mem/') ?><?= $members['mid'] ?>/img/<?= $members['photo'] ?>"
																alt="">
														</div>
													</div>
													<div class="widget-content-left flex2">
														<div class="widget-heading">
															<?php if ($members['app_android_tok'] != '') { ?>
																<i class="fa-brands fa-android"></i>
															<?php }
															if ($members['app_ios_tok'] != '') {  ?>
																<i class="fa-brands fa-apple"></i>
															<?php } ?>
															<?= $members['name'] ?>
															<?php echo user_check($members['user_status']); ?>


														</div>
														<div class="widget-subheading opacity-7">
															<a href="<?= base_url('userprofile/' . $members['username']) ?>" class="text-primary" target="_blank">@<?= $members['username'] ?></a> <br />
															<?= $members['email'] ?><br /><?php if ($members['pass_nc'] != '') { ?>Password:
															<?= $members['pass_nc'] ?> <?php } ?>
														</div>
													</div>
												</div>
											</div>
										</td>
										<td class="text-left">
											<i class="fa-regular fa-mobile"></i> <a
												href="tel: <?= $members['contact'] ?>"><?= $members['contact'] ?></a><br />
										</td>
										<td class="text-left"><?= date_format_1($members['date'], 't') ?><br />
											<?= date_format_1($members['last_seen'], 't') ?></td>
										<td class="text-left"><?= read_me_user('user_status', $members['user_status']) ?> <br />
											<?= read_me_user('kyc_status', $members['kyc_status']) ?>
										</td>
										<td class="text-left"><?= read_me_user('user_type_status', $members['user_type']) ?></td>
										<td class="text-left">
											<div class="mr-2 btn-group">
												<button class="btn btn-outline-secondary">Options</button>
												<button type="button" aria-haspopup="true" aria-expanded="false"
													data-toggle="dropdown"
													class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
														class="sr-only">Toggle Dropdown</span>
												</button>
												<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=active_user">
														<button type="button" tabindex="0" class="dropdown-item">Enable
															User</button></a>

													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=ban_user">
														<button type="button" tabindex="0" class="dropdown-item">Disable
															User</button></a>


													<a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=verify_user">
														<button type="button" tabindex="0" class="dropdown-item">Verify
															User</button></a>

													<a href="<?= base_url('admin/perform/web/add-notification') ?>?id=<?= $members['mid'] ?>">
														<button type=" button" tabindex="0" class="dropdown-item">Send
															Message</button></a>

													<?php if ($members['kyc_status'] != '3') { ?>
														<a href="<?= base_url('admin/perform/custom/kyc-requests') ?>?id=<?= $members['mid'] ?>">
															<button type=" button" tabindex="0" class="dropdown-item">KYC Verification</button></a>
													<?php } ?>

													<!-- <a href="<?= base_url('admin_action/user_modify') ?>?id=<?= $members['mid'] ?>&what=reset_pass">
															<button type="button" tabindex="0" class="dropdown-item">Reset
																Password</button></a> -->

													<div tabindex="-1" class="dropdown-divider"></div>
													<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
														href="<?= base_url('admin_action/delete') ?>?id=<?= $members['mid'] ?>&what=user">
														<button type="button" tabindex="0"
															class="dropdown-item">Delete</button></a>
												</div>
											</div>
										</td>

									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                              <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>
			<?php

			$getallmesgaes = $this->db->query("select * from yn_site_contact where (name like '%$q%' or phone like '%$q%' ) order by msid desc limit $limit1, $limit2");
			$theallamesages = $getallmesgaes->result_array();
			?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Matching Leads</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Subject</th>
									<th style="max-width: 450px;">Message</th>
									<th>Status</th>

									<th>Date</th>
									<th>IP</th>
									<th>Document/Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($theallamesages as $mess) { ?>
									<tr>
										<th scope="row"><?= $mess['msid'] ?></th>
										<td><?= $mess['name'] ?></td>
										<td><a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a></td>
										<td><?= $mess['phone'] ?></td>
										<td><?= $mess['subject'] ?></td>
										<td style="max-width: 450px;"><?= trim_text($mess['msg'], 300, '...') ?>
											<br />
											<small><a
													href="<?= base_url('admin/perform/web/contacts_det?id=') ?><?= $mess['msid'] ?>">
													Read More </a>
											</small>
										</td>
										<td>
											<?= read_me_user('attention', $mess['l_status']) ?>
										</td>
										<td><?= date_format_1($mess['date'], 1) ?></td>
										<td><?= $mess['ip'] ?></td>
										<td>
											<?php if ($mess['document'] != '') { ?><a
													href="<?= base_url('assets/avator/upload/') ?><?= $mess['document'] ?>"
													download>Document</a><br><?php } ?>

											<div class="mr-2 btn-group">
												<button class="btn btn-outline-secondary">Options</button>
												<button type="button" aria-haspopup="true" aria-expanded="false"
													data-toggle="dropdown"
													class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
														class="sr-only">Toggle Dropdown</span>
												</button>
												<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

													<a
														href="<?= base_url('admin/perform/web/contacts_det') ?>?id=<?= $mess['msid'] ?>">
														<button type="button" tabindex="0" class="dropdown-item">Read
															More</button></a>

													<a
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['msid'] ?>&what=attneed">
														<button type="button" tabindex="0" class="dropdown-item">Attention
															Needed</button></a>

													<a
														href="<?= base_url('admin_action/user_modify') ?>?id=<?= $mess['msid'] ?>&what=attended">
														<button type="button" tabindex="0" class="dropdown-item">Mark as
															Attended</button></a>

													<div tabindex="-1" class="dropdown-divider"></div>
													<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
														href="<?= base_url('admin_action/delete') ?>?id=<?= $mess['msid'] ?>&what=msg">
														<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
												</div>
											</div>


										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php
			$getPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE (p_content like '%$q%' or name like '%$q%' ) order by p_id desc limit $limit1, $limit2");
			$posts = $getPosts->result_array();
			?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Matching Posts</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Content</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1;
								foreach ($posts as $post) { ?>
									<tr>
										<th scope="row"><?= $count++ ?></th>
										<td><?= $post['name'] ?><br /><small><a href="<?= base_url('userprofile/' . $post['username']) ?>">@<?= $post['username'] ?></a></small></td>
										<td style="max-width: 450px;"><?= trim_text($post['p_content'], 300, '...') ?>
										</td>
										<td><?= date_format_1($post['p_created'], 1) ?></td>
										<td>
											<a onclick="return confirm('Do you really want to delete this post?');" href="<?= base_url('admin_action/delete') ?>?id=<?= $post['p_id'] ?>&what=post"><button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php if (check_service_status('1', '2', 'eco') == '1') { ?>
				<div class="col-12 pl-0">
					<div class="main-card mb-3 card">
						<div class="text-right m-2 pr-5"> </div>
						<div class="card-header">Matching Products
						</div>
						<div class="table-responsive min700">
							<table class="align-middle mb-0 table table-borderless table-striped table-hover">
								<thead>
									<tr>
										<th class="text-left">#</th>
										<th>Name</th>
										<th class="text-left">Shop</th>
										<th class="text-left">Category</th>
										<th class="text-left">Price</th>
										<th class="text-left">Status</th>
										<th class="text-left">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 1;
									$getProducts = $this->db->query("SELECT * FROM  yn_ecom_products where p_name like '%$q%' order by p_id desc limit $limit1, $limit2 ");
									if ($getProducts->num_rows() > 0) {
										foreach ($getProducts->result_array() as $products) {
									?>
											<tr>
												<td class="text-left text-muted">#<?= $count++; ?></td>
												<td>
													<div class="widget-content-left flex2">
														<div class="widget-heading">
															<b>
																<!-- <a href="<?= base_url('product/') ?><?= $products['p_id'] ?>/<?= url_smart($products['p_name']) ?>" target='_blank'> -->
																<?= $products['p_name'] ?>
																<!-- </a> -->
															</b>
														</div>
													</div>
												</td>
												<td class="text-left">
													<?= getShop($products['p_vendor']) ?>
												</td>
												<td class="text-left">
													<?= getCategory($products['p_category']) ?>
												</td>
												<td class="text-left">₹<?= $products['p_price'] ?> </td>
												<td class="text-left"><?= read_me_product("product_status", $products['p_status']) ?> </td>

												<td class="text-left">
													<div class="mr-2 btn-group">
														<button class="btn btn-outline-secondary">Options</button>
														<button type="button" aria-haspopup="true" aria-expanded="false"
															data-toggle="dropdown"
															class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
																class="sr-only">Toggle Dropdown</span>
														</button>
														<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

															<a
																href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=enable_product">
																<button type="button" tabindex="0" class="dropdown-item">Enable
																</button></a>

															<a
																href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=disable_product">
																<button type="button" tabindex="0" class="dropdown-item">Disable
																</button></a>

															<!-- <a
															href="<?= base_url('admin/perform/web/images') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">ADD
																IMAGES</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature">
															<button type="button" tabindex="0" class="dropdown-item">Add Featured
															</button></a>


														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_populer">
															<button type="button" tabindex="0" class="dropdown-item">Add Populer
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_day_deal">
															<button type="button" tabindex="0" class="dropdown-item">Add Day Deal
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_top_sale">
															<button type="button" tabindex="0" class="dropdown-item">Add Top Sale
															</button></a> -->

															<!-- <a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=add_to_slider">
															<button type="button" tabindex="0" class="dropdown-item">ADD TO SLIDER
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=remove_from_slider">
															<button type="button" tabindex="0" class="dropdown-item">REMOVE FROM SLIDER
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_add">
															<button type="button" tabindex="0" class="dropdown-item">ADD FEATURE
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_remove">
															<button type="button" tabindex="0" class="dropdown-item">Reset product type
															</button></a> -->


															<!-- <a
															href="<?= base_url('admin/perform/web/products') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">Edit</button></a> -->

															<div tabindex="-1" class="dropdown-divider"></div>
															<a onclick="return confirm('Do you really want to delete this Product, you can Disable the Product as well.');"
																href="<?= base_url('admin_action/delete') ?>?id=<?= @$products['p_id'] ?>&what=product">
																<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
														</div>
													</div>
												</td>

											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>

						</div>
						<div class="d-block text-center card-footer">
							<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                                      <button class="btn-wide btn btn-success">Save</button> -->
						</div>
					</div>
				</div>


			<?php }


			break;
		case 'img-logo':
			$getaction = 'add_image';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_img where img_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$getaction = 'edit_image';
				$theidval = $_GET['edit'];
			}
			?>
			<div class="main-card mb-3 card">
				<div class="card-header">Change Your Logo</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo_light.png') ?>" style='width:150px;background:#333;'
								class='mb-3 p-1'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new logo.</h5>
					Because of cache you may not see new logo updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated logo.<br />

					<p> Make sure you are adding horizontal image in the size of <b>220px width Maximum</b> and hight as per
						your image.</p>
					<form method="post" action="<?= base_url('admin_action/') ?><?= $getaction ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="logo">
						<input type="hidden" name="imageid" value="<?= $theidval ?>">

						<select name="ex" class="form-control col-sm-6 mb-2">
							<option value="w">Dark Logo</option>
							<option value="b">Light Logo</option>
							<option value="f">Favicon</option>
							<option value="og">Open Graph</option>
						</select>
						<?php if (isset($_GET['edit']) && $_GET['edit'] != '') {
							echo "You are editing the logo now. <br/>Please select a new logo. <br/>";
						} ?>
						<input type="file" name="file_name"><br />
						<button class="btn mt-2 btn-warning">Change Logo</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>

			<div class="main-card mb-3 col-sm-6 card ml-3">
				<div class="card-header">Logo</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:300px;'>
							<hr />
							<img src="<?= base_url('assets/avator/logo_light.png') ?>" style='width:300px;'>
							<hr>
							<img src="<?= base_url('assets/avator/favicon.png') ?>" style='width:300px;'>
						</div>
					</div>
				</div>
			</div>
		<?php
			break;

		case 'img-slider':
			$getaction = 'add_image';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_img where img_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$getaction = 'edit_image';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card">
				<div class="card-header">Add / Remove sliders</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>
					Because of cache you may not see new Image updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated Image.<br />

					<p> Make sure you are adding horizontal image in the size of <b>1200px width Minimum</b> and hight as per
						your image.<br /> <b> Also please make sure all the images are of same height</b></p>
					<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="slider1">
						<input type="hidden" name="imageid" value="<?= $theidval ?>">

						<!-- <input type="text" name="text" placeholder="Text" class="form-control mb-2 col-sm-6" value="<?= @$theimage_details3['img_text'] ?>"> -->



						<input type="text" name="sort" placeholder="Top Title" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_sort'] ?>">
						<input type="text" name="link" placeholder="Heading" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_link'] ?>">
						<input type="file" name="file_name"><br /><br>
						<textarea class="form-control rich_text" id="s_s9iskls90s" placeholder="Text"
							name="text"><?= @$theimage_details3['img_text'] ?></textarea>

						<button class="btn mt-2 btn-warning">Add Slider</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			$get_sliders = $this->db->query("select * from yn_site_img where img_place='slider1' and img_status='1' order by img_sort asc limit 10");
			$allsliedsrs = $get_sliders->result_array();
			?>
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Slider Images</h5>
						<div id="carouselExampleControls2" class="carousel slide carousel-fade" data-ride="carousel">
							<div class="carousel-inner">
								<?php $i = 'active';
								foreach ($allsliedsrs as $slidersr) { ?>
									<div class="carousel-item <?= $i ?>">
										<img class="d-block w-100"
											src="<?= base_url('assets/avator/upload/') ?><?= $slidersr['img_name'] ?>"
											alt="First slide">
										<div class="carousel-caption d-none d-md-block">
											<!-- <h5>First Slide</h5> -->
											<p><?= $slidersr['img_text'] ?></p>
										</div>
									</div>
								<?php $i = '';
								} ?>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Sliders</h5>
						<a href="<?= base_url('ynaps_admin_action/reset_data/sli') ?>"
							onclick="return confirm('Are you sure?');">Reset</a>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>Title</th>
									<th>Image</th>
									<th>Text</th>
									<th>Link</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['img_sort'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['img_name'] ?>"
												style='height:40px;'></td>
										<td><?= $slider2['img_text'] ?></td>
										<td><?= $slider2['img_link'] ?></td>
										<td><?= $slider2['img_status'] ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['img_id'] ?>&what=img">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/img-slider') ?>?edit=<?= $slider2['img_id'] ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'img-about':
			$getaction = 'add_image';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_img where img_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$getaction = 'edit_image';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card">
				<div class="card-header">Add / Remove about</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo-b.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>
					Because of cache you may not see new Image updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated Image.<br />

					<p> Make sure you are adding horizontal image in the size of <b>1200px width Minimum</b> and hight as per
						your image.<br /> <b> Also please make sure all the images are of same height</b></p>
					<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="about">
						<input type="hidden" name="imageid" value="<?= $theidval ?>">
						<input type="text" name="text" placeholder="Text" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_text'] ?>">
						<input type="text" name="sort" placeholder="Order" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_sort'] ?>">
						<input type="text" name="link" placeholder="link" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_link'] ?>">
						<input type="file" name="file_name"><br />
						<button class="btn mt-2 btn-warning">Add about</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			$get_sliders = $this->db->query("select * from yn_site_img where img_place='about' and img_status='1' order by img_sort asc limit 10");
			$allsliedsrs = $get_sliders->result_array();
			?>

			<div class="col-sm-6">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All About</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Text</th>
									<th>Link</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['img_sort'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['img_name'] ?>"
												style='height:40px;'></td>
										<td><?= $slider2['img_text'] ?></td>
										<td><?= $slider2['img_link'] ?></td>
										<td><?= $slider2['img_status'] ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['img_id'] ?>&what=img">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/img-about') ?>?edit=<?= $slider2['img_id'] ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'img-others':
			$getaction = 'add_image';
			$theidval = '';
			if (isset($_GET['pag_d']) && $_GET['pag_d'] != '') {
				$pag_d = $_GET['pag_d'];
			}
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_img where img_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$getaction = 'edit_image';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card">
				<div class="card-header">Add / Remove Image</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>
					Because of cache you may not see new Image updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated Image.<br />

					<p> Make sure you are adding horizontal image in the size of <b>1200px width Minimum</b> and hight as per
						your image.<br /> <b> Also please make sure all the images are of same height</b></p>
					<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="others">
						<input type="hidden" name="imageid" value="<?= $theidval ?>">
						<textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text"
							name="text"><?= @$theimage_details3['img_text'] ?></textarea>
						<div class="row my-2">
							<div class="col-sm-6"><input type="text" name="sort" placeholder="Order" class="form-control col-12"
									value="<?= @$theimage_details3['img_sort'] ?>"></div>
							<div class="col-sm-6"><input type="text" name="link" placeholder="link" class="form-control col-12"
									value="<?= @$theimage_details3['img_link'] ?>"></div>
						</div>

						<div class="row my-2">
							<div class="col-sm-6"><input type="text" name="head" placeholder="Heading"
									class="form-control col-12" value="<?= @$theimage_details3['img_head'] ?>"></div>
							<div class="col-sm-6"><select class="form-control" name="typename">
									<option value="team" <?php if (@$pag_d == 'team' || @$theimage_details3['img_place'] == 'team') {
																echo "selected";
															} ?>>Banner</option>
									<option value="port" <?php if (@$pag_d == 'port' || @$theimage_details3['img_place'] == 'port') {
																echo "selected";
															} ?>>Portfolio</option>
									<option value="oth" <?php if (@$pag_d == 'oth' || @$theimage_details3['img_place'] == 'oth') {
															echo "selected";
														} ?>>Others</option>
								</select></div>
						</div>

						<div class="col-12 my-1 px-0">
							<textarea class="form-control" placeholder="Other content block"
								name="img_text2"><?= @$theimage_details3['img_text2'] ?></textarea>
						</div>

						<input type="file" name="file_name"><br />
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Images</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			if (@$_GET['pag_d'] != '') {
				$thetypes = xss_clean($_GET['pag_d']);
				$get_sliders = $this->db->query("select * from yn_site_img where img_place ='$thetypes' and img_status='1' order by img_id desc limit 10");
			} else {
				$get_sliders = $this->db->query("select * from yn_site_img where img_place !='' and img_status='1' order by img_id desc limit 10");
			}
			$allsliedsrs = $get_sliders->result_array();
			?>

			<div class="col-sm-6 px-0 ml-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Contents</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Text</th>
									<!-- <th>Type</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['img_id'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['img_name'] ?>"
												style='height:40px;'></td>
										<td>
											<b><a href="<?= $slider2['img_link'] ?>"
													target='_blank'><?= $slider2['img_head'] ?></a></b><br />
											<?= trim_text(strip_tags($slider2['img_text']), '90') ?>
										</td>
										<!-- <td><a
                                    href="<?= base_url('admin/perform/web/img-others?pag_d=') ?><?= $slider2['img_place'] ?>"><?= $slider2['img_place'] ?></a>
                            </td> -->
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['img_id'] ?>&what=img">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/img-others') ?>?edit=<?= $slider2['img_id'] ?>&pag_d=<?= @$pag_d ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'img-partners':
			$getaction = 'add_image';
			$theidval = '';
			if (isset($_GET['pag_d']) && $_GET['pag_d'] != '') {
				$pag_d = $_GET['pag_d'];
			}
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_img where img_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$getaction = 'edit_image';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card">
				<div class="card-header">Add / Remove Image</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>
					Because of cache you may not see new Image updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated Image.<br />

					<p> Make sure you are adding horizontal image in the size of <b>1200px width Minimum</b> and hight as per
						your image.<br /> <b> Also please make sure all the images are of same height</b></p>
					<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="partner">
						<input type="hidden" name="imageid" value="<?= $theidval ?>">
						<input type="text" name="head" placeholder="Heading" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_head'] ?>">
						<input type="text" name="text" placeholder="Text 1" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_text'] ?>">
						<input type="text" name="text2" placeholder="Text 2" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_text2'] ?>">
						<input type="text" name="sort" placeholder="Order (Desc)" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_sort'] ?>">
						<input type="text" name="link" placeholder="link" class="form-control mb-2 col-sm-6"
							value="<?= @$theimage_details3['img_link'] ?>">

						<input type="file" name="file_name"><br />
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Images</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			if (@$_GET['pag_d'] != '') {
				$thetypes = xss_clean($_GET['pag_d']);
				$get_sliders = $this->db->query("select * from yn_site_img where img_place ='port' and img_status='1' order by img_sort desc limit $limit1,$limit2");
			} else {
				$get_sliders = $this->db->query("select * from yn_site_img where img_place = 'partner' and img_status='1' order by img_sort desc limit $limit1,$limit2");
			}
			$allsliedsrs = $get_sliders->result_array();
			?>

			<div class="col-sm-6 px-0 ml-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Contents</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Text</th>
									<th>Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['img_id'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['img_name'] ?>"
												style='height:40px;'></td>
										<td>
											<b><a href="<?= $slider2['img_link'] ?>"
													target='_blank'><?= $slider2['img_head'] ?></a></b><br />
											<?= trim_text(strip_tags($slider2['img_text']), '90') ?>
										</td>
										<td><a
												href="<?= base_url('admin/perform/web/img-others?pag_d=') ?><?= $slider2['img_place'] ?>"><?= $slider2['img_place'] ?></a>
										</td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['img_id'] ?>&what=img">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/img-others') ?>?edit=<?= $slider2['img_id'] ?>&pag_d=<?= @$pag_d ?>">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'tags':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_tags where stg_tgid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
		?>
			<div class="main-card mb-3 card col-sm-3">
				<div class="card-body">
					<h5 class="card-title">Tags</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_tags') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_tags') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<div class="form-group has-feedback">
								<!-- <input type="hidden" name="stg_type" value="t"> -->
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Keyword" name='name' value="<?= @$atheadmins['stg_name'] ?>">
							</div>

							<div class="form-group has-feedback">
								<input type="file" class="form-control has-feedback-left" id="inputSuccess4" name="file_name">
							</div>

							<input type="hidden" name="theid" value="<?= @$todoedit ?>">

							<!-- <div class="form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="sort" name="sort">
                                      </div> -->
							<div class="form-group has-feedback">

								<?php $getAllKeywordsType = $this->db->query("SELECT * FROM `yn_site_tags_type` where stg_type ='tg' ORDER BY `stst_name` ASC limit 50");
								$keywordsType = $getAllKeywordsType->result_array();
								if (count($keywordsType) > 0) { ?>
									<select class="form-control" name="stg_type">
										<?php foreach ($keywordsType as $kt) { ?>
											<option value="<?= $kt['stst_name'] ?>" <?php if (@$type == $kt['stst_name']) {
																						echo "selected";
																					} ?>><?= ucwords($kt['stst_name']) ?></option>
										<?php } ?>
									</select>
								<?php } ?>

								<hr />
								<small>Cannot find your desired keyword? <br /><a
										href="<?= base_url('admin/perform/web/tags-type?tgt=tg') ?>">Click Here</a> to
									create new keyword</small>

							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>

			<div class="col-sm-5 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title"><?= @$_GET['typ'] ?> Tags</h5>
						<div class="row">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Image</th>
										<th><a href="<?= base_url('admin/perform/web/tags') ?>">Type</a></th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (@$_GET['typ'] != '') {
										$type = $_GET['typ'];
										$gettex = $this->db->query("select * from yn_site_tags where stg_type ='$type' limit $limit1, $limit2");
									} else {
										$gettex = $this->db->query("select * from yn_site_tags where stg_type !='' limit $limit1, $limit2");
									}

									$atheadmins = $gettex->result_array();
									$z = 1;
									foreach ($atheadmins as $testimonials) { ?>
										<tr>
											<th scope="row"><?= $z++; //$testimonials['stg_tgid']
															?></th>
											<td><?= $testimonials['stg_name'] ?></td>
											<td><?php if ($testimonials['stg_img'] != '') { ?>
													<img src="<?= base_url('assets/avator/upload/tags/') ?><?= $testimonials['stg_img'] ?>"
														style="width: 40px;"><?php } ?>
											</td>
											<td><a
													href="<?= base_url('admin/perform/web/tags?typ=') ?><?= $testimonials['stg_type'] ?>"><?= $testimonials['stg_type'] ?></a>
											</td>
											<td>
												<a onclick="return confirm('Are you sure you want to delete this?');"
													href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['stg_tgid'] ?>&what=tags">
													<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
															class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

												<a
													href="<?= base_url('admin/perform/web/tags?edit=') ?><?= $testimonials['stg_tgid'] ?>">
													<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
															class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'tags-type':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_tags_type where stst_id='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
		?>
			<div class="main-card mb-3 card col-sm-3">
				<div class="card-body">
					<h5 class="card-title">Tags Type</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_tags_type') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_tags_type') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<div class="form-group has-feedback">
								<!-- <input type="hidden" name="stg_type" value="t"> -->
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Tag Type" name='name' value="<?= @$atheadmins['stst_name'] ?>">
							</div>

							<input type="hidden" name="theid" value="<?= @$todoedit ?>">
							<input type="hidden" name="tgtype" value="<?= clean($_GET['tgt']) ?>">

							<div class="form-group has-feedback">
								<!-- <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="sort" name="sort"> -->
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>

			<div class="col-sm-4 pl-3">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Tags Type</h5>
						<div class="row">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$gettex = $this->db->query("select * from yn_site_tags_type order by stst_id desc limit $limit1, $limit2");

									$atheadmins = $gettex->result_array();
									$count = 1;
									foreach ($atheadmins as $testimonials) { ?>
										<tr>
											<th scope="row"><?= $count++ ?></th>
											<td><?= $testimonials['stst_name'] ?></td>
											<td>
												<a onclick="return confirm('Are you sure you want to delete this?');"
													href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['stst_id'] ?>&what=tag_types">
													<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
															class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

												<a
													href="<?= base_url('admin/perform/web/tags-type?edit=') ?><?= $testimonials['stst_id'] ?>">
													<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
															class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'filters':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_tags where stg_tgid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
		?>
			<div class="main-card mb-3 card col-3">
				<div class="card-body">
					<h5 class="card-title">Tags</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_tags') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_tags') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Tag Name" name='name' value="<?= @$atheadmins['stg_name'] ?>">
							</div>
							<input type="hidden" name="theid" value="<?= @$todoedit ?>">
							<input type="hidden" name="stg_type" value="f">
							<div class="form-group has-feedback">
								<!-- <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="sort" name="sort"> -->
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>

			<div class="col-sm-6 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Tags</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<!-- <th>Views</th>
                                                <th>text</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$gettex = $this->db->query("select * from yn_site_tags where stg_type='f'");
								$atheadmins = $gettex->result_array();
								foreach ($atheadmins as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['stg_tgid'] ?></th>
										<td><?= $testimonials['stg_name'] ?></td>
										<!-- <td><?= $testimonials['stg_name'] ?></td>
                                                <td><?= $testimonials['stg_name'] ?></td> -->
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['stg_tgid'] ?>&what=tags">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/tags?edit=') ?><?= $testimonials['stg_tgid'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'category':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_catagory where ctid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
			if (isset($_GET['type']) && $_GET['type'] != '') {
				$type = $_GET['type'];
			} else {
				$type = '';
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Category</h5>

					<a href="<?= base_url('admin_action/reset?do=cats') ?>"
						onclick="confirm('This is non reversible, This will DELETE all the Category and sub category');"> Reset
						Category </a>
					<div>
						<form class="form-horizontal form-label-left" action="<?= base_url('admin_action/add_cat') ?>"
							method="post" enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_cat') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Catagory Name" name='name' value="<?= @$atheadmins['name'] ?>">
							</div>
							<input type="hidden" name="theid" value="<?= @$todoedit ?>">

							<div class="form-group has-feedback">
								<?php $getAllKeywordsType = $this->db->query("SELECT * FROM `yn_site_tags_type` where stg_type ='ct' ORDER BY `stst_name` ASC limit 50");
								$keywordsType = $getAllKeywordsType->result_array();
								if (count($keywordsType) > 0) { ?>
									<select class="form-control" name="type">
										<?php foreach ($keywordsType as $kt) { ?>
											<option value="<?= $kt['stst_name'] ?>" <?php if (@$type == $kt['stst_name']) {
																						echo "selected";
																					} ?>><?= ucwords($kt['stst_name']) ?></option>
										<?php } ?>
									</select>
								<?php } ?>
							</div>

							<small>Cannot find your desired keyword? <br /><a
									href="<?= base_url('admin/perform/web/tags-type?tgt=ct') ?>">Click Here</a> to
								create new keyword</small>

							<div class="row">
								<div class="form-group has-feedback col-6">
									<select name="display" class="form-control">
										<option value='1'>Show on Home</option>
										<option value='0'>Do not Show on Home</option>
									</select>
								</div>

								<div class="form-group has-feedback col-6">
									<input type="number" name="sort" placeholder="Weight Sorting"
										value="<?= @$atheadmins['sid'] ?>" class="form-control">
									<small>Higher the weight, priority in sorting.</small>
								</div>
							</div>

							<div class="row">
								<div class="form-group has-feedback col-6">
									<input type="file" class="form-control" title="Catagory Image" name='brand_image'>
								</div>

								<div class="form-group has-feedback col-6">
									<input type="text" class="form-control" title="Icon" name='icon'
										value='<?= @$atheadmins['icon'] ?>' placeholder="Category Icon">
									<small><a href="https://fontawesome.com/v6/icons/" target="_blank">You can find icons from
											here</a></small>
								</div>

							</div>

							<div class="form-group has-feedback">
								<textarea class="form-control" placeholder="Description..."
									name="desc"><?= @$atheadmins['desc'] ?></textarea>
							</div>

							<div class="form-group has-feedback">
								<input type="text" class="form-control" name="link" placeholder="Link..."
									value="<?= @$atheadmins['link'] ?>">
							</div>



							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>

			<div class="col-sm-6 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Categories</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Shown</th>
									<th>Sorting</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_GET['type']) && $_GET['type'] != '') {
									$thecats = $this->db->query("select * from yn_site_catagory where type='$type' order by sid asc limit $limit1, $limit2");
								} else {
									$thecats = $this->db->query("select * from yn_site_catagory order by sid asc limit $limit1, $limit2");
								}
								$thsersftsy = $thecats->result_array();
								foreach ($thsersftsy as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['ctid'] ?></th>
										<td><?= $testimonials['name'] ?></td>
										<td><?= read_me_user('yes_no', $testimonials['display']) ?></td>
										<td class="text-center"><?= $testimonials['sid'] ?></td>
										<td>
											<?php if ($testimonials['img'] != '') { ?>
												<img width="50px" src="<?= base_url('assets/avator/upload/' . $testimonials['img']) ?>"
													alt="">
											<?php } elseif ($testimonials['icon'] != '') {
												echo $testimonials['icon'];
											} ?>
										</td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['ctid'] ?>&what=cats">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/category?edit=') ?><?= $testimonials['ctid'] ?>&type=<?= $testimonials['type'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'sub-category':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_catagory where sc_ctid=ctid and sc_id='$aid'");
				$atheadmins = $thecats2234->row_array();
				$todoedit = $aid;
			}
		?>
			<div class="main-card mb-3 card col-sm-4">
				<div class="card-body">
					<h5 class="card-title">Sub Category</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_sub_cat') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_sub_cat') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_proile22w'>

							<div class="form-group has-feedback">
								<?php $getheco = $this->db->query("select * from yn_site_catagory"); ?>
								<div class="form-group has-feedback">
									<select name="cat" class="form-control">
										<?php
										foreach ($getheco->result() as $row) { ?>
											<option value="<?= $row->ctid ?>" <?php if (@$atheadmins['sc_ctid'] == $row->ctid) {
																					echo "Selected";
																				} ?>><?= $row->name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Sub Catagory Name" name='name' value="<?= @$atheadmins['sc_name'] ?>">
							</div>
							<input type="hidden" name="theid" value="<?= @$todoedit ?>">
							<!-- <div class="form-group has-feedback">
                                                        <select name="display" class="form-control">
                                                          <option value='1'>Show in header</option>
                                                          <option value='0'>Do not Show in header</option>
                                                        </select>
                                                      </div> -->

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="sort"
									name="sort">
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>

						</form>

						<div class="row">
							<div class="badge badge-primary m-1">
								<a href="<?= base_url('admin/perform/web/sub-category') ?>" class='text-white'>Show
									All</a>
							</div>

							<?php
							$thecats = $this->db->query("select * from yn_site_catagory order by ctid desc limit 100");
							$thsersftsy3 = $thecats->result_array();
							foreach ($thsersftsy3 as $testimonials5) { ?>
								<div class="badge badge-primary m-1">
									<a href="<?= base_url('admin/perform/web/sub-category') ?>?cat=<?= $testimonials5['ctid'] ?>"
										class='text-white'>
										<?= $testimonials5['name'] ?>
									</a>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
			</div>
			<?php
			if (isset($_GET['cat']) && $_GET['cat'] != '') {
				$cat = str_replace('-', ' ', $_GET['cat']);
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_catagory where sc_ctid=ctid AND sc_ctid='$cat' order by sc_sort asc limit $limit1, $limit2");
			} else {
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_catagory where sc_ctid=ctid order by sc_sort asc limit $limit1, $limit2");
			}
			$thsersfwwa34tsy2 = $thecats2234->result_array();
			?>
			<div class="col-sm-6 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Sub Categories</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th><a href="<?= base_url('admin/perform/web/category') ?>">Category</a></th>
									<th>Name</th>
									<th>Sort</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($thsersfwwa34tsy2 as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['sc_id'] ?></th>
										<td><a
												href="<?= base_url('admin/perform/web/sub-category') ?>?cat=<?= $testimonials['sc_ctid'] ?>"><?= $testimonials['name'] ?></a>
										</td>
										<td><?= $testimonials['sc_name'] ?></td>
										<td><?= $testimonials['sc_sort'] ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['sc_id'] ?>&what=csats">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/sub-category?edit=') ?><?= $testimonials['sc_id'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'sub2-category':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_sub2_cat where mr_sub2_sid=sc_id and mr_sub2_id='$aid' ");
				$atheadmins = $thecats2234->row_array();
				$todoedit = $aid;
			}
		?>
			<div class="main-card mb-3 card col-3">
				<div class="card-body">
					<h5 class="card-title">Sub Sub Category</h5>
					<div>
						<form class="form-horizontal form-label-left"
							action="<?= base_url('admin_action/add_sub_cat2') ?>" method="post"
							enctype="multipart/form-data"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_sub_cat2') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							id='fomr_id_sub2cat'>

							<!-- <div class="form-group has-feedback">
                                              <?php $getheco = $this->db->query("select * from yn_site_sub_cat, yn_site_catagory where sc_ctid=ctid"); ?>
                                                <div class="form-group has-feedback">
                                                  <select name="scat" class="form-control">
                                                    <?php
													foreach ($getheco->result() as $row) { ?>
                                                      <option value="<?= $row->sc_id ?>" <?php if (@$atheadmins['sc_id'] == $row->sc_id) {
																								echo "Selected";
																							} ?> > <?= $row->name ?> -> <?= $row->sc_name ?></option>
                                                      <?php } ?>
                                                  </select>
                                                </div>
                                            </div> -->

							<div class="form-group has-feedback">
								<?php $getheco = $this->db->query("select * from yn_site_catagory"); ?>
								<div class="form-group has-feedback">
									<select name="cat" id="cat" class="form-control" onchange="load_subcat(this);">
										<option value="">Select Category</option>
										<?php
										foreach ($getheco->result() as $row) { ?>
											<option value="<?= $row->ctid ?>" <?php if (@$atheadmins['mr_sub2_cid'] == $row->ctid) {
																					echo "Selected";
																				} ?>><?= $row->name ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group has-feedback">
								<?php $getheco = $this->db->query("select * from yn_site_catagory"); ?>
								<div class="form-group has-feedback">
									<select name="scat" class="form-control" id="get_subcat_data"
										onchange="load_srch_href(this);">
										<option value="">Select SubCategory</option>
										<option value="<?= @$atheadmins['mr_sub2_sid'] ?>" selected>
											<?= @$atheadmins['mr_sub2_scname'] ?></option>
									</select>
								</div>
							</div>

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
									placeholder="Sub Sub Catagory Name" name='name' value="<?= @$atheadmins['sc_name'] ?>">
							</div>
							<input type="hidden" name="theid" value="<?= @$todoedit ?>">
							<!-- <div class="form-group has-feedback">
                                              <select name="display" class="form-control">
                                                <option value='1'>Show in header</option>
                                                <option value='0'>Do not Show in header</option>
                                              </select>
                                            </div> -->

							<div class="form-group has-feedback">
								<input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Sort"
									name="sort">
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-success btn-block">Submit</button>
								</div>
							</div>
						</form>
						<!-- <div class="form-group">
                                              <div class="">
                                                <a href="<?= base_url('admin/perform/web/sub2-category') ?>" id="sub2cat_srch" class="btn btn-success btn-block">Search</a>
                                              </div>
                                            </div> -->
						<div class="col-12">
							<div class="badge badge-primary">
								<a href="<?= base_url('admin/perform/web/sub2-category') ?>" class='text-white'>
									Show All
								</a>
							</div>
							<?php
							$thecats = $this->db->query("select * from yn_site_sub_cat order by sc_id desc limit 100");
							$thsersftsy3 = $thecats->result_array();
							foreach ($thsersftsy3 as $testimonials5) { ?>
								<div class="badge badge-primary m-1">
									<a href="<?= base_url('admin/perform/web/sub2-category') ?>?scat=<?= $testimonials5['sc_id'] ?>"
										class='text-white'>
										<?= $testimonials5['sc_name'] ?>
									</a>
								</div>
							<?php } ?>
						</div>

					</div>
				</div>
			</div>
			<?php
			if ((isset($_GET['scat']) && $_GET['scat'] != '') && (isset($_GET['cat']) && $_GET['cat'] != '')) {
				$cat = $_GET['cat'];
				$scat = $_GET['scat'];
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_sub2_cat where mr_sub2_sid=sc_id AND mr_sub2_cid='$cat' AND mr_sub2_sid='$scat' order by mr_sub2_sort asc limit $limit1, $limit2");
			}
			if (isset($_GET['scat']) && $_GET['scat'] != '') {
				$scat = str_replace('-', ' ', $_GET['scat']);
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_sub2_cat where mr_sub2_sid=sc_id AND mr_sub2_sid='$scat' order by mr_sub2_sort asc limit $limit1, $limit2");
			} else {
				$thecats2234 = $this->db->query("select * from yn_site_sub_cat, yn_site_sub2_cat where mr_sub2_sid=sc_id order by mr_sub2_sort asc limit $limit1, $limit2");
			}
			$thsersfwwa34tsy2 = $thecats2234->result_array();
			?>
			<div class="col-sm-6 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Sub Sub Categories</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th><a href="<?= base_url('admin/perform/web/sub2-category') ?>">Sub Category</a>
									</th>
									<th>Name</th>
									<th>Sort</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($thsersfwwa34tsy2 as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['mr_sub2_sid'] ?></th>
										<td><a
												href="<?= base_url('admin/perform/web/sub2-category') ?>?scat=<?= $testimonials['sc_id'] ?>"><?= $testimonials['sc_name'] ?></a>
										</td>
										<td><?= $testimonials['mr_sub2_name'] ?></td>
										<td><?= $testimonials['mr_sub2_sort'] ?></td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['mr_sub2_sid'] ?>&what=scat2">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/sub2-category?edit=') ?><?= $testimonials['mr_sub2_sid'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;
		case 'blogs':
			$what = 'add_blog';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_site_blogs where blog_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_blog';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-header">Add / Remove Blog</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>
					Because of cache you may not see new Image updated instant so you <br /> need to use a private mode or clear
					your cache to see your updated Image.<br />

					<p> Make sure you are adding horizontal image in the size of <b>1200px width Minimum</b> and hight as per
						your image.<br /> <b> Also please make sure all the images are of same height</b></p>
					<form method="post" action="<?= base_url('admin_action/site_blog'); ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/site_blog') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="blogid" value="<?= $theidval ?>">

						<div class="row my-2">
							<div class="col-sm-6"><input type="text" name="title" placeholder="Title"
									class="form-control col-12" value="<?= @$theimage_details3['title'] ?>"></div>

							<div class="col-sm-6"><input type="text" name="blog_link" placeholder="Refrance"
									class="form-control col-12" value="<?= @$theimage_details3['blog_link'] ?>"></div>


							<div class="col-sm-6 mt-2">
								<select name="cat" class="form-control">
									<option value="">Select Category</option>
									<?php $getCats = get_web_elements('cat', '', '15');
									foreach ($getCats as $cat) { ?>
										<option value="<?= $cat['ctid'] ?>"><?= $cat['name'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-6 mt-2"><input type="text" name="slug" placeholder="Slug"
									class="form-control col-12" value="<?= @$theimage_details3['slug'] ?>"></div>

							<div class="col-sm-6 mt-2"><input type="text" name="tags" placeholder="tags"
									class="form-control col-12" value="<?= @$theimage_details3['tags'] ?>"></div>

							<div class="col-sm-6 mt-2"><input type="text" name="cta" placeholder="CTA, Call to Action"
									class="form-control col-12" value="<?= @$theimage_details3['cta'] ?>"></div>

							<div class="col-12 my-2">
								<textarea class="form-control rich_text" id="s_s9iskls90s" placeholder="text"
									name="comment"><?= @$theimage_details3['comment'] ?></textarea>
							</div>


							<div class="col-12 my-1">
								<select class="form-control" name="types">
									<option value="1">Blog</option>
									<option value="2">Site/APP Updates</option>
								</select>
							</div>
							<div class="col-sm-6">
								Upload File / Document: <br><input type="file" name="file_name">
							</div>

							<!-- <div class="col-sm-6">
                            <br><label class="pr-5">Expiry Date: </label><input type="date" name="till_date" min="<?= date('Y-m-d') ?>">
                          </div> -->
						</div>
						<div class="col-12 my-1 px-0">
							<textarea class="form-control" placeholder="Short Description"
								name="scomment"><?= @$theimage_details3['scomment'] ?></textarea>
						</div>


						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Blog</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			$get_sliders = $this->db->query("select * from yn_site_blogs order by blog_id desc limit 10");
			$allsliedsrs = $get_sliders->result_array();
			?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Blogs</h5>
						<a href="<?= base_url('admin_action/reset?do=blog') ?>"
							onclick="confirm('This is non reversible, This will DELETE all the Blogs.');"> Reset Blogs </a>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['blog_id'] ?></th>
										<td>
											<!-- <?= read_me_user('blog_type', $slider2['blog_type']) ?><br/> -->
											<b><?= $slider2['title'] ?></b>
										</td>
										<td><?= trim_text(strip_tags($slider2['comment']), '90') ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['blog_id'] ?>&what=blog">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
											<a
												href="<?= base_url('admin/perform/web/blogs') ?>?edit=<?= $slider2['blog_id'] ?>"><button
													class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'all_blogs':
			$get_sliders = $this->db->query("select * from yn_site_blogs order by blog_id desc limit $limit1, $limit2");
			$allsliedsrs = $get_sliders->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Blogs</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['blog_id'] ?></th>
										<td>
											<!-- <?= read_me_user('blog_type', $slider2['blog_type']) ?><br/> -->
											<b><?= $slider2['title'] ?></b>
										</td>
										<td><?= trim_text(strip_tags($slider2['comment']), '90') ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['blog_id'] ?>&what=blog">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
											<a
												href="<?= base_url('admin/perform/web/blogs') ?>?edit=<?= $slider2['blog_id'] ?>"><button
													class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<?php
			break; ?>

		<?php
		case 'services':
			$what = 'add_services';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from `yn_site_services` where service_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_services';
				$theidval = $_GET['edit'];
			}
		?>

			<div class="main-card mb-3 card col-sm-6">
				<div class="card-header">Add / Remove Services</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<h5 class="card-title">Refresh properly to see your new Image.</h5>


					<form method="post" action="<?= base_url('admin_action/services'); ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/services') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="service_id" value="<?= $theidval ?>">
						<div class="row my-2">


							<div class="col-sm-6 pl-0">
								<br><input type="text" class="form-control" placeholder="Service Name" name="name"
									value="<?= @$theimage_details3['service_name'] ?>">
								<!-- <a href=""> Generate Desc Based on the name Given ? </a> -->
							</div>


							<div class="col-sm-6 pr-0">
								<br><input type="text" name="meta_desc" placeholder="Meta Description" class="form-control mb-2"
									value="<?= @$theimage_details3['service_meta_desc'] ?>">
							</div>

							<div class="col-sm-12 px-0">
								<b>Slug</b><br />
								<small>Needs to be unique, this will become the Service url.</small>
								<input type="text" name="slug" placeholder="Slug" class="form-control mb-2"
									value="<?= @$theimage_details3['slug'] ?>">
							</div>

							<div class="col-sm-6 px-0">
								<b>Order</b><br />
								<small>Higher order will show first.</small>
								<input type="text" name="service_order" placeholder="Order" class="form-control mb-2"
									value="<?= @$theimage_details3['service_order'] ?>">
							</div>
							<div class="col-sm-6 pl-2">
								<b>Class CSS</b><br />
								<small>you can keep it blank, Mostly technical</small>
								<input type="text" name="ser_class" placeholder="Class CSS" class="form-control mb-2"
									value="<?= @$theimage_details3['ser_class'] ?>">
							</div>

							<div class="col-12 my-1 px-0">
								<select name="service_category" class="form-control">
									<option value="">Select Category</option>
									<?php $getCats = get_web_elements('cat', '', '5');
									foreach ($getCats as $cat) { ?>
										<option value="<?= $cat['ctid'] ?>"><?= $cat['name'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-12 my-1 px-0">
								<textarea class="form-control rich_text" id="s_s9iskls90s" placeholder="Description"
									name="scomment"><?= @$theimage_details3['service_description'] ?></textarea>
							</div>

							<!-- <div class="col-sm-12">
                            <br><input type="number" class="form-control" placeholder="Service Price" name="price" value="<?= @$theimage_details3['price'] ?>">
                          </div> -->
							<div class="col-sm-12 px-0">
								<br><input type="file" name="file_name" value="">
							</div>
							<button class="btn mt-2 btn-warning btn-block py-2">Update Service</button>
						</div>



					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
			<?php
			$get_sliders = $this->db->query("select * from `yn_site_services` order by service_order desc limit 10");
			$allsliedsrs = $get_sliders->result_array();
			?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Services</h5>
						<a onclick="return confirm('This will delete all services.');"
							href="<?= base_url('admin_action/reset?do=services') ?>"> Reset </a>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>Description</th>
									<th>Meta Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['service_id'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['service_image'] ?>"
												style='height:40px;'></td>

										<td><a href="<?= base_url('service/') ?><?= $slider2['slug'] ?>"
												target='_blank'><?= trim_text($slider2['service_name'], '90') ?></a></td>
										<td><?= trim_text(strip_tags($slider2['service_description']), '90') ?></td>
										<td><?= trim_text(strip_tags($slider2['service_meta_desc']), '90') ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['service_id'] ?>&what=service">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
											<a
												href="<?= base_url('admin/perform/web/services') ?>?edit=<?= $slider2['service_id'] ?>"><button
													class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'all_services':
		?>

			<?php
			$get_sliders = $this->db->query("select * from `yn_site_services` order by service_id desc limit $limit1, $limit2");
			$allsliedsrs = $get_sliders->result_array();
			?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Services</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Name</th>
									<th>Description</th>
									<th>Meta Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($allsliedsrs as $slider2) { ?>
									<tr>
										<th scope="row"><?= $slider2['service_id'] ?></th>
										<td><img src="<?= base_url('assets/avator/upload/') ?><?= $slider2['service_image'] ?>"
												style='height:40px;'></td>

										<td><?= trim_text(strip_tags($slider2['service_name']), '90') ?></td>
										<td><?= trim_text(strip_tags($slider2['service_description']), '90') ?></td>
										<td><?= trim_text(strip_tags($slider2['service_meta_desc']), '90') ?></td>
										<td style="min-width: 120px;">
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $slider2['service_id'] ?>&what=service">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
											<a
												href="<?= base_url('admin/perform/web/services') ?>?edit=<?= $slider2['service_id'] ?>"><button
													class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-pen"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'products':
			$what = 'add_products';
			@$the_product = xss_clean($_GET['product']);
			$product_data = get_product_data($the_product);
			if (@$_GET['product'] != '') {
				$send_product = 'edit_product';
			} else {
				$send_product = 'add_product';
			}
		?>

			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Add Edit Products </h5>
					<div>
						<form class="form-horizontal form-label-left" method="post"
							action="<?= base_url('admin_action/add_products'); ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_products') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-6">
									<label>Product Name
									</label>
									<input type="text" name="product_name" value="<?= @$product_data['p_name'] ?>"
										class="form-control" placeholder="Product Name">
									<input type="hidden" name="p_id" value="<?= $the_product ?>">
									<input type="hidden" name="what" value="<?= $send_product ?>">
								</div>

								<!-- <div class="col-sm-6">
									<label>Color </label>
									<input type="text" name="p_color" value="<?= @$product_data['p_color'] ?>"
										class="form-control" placeholder="Product Color">
								</div>

								<div class="col-sm-6">
									<label>Size </label>
									<input type="text" name="p_size" value="<?= @$product_data['p_size'] ?>"
										class="form-control" placeholder="Product Size">
								</div>

								<div class="col-sm-6">
									<label>Gurantee </label>
									<input type="text" name="p_gurantee" value="<?= @$product_data['p_gurantee'] ?>"
										class="form-control" placeholder="Product Gurantee">
								</div>

								<div class="col-sm-6">
									<label>Vendor </label>
									<input type="text" name="p_vendor" value="<?= @$product_data['p_vendor'] ?>"
										class="form-control" placeholder="Product Vendor">
								</div>

								<div class="col-sm-6">
									<label>Weight </label>
									<input type="text" name="p_weight" value="<?= @$product_data['p_weight'] ?>"
										class="form-control" placeholder="Product Weight">
								</div>

								<div class="col-sm-6">
									<label>shipping Location</label>
									<input type="text" name="p_shipping_location"
										value="<?= @$product_data['p_shipping_location'] ?>" class="form-control"
										placeholder="Product Shipping Location">
								</div>

								<div class="col-sm-6">
									<label>shipping Cost</label>
									<input type="text" name="p_shipping_cost" value="<?= @$product_data['p_shipping_cost'] ?>"
										class="form-control" placeholder="Product Shipping Cost">
								</div> -->


								<!-- <div class="col-sm-6">
                                    <label>Product Title
                                    <br/><small> Small Marketing Label Will be shown in detail page. </small></label>
                                    <input type="text" name="product_title" value="<?= @$product_data['p_title'] ?>" class="form-control" placeholder="Product Title">
                                  </div> -->

								<input type="hidden" name="p_category" value="membership">
								<!-- <div class="col-sm-6">
									<label>Category</label>
									<select class="form-control" id="cat" name="p_category" onchange="load_subcat(this);">
										<?php
										$Categories = $this->db->query("SELECT * FROM  yn_site_catagory ");
										if ($Categories->num_rows() > 0) {
										?>
											<option value="">--Select Category--</option>
											<?php
											foreach ($Categories->result_array() as $Cates) {
												if ($Cates['ctid'] == $product_data['p_category']) {
											?>
													<option selected value="<?= $Cates['ctid'] ?>"><?= $Cates['name'] ?></option>
												<?php
												} else {
												?>
													<option value="<?= $Cates['ctid'] ?>"><?= $Cates['name'] ?></option>
											<?php
												}
											}
										} else {
											?>
											<option value="">--Empty Category--</option>
										<?php
										}
										?>
									</select>
								</div> -->
								<!-- <div class="col-sm-6">
									<?php
									$getheco = $this->db->query("select * from  yn_site_sub_cat");
									$subCategories = $getheco->result_array();
									?>
									<label>Sub Category</label>
									<select name="p_sub_category" class="form-control" id="get_subcat_data"
										onchange="load_subsubcat(this);">
										<option value="">Select SubCategory</option>
										<?php

										foreach ($subCategories as $subCategory) {
										?>
											<option <?php if (@$product_data['p_sub_category'] == $subCategory['sc_id']) echo 'selected'; ?> value="<?= @$subCategory['sc_id'] ?>">
												<?= @$subCategory['sc_name'] ?></option>
										<?php } ?>
									</select>
								</div>





								<div class="col-sm-6">
									<label>Sub SubCategory</label>
									<select name="p_sub_sub_cat" class="form-control" id="get_subsubcat_data">
										<option value="">Select Sub SubCategory</option>
									</select>
								</div>

								<script type="text/javascript">
									function load_subsubcat(obj) {
										var selectedSubCategory = $(obj).val();
										var subSubCategorySelect = $("#get_subsubcat_data");

										subSubCategorySelect.empty();
										$.ajax({
											type: "GET",
											url: "<?= base_url('ynaps_load/load_subsubcat') ?>",
											data: {
												sub_category: selectedSubCategory
											},
											success: function(data) {
												subSubCategorySelect.append(data);
											}
										});
									}
								</script>





								<div class="col-sm-6">
									<label>Stock</label>
									<input type="number" min="1" name="p_stock" value="<?= @$product_data['p_stock'] ?>"
										class="form-control" placeholder="Stock">
								</div>
 -->


								<div class="col-sm-6">
									<label>Plan Price</label>
									<input type="number" min="1" name="p_price" value="<?= @$product_data['p_price'] ?>"
										class="form-control" placeholder="Price">
								</div>

								<!-- <div class="col-sm-6">
									<label>MRP</label>
									<input type="number" min="0" name="p_mrp" value="<?= @$product_data['p_mrp'] ?>"
										class="form-control" placeholder="MRP">
								</div>


								<div class="col-sm-6">
									<label>SKU</label>
									<input type="text" name="p_sku" value="<?= @$product_data['p_sku'] ?>" class="form-control" placeholder="SKU">
								</div> -->

								<!-- <div class="col-sm-6">
                                    <label>Tags</label>
                                    <br/><small>Keywords coma saperated for which this product should be found</small>
                                    <input type="text"  name="p_tags" value="<?= @$product_data['p_tags'] ?>" class="form-control" placeholder="Tags">
                                  </div> -->






								<!-- <div class="col-sm-6">
                                    <label>Buy Now Link</label>
                                    <br/><small>Incase you want to send user to buy the product on external link. Please Leave empty to follow Add to cart function</small>
                                    <input type="text"  name="p_cta" value="<?= @$product_data['p_cta'] ?>" class="form-control" placeholder="CTA">
                                  </div> -->

								<!-- <?php
										$tharra = explode(',', @$product_data['p_variant']);
										?>
                                <div class="col-sm-12 mt-2">
                                  <small>Please Select All Applicable for the product, We will Saperate them based on type automatically.</small>
                                    <select title="Select Variant" name="p_variant[]" class="form-control" multiple>
                                      <?php
										$Variants = $this->db->query("SELECT * FROM yn_site_tags where stg_type !='' limit 100 ");
										if ($Variants->num_rows() > 0) {
										?>
                                        <option value="" disabled>Select Variant</option>
                                        <?php
											foreach ($Variants->result_array() as $Vari) {
										?>
                                            <option value="<?= @$Vari['stg_tgid'] . '|' . $Vari['stg_name'] ?>" <?php if (in_array($Vari['stg_tgid'], $tharra)) {
																													echo 'selected';
																												} ?>  ><?= @$Vari['stg_type'] ?>  - <?= @$Vari['stg_name'] ?> </option>
                                        <?php

											}
										} else {
										?>
                                        <option disabled value="">--Empty Variant--</option>
                                      <?php
										}
										?>
                                    </select>
                                  </div> -->



								<!-- <div class="col-sm-6">
									<label>Rate thie Product.</label>
									<br><small>Show Star Ratings to customer for this prod.</small>
									<select class="form-control" name="product_rating">
										<option value="0">-- Rating | Star --</option>
										<?php
										for ($st = 1; $st <= 5; $st++) {
											if ($product_data['p_star'] == $st) {
										?>
												<option selected value="<?= $st ?>"><?= $st ?></option>
											<?php
											} else {
											?>
												<option value="<?= $st ?>"><?= $st ?></option>
										<?php
											}
										}
										?>
									</select>
								</div> -->




								<div class="col-sm-12">
									<div class="form-group mt-3">
										<hr />
										<label>Product Description.<br />
										</label>
										<textarea name="p_desc" placeholder="About your business."
											class="form-control rich_text"
											id='rich_text12_90'><?= @$product_data['p_descp'] ?></textarea>
									</div>
								</div>

								<div class="col-sm-6">
									<input style="float: left;" type="submit" name=""
										class="mt-2 btn-warning active btn py-2 text-white text-bold px-5" value="SAVE DATA">
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="text-right m-2 pr-5"> </div>
					<div class="card-header">View All Products
					</div>
					<div class="table-responsive min700">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Name</th>
									<!--<th class="text-left">Color</th>-->
									<!--<th class="text-left">Size</th>-->
									<!--<th class="text-left">Weight</th>-->
									<!--<th class="text-left">Shipping location & Cost</th>-->
									<th class="text-left">Price</th>


									<th class="text-left">Status</th>
									<!--<th class="text-left">Type</th>-->

									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$getProducts = $this->db->query("SELECT * FROM  yn_ecom_products order by p_id desc limit 60 ");
								if ($getProducts->num_rows() > 0) {
									foreach ($getProducts->result_array() as $products) {
								?>
										<tr>
											<td class="text-left text-muted">#<?= $products['p_id'] ?></td>
											<td>
												<div class="widget-content-left flex2">
													<div class="widget-heading"><b>
															<a href="<?= base_url('product/') ?><?= $products['p_id'] ?>/<?= url_smart($products['p_name']) ?>"
																target='_blank'>
																<?= $products['p_name'] ?>
															</a>
														</b></div>
												</div>
											</td>
											<!--<td class="text-left">-->
											<!--	<?= $products['p_color'] ?>-->
											<!--</td>-->
											<!--<td class="text-left">-->
											<!--	<?= $products['p_size'] ?>-->
											<!--</td>-->
											<!--<td class="text-left">-->
											<!--	<?= $products['p_weight'] ?>-->
											<!--</td>-->
											<!--<td class="text-left">-->
											<!--	<?= $products['p_shipping_location'] ?> <br> ₹<?= $products['p_shipping_cost'] ?>-->
											<!--</td>-->

											<td class="text-left">
												₹<?= $products['p_price'] ?>
												<!--<strike class="text-danger">₹<?= $products['p_mrp'] ?></strike>-->


											</td>


											<td class="text-left"><?= read_me_product("product_status", $products['p_status']) ?> </td>
											<!--<td class="text-left">-->
											<!--	<?= read_me_product("trend_status", $products['p_sale_status']) ?>-->
											<!--</td>-->

											<td class="text-left">
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">Options</button>
													<button type="button" aria-haspopup="true" aria-expanded="false"
														data-toggle="dropdown"
														class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
															class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=enable_product">
															<button type="button" tabindex="0" class="dropdown-item">Enable
															</button></a>

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=disable_product">
															<button type="button" tabindex="0" class="dropdown-item">Disable
															</button></a>

														<!--<a-->
														<!--	href="<?= base_url('admin/perform/web/images') ?>?product=<?= @$products['p_id'] ?>">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">ADD-->
														<!--		IMAGES</button></a>-->

														<!--<a-->
														<!--	href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">Add Featured-->
														<!--	</button></a>-->


														<!--<a-->
														<!--	href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_populer">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">Add Populer-->
														<!--	</button></a>-->

														<!--<a-->
														<!--	href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_day_deal">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">Add Day Deal-->
														<!--	</button></a>-->

														<!--<a-->
														<!--	href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_top_sale">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">Add Top Sale-->
														<!--	</button></a>-->

														<!-- <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=add_to_slider">
                                            <button type="button" tabindex="0" class="dropdown-item">ADD TO SLIDER
                                            </button></a> 

                                        <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=remove_from_slider">
                                            <button type="button" tabindex="0" class="dropdown-item">REMOVE FROM SLIDER
                                            </button></a>-->

														<!-- <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_add">
                                            <button type="button" tabindex="0" class="dropdown-item">ADD FEATURE
                                            </button></a>-->

														<!--<a-->
														<!--	href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_remove">-->
														<!--	<button type="button" tabindex="0" class="dropdown-item">Reset product type-->
														<!--	</button></a>-->


														<a
															href="<?= base_url('admin/perform/web/products') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">Edit</button></a>

														<div tabindex="-1" class="dropdown-divider"></div>
														<a onclick="return confirm('Do you really want to delete this Product, you can Disable the Product as well.');"
															href="<?= base_url('admin_action/delete') ?>?id=<?= @$products['p_id'] ?>&what=product">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>

										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>
		<?php
			break;

		case 'all-products':
		?>
			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="text-right m-2 pr-5"> </div>
					<div class="card-header">View All Products
					</div>
					<div class="table-responsive min700">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Name</th>
									<!--<th class="text-left">Shop</th>-->
									<!--<th class="text-left">Category</th>-->
									<th class="text-left">Price</th>
									<th class="text-left">Status</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$getProducts = $this->db->query("SELECT * FROM  yn_ecom_products order by p_id desc limit $limit1, $limit2 ");
								if ($getProducts->num_rows() > 0) {
									foreach ($getProducts->result_array() as $products) {
								?>
										<tr>
											<td class="text-left text-muted">#<?= $products['p_id'] ?></td>
											<td>
												<div class="widget-content-left flex2">
													<div class="widget-heading">
														<b>
															<!-- <a href="<?= base_url('product/') ?><?= $products['p_id'] ?>/<?= url_smart($products['p_name']) ?>" target='_blank'> -->
															<?= $products['p_name'] ?>
															<!-- </a> -->
														</b>
													</div>
												</div>
											</td>
											<!--<td class="text-left">-->
											<!--	<?= getShop($products['p_vendor']) ?>-->
											<!--</td>-->
											<!--<td class="text-left">-->
											<!--	<?= getCategory($products['p_category']) ?>-->
											<!--</td>-->
											<td class="text-left">₹<?= $products['p_price'] ?> </td>
											<td class="text-left"><?= read_me_product("product_status", $products['p_status']) ?> </td>

											<td class="text-left">
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">Options</button>
													<button type="button" aria-haspopup="true" aria-expanded="false"
														data-toggle="dropdown"
														class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
															class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=enable_product">
															<button type="button" tabindex="0" class="dropdown-item">Enable
															</button></a>

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=disable_product">
															<button type="button" tabindex="0" class="dropdown-item">Disable
															</button></a>

														<!-- <a
															href="<?= base_url('admin/perform/web/images') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">ADD
																IMAGES</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature">
															<button type="button" tabindex="0" class="dropdown-item">Add Featured
															</button></a>


														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_populer">
															<button type="button" tabindex="0" class="dropdown-item">Add Populer
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_day_deal">
															<button type="button" tabindex="0" class="dropdown-item">Add Day Deal
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_top_sale">
															<button type="button" tabindex="0" class="dropdown-item">Add Top Sale
															</button></a> -->

														<!-- <a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=add_to_slider">
															<button type="button" tabindex="0" class="dropdown-item">ADD TO SLIDER
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=remove_from_slider">
															<button type="button" tabindex="0" class="dropdown-item">REMOVE FROM SLIDER
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_add">
															<button type="button" tabindex="0" class="dropdown-item">ADD FEATURE
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_remove">
															<button type="button" tabindex="0" class="dropdown-item">Reset product type
															</button></a> -->


														<!-- <a
															href="<?= base_url('admin/perform/web/products') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">Edit</button></a> -->

														<div tabindex="-1" class="dropdown-divider"></div>
														<a onclick="return confirm('Do you really want to delete this Product, you can Disable the Product as well.');"
															href="<?= base_url('admin_action/delete') ?>?id=<?= @$products['p_id'] ?>&what=product">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>

										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>
		<?php
			break;



		case 'images':
			@$the_product_img = xss_clean($_GET['images']);
			$imgData = get_product_image_data($the_product_img);
			if (@$_GET['images'] != '') {
				$send_product_images = 'edit_product_images';
			} else {
				$send_product_images = 'add_product_images';
			}

		?>
			<div class="main-card mb-3 card col-sm-5">
				<div class="card-body">
					<h5 class="card-title">Add Edit Products Product Images </h5>
					<div>
						<form class="form-horizontal form-label-left" method="post"
							action="<?= base_url('admin_action/add_product_images'); ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/add_product_images') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">
							<input type="hidden" name="p_id" value="<?= $the_product_img ?>">

							<table class="table table-borderless">
								<tbody>
									<tr>
										<td>
											<input type="hidden" name="product_name" value="<?= @$imgData['img'] ?>"
												class="form-control" placeholder="Product Name">
											<input type="hidden" name="what" value="<?= $send_product_images ?>">
											<select class="d-none form-control" id="prod" name="pid"
												onchange="change_prod(this);">
												<?php
												$products = $this->db->query("SELECT * FROM `yn_ecom_products` order by p_id desc limit 50 ");
												if ($products->num_rows() > 0) {
												?>
													<option>-- Select Product (Shown Last 50 Here) --</option>
													<?php
													foreach ($products->result_array() as $proData) { ?>
														<option value="<?= $proData['p_id'] ?>"
															<?php if (@$_GET['product'] == $proData['p_id']) {
																echo 'selected';
															} ?>>
															<?= $proData['p_name'] ?></option>
													<?php
													}
												} else {
													?>
													<option value="">--Empty Product--</option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<input type="file" id="uploadImages1" class="form-control" accept=".jpeg,.png,.gif"
												name="p_image1" style="border:0px;">
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input style="float: left;" type="submit" name=""
												class="mt-2 btn-warning active btn py-2 text-white text-bold px-5"
												value="SAVE DATA">
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>


			<div class="col-7 pl-2">
				<div class="main-card mb-3 card">
					<div class="text-right m-2 pr-5"> </div>
					<div class="card-header">View All Product Images
					</div>
					<div class="table-responsive">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Product Name</th>
									<th class="text-left">Product Image</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$pid = clean($_GET['product']);
								$getImages = $this->db->query("SELECT * FROM `yn_ecom_products_img` where pid='$pid' order by id desc limit 20 ");
								$theresl = $getImages->result_array();
								$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` where p_id = '$pid' ");
								$the_pros_ps = $getProducts->row_array();
								foreach ($theresl as $pro_img) {
								?>
									<tr>
										<td class="text-left text-muted">#<?= $pro_img['id'] ?></td>
										<td>
											<div class="widget-content-left flex2">
												<div class="widget-heading"><b><?= $the_pros_ps['p_name'] ?></b></div>
											</div>
										</td>
										<td class="text-left">
											<img width="60px" class="rounded-square"
												src="<?= base_url('assets/avator/upload/' . $pro_img['img']) ?>" />
										</td>
										<td class="text-left">
											<?php if ($the_pros_ps['p_cover'] == $pro_img['img']) { ?>
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-primary bg-light">COVER IMAGE
												</button></a>
											<?php } else { ?>
												<a
													href="<?= base_url('admin_action/manage_prod') ?>?imgid=<?= @$pro_img['img'] ?>&pid=<?= $pro_img['pid'] ?>">
													<button class="mr-2 btn-icon btn-icon-only btn btn-outline-info">Cover </button></a>
												</a>
											<?php } ?>
											<!-- <a
                                    href="<?= base_url('admin/perform/web/images') ?>?images=<?= @$pro_img['pid'] ?>">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
                                            class="pe-7s-pen btn-icon-pen"> </i></button></a>
                                </a> -->
											<a onclick="return confirm('Do you really want to delete this Product, you can Disable the Product as well.');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $pro_img['id'] ?>&what=images">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>
										</td>

									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>
		<?php
			break;
		// Products End

		// View Products 
		case 'view_products':
		?>

			<div class="col-12 pl-0">
				<div class="main-card mb-3 card">
					<div class="text-right m-2 pr-5"> </div>
					<div class="card-header">View All Products
					</div>
					<div class="table-responsive min700">
						<table class="align-middle mb-0 table table-borderless table-striped table-hover">
							<thead>
								<tr>
									<th class="text-left">#</th>
									<th>Name</th>
									<th class="text-left">Color</th>
									<th class="text-left">Size</th>
									<th class="text-left">Weight</th>
									<th class="text-left">Shipping location & Cost</th>
									<th class="text-left">Price</th>
									<th class="text-left">MRP</th>

									<th class="text-left">Status</th>
									<th class="text-left">Type</th>

									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$getProducts = $this->db->query("SELECT * FROM  yn_ecom_products order by p_id desc limit 60 ");
								if ($getProducts->num_rows() > 0) {
									foreach ($getProducts->result_array() as $products) {
								?>
										<tr>
											<td class="text-left text-muted">#<?= $products['p_id'] ?></td>
											<td>
												<div class="widget-content-left flex2">
													<div class="widget-heading"><b>
															<a href="<?= base_url('product/') ?><?= $products['p_id'] ?>/<?= url_smart($products['p_name']) ?>"
																target='_blank'>
																<?= $products['p_name'] ?>
															</a>
														</b></div>
												</div>
											</td>
											<td class="text-left">
												<?= $products['p_color'] ?>
											</td>
											<td class="text-left">
												<?= $products['p_size'] ?>
											</td>
											<td class="text-left">
												<?= $products['p_weight'] ?>
											</td>
											<td class="text-left">
												<?= $products['p_shipping_location'] ?> <br> ₹<?= $products['p_shipping_cost'] ?>
											</td>

											<td class="text-left">₹<?= $products['p_price'] ?> </td>
											<td class="text-left">₹<?= $products['p_mrp'] ?> </td>



											<td class="text-left"><?= read_me_product("product_status", $products['p_status']) ?> </td>
											<td class="text-left">
												<?= read_me_product("trend_status", $products['p_sale_status']) ?>
											</td>

											<td class="text-left">
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">Options</button>
													<button type="button" aria-haspopup="true" aria-expanded="false"
														data-toggle="dropdown"
														class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
															class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=enable_product">
															<button type="button" tabindex="0" class="dropdown-item">Enable
															</button></a>

														<a
															href="<?= base_url('admin_action/product_modify') ?>?id=<?= $products['p_id'] ?>&what=disable_product">
															<button type="button" tabindex="0" class="dropdown-item">Disable
															</button></a>

														<a
															href="<?= base_url('admin/perform/web/images') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">ADD
																IMAGES</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature">
															<button type="button" tabindex="0" class="dropdown-item">Add Featured
															</button></a>


														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_populer">
															<button type="button" tabindex="0" class="dropdown-item">Add Populer
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_day_deal">
															<button type="button" tabindex="0" class="dropdown-item">Add Day Deal
															</button></a>

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_top_sale">
															<button type="button" tabindex="0" class="dropdown-item">Add Top Sale
															</button></a>

														<!-- <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=add_to_slider">
                                            <button type="button" tabindex="0" class="dropdown-item">ADD TO SLIDER
                                            </button></a> 

                                        <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=remove_from_slider">
                                            <button type="button" tabindex="0" class="dropdown-item">REMOVE FROM SLIDER
                                            </button></a>-->

														<!-- <a
                                            href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_add">
                                            <button type="button" tabindex="0" class="dropdown-item">ADD FEATURE
                                            </button></a>-->

														<a
															href="<?= base_url('admin_action/product_deal') ?>?id=<?= $products['p_id'] ?>&what=make_feature_product_remove">
															<button type="button" tabindex="0" class="dropdown-item">Reset product type
															</button></a>


														<a
															href="<?= base_url('admin/perform/web/products') ?>?product=<?= @$products['p_id'] ?>">
															<button type="button" tabindex="0" class="dropdown-item">Edit</button></a>

														<div tabindex="-1" class="dropdown-divider"></div>
														<a onclick="return confirm('Do you really want to delete this Product, you can Disable the Product as well.');"
															href="<?= base_url('admin_action/delete') ?>?id=<?= @$products['p_id'] ?>&what=product">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>

										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<!-- <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                        <button class="btn-wide btn btn-success">Save</button> -->
					</div>
				</div>
			</div>

		<?php
			break;
		case 'coupon':
			$theidval = '';
			$what = 'add_coupon';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_ecom_coupon where coupon_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$theidval = $_GET['edit'];
				$what = 'edit_coupon';
			}
		?>
			<div class="main-card mb-3 card col-sm-4">
				<div class="card-header">Add / Edit Coupon</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<form method="post" action="<?= base_url('admin_action/coupon'); ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/coupon') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-12">
								<label>Coupon Code:</label>
								<input type="text" class="form-control" name="coupon_code" placeholder="Coupon Code"
									value="<?= @$theimage_details3['coupon_code'] ?>">
							</div>
						</div>
						<div class="row my-2">
							<div class="col-12">
								<label>Description:</label>
								<textarea class="form-control" name="coupon_desc"
									placeholder="Coupon Description"><?= @$theimage_details3['coupon_desc'] ?></textarea>
							</div>
						</div>
						<div class="row my-2">
							<div class="col-12">
								<label>Coupon Type:</label>
								<select name="coupon_type" class="form-control">
									<option value="">--- Select Type ---</option>
									<option value="flat" <?php if (@$theimage_details3['coupon_type'] == 'flat') {
																echo 'selected';
															} ?>>Flat</option>
									<option value="percentage" <?php if (@$theimage_details3['coupon_type'] == 'percentage') {
																	echo 'selected';
																} ?>>Percentage</option>
								</select>
							</div>
						</div>

						<div class="row my-2">
							<div class="col-6">
								<label>Minimum Order:</label>
								<input type="number" min="0" class="form-control" name="min_ord_amount"
									placeholder="Minimum order amount" value="<?= @$theimage_details3['min_ord_amount'] ?>">
							</div>
							<div class="col-6">
								<label>Discount Amount:</label>
								<input type="number" min="0" class="form-control" name="discount_amount"
									placeholder="Discount worth (amount of discount )in rupees."
									value="<?= @$theimage_details3['discount_amount'] ?>">
							</div>
						</div>
						<div class="row my-2">
							<div class="col-6">
								<label>Discount Percentage:</label>
								<input type="number" min="0" class="form-control" name="discount_percent"
									placeholder="Discount worth in percentage."
									value="<?= @$theimage_details3['discount_percent'] ?>">
							</div>
							<div class="col-6">
								<label>Maximum Discount:</label>
								<input type="number" min="0" class="form-control" name="max_discount"
									placeholder="Maximum discount in rupees(ex 100 rupees)."
									value="<?= @$theimage_details3['max_discount'] ?>">
							</div>
						</div>

						<div class="row my-2">
							<div class="col-6">
								<label>Start Date:</label>
								<input type="date" name="start_date" value="<?= @$theimage_details3['start_date'] ?>"
									class="form-control" placeholder="Start Date">
							</div>
							<div class="col-6">
								<label>Expiry Date:</label>
								<input type="date" name="end_date" value="<?= @$theimage_details3['end_date'] ?>"
									class="form-control" placeholder="Expiry Date">
							</div>
						</div>
						<div class="row my-2">
							<div class="col-6">
								<label>Coupon Limit:</label>
								<input type="number" min="1" name="coupon_limit"
									value="<?= @$theimage_details3['coupon_limit'] ?>" class="form-control"
									placeholder="Maximum usage of coupon ( ex. 100 times)">
							</div>
							<div class="col-6">
								<label>Coupon For:</label>
								<select name="coupon_valid_for" class="form-control">
									<option value="">--- Select Type ---</option>
									<option value=""
										<?php if (@$theimage_details3['coupon_valid_for'] == '') echo 'selected' ?>>Non
										Restricted</option>
									<option value="o"
										<?php if (@$theimage_details3['coupon_valid_for'] == 'o') echo 'selected' ?>>Once Per
										User</option>
									<option value="n"
										<?php if (@$theimage_details3['coupon_valid_for'] == 'n') echo 'selected' ?>>New
									</option>
								</select>
							</div>
						</div>

						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Coupon</button>
					</form>
				</div>
			</div>
			<div class="col-sm-8 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Coupons</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Coupon Code</th>
									<th>Min Order Amount</th>
									<th>Max Discount Amount</th>
									<th>Plan Name</th>
									<th>Coupon Type</th>
									<th>Coupon Limit</th>
									<th>Coupon Used</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$theplans = $this->db->query("select * from yn_ecom_coupon order by coupon_id desc limit $limit1, $limit2");
								$thsersftsy = $theplans->result_array();
								$p = 0;
								foreach ($thsersftsy as $testimonials) {
									$p++; ?>
									<tr>
										<th scope="row"><?= $p ?></th>
										<td><?= $testimonials['coupon_code'] ?></td>
										<td><?= money_show($testimonials['min_ord_amount']) ?></td>
										<td><?= money_show($testimonials['max_discount']) ?></td>
										<td><?= $testimonials['coupon_plan_name'] ?></td>
										<td><?= $testimonials['coupon_type'] ?></td>
										<td><?= $testimonials['coupon_limit'] ?></td>
										<td><?= $testimonials['coupon_usage'] ?></td>

										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['coupon_id'] ?>&what=coupon">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/coupon?edit=') ?><?= $testimonials['coupon_id'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;

		case 'feature':
			$theidval = '';
			$what = 'add_feature';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from yn_prod_feature where pf_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$theidval = $_GET['edit'];
				$what = 'edit_feature';
			}
		?>
			<div class="main-card mb-3 card col-sm-4">
				<div class="card-header">Add / Edit Feature</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<form method="post" action="<?= base_url('admin_action/feature'); ?>"
						onsubmit="return uploadandform('<?= base_url('admin_action/feature') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
						enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-12">
								<label>Vehicle Brand:</label>
								<input type="text" class="form-control" name="vehicle" placeholder="Vehicle Brand"
									value="<?= @$theimage_details3['pf_vehicle'] ?>">
							</div>
						</div>

						<div class="row my-2">
							<div class="col-12">
								<label>Model:</label>
								<input type="text" class="form-control" name="model" placeholder="Model"
									value="<?= @$theimage_details3['pf_model'] ?>">
							</div>
						</div>

						<div class="row my-2">
							<div class="col-12">
								<label>Year:</label>
								<input type="number" class="form-control" name="year" placeholder="Year"
									value="<?= @$theimage_details3['pf_year'] ?>">
							</div>
						</div>

						<div class="row my-2">
							<div class="col-12">
								<label>Fuel:</label>
								<input type="text" class="form-control" name="fuel" placeholder="Fuel"
									value="<?= @$theimage_details3['pf_fuel'] ?>">
							</div>
						</div>



						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Feature</button>
					</form>
				</div>
			</div>
			<div class="col-sm-8 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All vehicle Feature</h5>
						<table class="mb-0 table">
							<thead>
								<tr>
									<th>#</th>
									<th>Vehicle Brand</th>
									<th>Model</th>
									<th>Year</th>
									<th>Fuel</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$theplans = $this->db->query("select * from yn_prod_feature order by pf_id desc limit $limit1, $limit2");
								$thsersftsy = $theplans->result_array();
								$p = 0;
								foreach ($thsersftsy as $testimonials) {
									$p++; ?>
									<tr>
										<th scope="row"><?= $p ?></th>
										<td><?= $testimonials['pf_vehicle'] ?></td>
										<td><?= $testimonials['pf_model'] ?></td>
										<td><?= $testimonials['pf_year'] ?></td>
										<td><?= $testimonials['pf_fuel'] ?></td>

										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');"
												href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['pf_id'] ?>&what=feature">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
														class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a
												href="<?= base_url('admin/perform/web/feature?edit=') ?><?= $testimonials['pf_id'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
														class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Previous"><span aria-hidden="true">«</span><span
												class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
													class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link"
											aria-label="Next"><span aria-hidden="true">»</span><span
												class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php
			break;




		case 'faq':
			$getaction = 'add_faq';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_faq where faq_id='$aid' ");
				$atheadmins = $gettex->row_array();
				$getaction = 'edit_faq';
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">FAQ ADD / EDIT</h5>
					<div>
						<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">

							<input type="hidden" name="id" value="<?= @$atheadmins['faq_id'] ?>">


							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Question</span> </div>
								<input type="text" class="form-control" name="que" placeholder="Your question"
									value="<?= @$atheadmins['faq_que'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
							</div>
							<textarea class="form-control rich_text" id='rich_text12_90' name="ans"
								placeholder="Answer here..."><?= @$atheadmins['faq_ans'] ?></textarea>
					</div>


					<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block"
						value="SAVE DATA">
					</form>

				</div>
			</div>
</div>
<?php
			$gettex = $this->db->query("select * from yn_site_faq order by faq_id asc");
			$thedatss = $gettex->result_array();
?>
<div class="col-sm-12 pl-2">
	<div class="main-card mb-3 card">
		<div class="card-body">
			<h5 class="card-title">FAQ List</h5>
			<table class="mb-0 table">
				<thead>
					<tr>
						<th>#</th>
						<th>Question</th>
						<th>Answer</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($thedatss as $testimonials) { ?>
						<tr>
							<td scope="row"><?= $testimonials['faq_id'] ?></td>

							<td style="min-width: 130px;"><?= $testimonials['faq_que'] ?> <br />

							<td><?= $testimonials['faq_ans'] ?></td>

							<td><?= read_me_user('test_status', $testimonials['faq_status']) ?></td>

							<td>
								<a onclick="return confirm('Are you sure you want to delete this?');"
									href="<?= base_url('admin_action/delete') ?>?id=<?= $testimonials['faq_id'] ?>&what=faq">
									<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
											class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

								<a
									href="<?= base_url('admin/perform/web/faq?edit=') ?><?= $testimonials['faq_id'] ?>">
									<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
											class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<div class="col-12">
				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link"
								aria-label="Previous"><span aria-hidden="true">«</span><span
									class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>

		</div>
	</div>
</div>
<?php break;

		case 'order':
			$getaction = 'order';
			$theidval = '';
?>

	<div class="card w-100">
		<div class="card-header">All Orders</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Order id</th>
					<th>Order date</th>
					<th>Amount</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>status</th>
					<th>Action</th>
				</tr>
				<?php

				@$sts = xss_clean($_GET['sts']);
				$getall_order = $this->db->query("select * from yn_ecom_order join yn_site_mem on yn_ecom_order.so_mid=yn_site_mem.mid 
              order by so_id desc limit $limit1, $limit2");
				$all_order = $getall_order->result_array();
				$count = 1;

				foreach ($all_order as $order) { ?>


					<tr class="bg-white">
						<td><?= $count++; ?></td>
						<td><?php echo $order['so_order_id'] ?></td>
						<td><?= date_format_1($order['so_date'], '1') ?></td>
						<td><?= money_show($order['so_price']) ?></td>
						<td><?php echo $order['name'] ?></td>
						<td><?php echo $order['email'] ?></td>
						<td><?php echo $order['contact'] ?></td>
						<td>
							<!-- <a href="<?= base_url('admin/perform/custom/orders?sts=' . $order['so_status']) ?>"><?= read_me_user('order_status', $order['so_status'], 1) ?><br></a> -->
							<a
								href="<?= base_url('admin/perform/custom/orders?pts=' . $order['so_status']) ?>"><?= read_me_user('order_status', $order['so_status'], 1) ?></a>
						</td>

						<td class="text-left">
							<div class="mr-2 btn-group">
								<button class="btn btn-outline-secondary">Options</button>
								<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
									class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
										class="sr-only">Toggle Dropdown</span>
								</button>
								<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">


									<a
										href="<?= base_url('admin/perform/custom/view_details') ?>?id=<?= $order['so_id'] ?>&what=view_details">
										<button type="button" tabindex="0" class="dropdown-item">Details</button></a>

									<!-- <a
                                href="<?= base_url('admin_action/service_modify') ?>?id=<?= $order['so_id'] ?>&what=con_ord">
                                <button type="button" tabindex="0" class="dropdown-item">Confirm</button></a> -->

									<a
										href="<?= base_url('admin_action/service_modify') ?>?id=<?= $order['so_id'] ?>&what=del_ord">
										<button type="button" tabindex="0" class="dropdown-item">Delivered</button></a>

									<a
										href="<?= base_url('admin_action/service_modify') ?>?id=<?= $order['so_id'] ?>&what=paid">
										<button type="button" tabindex="0" class="dropdown-item">Paid</button></a>

									<a
										href="<?= base_url('admin_action/service_modify') ?>?id=<?= $order['so_id'] ?>&what=unpaid">
										<button type="button" tabindex="0" class="dropdown-item">Un-paid</button></a>

									<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
										href="<?= base_url('admin_action/delete') ?>?id=<?= $order['so_id'] ?>&what=order">
										<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
								</div>
							</div>
						</td>

					</tr>

				<?php } ?>
			</table>


			<div class="col-12">
				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>

		</div>
	</div>
<?php
			break;
		case 'view_details':
			$id = $_GET['id'];
			$getallmesgaes = $this->db->query("select * from `site_order` join yn_site_mem on site_order.so_mid=site_mem.mid 
          join x_home_property on site_order.service_name=x_home_property.prop_id
          join x_home_plan on site_order.or_plan=x_home_plan.plan_id where so_id='$id'");
			$mess = $getallmesgaes->row_array();
			$oid = $mess['so_order_id'];
			// CHECKINS
			$getCheckings = $this->db->query("SELECT * FROM x_checkings WHERE orderID = $oid");
			$allCheckings = $getCheckings->num_rows();

			// CHECKINS END
?>
	<div class="main-card mb-3 card col-sm-8">
		<div class="card-body">
			<h5 class="card-title">Order Details</h5>
			<!-- <div class="col-sm-4"> -->
			<table class="table">
				<tbody class="text-dark">
					<tr>
						<th>Order #</th>
						<td class="font-weight-bold"><?= $mess['so_order_id'] ?></td>
						<th>Checkout Date</th>
						<td class="font-weight-bold"><?= date('d-m-Y', strtotime($mess['so_order_date_made'])) ?></td>
					</tr>
					<tr>
						<th>Name</th>
						<td class="font-weight-bold"><?= $mess['name'] ?></td>
						<th>Phone#</th>
						<td class="font-weight-bold"><?= $mess['contact'] ?></td>
					</tr>
					<tr>
						<th>Order Status</th>
						<td class="font-weight-bold"><?= read_me_user('order_status', $mess['so_status']) ?></td>
						<th>Email</th>
						<td class="font-weight-bold"><a href="mailto: <?= $mess['email'] ?>"><?= $mess['email'] ?></a></td>
					</tr>
					<tr>
						<th>Order Amount</th>
						<td class="font-weight-bold"><?= money_show($mess['so_amount']) ?></td>
						<th>Payment Status</th>
						<td class="font-weight-bold"><?= read_me_user('lpay_status', $mess['or_pay_status']) ?></td>
					</tr>
					<tr>
						<th>Gym</th>
						<td><?= $mess['prop_name'] ?></td>
						<th>Plan</th>
						<td><?= $mess['plan_name'] ?></td>
					</tr>
					<tr>
						<th>Remaining Sessions</th>
						<td><?= $mess['or_duration'] ?></td>
						<th>Attended Sessions</th>
						<td><?= $allCheckings ?></td>
					</tr>
					<tr>
						<th>Expiry Date</th>
						<td><?= date('d-m-Y', strtotime($mess['so_date'])); ?></td>
					</tr>
				</tbody>
			</table>
			<!-- </div> -->
		</div>
	</div>

<?php
			break;








		case 'o-settings':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_tags where stg_tgid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
?>
	<div class="col-sm-5 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Website Values</h5>
				<div class="row">
					<table class="mb-0 table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<!-- <th>Views</th> -->
								<th>Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							if (@$_GET['typ'] != '') {
								$type = $_GET['typ'];
								$gettex = $this->db->query("select * from yn_site_tags where stg_type ='$type' limit $limit1, $limit2");
							} else {
								$gettex = $this->db->query("select * from yn_site_tags where stg_type ='visit' limit $limit1, $limit2");
							}

							$atheadmins = $gettex->result_array();
							foreach ($atheadmins as $testimonials) { ?>
								<tr>
									<th scope="row"><?= $testimonials['stg_tgid'] ?></th>
									<!-- <td><?= $testimonials['stg_name'] ?></td> -->
									<td><?= $testimonials['stg_name'] ?></td>
									<td><a
											href="<?= base_url('admin/perform/web/tags?typ=') ?><?= $testimonials['stg_type'] ?>"><?= $testimonials['stg_type'] ?></a>
									</td>
									<td>
										<a
											href="<?= base_url('admin/perform/web/tags?edit=') ?><?= $testimonials['stg_tgid'] ?>">
											<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
													class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-12">
					<nav class="mt-4" aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item"><a href="javascript:void(0);" class="page-link"
									aria-label="Previous"><span aria-hidden="true">«</span><span
										class="sr-only">Previous</span></a></li>
							<?php
							$pagesare = $pageNum;
							for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
								$addclass = '';
								if ($pageNum == $x) {
									$addclass = 'bold';
								}
								if ($x > 0) {
							?>
									<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
											class="page-link"><?= $x ?></a></li>
							<?php }
							} ?>
							<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
										aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>
	<?php
			break;

		case 'setup':
			$do = clean($_GET['do']);
			switch ($do) {
				case '5':

					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='ser' ");
					$the_d_values = $checkdb->row_array();

					$theservlist = $the_d_values['ki_key'];
					$the_array_4 = explode(',', $theservlist);

	?>

			<div class="main-card mb-3 card col-sm-4 the_sjd">
				<div class="card-body">
					<h5 class="card-title">Service Selection.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="5">
						<input type="hidden" name="t" value="ser">
						<table>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('se', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="se">
								</td>
								<td>
									<b>Services</b><br>
									<small>Add and update services on the website.</small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('bl', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="bl">
								</td>
								<td>
									<b>Blogs</b><br>
									<small>Publish and manage blog content on the website.</small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('faq', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="faq">
								</td>
								<td>
									<b>FAQ</b><br>
									<small>Display frequently asked questions and answers on the website.</small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('port', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="port">
								</td>
								<td>
									<b>Portfolio</b><br>
									<small>Display frequently asked questions and answers on the website.</small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('testi', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="testi">
								</td>
								<td>
									<b>Testimonials</b><br>
									<small>Display customer testimonials on the website.</small>
								</td>
							</tr>



							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('subs', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="subs">
								</td>
								<td>
									<b>Subscribe </b></br>
									<small>Do you need subscription services for the website?.</small>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr />
									Manage categories and subcategories for the web application.
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('ct', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="ct">
								</td>
								<td>
									<b>Category</b></br>
									<small>Do you need to manage categories for the website? .</small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('sb', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="sb">
								</td>
								<td>
									<b>Subcategory</b></br>
									<small>Do you need to manage subcategories for the website? </small>
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('ssb', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="ssb">
								</td>
								<td>
									<b>Sub-Subcategory</b></br>
									<small>Do you need to manage sub-subcategories for the website? .</small>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr />
									Admin Services Setup
								</td>
							</tr>






							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('loc', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="loc">
								</td>

								<td>
									<b>Location</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('po', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="po">
								</td>

								<td>
									<b>Popups</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('tag', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="tag">
								</td>

								<td>
									<b>Tags Management</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('team', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="team">
								</td>

								<td>
									<b>Teams</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>


							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('csv', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="csv">
								</td>

								<td>
									<b>CSV Management</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>


							<tr>
								<td colspan="2">
									<hr />
									Sell online and ecommerce Related Features.
								</td>
							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('eco', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="eco">
								</td>

								<td>
									<b>eCom Features</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>
							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('coup', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="coup">
								</td>

								<td>
									<b>Coupons</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>




							<tr>
								<td colspan="2">
									<hr />
									WebApp Users and their management.
								</td>
							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('usr', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="usr">
								</td>

								<td>
									<b>Users</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('uty', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="uty">
								</td>

								<td>
									<b>User Type </b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('rati', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="rati">
								</td>

								<td>
									<b>Ratings</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td colspan="2">
									<hr />
									WebAPP Admin Settings and features.
								</td>
							</tr>


							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('navi', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="navi">
								</td>

								<td>
									<b>Navigation</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('the', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="the">
								</td>

								<td>
									<b>Theme and Plugin</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('app', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="app">
								</td>

								<td>
									<b>Mobile APP Features</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>




							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('trans', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="trans">
								</td>

								<td>
									<b>Google Translate</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('curr', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="curr">
								</td>

								<td>
									<b>Currency</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('pg', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="pg">
								</td>

								<td>
									<b>Page manager</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td colspan="2">
									<hr />
									<small>Nodly's Specials</small>
								</td>
							</tr>


							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('liv', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="liv">
								</td>

								<td>
									<b>Hide Settings</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>




							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('wabt', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="wabt">
								</td>

								<td>
									<b>WhatsApp Floating Button</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('mobf', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="mobf">
								</td>

								<td>
									<b>Enable Mobile Footer</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('pho', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="pho">
								</td>

								<td>
									<b>Photo manager</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>


							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('nodl', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="nodl">
								</td>

								<td>
									<b>Nodly's features</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>

							<tr>
								<td class="the_box pr-3">
									<input type="checkbox" <?php if (in_array('news', $the_array_4)) {
																echo 'checked';
															} ?> data-toggle="toggle" data-onstyle="info" name="ser[]" value="news">
								</td>

								<td>
									<b>News in Admin</b></br>
									<small>Do you need services in the Website, you can add and update services.</small>
								</td>

							</tr>
						</table>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">

					</form>

				</div>
			</div>
			<script type="text/javascript" src="<?= base_url('assets/admin') ?>/scripts/main.8d288f825d8dffbbe55e.js"></script>


			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars ml-3">
				<div class="card-body">
					<h5 class="card-title">Reset Database</h5>

					<table class="col-12 table table-responsive-sm table-striped">
						<tr>
							<td>
								S.No
							</td>
							<td>
								Sercices
							</td>
							<td>
								Reset data
							</td>
						</tr>

						<tr>
							<td>
								1:
							</td>
							<td>
								Member List
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=mem') ?>"> Reset </a>
							</td>
						</tr>

						<tr>
							<td>
								2:
							</td>
							<td>
								Leads
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=lead') ?>"> Reset </a>
							</td>
						</tr>
						<tr>
							<td>
								3:
							</td>
							<td>
								Subscribers
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=subs') ?>"> Reset </a>
							</td>
						</tr>

						<tr>
							<td>
								4:
							</td>
							<td>
								Orders
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=orders') ?>"> Reset </a>
							</td>
						</tr>


						<tr>
							<td>
								5:
							</td>
							<td>
								Products
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=prod') ?>"> Reset </a>
							</td>
						</tr>


						<tr>
							<td>
								6:
							</td>
							<td>
								Category and sub, sub category
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=cats') ?>"> Reset </a>
							</td>
						</tr>

						<tr>
							<td>
								7:
							</td>
							<td>
								Tags
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=keys') ?>"> Reset </a>
							</td>
						</tr>


						<tr>
							<td>
								8:
							</td>
							<td>
								Business
							</td>
							<td>
								<a href="<?= base_url('admin_action/reset?do=buss') ?>"> Reset </a>
							</td>
						</tr>

					</table>

					<a href="<?= base_url('admin_action/bdbackup') ?>">
						<input type="button" name="" class="btn btn-primary btn-block" value="Database Backup">
					</a>

					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

		<?php
					break;

				case '1':
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='em' ");
					$the_d_values = $checkdb->row_array();
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">

					<h5 class="card-title">Email Settings.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="em">
						<div>
							<label>Key</label>
							<input type="text" name="key" value="<?= $the_d_values['ki_key'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Password</label>
							<input type="text" name="pass" value="<?= $the_d_values['ki_pass'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Host</label>
							<input type="text" name="host" value="<?= $the_d_values['ki_host'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Send Email From</label>
							<input type="text" name="v1" value="<?= $the_d_values['ki_v1'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Send Email From</label>
							<select name="v2" class='form-control'>
								<option value="1" <?php if ($the_d_values['ki_v2'] == '1') {
														echo 'selected';
													} ?>>SendGrid</option>
								<option value="2" <?php if ($the_d_values['ki_v2'] == '2') {
														echo 'selected';
													} ?>>MailJet</option>
							</select>
						</div>
						<a href="https://reurl.in/aEveF" target="_blank"> Get Email Apis </a>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

			<?php
					$checkdb = $this->db->query("select * from  yn_admin_files where asid='1' ");
					$checkdb_css_r = $checkdb->row_array();
			?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars ml-2">
				<div class="card-body">

					<div class="col-12 px-0">
						<h5 class="card-title">Email Template.</h5>
						<small>Please do not change this, This has PHP Variables.</small>
						<form class="col-12 px-0"
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
							<input type="hidden" name="s" value="1">
							<input type="hidden" name="t" value="em">
							<input type="hidden" name="s" value="emtemp">
							<input type="hidden" name="t" value="sm">
							<textarea class="shadow code_texta" name="em_temp"
								style="min-height: 420px;"><?= $checkdb_css_r['em_temp'] ?></textarea>

							<input type="submit" name="" value="Save" class="btn px-3 my-3 btn_2 pull-right btn-block">
						</form>
					</div>
				</div>

			</div>

		<?php
					break;

				case 'theme':
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='em' ");
					$the_d_values = $checkdb->row_array();
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">

					<h5 class="card-title">Upload New Theme.</h5>
					<form action="<?= base_url('admin_action/theme_manager') ?>" method='POST' enctype="multipart/form-data">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="em">

						<div>
							<label>Theme name</label>
							<input type="text" name="thm_name" value="" class="form-control" placeholder="Theme name" required>
						</div>

						<div class="mt-3">
							<input type="file" name="zip_file">
						</div>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

			<?php
					$thetheme_names = $this->db->query("select * from yn_site_theme order by thm_id desc ");
					$the_themes = $thetheme_names->result_array();
			?>

			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars ml-4">
				<div class="card-body">
					<h5 class="card-title">Manage themes.</h5>
					<table class="col-12 table table-responsive-sm table-striped">
						<?php foreach ($the_themes as $thes_e9) { ?>
							<tr>
								<td>
									Theme Name: <b><?= $thes_e9['thm_name'] ?> </b>
									<br /><small>Uploaded on <?= date_format_1($thes_e9['thm_date'], 't') ?>
										<?php if ($thes_e9['thm_status'] == '1') { ?>
											<br><i class="fa-light fa-square-check"></i> This is an active theme
										<?php } ?>
									</small>
									<br /><a onclick="return confirm('Are you sure you want to delete this theme ?');"
										href="<?= base_url('admin_action/delete') ?>?id=<?= $thes_e9['thm_id'] ?>&what=theme"
										class=" text-danger mt-2">
										<i class="fa-light fa-trash"></i> Delete
									</a>
								</td>
								<td>
									<?php
									if ($thes_e9['thm_status'] == '1') { ?>
										<a href="<?= base_url('admin_action/theme_activate/') ?><?= $thes_e9['thm_id'] ?>"
											class="btn btn-success">
											Activated
										</a>
									<?php } else { ?>
										<a href="<?= base_url('admin_action/theme_activate/') ?><?= $thes_e9['thm_id'] ?>"
											class="btn btn_2">
											Activate
										</a>
									<?php }
									?>
								</td>
							</tr>
						<?php } ?>
					</table>
					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

		<?php
					break;

				case '3':
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='ca' ");
					$the_d_values = $checkdb->row_array();
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">

					<h5 class="card-title">Google ReCaptcha Settings.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="ca">
						<div>
							<label>Site Key</label>
							<input type="text" name="key" value="<?= $the_d_values['ki_key'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Secret</label>
							<input type="text" name="pass" value="<?= $the_d_values['ki_pass'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Status</label>
							<select name="v2" class='form-control'>
								<option value="1" <?php if ($the_d_values['ki_v2'] == '1') {
														echo 'selected';
													} ?>>Enable</option>
								<option value="2" <?php if ($the_d_values['ki_v2'] == '2') {
														echo 'selected';
													} ?>>Disable</option>
							</select>
						</div>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

		<?php
					break;

				case '6':
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='pa' ");
					$the_d_values = $checkdb->row_array();
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">

					<h5 class="card-title">Create a Master Password to access any user account.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="pa">

						<div>
							<label>Password</label>
							<br /><small>We wont be able to show your master password here.</small>
							<input type="text" name="pass" value="" class="form-control" placeholder="Password">
						</div>

						<div>
							<label>Status</label>
							<select name="v2" class='form-control'>
								<option value="1" <?php if ($the_d_values['ki_v2'] == '1') {
														echo 'selected';
													} ?>>Enable</option>
								<option value="2" <?php if ($the_d_values['ki_v2'] == '2') {
														echo 'selected';
													} ?>>Disable</option>
							</select>
						</div>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

		<?php
					break;

				case 'css':
					$checkdb = $this->db->query("select * from  yn_site_theme where thm_status='1' ");
					$checkdb_css_r = $checkdb->row_array();
		?>
			<form class="col-12"
				onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

				<input type="hidden" name="s" value="ocss">
				<input type="hidden" name="t" value="sm">
				<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['thm_css'] ?></textarea>
				<input type="submit" name="" value="Save CSS" class="btn px-3 my-3 btn_2 pull-right">
			</form>

		<?php break;

				case 'code':
					$checkdb = $this->db->query("select * from  yn_admin_files where asid='1' ");
					$checkdb_css_r = $checkdb->row_array();
		?>
			<div class="col-12">
				<form class="col-12"
					onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

					<h5>Mobile Footer Code.</h5>
					<input type="hidden" name="s" value="mfo">
					<input type="hidden" name="t" value="sm">
					<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['mo_footer'] ?></textarea>
					<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
				</form>
			</div>

			<div class="col-12">
				<form class="col-12"
					onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

					<h5>WhatsApp Floating code.</h5>
					<input type="hidden" name="s" value="wab">
					<input type="hidden" name="t" value="sm">
					<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['wa_btn'] ?></textarea>
					<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
				</form>
			</div>

			<div class="col-12">
				<form class="col-12"
					onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

					<h5>Disqus Comments.</h5>
					<input type="hidden" name="s" value="dis">
					<input type="hidden" name="t" value="sm">
					<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['disqus'] ?></textarea>
					<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
				</form>
			</div>

		<?php break;

				case 'php':
					$check_theme = $this->db->query("select * from yn_site_theme where thm_status='1' ");
					$checkdb_css_r = $check_theme->row_array();

					if ($check_theme->num_rows() == '0') {
						echo "<span class='bg-danger text-white px-4 ml-0'>Please Activate a theme to edit this.</span>";
					}

		?>
			<div class="row col-12 pl-0">

				<div class="col-sm-12 bg-white shadow my-2" style="border-radius:6px;">
					<h4>Theme Header Codes (CSS) </h4>
					<p>Please add theme CSS here

						<br /><code
							class="bg-light"> script src="{{base_url}}assets/theme/{{theme}}/js/vendor/svg-inject.min.js </code>
						<br>Please use {{base_url}} for Dynamic URL in the website and {{theme}} for the theme name auto select in
						your codes.
					</p>
					<small class="bg-danger px-3 text-white">Please Do not Edit.</small>
					<hr />
					<form class="col-12 p-0"
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

						<input type="hidden" name="s" value="h2">
						<input type="hidden" name="t" value="sm">
						<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['thm_header2'] ?></textarea>
						<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
					</form>
				</div>

				<div class="col-sm-12 bg-white shadow" style="border-radius:6px;">
					<h4>Theme Footer Codes (JS) </h4>
					<p>
						<code class="bg-light"> script src="{{base_url}}assets/theme/{{theme}}/js/vendor/svg-inject.min.js </code>
						<br>Please use {{base_url}} for Dynamic URL in the website and {{theme}} for the theme name auto select in
						your codes.
					</p>
					<small class="bg-danger px-3 text-white">Please Do not Edit.</small>
					<hr />
					<form class="col-12 p-0"
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

						<input type="hidden" name="s" value="f2">
						<input type="hidden" name="t" value="sm">
						<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['thm_footer2'] ?></textarea>
						<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
					</form>
				</div>

				<div class="col-sm-12 bg-white shadow my-2" style="border-radius:6px;">
					<h4>Nodly's Footer Codes</h4>
					<p>
						These are scripts required by Nodly's system to work on website, please do not remove unless you know what
						you are doing.

						<br /><code
							class="bg-light"> script src="{{base_url}}assets/theme/{{theme}}/js/vendor/svg-inject.min.js </code>
						<br>Please use {{base_url}} for Dynamic URL in the website and {{theme}} for the theme name auto select in
						your codes.
					</p>
					<small class="bg-danger px-3 text-white">Please Do not Edit.</small>
					<hr />
					<form class="col-12 p-0"
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

						<input type="hidden" name="s" value="f1">
						<input type="hidden" name="t" value="sm">
						<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['thm_footer1'] ?></textarea>
						<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
					</form>
				</div>

				<div class="col-sm-12 my-2 bg-white shadow" style="border-radius:6px;">
					<h4>Nodly's Header Codes</h4>
					<p>
						These are scripts required by Nodly's system to work on website, please do not remove unless you know what
						you are doing.

						<br><code
							class="bg-light"> script src="{{base_url}}assets/theme/{{theme}}/js/vendor/svg-inject.min.js </code>
						<br>Please use {{base_url}} for Dynamic URL in the website and {{theme}} for the theme name auto select in
						your codes.
					</p>
					<small class="bg-danger px-3 text-white">Please Do not Edit.</small>
					<hr />
					<form class="col-12 p-0"
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">

						<input type="hidden" name="s" value="h1">
						<input type="hidden" name="t" value="sm">
						<textarea class="shadow code_texta" name="css"><?= $checkdb_css_r['thm_header1'] ?></textarea>
						<input type="submit" name="" value="Save Code" class="btn px-3 my-3 btn_2 pull-right">
					</form>
				</div>





			</div>

		<?php break;
				case 'widget':

					$getaction = 'add_widget';
					$theidval = '';
					if (isset($_GET['edit']) && $_GET['edit'] != '') {
						$id = $_GET['edit'];
						$getslider_details = $this->db->query("select * from yn_widgets where wd_id='$id' ");
						$theimage_details3 = $getslider_details->row_array();
						$getaction = 'edit_widget';
						$theidval = $_GET['edit'];
					}

		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">WIDGETS</h5>
					<div>
						<form method="post" action="<?= base_url('admin_action/'); ?><?= $getaction ?>"
							onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $getaction ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
							enctype="multipart/form-data">

							<input type="hidden" name="id" value="<?= @$theimage_details3['wd_id'] ?>">


							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Widget name</span> </div>
								<input type="text" class="form-control" name="que" placeholder="Widget name"
									value="<?= @$theimage_details3['wd_name'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
							</div>
							<textarea class="form-control" id='rich_text12_90' name="ans"
								placeholder="Widget HTML"><?= @$theimage_details3['wd_text'] ?></textarea>
					</div>


					<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold px-4 "
						value="SAVE DATA">
					</form>

				</div>
			</div>
			</div>

			<?php
					$getall_widgets = get_web_elements('widget', '1', '10');
					foreach ($getall_widgets as $widgets) { ?>
				<div class="main-card mb-3 card col-sm-4">
					<div class="card-body">
						<h5 class="card-title">Widget: <?= $widgets['wd_name'] ?></h5>
						<a href="<?= base_url('admin/perform/ynaps/setup?do=widget&edit=') ?><?= $widgets['wd_id'] ?>">Edit</a> -
						<a href="<?= base_url('admin_action/delete') ?>?id=<?= $widgets['wd_id'] ?>&what=widget">Delete</a>

						<div class="main-card">
							<div>
								<code>widget(<?= $widgets['wd_id'] ?>)</code><br />
								<small>Use the above function to get this widget anywhere.</small>
								<hr />
								<?php echo widget($widgets['wd_id']); ?>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>


		<?php break;
				case '2':
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='sm' ");
					$the_d_values = $checkdb->row_array();
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">
					<div class="the_box_s09d">
						<i class="fa-solid fa-message-sms"></i>
					</div>
					<h5 class="card-title">SMS Settings.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="sm">
						<div>
							<label>Key</label>
							<input type="text" name="key" value="<?= $the_d_values['ki_key'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Password</label>
							<input type="text" name="pass" value="<?= $the_d_values['ki_pass'] ?>" class="form-control"
								placeholder="Password">
						</div>

						<div>
							<label>Host</label>
							<input type="text" name="host" value="<?= $the_d_values['ki_host'] ?>" class="form-control"
								placeholder="Host">
						</div>

						<div>
							<label>Send SMS From</label>
							<input type="text" name="v1" value="<?= $the_d_values['ki_v1'] ?>" class="form-control"
								placeholder="Header SMS">
						</div>

						<div>
							<label>Send SMS From</label>
							<select name="v2" class='form-control'>
								<option value="1" <?php if ($the_d_values['ki_v2'] == '1') {
														echo 'selected';
													} ?>>2 factor</option>
								<option value="2" <?php if ($the_d_values['ki_v2'] == '2') {
														echo 'selected';
													} ?>>Msg91</option>
							</select>
						</div>

						<a href="https://reurl.in/uyLws" target="_blank"> Get 2 Factor Account </a>

						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

			<?php
					$checkdb = $this->db->query("select * from yn_site_keys where ki_type ='wa' ");
					$the_d_values = $checkdb->row_array();
			?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars ml-3">
				<div class="card-body">
					<div class="the_box_s09d">
						<i class="fa-brands fa-whatsapp"></i>
					</div>
					<h5 class="card-title">WhatsApp Settings.</h5>
					<form
						onsubmit="return ajaxsubmitform('<?= base_url('') ?>ynaps_admin_action/settings_web',this,'error_div','loder_div','#','1','success');">
						<input type="hidden" name="s" value="1">
						<input type="hidden" name="t" value="wa">

						<div>
							<label>Key</label>
							<input type="text" name="key" value="<?= $the_d_values['ki_key'] ?>" class="form-control"
								placeholder="Key">
						</div>

						<div>
							<label>Password</label>
							<input type="text" name="pass" value="<?= $the_d_values['ki_pass'] ?>" class="form-control"
								placeholder="Password">
						</div>

						<div>
							<label>Host</label>
							<input type="text" name="host" value="<?= $the_d_values['ki_host'] ?>" class="form-control"
								placeholder="Host">
						</div>

						<div>
							<label>Send WhatsApp From</label>
							<input type="text" name="v1" value="<?= $the_d_values['ki_v1'] ?>" class="form-control"
								placeholder="Header WhatsApp">
						</div>

						<a href="https://reurl.in/E8nBU" target="_blank"> Get WhatsApp APIs </a>


						<input type="submit" name="" value="Save" class="btn btn-primary btn-block mt-3 py-2">
					</form>


					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>

		<?php
					break;

				case 'assets':
		?>
			<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
				<div class="card-body">
					<h5 class="card-title">Find Your Assets.</h5>

					<table class="col-12 table table-responsive-sm table-striped">
						<tr>
							<td>
								S.No
							</td>
							<td>
								Job to do
							</td>
							<td>
								Link
							</td>
						</tr>

						<tr>
							<td>
								1:
							</td>
							<td>
								Nodlys Documentation
							</td>
							<td>
								<a href="<?= base_url('admin/perform/ynaps/setup?do=assets&doc=https://reurl.in/YcWJN') ?>">
									Documentation </a>
							</td>
						</tr>

						<tr>
							<td>
								2:
							</td>
							<td>
								Image Compression
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>
						<tr>
							<td>
								3:
							</td>
							<td>
								Business Map
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>
						<tr>
							<td>
								4:
							</td>
							<td>
								Google Map Coordinates
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>
						<tr>
							<td>
								1:
							</td>
							<td>
								SMS Gateway India
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>
						<tr>
							<td>
								1:
							</td>
							<td>
								SMS Gateway WorldWide
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>
						<tr>
							<td>
								1:
							</td>
							<td>
								WhatsApp API
							</td>
							<td>
								<a href=""> Documentation </a>
							</td>
						</tr>

					</table>




					<small>
						<hr />
						Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
						cause a major change in functioning of webApp.
					</small>
				</div>
			</div>


			<?php
					$url = $_GET['doc'];
			?>
			<div class="main-card mb-3 card col-sm-6 ml-3 the_sepcial_cars pt-2">
				<h4>Documentation will be Available Soon.</h4>
				<small>We are prepairing the same.</small>
			</div>

	<?php
					break;
			}
			break;


		case 'navi':

			if (@$_GET['edit'] != '') {
				$edit = clean($_GET['edit']);
				$thecheck = $this->db->query("select * from yn_site_nav where nv_id ='$edit'  ");
				$the_nav_item = $thecheck->row_array();
			}

	?>

	<div class="col-sm-4 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Create a Navigation.</h5>
				<div class="row">
					<div class="col-12">
						<form
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/yn_site_nav',this,'error_div','loder_div','#','1','success');">
							<div>
								<label>Navigation Name</label>
								<input type="text" name="name" placeholder="Navigation Name" class="form-control"
									value="<?= @$the_nav_item['nv_m_name'] ?>">
								<input type="hidden" name="edit" value="<?= @$edit ?>">
							</div>

							<input type="submit" name="" value="Add Navigation" class="btn btn-primary btn-block mt-2">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Navigation Management.</h5>
				<div class="row">
					<?php
					$getall_forms = $this->db->query("select * from yn_site_nav ");
					$theforms_list = $getall_forms->result_array();
					foreach ($theforms_list as $form_name) {
					?>
						<div class="row col-12 pb-1" style="border-bottom:1px solid #ddd;">
							<div class="col-6">
								<?= $form_name['nv_m_name'] ?>
							</div>

							<div class="col-6">
								<a href="<?= base_url('admin/perform/web/navi_menu?frmid=') ?><?= $form_name['nv_id'] ?>"
									class=""> Add Menu </a>

								| <a href="<?= base_url('admin/perform/web/navi?edit=') ?><?= $form_name['nv_id'] ?>" class="">
									Edit </a>
								| <a onclick="return confirm('Are you sure you want to delete this ?');"
									href="<?= base_url('admin_action/delete') ?>?id=<?= $form_name['nv_id'] ?>&what=navig"
									class=""> Delete </a>
							</div>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php
			break;

		case 'navi_menu':
?>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Navigation Management.</h5>
				<div class="row">
					<div class="col-12">
						<form
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/add_navi_link',this,'error_div','loder_div','#','1','success');">
							<div class="mb-2">
								<?php
								$getall_forms = $this->db->query("select * from yn_site_nav ");
								$theforms_list = $getall_forms->result_array();
								?>
								<label>Select Navigation</label>
								<select class="form-control" name="frm">
									<?php foreach ($theforms_list as $forms) { ?>
										<option value="<?= $forms['nv_id'] ?>"
											<?php if (@$_GET['frmid'] == $forms['nv_id']) {
												echo 'selected';
											} ?>>
											<?= $forms['nv_m_name'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div>
								<small>Open the Link in Same Tab ? </small>
								<select class="form-control" name="type">
									<option value="0">Same tab</option>
									<option value="1">New Tab</option>
								</select>
							</div>

							<div>
								<label>Name</label>
								<input type="text" name="label" placeholder="label Your text Box" class="form-control">
							</div>

							<div>
								<label>Link</label>
								<input type="text" name="link" placeholder="Name Your text Box" class="form-control">
							</div>

							<div>
								<label>Sort Order</label>
								<input type="text" name="sort" placeholder="Name Your text Box" class="form-control">
							</div>

							<div>
								<label>CSS Class</label>
								<input type="text" name="nv_class_css" placeholder="Class" class="form-control">
							</div>

							<input type="submit" name="" value="Add Navigation Link" class="btn btn-primary btn-block mt-2">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Navigation Management.</h5>
				<?php
				$frm = clean($_GET['frmid']);
				$sele_check = $this->db->query("select * from yn_site_nav_items where nv_nvid ='$frm' order by nv_weight asc ");
				$the_deas = $sele_check->result_array();
				foreach ($the_deas as $thefield_names) { ?>
					<div class="col-12">
						<a href="<?= $thefield_names['nv_link'] ?>">
							<?= $thefield_names['nv_name'] ?>
						</a>

						- <a
							href="<?= base_url('admin_action/delete') ?>?id=<?= $thefield_names['nv_imid'] ?>&what=navifiel">
							Delete
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

<?php
			break;

		case 'form':
?>

	<div class="col-sm-4 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Form Management.</h5>
				<div class="row">
					<div class="col-12">
						<form
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/form',this,'error_div','loder_div','#','1','success');">
							<div>
								<label>Form Name</label>
								<input type="text" name="name" placeholder="Name Your Form" class="form-control">
							</div>

							<input type="submit" name="" value="Add Form" class="btn btn-primary btn-block mt-2">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Form Management.</h5>
				<div class="row">
					<?php
					$getall_forms = $this->db->query("select * from yn_site_forms ");
					$theforms_list = $getall_forms->result_array();
					foreach ($theforms_list as $form_name) {
					?>

						<div class="col-8">
							<?= $form_name['frm_name'] ?>
						</div>

						<div class="col-4">
							<a href="<?= base_url('admin/perform/web/form2?frmid=') ?><?= $form_name['frm_id'] ?>" class=""> Add
								Fields </a>

							| <a href="<?= base_url('admin/perform/web/form?edit=') ?><?= $form_name['frm_id'] ?>" class="">
								Edit </a>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php
			break;

		case 'form2':
?>


	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Form Management.</h5>
				<div class="row">
					<div class="col-12">
						<form
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/form_fields',this,'error_div','loder_div','#','1','success');">
							<div class="mb-2">
								<?php
								$getall_forms = $this->db->query("select * from yn_site_forms ");
								$theforms_list = $getall_forms->result_array();
								?>
								<label>Select Form</label>
								<select class="form-control" name="frm">
									<?php foreach ($theforms_list as $forms) { ?>
										<option value="<?= $forms['frm_id'] ?>"><?= $forms['frm_name'] ?></option>
									<?php } ?>
								</select>
							</div>

							<div>
								<select class="form-control" name="type">
									<option value="textbox">Textbox</option>
									<option value="select">Select</option>
									<option value="radio">Radio</option>
									<option value="checkbox">Check Box</option>
								</select>
							</div>

							<div>
								<label>Label</label>
								<input type="text" name="label" placeholder="label Your text Box" class="form-control">
							</div>

							<div>
								<label>Name</label>
								<input type="text" name="name" placeholder="Name Your text Box" class="form-control">
							</div>

							<input type="submit" name="" value="Add Form" class="btn btn-primary btn-block mt-2">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Form Management.</h5>
				<?php
				$frm = clean($_GET['frmid']);
				$sele_check = $this->db->query("select * from yn_site_form_fields where frf_frmid ='$frm'");
				$the_deas = $sele_check->result_array();
				foreach ($the_deas as $thefield_names) {
					switch ($thefield_names['frf_type']) {
						case 'textbox': ?>
							<label><?= $thefield_names['frf_label'] ?> - <a
									href="<?= base_url('admin_action/delete') ?>?id=<?= $thefield_names['frf_id'] ?>&what=form_fiel">Delete</a>
							</label>
							<input type="text" class="form-control" placeholder="<?= $thefield_names['frf_label'] ?>"
								name="<?= $thefield_names['frf_name'] ?>">
						<?php
							break;

						case 'select':
							$ffv_flid = $thefield_names['frf_id'];
							$getall_values = $this->db->query("select * from yn_site_form_field_values where ffv_flid ='$ffv_flid' ");
							$agetall_datea = $getall_values->result_array();
						?>
							<label><?= $thefield_names['frf_label'] ?> - <a
									href="<?= base_url('admin_action/delete') ?>?id=<?= $thefield_names['frf_id'] ?>&what=form_fiel">Delete</a>
								- <a href="<?= base_url('admin/perform/web/form3?fldid=') ?><?= $thefield_names['frf_id'] ?>&frmid=<?= $frm ?>"
									class=""> Add Values </a> </label>
							<select class="form-control" name="<?= $thefield_names['frf_name'] ?>">
								<?php foreach ($agetall_datea as $the_de_details) { ?>
									<option><?= $the_de_details['ffv_val'] ?></option>
								<?php } ?>
							</select>
				<?php
							break;
					}
				} ?>
			</div>
		</div>
	</div>

<?php
			break;

		case 'form3':
?>

	<div class="col-sm-4 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Form Values Management.</h5>
				<div class="row">
					<div class="col-12">
						<form
							onsubmit="return ajaxsubmitform('<?= base_url('') ?>admin_action/ffv',this,'error_div','loder_div','#','1','success');">

							<?php
							$frm = clean($_GET['frmid']);
							$sele_check = $this->db->query("select * from yn_site_form_fields where frf_frmid ='$frm' and (frf_type ='checkbox' || frf_type ='select' ) ");
							$the_deas = $sele_check->result_array();
							?>
							<div>
								<select class="form-control" name="frf_id">
									<?php foreach ($the_deas as $thefield_names) {
									?>
										<option value="<?= $thefield_names['frf_id'] ?>"><?= $thefield_names['frf_name'] ?>
										</option>
									<?php } ?>
								</select>
							</div>

							<div>
								<label>Value Name</label>
								<input type="text" name="ffv" placeholder="Value" class="form-control">
							</div>

							<input type="submit" name="" value="Add Form" class="btn btn-primary btn-block mt-2">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 pl-2">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">Values</h5>
				<div class="row">
					<div class="col-12">
						<?php
						$ffv_flid = clean($_GET['fldid']);
						$getall_values = $this->db->query("select * from yn_site_form_field_values where ffv_flid ='$ffv_flid' ");
						$agetall_datea = $getall_values->result_array();
						foreach ($agetall_datea as $the_de_details) { ?>
							<?= $the_de_details['ffv_val'] ?> - <a
								href="<?= base_url('admin_action/delete') ?>?id=<?= $the_de_details['ffv_id'] ?>&what=form_fiel">Delete</a><br />
							<hr />
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
			break;

		case 'countries':
			$getall_flav = $this->db->query("select * from  yn_site_countries order by status desc limit $limit1, $limit2");
			$theflav_data = $getall_flav->result_array();
?>
	<div class="col-sm-6">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">All countries</h5>
				<div class="table-responsive">
					<table class="mb-0 table">
						<thead>
							<tr>
								<th>#</th>
								<th>Country Name</th>
								<th>Status</th>
								<th style="width: 180px;">Action </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($theflav_data as $flav_details) { ?>
								<tr>
									<th scope="row"><?= $flav_details['country_id'] ?></th>
									<td><?= $flav_details['country_name'] ?></td>
									<td class="text-left"><?= read_me_user('status', $flav_details['status']) ?></td>
									<td>
										<div class="mr-2 btn-group">
											<button class="btn btn-outline-secondary">View</button>
											<button type="button" aria-haspopup="true" aria-expanded="false"
												data-toggle="dropdown"
												class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
													class="sr-only">Toggle Dropdown</span>
											</button>
											<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['country_id'] ?>&what=en_cntry"><button
														type="button" tabindex="0" class="dropdown-item">Enable
														Country</button></a>
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['country_id'] ?>&what=dis_cntry"><button
														type="button" tabindex="0" class="dropdown-item">Disable
														Country</button></a>
											</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

<?php
			break;
		case 'states':
?>
	<div class="main-card mb-3 card col-3">
		<div class="card-body">
			<h5 class="card-title">States</h5>
			<div>
				<form class="form-horizontal form-label-left" method="get" enctype="multipart/form-data">
					<div class="form-group has-feedback">
						<?php $getheco = $this->db->query("select * from yn_site_countries where status='1' "); ?>
						<div class="form-group has-feedback">
							<select name="country" class="form-control" onchange="load_new_state(this)">
								<option value="">--Select Country--</option>
								<?php
								foreach ($getheco->result() as $row) { ?>
									<option value="<?= $row->country_id ?>" <?php if (@$_GET['country_id'] == $row->country_id) {
																				echo "Selected";
																			} ?>><?= $row->country_name ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>

				</form>

				<div class="col-12">
					<b> Filter</b>
					<hr />
					<div class="col-12">
						<a href="<?= base_url('admin/perform/web/states') ?>">
							- Show All
						</a>
					</div>
					<?php
					$country = @$_GET['country'];
					$thecats = $this->db->query("select ss.* from yn_site_states ss,yn_site_countries sc where sc.country_id=ss.country_id and sc.status='1' and ss.status='1' AND ss.country_id='$country' order by status desc limit 100");
					$thsersftsy3 = $thecats->result_array();
					foreach ($thsersftsy3 as $testimonials5) { ?>
						<div class="col-12">
							<a
								href="<?= base_url('admin/perform/web/cities') ?>?country=<?= $testimonials5['country_id'] ?>&state=<?= $testimonials5['state_id'] ?>">
								- <?= $testimonials5['state_name'] ?>
							</a>
						</div>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
	<?php
			if (isset($_GET['country']) && $_GET['country'] != '') {
				$country = $_GET['country'];
				$getall_flav = $this->db->query("select ss.* from yn_site_states ss, yn_site_countries sc where sc.country_id=ss.country_id and sc.status='1' and ss.country_id='$country' order by status desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select ss.* from yn_site_states ss, yn_site_countries sc where sc.country_id=ss.country_id and sc.status='1' order by status desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
	?>
	<div class="col-sm-6">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">All States</h5>

				<a href="<?= base_url('admin_action/modify_loc') ?>?what=disable_states" style="float: right;"
					class="btn btn_2 mb-2">Disable all States</a>

				<div class="table-responsive">
					<table class="mb-0 table">
						<thead>
							<tr>
								<th>#</th>
								<th>State Name</th>
								<th>Status</th>
								<th style="width: 180px;">Action </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($theflav_data as $flav_details) { ?>
								<tr>
									<th scope="row"><?= $flav_details['state_id'] ?></th>
									<td><?= $flav_details['state_name'] ?></td>
									<td class="text-left"><?= read_me_user('status', $flav_details['status']) ?></td>
									<td>
										<div class="mr-2 btn-group">
											<button class="btn btn-outline-secondary">View</button>
											<button type="button" aria-haspopup="true" aria-expanded="false"
												data-toggle="dropdown"
												class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
													class="sr-only">Toggle Dropdown</span>
											</button>
											<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['state_id'] ?>&what=en_state"><button
														type="button" tabindex="0" class="dropdown-item">Enable
														State</button></a>
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['state_id'] ?>&what=dis_state"><button
														type="button" tabindex="0" class="dropdown-item">Disable
														State</button></a>
											</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
<?php
			break;
		case 'cities':
?>
	<div class="main-card mb-3 card col-3">
		<div class="card-body">
			<h5 class="card-title">Cities</h5>
			<div>
				<form class="form-horizontal form-label-left" method="get" enctype="multipart/form-data">
					<div class="form-group has-feedback">
						<?php $getheco = $this->db->query("select * from yn_site_countries where status='1'"); ?>
						<div class="form-group has-feedback">
							<select name="country" class="form-control" onchange="load_new_state(this)">
								<option value="">--Select Country--</option>
								<?php
								foreach ($getheco->result() as $row) { ?>
									<option value="<?= $row->country_id ?>" <?php if (@$_GET['country_id'] == $row->country_id) {
																				echo "Selected";
																			} ?>><?= $row->country_name ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback">
						<div class="form-group has-feedback">
							<select name="state" class="form-control" id="get_state_data" onchange="load_new_city(this)">
								<option>--Select State--</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>

				</form>

				<div class="col-12">
					<b> Filter</b>
					<hr />
					<div class="col-12">
						<a href="<?= base_url('admin/perform/web/cities') ?>">
							- Show All
						</a>
					</div>
					<?php
					$state = @$_GET['state'];
					$thecats = $this->db->query("select c.* from yn_site_cities c, yn_site_states ss, yn_site_countries sc where sc.country_id=ss.country_id and sc.status=1 and ss.status='1' and c.state_id='$state' and c.state_id=ss.state_id order by status desc limit 100");
					$thsersftsy3 = $thecats->result_array();
					foreach ($thsersftsy3 as $testimonials5) { ?>
						<div class="col-12">
							<a
								href="<?= base_url('admin/perform/web/cities') ?>?state=<?= $testimonials5['state_id'] ?>">
								- <?= $testimonials5['city_name'] ?>
							</a>
						</div>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
	<?php
			if (isset($_GET['state']) && $_GET['state'] != '') {
				$state = $_GET['state'];
				$getall_flav = $this->db->query("select c.* from yn_site_cities c, yn_site_states ss where c.state_id='$state' and c.state_id=ss.state_id order by status desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select c.* from  yn_site_cities c, yn_site_states ss where c.state_id=ss.state_id order by status desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
	?>
	<div class="col-sm-6">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">All cities</h5>
				<a href="<?= base_url('admin_action/modify_loc') ?>?what=disable_cities" style="float: right;"
					class="btn btn-warning">Disable all Cities</a>
				<div class="table-responsive">
					<table class="mb-0 table">
						<thead>
							<tr>
								<th>#</th>
								<th>City Name</th>
								<th>Status</th>
								<th style="width: 180px;">Action </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($theflav_data as $flav_details) { ?>
								<tr>
									<th scope="row"><?= $flav_details['city_id'] ?></th>
									<td><?= $flav_details['city_name'] ?></td>
									<td class="text-left"><?= read_me_user('status', $flav_details['status']) ?></td>
									<td>
										<div class="mr-2 btn-group">
											<button class="btn btn-outline-secondary">View</button>
											<button type="button" aria-haspopup="true" aria-expanded="false"
												data-toggle="dropdown"
												class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
													class="sr-only">Toggle Dropdown</span>
											</button>
											<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['city_id'] ?>&what=en_city"><button
														type="button" tabindex="0" class="dropdown-item">Enable
														City</button></a>
												<a
													href="<?= base_url('admin_action/modify_loc') ?>?id=<?= $flav_details['city_id'] ?>&what=dis_city"><button
														type="button" tabindex="0" class="dropdown-item">Disable
														City</button></a>
											</div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

<?php
			break;
		case 'locality':
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from yn_site_locality where loc_id='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
?>
	<div class="main-card mb-3 card col-3">
		<div class="card-body">
			<h5 class="card-title">Locality</h5>
			<div>
				<form class="form-horizontal form-label-left"
					action="<?= base_url('admin_action/add_locality') ?>" method="post"
					enctype="multipart/form-data"
					onsubmit="return uploadandform('<?= base_url('admin_action/add_locality') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
					id='fomr_id_proile22w'>
					<input type="hidden" name="theid" value="<?= @$todoedit ?>">
					<div class="form-group has-feedback">
						<div class="form-group has-feedback">
							<label>Select State</label>
							<select name="state" class="form-control" id="get_state_data" onchange="load_new_city(this)">
								<?= getState(101, 1) ?>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback">
						<div class="form-group has-feedback">
							<label>Select City</label>
							<select name="city" class="form-control" id="get_cities_data">
								<option>--Select City--</option>
								<?php if (@$atheadmins['loc_city_id'] != '') { ?>
									<option value="<?= @$atheadmins['loc_city_id'] ?>" selected>
										<?= $atheadmins['loc_city_name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback">
						<div class="form-group has-feedback">
							<label>Enter Locality Name</label>
							<input type="text" class="form-control" name="locality"
								value="<?= @$atheadmins['loc_name'] ?>" />
						</div>
					</div>

					<div class="form-group">
						<div class="">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<?php
			if (isset($_GET['city']) && $_GET['city'] != '') {
				$city = $_GET['city'];
				$getall_flav = $this->db->query("select * from yn_site_locality where loc_city_id = '$city' order by loc_id desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select * from yn_site_locality order by loc_id desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
	?>
	<div class="col-sm-6">
		<div class="main-card mb-3 card">
			<div class="card-body">
				<h5 class="card-title">All Localities</h5>
				<div class="table-responsive">
					<table class="mb-0 table">
						<thead>
							<tr>
								<th>#</th>
								<th>City Name</th>
								<th>Locality</th>
								<th style="width: 180px;">Action </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x = 1;
							foreach ($theflav_data as $flav_details) { ?>
								<tr>
									<th scope="row"><?= $x++ ?></th>
									<th scope="row"><a
											href="<?= base_url('admin/perform/web/locality?city=' . $flav_details['loc_city_id']) ?>"><?= $flav_details['loc_city_name'] ?></a>
									</th>
									<td class="text-left"><?= $flav_details['loc_name'] ?></td>
									<td>
										<a onclick="return confirm('Are you sure you want to delete this?');"
											href="<?= base_url('admin_action/delete') ?>?id=<?= $flav_details['loc_id'] ?>&what=locality">
											<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
													class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

										<a
											href="<?= base_url('admin/perform/web/locality?edit=') ?><?= $flav_details['loc_id'] ?>">
											<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i
													class="pe-7s-pen btn-icon-wrapper"> </i></button></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<nav class="mt-4" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span
									aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#"
										class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span
									aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

<?php
			break;

		case 'download':
?>

	<div class="main-card mb-3 card col-sm-4 the_sepcial_cars">
		<div class="card-body">
			<h5 class="card-title">Download CSV.</h5>

			<table class="col-12 table table-responsive-sm table-striped">
				<tr>
					<td>
						S.No
					</td>
					<td>
						Sercices
					</td>
					<td>
						Download data
					</td>
				</tr>

				<tr>
					<td>
						1:
					</td>
					<td>
						Member List
					</td>
					<td>
						<a href="<?= base_url('admin_action/download?do=mem') ?>"> Download XLS </a>
					</td>
				</tr>

				<tr>
					<td>
						2:
					</td>
					<td>
						Leads
					</td>
					<td>
						<a href="<?= base_url('admin_action/download?do=lead') ?>"> Download XLS </a>
					</td>
				</tr>
				<tr>
					<td>
						3:
					</td>
					<td>
						Subscribers
					</td>
					<td>
						<a href="<?= base_url('admin_action/download?do=subs') ?>"> Download XLS </a>
					</td>
				</tr>

				<?php if (check_service_status('1', '2', 'eco') == '1') { ?>
					<tr>
						<td>
							4:
						</td>
						<td>
							Orders
						</td>
						<td>
							<a href="<?= base_url('admin_action/download?do=orders') ?>"> Download XLS </a>
						</td>
					</tr>
					<!-- <tr>
            <td>
              1:
            </td>
            <td>
              Products
            </td>
            <td>
              <a href="<?= base_url('admin_action/download?do=prod') ?>"> Download XLS </a>
            </td>
          </tr> -->
				<?php } ?>

				<!-- <tr>
          <td>
            1:
          </td>
          <td>
            Business
          </td>
          <td>
            <a href="<?= base_url('admin_action/download?do=buss') ?>"> Download XLS </a>
          </td>
        </tr> -->

			</table>


			<small>
				<hr />
				Please Do not edit these details unless you are fully aware of what you are doing, as these settings may
				cause a major change in functioning of webApp.
			</small>
		</div>
	</div>

<?php
			break;


		case 'add-notification':
			$theidval = $_GET['id'];

			$theReq = $this->db->query("SELECT * FROM yn_site_mem WHERE mid = '$theidval'");
			$reqDetails = $theReq->row_array();
?>
	<div class="main-card mb-3 card col-sm-6">
		<div class="card-header">Add Notifications</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
				</div>
			</div>

			<form method="post" action="<?= base_url('admin_action_custom/add_notify') ?>" novalidate="novalidate"
				onsubmit="return ajaxsubmitform('<?= base_url('admin_action_custom/add_notify') ?>',this,'error_div','loder_div','#','1', 'notify');">
				<input type="hidden" name="mid" value="<?= $theidval ?>">
				<input type="hidden" name="email" value="<?= $reqDetails['email'] ?>">

				<div class="row my-2 m-2">
					<?php
					$getall_mems = $this->db->query("select * from yn_site_mem order by name asc limit 500");
					$get_all_mems = $getall_mems->result_array();
					?>
					<div class="col-12 mb-2">
						<small>Limited to 500 users </small>
						<select class="form-control" name="to">
							<?php
							foreach ($get_all_mems as $mems_data) { ?>
								<option value="<?= $mems_data['mid'] ?>">
									<?= $mems_data['name'] ?> | <?= $mems_data['email'] ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-12">
						<input type="text" name="subject" placeholder="Subject" class="form-control col-12"
							value="<?= @$reqDetails['subject'] ?>">
					</div>

					<div class="col-sm-12 mt-2">
						<textarea name="message" placeholder="Message"
							class="form-control col-12"><?= @$reqDetails['message'] ?></textarea>
					</div>


					<div class="col-12">
						<input type="checkbox" checked name="email_notify" <?php if (@$reqDetails['email_notify'] == "1") {
																				echo 'checked';
																			} ?>>
						Email

						<input type="checkbox" name="app_notify" <?php if (@$reqDetails['app_notify'] == "1") {
																		echo 'checked';
																	} ?>>
						APP
					</div>

					<div class="col-12">
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Notifications</button>
					</div>
				</div>

			</form>
		</div>
		<div class="card-footer">Good luck!</div>
	</div>
<?php
			break;
	}
?>
</div>