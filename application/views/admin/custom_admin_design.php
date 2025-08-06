<?php
$pageNum = @$_GET['page'];
if ($pageNum == NULL || $pageNum == '0') {
	$pageNum = 1;
}
$resultsPerPage = '50';
$limit1 = $pageNum * $resultsPerPage - $resultsPerPage;
$limit2 =  $resultsPerPage;
?>

<div class="row">
	<?php
	$sub_perform = $this->uri->segment(4);
	switch ($sub_perform) {
		case 'all-course':
			if (isset($_GET['cat']) && $_GET['cat'] != '') {
				$cat = str_replace('-', ' ', $_GET['cat']);
				$getall_flav = $this->db->query("select * from x_edu_courses where cou_cat = '$cat' order by course_id desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select * from x_edu_courses  order by course_id desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
	?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Courses</h5>
						<div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=cou') ?>" download>
								<h5 class="card-title">Download Data</h5>
							</a> </div>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Course Name</th>
										<!-- <th>Image</th> -->
										<th><a href="<?= base_url('admin/perform/custom/all-course') ?>">Category Name</a></th>
										<th>Price</th>
										<th>Description</th>
										<th>Materials</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {

									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['course_id']
															?></th>
											<td style="max-width:200px;">
												<?= trim_text($flav_details['course_name'], 200, '...') ?>
											</td>
											<!-- <td><img src="<?= base_url('assets/avator/upload/courses/') ?><?= $flav_details['course_img'] ?>" style="height: 40px;"></td> -->
											<td><a href="<?= base_url('admin/perform/custom/all-course') ?>?cat=<?= url_smart($flav_details['course_cat']) ?>"><?= $flav_details['course_category'] ?></td>
											<td><?= @$flav_details['course_price'] ?></td>
											<td style="max-width:200px;"><?= trim_text(strip_tags(@$flav_details['course_desc']), 100, '...') ?></td>
											<td><?php $lid = $flav_details['course_id'];
												$materials = '';
												$getall_tests = $this->db->query("select * from x_edu_study_material where sm_course_id='$lid' order by sm_sort DESC");
												$all_mats = $getall_tests->result_array();
												foreach ($all_mats as $test) {
													$materials .= '<a href="' . base_url('admin/perform/custom/add-smaterial?couID=') . $flav_details['course_id'] . '&edit=' . $test['sm_id'] . '">' . $test['sm_name'] . '</a><br>';
												}
												echo $materials; ?></td>
											<td class="text-left">
												<?= read_me_user('cou_status', $flav_details['course_status']) ?>
												<br>
												<?= read_me_product('trend_status', $flav_details['course_featured']) ?>
												<br><?= $flav_details['course_app_web'] ?>
											</td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['course_id'] ?>&what=<?php echo $flav_details['course_status'] == 0 ? 'enable_course' : 'disable_course' ?>">
															<button type="button" tabindex="0" class="dropdown-item"><?php echo $flav_details['course_status'] == 0 ? ' Enable' : 'Disable' ?> </button></a>
														<a href="<?= base_url('admin/perform/custom/add-smaterial?couID=') ?><?= $flav_details['course_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Add Study Material</button></a>
														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/add-course?couID=') ?><?= $flav_details['course_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Edit Course</button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['course_id'] ?>&what=<?php echo $flav_details['course_featured'] == 0 ? 'cou_feat' : 'cou_nonf' ?>">
															<button type="button" tabindex="0" class="dropdown-item"><?php echo $flav_details['course_featured'] == 0 ? ' MARK FEATURED' : 'MARK NON-FEATURED' ?> </button></a>
														<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $flav_details['course_id'] ?>&what=course">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'add-course':
			$what = 'add_course';
			$theidval = '';
			if (isset($_GET['couID']) && $_GET['couID'] != '') {
				$id = $_GET['couID'];
				$getslider_details = $this->db->query("select * from x_edu_courses where course_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_course';
				$theidval = $_GET['couID'];
			}
		?>
			<div class="main-card mb-3 card col-sm-9">
				<div class="card-header">Add / Remove Course</div>
				<a href="<?= base_url('admin/perform/custom/all-course') ?>">
					<h5 class="card-title text-right">All Courses</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/add_data'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/add_data') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="the_id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-sm-6 my-1"><b>Course Name:</b><input type="text" name="name" placeholder="Name" class="form-control col-12" value="<?= @$theimage_details3['course_name'] ?>"></div>

							<div class="col-sm-6 my-1"><b>Course Duration:</b><input type="text" name="course_dur" placeholder="Course Duration" class="form-control col-12" value="<?= @$theimage_details3['course_dur'] ?>"></div>

							<div class="col-sm-6"><b>Category: </b>
								<?php
								$gettheCats = $this->db->query("select * from yn_site_catagory");
								$theCats = $gettheCats->result_array();
								?>
								<div class="form-group has-feedback">
									<select name="cat" id="cat" class="form-control" onchange="load_subcat(this);">
										<option value="">-Select Category-</option>
										<?php
										foreach ($theCats as $cat) { ?>
											<option value="<?= $cat['ctid'] ?>" <?php if ($cat['ctid'] == @$theimage_details3['course_cat']) {
																					echo ' selected';
																				} ?>><?= $cat['name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group col-sm-6"><b>Sub-Category: </b>
								<div class="form-group has-feedback">
									<select name="scat" class="form-control" id="get_subcat_data">
										<option value="">-Select SubCategory-</option>
										<option value="<?= @$theimage_details3['course_scat'] ?>" selected><?= @$theimage_details3['course_scategory'] ?></option>
									</select>
								</div>
							</div>
							<div class="col-sm-6 my-1"><b>Price:</b><input type="text" name="course_price" placeholder="Course Price" class="form-control col-12" value="<?= @$theimage_details3['course_price'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Rating:</b><select required class="form-control" name="rating">
									<option value="0">-- Rating | Star --</option>
									<?php
									for ($st = 1; $st <= 5; $st++) {
										if ($theimage_details3['course_rating'] == $st) {
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
								</select></div>
							<div class="col-sm-6 my-1"><b>Show in APP / Web:</b><select required class="form-control" name="course_app_web">
									<option <?php if (@$theimage_details3['course_app_web'] == "both") { ?>selected <?php } ?> value="both">Both</option>
									<option <?php if (@$theimage_details3['course_app_web'] == "web") { ?>selected <?php } ?> value="web">Web</option>
									<option <?php if (@$theimage_details3['course_app_web'] == "app") { ?>selected <?php } ?> value="app">App</option>

								</select></div>
							<div class="col-sm-6 my-1"><b>Language:</b><input type="text" name="course_lang" placeholder="Course Language" class="form-control col-12" value="<?= @$theimage_details3['course_lang'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Course Demo Video Link:</b><input type="text" name="course_video" placeholder="Course Demo Video Link" class="form-control col-12" value="<?= @$theimage_details3['course_video'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Course Lessons:</b><input type="text" name="course_lessons" placeholder="Course Lessons" class="form-control col-12" value="<?= @$theimage_details3['course_lessons'] ?>"></div>
							<div class="col-sm-6 my-1">
								<b>Course Photo: </b>
								<br /><input type="file" name="file_name">
								<br /><label>Video Thumbnail</label>
								<br /><input type="file" name="file_name2">
							</div>
							<!-- <div class="col-sm-6 my-1"></div> -->
							<div class="col-sm-6"><b>Tags: </b>
								<?php
								$gethelab = $this->db->query("select * from yn_site_tags");
								$thesmat = $gethelab->result_array();

								$geththelabTests = $this->db->query("select * from x_edu_course_tags where ct_course_id='$theidval'");
								$theCrsMats = $geththelabTests->result_array();
								?>
								<div class="form-group has-feedback">
									<select name="crs_tags[]" class="form-control" multiple>
										<?php
										foreach ($thesmat as $mat) { ?>
											<option value="<?= $mat['stg_tgid'] ?>" <?php if (array_search($mat['stg_tgid'], array_column($theCrsMats, 'ct_tag_id')) !== false) {
																						echo ' selected';
																					} ?>><?= $mat['stg_name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="desc"><?= @$theimage_details3['course_desc'] ?></textarea>
							</div>
						</div>
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Course</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>


		<?php
			break;
		case 'add-smaterial':
			$what = 'add_smaterial';
			$theidval = '';
			$cid = $_GET['couID'];
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from x_edu_study_material where sm_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_smaterial';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-header">Add / Remove Study Material</div>
				<a href="<?= base_url('admin/perform/custom/all-course') ?>">
					<h5 class="card-title text-right">All Courses</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/add_data'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/add_data') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="the_id" value="<?= $theidval ?>">
						<input type="hidden" name="course_id" value="<?= $cid ?>">
						<div class="row my-2">
							<div class="col-sm-6 my-1"><b>Material Name:</b><input type="text" name="name" placeholder="Material Name" class="form-control col-12" value="<?= @$theimage_details3['sm_name'] ?>"></div>

							<div class="col-sm-6 my-1"><b>Material Link - Vimeo ID:</b><input type="text" name="link" placeholder="Material Link" class="form-control col-12" value="<?= @$theimage_details3['sm_link'] ?>"></div>

							<div class="col-sm-6 my-1"><b>Sort:</b><input type="text" name="sm_sort" placeholder="Material Sort" class="form-control col-12" value="<?= @$theimage_details3['sm_sort'] ?>"></div>

							<div class="col-sm-6 my-1">
								<b>Material to Upload: </b><input type="file" name="file_name">
								<?php if (@$theimage_details3['sm_file'] != '') { ?>
									<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= @$theimage_details3['sm_id'] ?>&what=delete_sm_file"><i class="fa fa-trash mr-3"></i>Delete File</a>
								<?php } ?>
							</div>
							<div class="col-sm-12 my-1"><b>QBank:</b><select name="sm_qbank_id" class="form-control">
									<option value="">-- Choose QBank --</option>
									<?php
									$allqbanks = $this->db->query("select * from x_edu_qbank where qbstatus='1' and qbapp_web='sm' order by qb_id desc");
									$show_qbanks = $allqbanks->result_array();
									foreach ($show_qbanks as $qbank) {
									?>
										<option value="<?= $qbank['qb_id'] ?>"><?= $qbank['qbtitle'] ?></option>
									<?php } ?>
								</select></div>
							<div class="col-sm-12">
								<br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="desc"><?= @$theimage_details3['sm_desc'] ?></textarea>
							</div>
						</div>
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Study Material</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>

			<?php
			$getall_flav = $this->db->query("select * from x_edu_study_material where sm_course_id='$cid' order by sm_id desc limit $limit1, $limit2");
			$theflav_data = $getall_flav->result_array();
			?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Study Materials of this course</h5>
						<div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=sm') ?>" download>
								<h5 class="card-title">Download Data</h5>
							</a> </div>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Material Name</th>
										<th>Link</th>
										<th>Document</th>
										<th>Desc</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {

									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td style="max-width:290px;"><?= $flav_details['sm_name'] ?></td>
											<td><?= $flav_details['sm_link'] ?></td>
											<td><a href="<?= base_url('assets/avator/upload/smaterial/') ?><?= $flav_details['sm_file'] ?>" download><?= $flav_details['sm_file'] ?></td>
											<td><?= trim_text(strip_tags(@$flav_details['sm_desc']), 300, '...') ?></td>
											<td><?= read_me_product('product_status', $flav_details['sm_status']) ?></td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['sm_id'] ?>&what=enable_sm"><button type="button" tabindex="0" class="dropdown-item">Enable</button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['sm_id'] ?>&what=disable_sm"><button type="button" tabindex="0" class="dropdown-item">Disable</button></a>
														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/add-smaterial?edit=') ?><?= $flav_details['sm_id'] ?>&couID=<?= $cid ?>"><button type="button" tabindex="0" class="dropdown-item">Edit Material</button></a>
														<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $flav_details['sm_id'] ?>&what=material">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'enrollments':
			if (isset($_GET['pay']) && $_GET['pay'] != '') {
				$pay = $_GET['pay'];
				$getall_flav = $this->db->query("select * from x_edu_enrollments,x_edu_courses where co_course_id=course_id and co_payment_status='$pay' order by co_id desc limit $limit1, $limit2");
			} else
    if (isset($_GET['cid']) && $_GET['cid'] != '') {
				//$cid=str_replace('-',' ',$_GET['cid']);
				$cid = $_GET['cid'];
				$getall_flav = $this->db->query("select * from x_edu_enrollments,x_edu_courses where co_course_id=course_id and course_id='$cid' order by co_id desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select * from x_edu_enrollments,x_edu_courses where co_course_id=course_id order by co_id desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Enrollments</h5>
						<!-- <div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=cou') ?>" download><h5 class="card-title">Download Data</h5></a> </div> -->
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th># Order ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th><a href="<?= base_url('admin/perform/custom/enrollments') ?>">Course Name</a></th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Payment Status</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($theflav_data as $flav_details) {

									?>
										<tr>
											<th scope="row"><?= $flav_details['co_order_id'] ?></th>
											<td><?= $flav_details['co_name'] ?></td>
											<td style="max-width:290px;"><?= $flav_details['co_email'] ?></td>
											<td><?= $flav_details['co_phone'] ?></td>
											<td><a href="<?= base_url('admin/perform/custom/enrollments') ?>?cid=<?= url_smart($flav_details['course_id']) ?>"><?= $flav_details['course_name'] ?></td>
											<td><?= date_format_1(@$flav_details['co_start_date'], '1') ?></td>
											<td><?= date_format_1(@$flav_details['co_end_date'], '1') ?></td>
											<td><?= read_me_user('cpay', @$flav_details['co_payment_status']) ?></td>
											<td><?= read_me_user('test_status', @$flav_details['co_status']) ?></td>

											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['co_id'] ?>&what=approved">
															<button type="button" tabindex="0" class="dropdown-item">Approve </button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['co_id'] ?>&what=rejected">
															<button type="button" tabindex="0" class="dropdown-item">Reject </button></a>
														<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $flav_details['co_id'] ?>&what=enrollment">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'add-question':
			$what = 'add_question';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from x_edu_questions where qid='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_question';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-header">Add / Remove Questions</div>
				<a href="<?= base_url('admin/perform/custom/all-questions') ?>">
					<h5 class="card-title text-right">All Questions</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/question'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/question') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="the_id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-sm-12">
								<br><b> Ask a Question</b><br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="qtitle"><?= @$theimage_details3['qtitle'] ?></textarea>
							</div>

							<div class="col-sm-6 my-1"><b>Option1:</b><input type="text" name="qoption1" placeholder="Option 1" class="form-control col-12" value="<?= @$theimage_details3['qoption1'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Option2:</b><input type="text" name="qoption2" placeholder="Option 2" class="form-control col-12" value="<?= @$theimage_details3['qoption2'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Option3:</b><input type="text" name="qoption3" placeholder="Option 3" class="form-control col-12" value="<?= @$theimage_details3['qoption3'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Option4:</b><input type="text" name="qoption4" placeholder="Option 4" class="form-control col-12" value="<?= @$theimage_details3['qoption4'] ?>"></div>
							<div class="col-sm-6 my-1"><b>Answer:</b><select required class="form-control" name="qanswer">
									<option value="0">-- Choose Answer --</option>
									<?php
									for ($st = 1; $st <= 4; $st++) {
										if (@$theimage_details3['qanswer'] == $st) {
									?>
											<option selected value="<?= $st ?>">Option<?= $st ?></option>
										<?php
										} else {
										?>
											<option value="<?= $st ?>">Option<?= $st ?></option>
									<?php
										}
									}
									?>
								</select></div>
							<div class="col-sm-6 my-1"><b>Marks:</b><input type="number" name="qmarks" placeholder="Marks" class="form-control col-12" value="<?= @$theimage_details3['qmarks'] ?>"></div>

							<div class="col-sm-6 my-1">
								<b>Image to Upload: </b><input type="file" name="file_name">
								<?php if (isset($theimage_details3['qimg_url']) && $theimage_details3['qimg_url'] != '') {
								?>
									<br><img src="<?= $theimage_details3['qimg_url'] ?>" class="img-fluid" align="center">
								<?php } ?>
							</div>
							<div class="col-sm-6"><b>Subjects: </b>
								<?php
								$gethelab = $this->db->query("select * from yn_site_tags where stg_type='subject'");
								$thesmat = $gethelab->result_array();

								$geththelabTests = $this->db->query("select * from x_edu_subject_question where sq_ques_id='$theidval'");
								$theCrsMats = $geththelabTests->result_array();
								?>
								<div class="form-group has-feedback">
									<select name="ques_subj[]" class="form-control" multiple>
										<?php
										foreach ($thesmat as $mat) { ?>
											<option value="<?= $mat['stg_tgid'] ?>" <?php if (array_search($mat['stg_tgid'], array_column($theCrsMats, 'sq_subj_id')) !== false) {
																						echo ' selected';
																					} ?>><?= $mat['stg_name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<!-- <div class="col-sm-6"><b>QBanks: </b>
            <?php
			// $gethelab=$this->db->query("select * from x_edu_qbank where paper_status='1'"); 
			// $thesmat=$gethelab->result_array();

			// $geththelabTests=$this->db->query("select * from x_edu_qbank_question where pq_ques_id='$theidval'");
			// $theCrsMats=$geththelabTests->result_array();
			?>
              <div class="form-group has-feedback">
                <select name="ques_paper[]" class="form-control" multiple>
                  <?php
					foreach ($thesmat as $mat) { ?>
                    <option value="<?= $mat['qb_id'] ?>" <?php if (array_search($mat['qb_id'], array_column($theCrsMats, 'qbq_qb_id')) !== false) {
																echo ' selected';
															} ?>><?= $mat['qbtitle'] ?></option>
                    <?php } ?>
                </select>
              </div></div> -->
							<div class="col-sm-12">
								<br><b> Comments/ Description</b><br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="qdesc"><?= @$theimage_details3['qdesc'] ?></textarea>
							</div>
						</div>
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Question</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>


		<?php
			break;
		case 'all-questions':
			$getall_flav = $this->db->query("select * from x_edu_questions order by qid desc limit $limit1, $limit2");
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Questions</h5>
						<div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=q') ?>" download>
								<h5 class="card-title">Download Data</h5>
							</a> </div>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Question</th>
										<th>Options</th>
										<th>Answer</th>
										<!-- <th>Image</th> -->
										<th>Desc</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {
									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td style="max-width:290px;"><?= strip_tags($flav_details['qtitle']) ?></td>
											<td style="max-width:200px;">
												<b>1: </b><?= trim_text($flav_details['qoption1'], 200, '...') ?><br>
												<b>2: </b><?= trim_text($flav_details['qoption2'], 200, '...') ?><br>
												<b>3: </b><?= trim_text($flav_details['qoption3'], 200, '...') ?><br>
												<b>4: </b><?= trim_text($flav_details['qoption4'], 200, '...') ?><br>
											</td>
											<td><?= $flav_details['qanswer'] ?></td>
											<!-- <td><?php if ($flav_details['qimg'] != '') { ?><img src="<?= base_url('assets/avator/upload/questions/') ?><?= $flav_details['qimg'] ?>" style="width: 40px;"><?php } ?></td> -->
											<td style="max-width:290px;"><?= strip_tags(@$flav_details['qdesc']) ?></td>
											<td><?= read_me_product('product_status', $flav_details['qstatus']) ?></td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['qid'] ?>&what=enable_q"><button type="button" tabindex="0" class="dropdown-item">Enable</button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['qid'] ?>&what=disable_q"><button type="button" tabindex="0" class="dropdown-item">Disable</button></a>
														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/add-question?edit=') ?><?= $flav_details['qid'] ?>"><button type="button" tabindex="0" class="dropdown-item">Edit Question</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'import-questions':
		?>
			<div class="main-card mb-3 card" style="width:800px;">
				<div class="card-header">Import Qquestions from CSV</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<img src="<?= base_url('assets/avator/logo.png') ?>" style='width:150px;' class='mb-3'>
						</div>
					</div>
					<form method="post" action="<?= base_url('admin_action_custom/import_questions'); ?>" enctype="multipart/form-data">
						<div class="row my-2">
							<div class="col-12">
								<span class="bg-info px-3 py-1 text-white">
									<i class="fa fa-angle-down mr-2"> </i><a href="<?= base_url('assets/import_questions.csv') ?>" download class='text-white'> Download the template </a>
								</span>
							</div>
							<div class="col-12">
								<hr />
							</div>

							<div class="col-sm-6">
								<div class="col-sm-6">Upload csv file here: <input type="file" name="file_name"><br /></div>
							</div>
							<div class="col-12">
								<hr />
							</div>
						</div>

						<button class="btn mt-2 btn-warning px-3 pull-right py-2">Import Questions</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
		<?php
			break;
		case 'add-qbank':
			$what = 'add_qbank';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from x_edu_qbank where qb_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_qbank';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-12">
				<div class="card-header">Add / Remove QBanks</div>
				<a href="<?= base_url('admin/perform/custom/all-qbank') ?>">
					<h5 class="card-title text-right">All QBanks</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/qbank'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/qbank') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="the_id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-sm-5">
								<div class="row">
									<div class="col-sm-6 my-1"><b>QBank Name:</b><input type="text" name="qbtitle" placeholder="QBank title" class="form-control col-12" value="<?= @$theimage_details3['qbtitle'] ?>"></div>
									<div class="col-sm-6 my-1"><b>QBank Short Description:</b><textarea name="qbshort_desc" placeholder="QBank Short Description3" class="form-control rich_text"><?= @$theimage_details3['qbshort_desc'] ?></textarea></div>
									<div class="col-sm-6 my-1"><b>Total Marks:</b><input type="number" name="qbtotal" placeholder="Total Marks" class="form-control col-12" value="<?= @$theimage_details3['qbtotal'] ?>"></div>
									<div class="col-sm-6 my-1"><b>Total Questions:</b><input type="number" name="qbquestions" placeholder="Total Questions" class="form-control col-12" value="<?= @$theimage_details3['qbquestions'] ?>"></div>
									<div class="col-sm-6"><b>Category: </b>
										<?php
										$gettheCats = $this->db->query("select * from yn_site_catagory where type='qbank'");
										$theCats = $gettheCats->result_array();
										?>
										<div class="form-group has-feedback">
											<select name="qbcat" id="qbcat" class="form-control" onchange="load_subcat(this);">
												<option value="">-Select Category-</option>
												<?php
												foreach ($theCats as $cat) { ?>
													<option value="<?= $cat['ctid'] ?>" <?php if ($cat['ctid'] == @$theimage_details3['qbcat']) {
																							echo ' selected';
																						} ?>><?= $cat['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group col-sm-6"><b>Sub-Category: </b>
										<div class="form-group has-feedback">
											<select name="qbscat" class="form-control" id="get_subcat_data">
												<option value="">-Select SubCategory-</option>
												<option value="<?= @$theimage_details3['qbscat'] ?>" selected><?= @$theimage_details3['qbscategory'] ?></option>
											</select>
										</div>
									</div>

									<div class="col-sm-6 my-1"><b>Correct Marks:</b>
										<select name="qbmarks" class="form-control" required="">
											<option value="">-- Correct Marks--</option>
											<?php for ($nm = 1; $nm < 11; $nm++) { ?>
												<option value="<?= $nm ?>" <?php if (@$theimage_details3['qbmarks'] == $nm) {
																				echo 'selected';
																			} ?>><?= $nm ?> Marks</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-6 my-1"><b>Negative Marks</b>
										<select name="qbnmarks" class="form-control" required="">
											<option value="">-- Negative Marks--</option>
											<option value="0.33" <?php if (@$theimage_details3['qbnmarks'] == '0.33') {
																		echo 'selected';
																	} ?>>0.33 Marks</option>
											<?php for ($nm = 0.25; $nm < 3; $nm = ($nm + 0.25)) { ?>
												<option value="<?= $nm ?>" <?php if (@$theimage_details3['qbnmarks'] == $nm) {
																				echo 'selected';
																			} ?>><?= $nm ?> Marks</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-6 my-1"><b>Show in APP / Web:</b><select required class="form-control" name="qbapp_web">
											<option <?php if (@$theimage_details3['qbapp_web'] == "both") { ?>selected <?php } ?> value="both">Both</option>
											<option <?php if (@$theimage_details3['qbapp_web'] == "web") { ?>selected <?php } ?> value="web">Web</option>
											<option <?php if (@$theimage_details3['qbapp_web'] == "app") { ?>selected <?php } ?> value="app">App</option>
											<option <?php if (@$theimage_details3['qbapp_web'] == "sm") { ?>selected <?php } ?> value="sm">Study Material</option>
										</select></div>
									<div class="col-sm-6 my-1"><b>Status</b>
										<select name="qbstatus" class="form-control" required="">
											<option value="">--Select Status--</option>
											<option value="1" <?php if (@$theimage_details3['qbstatus'] == '1') {
																	echo 'selected';
																} ?>>Active</option>
											<option value="0" <?php if (@$theimage_details3['qbstatus'] == '0') {
																	echo 'selected';
																} ?>>In-Active</option>
										</select>
									</div>

									<div class="col-sm-6 my-1"><b>Mode</b>
										<select name="qbmode" class="form-control" required="">
											<option value="3">Both</option>
											<option value="1" <?php if (@$theimage_details3['qbmode'] == '1') {
																	echo 'selected';
																} ?>>AIJPETCT Mode</option>
											<option value="2" <?php if (@$theimage_details3['qbmode'] == '2') {
																	echo 'selected';
																} ?>>AIAPEGT and Assessment Mode</option>
										</select>
									</div>

									<div class="col-sm-6 my-1"><b>Total Time</b>
										<select name="qbtime" class="form-control" required="">
											<option value="">--Total Time--</option>
											<?php for ($nm = 15; $nm < 315; $nm = ($nm + 15)) { ?>
												<option value="<?= $nm ?>" <?php if (@$theimage_details3['qbtime'] == $nm) {
																				echo 'selected';
																			} ?>><?= $nm ?> Mins</option>
											<?php } ?>
										</select>
									</div>
									<?php if (!isset($theimage_details3['qbseries'])) { ?>
										<div class="col-sm-6"><b>Series: </b>
											<?php
											$gettheSeries = $this->db->query("select * from x_edu_qbseries");
											$theqbseries = $gettheSeries->result_array();
											?>
											<div class="form-group has-feedback">
												<select name="qbseries" id="qbseries" class="form-control">
													<option value="">-Select Series-</option>
													<?php
													foreach ($theqbseries as $cat) { ?>
														<option value="<?= $cat['series_id'] ?>" <?php if ($cat['series_id'] == @$theimage_details3['qbseries']) {
																										echo ' selected';
																									} ?>><?= $cat['series_title'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									<?php } ?>
									<div class="col-sm-12">
										<br><b> Instructions/ Description</b><br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="qbdesc"><?= @$theimage_details3['qbdesc'] ?></textarea>
									</div>

								</div>
							</div>
							<div class="col-sm-7">
								<div class="col-sm-12"><b>Questions: </b>
									<?php
									$gethelab = $this->db->query("select * from x_edu_questions where qstatus='1' order by qid DESC");
									$thesmat = $gethelab->result_array();

									$geththelabTests = $this->db->query("select * from x_edu_qbank_question where qbq_qbank_id='$theidval'");
									$theCrsMats = $geththelabTests->result_array();
									?>
									<div class="form-group has-feedback">
										<select name="qb_ques[]" class="form-control" multiple required="">
											<?php
											foreach ($thesmat as $mat) { ?>
												<option value="<?= $mat['qid'] ?>" <?php if (array_search($mat['qid'], array_column($theCrsMats, 'qbq_ques_id')) !== false) {
																						echo ' selected';
																					} ?>><?= $mat['qid'] ?>: <?= $mat['qtitle'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit QBank</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>


		<?php
			break;
		case 'all-qbank':
			if (isset($_GET['cat']) && $_GET['cat'] > '0') {
				$cat = $_GET['cat'];
				$getall_flav = $this->db->query("select * from x_edu_qbank LEFT JOIN x_edu_qbseries ON qbseries=series_id WHERE qbcat='$cat' order by qb_id desc limit $limit1, $limit2");
			} elseif (isset($_GET['sid']) && $_GET['sid'] > '0') {
				$sid = $_GET['sid'];
				$getall_flav = $this->db->query("select * from x_edu_qbank LEFT JOIN x_edu_qbseries ON qbseries=series_id WHERE qbseries='$sid' order by qb_id desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select * from x_edu_qbank LEFT JOIN x_edu_qbseries ON qbseries=series_id order by qb_id desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All QBanks</h5>
						<div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=qbank') ?>" download>
								<h5 class="card-title">Download Data</h5>
							</a> </div>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>QB Title</th>
										<th>Correct Marks</th>
										<th>Negative <br> Marks</th>
										<th>Total <br> Questions</th>
										<th>Total <br> Marks</th>
										<th><a href="<?= base_url('admin/perform/custom/all-qbank') ?>">Category</a></th>
										<th><a href="<?= base_url('admin/perform/custom/all-qbank') ?>">Series</a></th>
										<th>Desc</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {
									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td style="max-width:290px;"><?= strip_tags($flav_details['qbtitle']) ?></td>
											<td style="max-width:200px;"><?= @$flav_details['qbmarks'] ?></td>
											<td><?= @$flav_details['qbnmarks'] ?></td>
											<td><?= @$flav_details['qbquestions'] ?></td>
											<td><?= @$flav_details['qbtotal'] ?></td>
											<td><a href="<?= base_url('admin/perform/custom/all-qbank?cat=') ?><?= @$flav_details['qbcat'] ?>"><?= @$flav_details['qbcategory'] ?></a></td>
											<td><a href="<?= base_url('admin/perform/custom/all-qbank?sid=') ?><?= @$flav_details['qbseries'] ?>"><?= @$flav_details['series_title'] ?></a></td>
											<td style="max-width:290px;"><?= trim_text(strip_tags(@$flav_details['qbdesc']), '100', '...') ?></td>
											<td><?= read_me_product('product_status', @$flav_details['qbstatus']) ?><br><?= @$flav_details['qbapp_web'] ?></td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['qb_id'] ?>&what=enable_qb"><button type="button" tabindex="0" class="dropdown-item">Enable</button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['qb_id'] ?>&what=disable_qb"><button type="button" tabindex="0" class="dropdown-item">Disable</button></a>
														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/add-qbank?edit=') ?><?= $flav_details['qb_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Edit QBank</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'doubts':
			$getall_flav = $this->db->query("select * from x_edu_material_review,x_edu_study_material where sm_id=mr_smid order by mrid desc limit $limit1, $limit2");
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Doubts</h5>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Material Name</th>
										<th>Name</th>
										<th>Message</th>
										<th>Reply</th>
										<th>Status</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {
									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td style="max-width:290px;"><?= $flav_details['sm_name'] ?></td>
											<td><?= $flav_details['mr_name'] ?></td>
											<td><?= trim_text(strip_tags(@$flav_details['mr_message']), 300, '...') ?></td>
											<td><?= trim_text(strip_tags(@$flav_details['mr_reply']), 300, '...') ?></td>
											<td><?= read_me_user('yes_no', $flav_details['mr_status']) ?></td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['mrid'] ?>&what=accept_doubt"><button type="button" tabindex="0" class="dropdown-item">Accept</button></a>
														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $flav_details['mrid'] ?>&what=reject_doubt"><button type="button" tabindex="0" class="dropdown-item">Reject</button></a>
														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/reply?mrid=') ?><?= $flav_details['mrid'] ?>"><button type="button" tabindex="0" class="dropdown-item">Reply</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'reply':
			$mrid = @$_GET['mrid'];
			$getslider_details = $this->db->query("select * from x_edu_material_review,x_edu_study_material where mrid='$mrid' and sm_id=mr_smid");
			$theimage_details3 = $getslider_details->row_array();

		?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-header">Reply - Doubt</div>
				<a href="<?= base_url('admin/perform/custom/doubts') ?>">
					<h5 class="card-title text-right">All Doubts</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/reply_doubt'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/reply_doubt') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="the_id" value="<?= @$mrid ?>">
						<div class="row my-2">
							<div class="col-sm-12 my-1"><b>Material Name: </b><?= @$theimage_details3['sm_name'] ?></div>

							<div class="col-sm-12 my-1"><b>Doubt: </b><?= @$theimage_details3['mr_message'] ?></div>


							<div class="col-sm-12">Reply
								<br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="reply"><?= @$theimage_details3['mr_reply'] ?></textarea>
							</div>
						</div>
						<button class="btn mt-2 btn-warning btn-block py-2">Reply</button>
					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
		<?php
			break;
		case 'user_tests':
			if (isset($_GET['id']) && $_GET['id'] > '0') {
				$mid = $_GET['id'];
				$getall_flav = $this->db->query("select * from x_edu_qbank,x_edu_qbank_user,site_mem where mid=qbu_mid and qb_id=qbu_qbid and qbu_mid='$mid' order by qbu_id DESC");
			} else {
				$mid = 0;
				$getall_flav = $this->db->query("select * from x_edu_qbank,x_edu_qbank_user,site_mem where mid=qbu_mid and qb_id=qbu_qbid order by qbu_id DESC");
			}
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Tests</h5>
						<?php if ($mid > '0' && count($theflav_data) > '0') { ?><h1>Student Name: <?= strtoupper(@$theflav_data['0']['name']) ?> </h1><?php } ?>
						<div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin/perform/web/users') ?>">
								<h5 class="card-title">Back to Users</h5>
							</a> </div>
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Exam ID</th>
										<?php if ($mid == '0') { ?><th>User Name</th><?php } ?>
										<th>QBank Name</th>
										<th>Date & Time</th>
										<th>Score</th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $enrollment) {
									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td><?= $enrollment['qbu_exam_id'] ?></td>
											<?php if ($mid == '0') { ?><td><?= $enrollment['name'] ?></td><?php } ?>
											<td><?= $enrollment['qbtitle'] ?></td>
											<td><small><?= date_format_1($enrollment['qbu_start_time'], 't') ?></small></td>
											<td><?= $enrollment['qbu_score'] ?></td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'rankers': ?>
			<?php
			$todoedit = '-1';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$aid = $_GET['edit'];
				$gettex = $this->db->query("select * from x_edu_rankers where tid='$aid' ");
				$atheadmins = $gettex->row_array();
				$todoedit = $aid;
			}
			?>
			<div class="main-card mb-3 card col-sm-6">
				<div class="card-body">
					<h5 class="card-title">Rankers</h5>
					<div>
						<!-- <img src="https://cdn.pixabay.com/photo/2019/03/18/09/38/feedback-4062738_960_720.jpg" class="img-fluid"> -->
						<form class="form-horizontal form-label-left" action="<?= base_url('admin_action_custom/add_rankers') ?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?= base_url('admin_action_custom/add_rankers') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile22w'>

							<input type="hidden" name="todo" value="<?= $todoedit ?>">
							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"><span class="fa fa-user mr-2"></span> Name</span> </div>
								<input type="text" class="form-control" name="name" placeholder="Name" value="<?= @$atheadmins['name'] ?>">
							</div>

							<div class="input-group mt-3 col-12 p-0">
								<div class="input-group-prepend"><span class="input-group-text"> Rank*</span> </div>
								<input type="number" class="form-control" name="desi" placeholder="Rank" value="<?= @$atheadmins['role'] ?>">
							</div>

							<!-- <div class="input-group mt-3 col-12 p-0">
                                  <div class="input-group-prepend"><span class="input-group-text"> Order to show</span> </div>
                                  <input type="text" class="form-control" name="order" placeholder="order" value="<?= @$atheadmins['li'] ?>">
                                </div> -->

							<div class="input-group mt-3 p-0">
								<span class="form-control">
									<input type="file" name="image_name" id="image_name">
							</div>
							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold btn-block" value="SAVE DATA">
						</form>

					</div>
				</div>
			</div>
			<?php
			$gettex = $this->db->query("select * from x_edu_rankers order by role asc");
			$thedatss = $gettex->result_array();
			?>
			<div class="col-sm-12 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Rankers</h5>
						<table class="mb-0 table table-responsive-sm">
							<thead>
								<tr>
									<th>#</th>
									<th>Photo</th>
									<th>Name</th>
									<th>Rank</th>
									<!-- <th>Status</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($thedatss as $testimonials) { ?>
									<tr>
										<th scope="row"><?= $testimonials['li'] ?></th>
										<td><img width="40" class="rounded-circle" src="<?= base_url('assets/avator/webimg/t/') ?><?= $testimonials['image'] ?>" alt=""></td>

										<td style="min-width: 130px;"><?= $testimonials['name'] ?></td>
										<td><?= $testimonials['role'] ?></td>
										<!-- <td><?= $testimonials['text'] ?></td>
                                      <td><?= read_me_user('test_status', $testimonials['status']) ?></td> -->
										<td>
											<a onclick="return confirm('Are you sure you want to delete this?');" href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $testimonials['tid'] ?>&what=tst">
												<button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button></a>

											<a href="<?= base_url('admin/perform/custom/rankers?edit=') ?><?= $testimonials['tid'] ?>">
												<button class="mr-2 mt-1 btn-icon btn-icon-only btn btn-outline-warning"><i class="pe-7s-pen btn-icon-wrapper"> </i></button></a>

										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>

						<div class="col-12">
							<nav class="mt-4" aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
									<?php
									$pagesare = $pageNum;
									for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
										$addclass = '';
										if ($pageNum == $x) {
											$addclass = 'bold';
										}
										if ($x > 0) {
									?>
											<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
									<?php }
									} ?>
									<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>
		<?php break;
		case 'add-qbank-series':
			$what = 'add_qbank_series';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$getslider_details = $this->db->query("select * from x_edu_qbseries where series_id='$id' ");
				$theimage_details3 = $getslider_details->row_array();
				$what = 'edit_qbank_series';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-12">
				<div class="card-header">Add / Remove QBank Series</div>
				<a href="<?= base_url('admin/perform/custom/all-series') ?>">
					<h5 class="card-title text-right">All QBank Series</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/qbank_series'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/qbank_series') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="the_id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-6 my-1"><b>Series Name:</b><input type="text" name="series_title" placeholder="Series title" class="form-control col-12" value="<?= @$theimage_details3['series_title'] ?>"></div>
									<div class="col-sm-6 my-1"><b>Attempted By:</b><input type="number" name="series_attempted" placeholder="Attempted By" class="form-control col-12" value="<?= @$theimage_details3['series_attempted'] ?>"></div>
									<div class="col-sm-6 my-1"><b>Start Date:</b><input type="date" name="series_start_date" placeholder="Series Start Date" class="form-control col-12" value="<?= @$theimage_details3['series_start_date'] ?>"></div>
									<div class="col-sm-6 my-1"><b>End Date:</b><input type="date" name="series_end_date" placeholder="Series End Date" class="form-control col-12" value="<?= @$theimage_details3['series_end_date'] ?>"></div>

									<div class="col-sm-6 my-1"><b>Total Question Banks:</b><input type="number" name="series_qbanks_num" placeholder="Total Question Banks" class="form-control col-12" value="<?= @$theimage_details3['series_qbanks_num'] ?>"></div>
									<div class="col-sm-6 my-1"><b>Schedule:</b><input type="file" name="series_schedule" class="form-control col-12"></div>
									<div class="col-sm-6 my-1"><b>Discussion link with Telegram:</b><input type="text" name="series_discussion" placeholder="Discussion link with Telegram" class="form-control col-12" value="<?php if (!isset($theimage_details3['series_discussion'])) {
																																																									echo 'https://www.telegram.app/';
																																																								} else {
																																																									echo $theimage_details3['series_discussion'];
																																																								} ?>"></div>
									<div class="col-sm-6 my-1"><b>Amount to Enroll:</b><input type="text" name="series_amount" placeholder="Amount to Enroll" class="form-control col-12" value="<?= @$theimage_details3['series_amount'] ?>"></div>
									<div class="col-sm-6"><b>Category: </b>
										<?php
										$gettheCats = $this->db->query("select * from yn_site_catagory where type='qbank'");
										$theCats = $gettheCats->result_array();
										?>
										<div class="form-group has-feedback">
											<select name="series_cat" id="series_cat" class="form-control" onchange="load_subcat(this);">
												<option value="">-Select Category-</option>
												<?php
												foreach ($theCats as $cat) { ?>
													<option value="<?= $cat['ctid'] ?>" <?php if ($cat['ctid'] == @$theimage_details3['series_cat']) {
																							echo ' selected';
																						} ?>><?= $cat['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6 my-1"><b>Rating:</b><select required class="form-control" name="series_rating">
											<option value="0">-- Rating | Star --</option>
											<?php
											for ($st = 1; $st <= 5; $st++) {
												if ($theimage_details3['series_rating'] == $st) {
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
										</select></div>
									<div class="col-sm-12">
										<br><b> Instructions/ Description</b><br><textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="text" name="series_desc"><?= @$theimage_details3['series_desc'] ?></textarea>
									</div>
								</div>
								<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit QBank Series</button>
							</div>

					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>


		<?php
			break;
		case 'all-series':
			if (isset($_GET['cat']) && $_GET['cat'] > '0') {
				$cat = $_GET['cat'];
				$getall_flav = $this->db->query("select * from x_edu_qbseries where series_cat='$cat' order by series_id desc limit $limit1, $limit2");
			} else {
				$getall_flav = $this->db->query("select * from x_edu_qbseries order by series_id desc limit $limit1, $limit2");
			}
			$theflav_data = $getall_flav->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All QBank Series</h5>
						<!-- <div class="pull-right" style="width: 130px;"><a href="<?= base_url('admin_action_custom/download_data?what=qbank') ?>" download><h5 class="card-title">Download Data</h5></a> </div>   -->
						<div class="table-responsive">
							<table class="mb-0 table">
								<thead>
									<tr>
										<th>#</th>
										<th>Series Title</th>
										<th>Description</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Total QBanks</th>
										<th><a href="<?= base_url('admin/perform/custom/all-series') ?>">Category</a></th>
										<th>Students <br> Attempted</th>
										<th>Series Schedule</th>
										<th>Rating</th>
										<th style="width: 30px;">Action </th>
									</tr>
								</thead>
								<tbody>
									<?php $z = 1;
									foreach ($theflav_data as $flav_details) {
									?>
										<tr>
											<th scope="row"><?= $z++; //$flav_details['sm_id']
															?></th>
											<td style="max-width:290px;"><?= $flav_details['series_title'] ?></td>
											<td style="max-width:290px;"><?= trim_text(strip_tags($flav_details['series_title']), '200', '...') ?></td>
											<td><?= date_format_1(@$flav_details['series_start_date'], '1') ?></td>
											<td><?= date_format_1(@$flav_details['series_end_date'], '1') ?></td>
											<td><?= @$flav_details['series_qbanks_num'] ?></td>
											<td><a href="<?= base_url('admin/perform/custom/all-series?cat=') ?><?= @$flav_details['series_cat'] ?>"><?= @$flav_details['series_category'] ?></a></td>
											<td><?= @$flav_details['series_attempted'] ?></td>
											<td><?php if ($flav_details['series_schedule'] != '') { ?><a href="<?= base_url('assets/avator/upload/series_schedule/') ?><?= $flav_details['series_schedule'] ?>" download>Schedule</a><?php } ?></td>
											<td><?= @$flav_details['series_rating'] ?></td>
											<td>
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">View</button>
													<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<div tabindex="-1" class="dropdown-divider"></div>
														<a href="<?= base_url('admin/perform/custom/add-qbank-series?edit=') ?><?= $flav_details['series_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Edit QBank Series</button></a>
														<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $flav_details['series_id'] ?>&what=series">
															<button type="button" tabindex="0" class="dropdown-item">Delete</button></a>
													</div>
												</div>
											</td>
										</tr>
									<?php } //foreach 
									?>
								</tbody>
							</table>
						</div>
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'all-posts':
			$getPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid order by p_id desc limit $limit1, $limit2");
			$posts = $getPosts->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">All Posts</h5>
						<div class="table-responsive">
							<table class="mb-0 table table table-striped table-responsive-sm">
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
						<nav class="mt-4" aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'kyc-requests':
			$id = $_GET['id'];
			$getPosts = $this->db->query("SELECT * FROM x_kyc LEFT JOIN yn_site_mem ON kyc_user_id = mid WHERE kyc_user_id = '$id' order by kyc_id desc limit $limit1, $limit2");
			$posts = $getPosts->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">KYC Requests</h5>
						<div class="table-responsive">
							<table class="mb-0 table table table-striped table-responsive-sm">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Aadhaar card front</th>
										<th>Aadhaar card back</th>
										<th>Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $count = 1;
									foreach ($posts as $post) { ?>
										<tr>
											<th scope="row"><?= $count++ ?></th>
											<td><?= $post['name'] ?><br /><small><a href="<?= base_url('userprofile/' . $post['username']) ?>">@<?= $post['username'] ?></a></small></td>
											<td><a href="<?= base_url('assets/avator/upload/' . $post['kyc_img_front']) ?>" target="_blank">Aadhar Card Front</a></td>
											<td><a href="<?= base_url('assets/avator/upload/' . $post['kyc_img_back']) ?>" target="_blkank">Aadhar Card Back</a></td>
											<td><?= date_format_1($post['kyc_created_at'], 1) ?></td>
											<td><?= read_me_user('kyc_status', $post['kyc_status']) ?></td>
											<td class="text-left">
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">Options</button>
													<button type="button" aria-haspopup="true" aria-expanded="false"
														data-toggle="dropdown"
														class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
															class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $post['kyc_id'] ?>&mid=<?= $post['kyc_user_id'] ?>&what=kyc_apr">
															<button type="button" tabindex="0" class="dropdown-item">Approve Request</button></a>

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $post['id'] ?>&mid=<?= $post['kyc_user_id'] ?>&what=kyc_rej">
															<button type="button" tabindex="0" class="dropdown-item">Reject Request</button></a>

														<div tabindex="-1" class="dropdown-divider"></div>
														<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
															href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $post['kyc_id'] ?>&what=kyc">
															<button type="button" tabindex="0"
																class="dropdown-item">Delete</button></a>
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
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'user-shop':
			$id = $_GET['id'];
			$getPosts = $this->db->query("SELECT * FROM x_vendor_shop LEFT JOIN yn_site_mem ON shop_user_id = mid WHERE shop_user_id = '$id' order by shop_id desc limit $limit1, $limit2");
			$posts = $getPosts->result_array();
		?>
			<div class="col-sm-12">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">User Shop</h5>
						<div class="table-responsive">
							<table class="mb-0 table table table-striped table-responsive-sm">
								<thead>
									<tr>
										<th>#</th>
										<th>User Name</th>
										<th>Shop Name</th>
										<th>Shop Address</th>
										<th>Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $count = 1;
									foreach ($posts as $post) { ?>
										<tr>
											<th scope="row"><?= $count++ ?></th>
											<td><?= $post['name'] ?><br /><small><a href="<?= base_url('userprofile/' . $post['username']) ?>">@<?= $post['username'] ?></a></small></td>
											<td><a href="<?= base_url('user-shop/' . $post['shop_uniq_id']) ?>" target="_blank"><?= $post['shop_name'] ?></a></td>
											<td><?= $post['shop_address'] ?>, <?= getState($post['shop_state'], 'st_name') ?>, <?= getCity($post['shop_city'], 'ct_name') ?></td>
											<td><?= date_format_1($post['shop_created_at'], 1) ?></td>
											<td><?= read_me_user('shop_status', $post['shop_status']) ?></td>
											<td class="text-left">
												<div class="mr-2 btn-group">
													<button class="btn btn-outline-secondary">Options</button>
													<button type="button" aria-haspopup="true" aria-expanded="false"
														data-toggle="dropdown"
														class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span
															class="sr-only">Toggle Dropdown</span>
													</button>
													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $post['shop_id'] ?>&shop_id=<?= $post['shop_uniq_id'] ?>&mid=<?= $post['shop_user_id'] ?>&what=shop_apr">
															<button type="button" tabindex="0" class="dropdown-item">Approve</button></a>

														<a href="<?= base_url('admin_action_custom/modify') ?>?id=<?= $post['shop_id'] ?>&shop_id=<?= $post['shop_uniq_id'] ?>&mid=<?= $post['shop_user_id'] ?>&what=shop_rej">
															<button type="button" tabindex="0" class="dropdown-item">Reject</button></a>

														<div tabindex="-1" class="dropdown-divider"></div>
														<a onclick="return confirm('Do you really want to delete this user, you can ban the user as well.');"
															href="<?= base_url('admin_action_custom/delete') ?>?id=<?= $post['shop_id'] ?>&what=shop">
															<button type="button" tabindex="0"
																class="dropdown-item">Delete</button></a>
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
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
								<?php
								$pagesare = $pageNum;
								for ($x = $pageNum - 10; $x <= $pageNum + 10; $x++) {
									$addclass = '';
									if ($pageNum == $x) {
										$addclass = 'bold';
									}
									if ($x > 0) {
								?>
										<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
								<?php }
								} ?>
								<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'content':
			$type = $this->uri->segment(5);
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
					<h5 class="card-title"><?= $type ?> </h5>
					<div>
						<form method="post" action="<?= base_url('admin_action/'); ?><?= $send_meher ?>" onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $send_meher ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
							<label>Unique Name / Title of the <?= $type ?></label>
							<input type="text" name="page" value="<?= @$page_data['name'] ?>" class="form-control" placeholder="<?= $type ?> Name / Title" required>
							<input type="hidden" name="page_id" value="<?= @$page_data['pid'] ?>">
							<input type="hidden" name="type2" value="<?= $type ?>">

							<label>Upload PPT</label>
							<input type="file" name="file_name" class="form-control">

							<!-- <div class="form-group mt-3">
                  <hr/>
                  <label>Content.<br/>
                  </label>
                  <textarea name="text" placeholder="About your business." class="form-control rich_text" id='rich_text12_90'><?= @$page_data['content'] ?></textarea>
                </div> -->
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

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold px-5" value="SAVE DATA">
						</form>
					</div>
					<div class="mt-3 pull-right">
						<?php if ($the_block > '0') { ?>
							<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action/delete') ?>?id=<?= $the_block ?>&what=block_co">
								<i class="fa fa-trash mr-1"></i> Delete
							</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<?php
			$get_all_blocks = $this->db->query("select * from yn_admin_pages where type='" . $type . "' and name !='' ");
			$the_pages_data = $get_all_blocks->result_array();
			?>
			<div class="col-sm-4 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title"><?= $type ?></h5>
						<div class="row">
							<?php
							//print_r($the_pages_data);
							foreach ($the_pages_data as $bloks_data) { ?>
								<div class="col-sm-6 text-uppercase py-1" style="border-bottom: 1px solid #eee;">
									<a href="<?= base_url('admin/perform/custom/content/') . $type . '?type=' . $type . '&block=' ?><?= $bloks_data['pid'] ?>"><i class="fa fa-file mr-2"> </i><?= $bloks_data['name'] ?> <?= $bloks_data['type'] ?></a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'achieve':
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
					<h5 class="card-title">Home Page - Achieve Success Content</h5>
					<div>
						<form method="post" action="<?= base_url('admin_action/'); ?><?= $send_meher ?>" onsubmit="return uploadandform('<?= base_url('admin_action/') ?><?= $send_meher ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
							<label>Unique Name / Title of the Content</label>
							<input type="text" name="page" value="<?= @$page_data['name'] ?>" class="form-control" placeholder="Content Name / Title">
							<input type="hidden" name="page_id" value="<?= @$page_data['pid'] ?>">
							<input type="hidden" name="type2" value="achieve">

							<!-- <label>Color Code</label>
                  <input type="text" name="link" value="<?= @$page_data['content_link'] ?>" class="form-control" placeholder="BG Color"> -->

							<div class="form-group mt-3">
								<hr />
								<label>Content.<br />
								</label>
								<textarea name="text" placeholder="About your business." class="form-control rich_text" id='rich_text12_90'><?= @$page_data['content'] ?></textarea>
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

							<input type="submit" name="" class="mt-2 btn-warning active btn py-2 text-white text-bold px-5" value="SAVE DATA">
						</form>
					</div>
					<div class="mt-3 pull-right">
						<a onclick="return confirm('are you sure you want to delete this?');" href="<?= base_url('admin_action/delete') ?>?id=<?= $the_block ?>&what=block_co">
							<i class="fa fa-trash mr-1"></i> Delete
						</a>
					</div>
				</div>
			</div>

			<?php
			$get_all_blocks = $this->db->query("select * from yn_admin_pages where type='achieve' and name !='' ");
			$the_pages_data = $get_all_blocks->result_array();
			?>
			<div class="col-sm-4 pl-2">
				<div class="main-card mb-3 card">
					<div class="card-body">
						<h5 class="card-title">Content</h5>
						<div class="row">
							<?php
							foreach ($the_pages_data as $bloks_data) { ?>
								<div class="col-sm-6 text-uppercase py-1" style="border-bottom: 1px solid #eee;">
									<a href="<?= base_url('admin/perform/custom/achieve?type=achieve&block=') ?><?= $bloks_data['pid'] ?>"><i class="fa fa-file mr-2"> </i><?= $bloks_data['name'] ?> <?= $bloks_data['type'] ?></a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			break;
		case 'add-property':
			$what = 'add_property';
			$theidval = '';
			if (isset($_GET['edit']) && $_GET['edit'] != '') {
				$id = $_GET['edit'];
				$property_row = $this->db->query("select * from x_home_property where prop_id='$id' ");
				$prop = $property_row->row_array();
				$what = 'edit_property';
				$theidval = $_GET['edit'];
			}
		?>
			<div class="main-card mb-3 card col-sm-10">
				<div class="card-header">Add / Edit Property</div>
				<a href="<?= base_url('admin/perform/custom/all-series') ?>">
					<h5 class="card-title text-right">All Properties</h5>
				</a>
				<div class="card-body">
					<form method="post" action="<?= base_url('admin_action_custom/add_property'); ?>" onsubmit="return uploadandform('<?= base_url('admin_action_custom/add_property') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
						<input type="hidden" name="what" value="<?= $what ?>">
						<input type="hidden" name="prop_id" value="<?= $theidval ?>">
						<div class="row my-2">
							<div class="col-12">
								<div class="form-group">
									<label for="prop_name">Property Name</label>
									<input type="text" name="prop_name" class="form-control" id="prop_name" value="<?= @$prop['prop_name'] ?>" placeholder="Property Name">
								</div>
							</div>

							<div class="col-md-6 col-12">
								<!-- Category select-->
								<div class="form-group mb-3">
									<label for="category">Category</label>
									<select class="form-control rounded-5" id="category" name="prop_category" onchange="load_subcat(this);">
										<option value="" disabled selected>Select Category</option>
										<?php $getCategories = $this->db->query("SELECT * FROM yn_site_catagory ORDER BY ctid");
										$categories = $getCategories->result_array();
										foreach ($categories as $category) : ?>
											<option value="<?= $category['ctid'] ?>" <?=
																						@$prop['prop_cat'] == $category['ctid'] ? 'selected' : ''
																						?>><?= $category['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<!-- Sub Category select-->
								<div class="form-group mb-3">
									<label for="get_subcat_data">Sub Category</label>
									<select class="form-control rounded-5" id="get_subcat_data" name="prop_sub_category">
										<option value="" disabled selected>Select Sub Category</option>
										<?php
										if (isset($prop['prop_scat']) && $prop['prop_scat'] != '') {
											$getSubCategories = $this->db->query("SELECT * FROM yn_site_sub_cat WHERE sc_ctid = " . $prop['prop_cat'] . " ORDER BY sc_id");
											$sub_categories = $getSubCategories->result_array();

											foreach ($sub_categories as $sub_category) { ?>
												<option value="<?= $sub_category['sc_id'] ?>" <?= @$prop['prop_scat'] == $sub_category['sc_id'] ? 'selected' : '' ?>><?= $sub_category['sc_name'] ?></option>
										<?php }
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group mb-3">
									<label for="prop_rent_sale">Property For</label>
									<select class="form-control rounded-5" id="prop_rent_sale" name="prop_rent_sale" data-sb-validations="required">
										<option value="" disabled selected>Property For</option>
										<option value="Rent" <?= @$prop['prop_rent_sale'] == 'Rent' ? 'selected' : '' ?>>Rent</option>
										<option value="Sale" <?= @$prop['prop_rent_sale'] == 'Sale' ? 'selected' : '' ?>>Sale</option>
									</select>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group mb-3">
									<label for="prop_area">Area</label>
									<input type="text" name="prop_area" id="prop_area" class="form-control rounded-5" placeholder="eg 240 sqft" value="<?= @$prop['prop_area'] ?>">
								</div>
							</div>

							<div class="col-md-3 col-12">
								<!-- Bedroom select -->
								<div class="form-group mb-3">
									<label for="bedroom">Number of Bedrooms</label>
									<select name="prop_bedroom" id="bedroom" class="form-control">
										<option value="" disabled selected>Select Bedrooms</option>
										<option value="1" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>1</option>
										<option value="2" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>2</option>
										<option value="3" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>3</option>
										<option value="4" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>4</option>
										<option value="5" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>5</option>
										<option value="5+" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>5+</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 col-12">
								<!-- Bathroom select -->
								<div class="form-group mb-3">
									<label for="bathroom">Number of Bathrooms</label>
									<select name="prop_bathroom" id="bathroom" class="form-control">
										<option value="" disabled selected>Select Bathrooms</option>
										<option value="1" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>1</option>
										<option value="2" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>2</option>
										<option value="3" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>3</option>
										<option value="4" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>4</option>
										<option value="5" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>5</option>
										<option value="5+" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>5+</option>
									</select>
								</div>
							</div>

							<div class="col-md-3 col-12">
								<!-- Facing select -->
								<div class="form-group mb-3">
									<label for="facing">Facings</label>
									<select name="prop_facing" id="facing" class="form-control">
										<option value="" disabled selected>Select Facing</option>
										<option value="North" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North</option>
										<option value="East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>East</option>
										<option value="South" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South</option>
										<option value="West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>West</option>
										<option value="North-East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North-East</option>
										<option value="North-West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North-West</option>
										<option value="South-East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South-East</option>
										<option value="South-West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South-West</option>
									</select>
								</div>
							</div>

							<div class="col-md-3 col-12">
								<!-- Is Furbished select -->
								<div class="form-group mb-3">
									<label for="is_furbished">Is Furnished</label>
									<select name="prop_furnished" id="is_furbished" class="form-control">
										<option value="" disabled selected>Select option</option>
										<option value="Yes" <?= (@$prop['prop_furnished'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
										<option value="No" <?= (@$prop['prop_furnished'] == 'No') ? 'selected' : '' ?>>No</option>
									</select>
								</div>
							</div>

							<div class="col-md-4 col-12">
								<div class="form-group mb-3">
									<label for="floor">Floor Number</label>
									<input type="number" name="prop_floor" id="floor" min="0" class="form-control" placeholder="Enter floor number" value="<?= @$prop['prop_floor'] ?>">
								</div>
							</div>

							<div class="col-md-4 col-12">
								<div class="form-group mb-3">
									<label for="total_floors">Total Floors in Building</label>
									<input type="number" name="prop_total_floors" min="0" id="total_floors" class="form-control" placeholder="Enter total floors" value="<?= @$prop['prop_total_floors'] ?>">
								</div>
							</div>

							<div class="col-md-4 col-12">
								<div class="form-group mb-3">
									<label for="balcony">Number of Balconies</label>
									<input type="number" name="prop_balcony" min="0" id="balcony" class="form-control" placeholder="Enter number of balconies" value="<?= @$prop['prop_balcony'] ?>">
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="state">State</label>
									<select name="prop_state" id="state" class="form-control" onchange="load_new_city(this);">
										<option value="">Select State</option>
										<?= getState('101', '1', @$prop['prop_state']) ?>
									</select>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="get_cities_data">City</label>
									<select name="prop_city" id="get_cities_data" class="form-control">
										<?php if (isset($prop['prop_city']) && $prop['prop_city']) {
											$seletedCity = $prop['prop_city'];
											getCity($prop['prop_state'], '1', $prop['prop_city']);
										} else {
											getState('101', '1', @$prop['prop_state']);
										} ?>
									</select>
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<label for="address">Address</label>
									<input type="text" name="prop_address" class="form-control" id="address" value="<?= @$prop['prop_address'] ?>" placeholder="Address">
								</div>
							</div>

							  <div class="col-md-6 col-12">
                                                    <!-- Price dropdown -->
                                                    <div class="form-group mb-3">
                                                        <label for="prop_price">Price</label>
                                                        <select name="prop_price" id="prop_price" class="form-control rounded-5">
                                                            <option value="">Select Price Range</option>
                                                            <option value="100000-200000" <?= (@$prop['prop_price'] == '100000-200000') ? 'selected' : '' ?>>100,000 - 200,000</option>
                                                            <option value="200001-300000" <?= (@$prop['prop_price'] == '200001-300000') ? 'selected' : '' ?>>200,001 - 300,000</option>
                                                            <option value="300001-400000" <?= (@$prop['prop_price'] == '300001-400000') ? 'selected' : '' ?>>300,001 - 400,000</option>
                                                            <option value="400001-500000" <?= (@$prop['prop_price'] == '400001-500000') ? 'selected' : '' ?>>400,001 - 500,000</option>
                                                            <option value="500001-1000000" <?= (@$prop['prop_price'] == '500001-1000000') ? 'selected' : '' ?>>500,001 - 1,000,000</option>
                                                            <option value="1000001-1500000" <?= (@$prop['prop_price'] == '1000001-1500000') ? 'selected' : '' ?>>1,000,001 - 1,500,000</option>
                                                            <option value="1500001-2000000" <?= (@$prop['prop_price'] == '1500001-2000000') ? 'selected' : '' ?>>1,500,001 - 2,000,000</option>
                                                            <option value="2000001-2500000" <?= (@$prop['prop_price'] == '2000001-2500000') ? 'selected' : '' ?>>2,000,001 - 2,500,000</option>
                                                            <option value="2500001-3000000" <?= (@$prop['prop_price'] == '2500001-3000000') ? 'selected' : '' ?>>2,500,001 - 3,000,000</option>
                                                            <option value="3000001-3500000" <?= (@$prop['prop_price'] == '3000001-3500000') ? 'selected' : '' ?>>3,000,001 - 3,500,000</option>
                                                            <option value="3500001-4000000" <?= (@$prop['prop_price'] == '3500001-4000000') ? 'selected' : '' ?>>3,500,001 - 4,000,000</option>
                                                            <option value="4000001-4500000" <?= (@$prop['prop_price'] == '4000001-4500000') ? 'selected' : '' ?>>4,000,001 - 4,500,000</option>
                                                            <option value="4500001-5000000" <?= (@$prop['prop_price'] == '4500001-5000000') ? 'selected' : '' ?>>4,500,001 - 5,000,000</option>
                                                        </select>
                                                    </div>
                                                </div>

							<div class="col-md-6 col-12">
								<!-- Image input-->
								<div class="form-group mb-3">
									<label for="prop_img1">Thumbnail Image
										<!-- (<small class="text-danger">You can add more images later</small>) -->
									</label>
									<input type="file" name="prop_img1" id="prop_img1" class="form-control rounded-5" accept="image/*">
									<input type="hidden" name="old_img" id="image_name" value="<?= @$prop['prop_img1'] ?>">
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="prop_amenity_list">Amenitiess</label>
									<select name="prop_amenity_list[]" id="prop_amenity_list" class="form-control" multiple>
										<option value="" disabled>Select Amenities</option>

										<?php
										$selectedAmenities = !empty($prop['prop_amenity_list']) ? explode(',', $prop['prop_amenity_list']) : [];

										$getAmenities = $this->db->query("SELECT * FROM yn_site_tags WHERE stg_type = 'amenity' ORDER BY stg_tgid");

										foreach ($getAmenities->result_array() as $amenity) {
											$amenityId = $amenity['stg_tgid'];
											$amenityName = $amenity['stg_name'];
											$selectedAmenity = in_array($amenityId, $selectedAmenities) ? 'selected' : ''; ?>

											<option value="<?= $amenityId ?>" <?= $selectedAmenity ?>><?= $amenityName ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="prop_furnish_list">Facilities</label>
									<select name="prop_furnish_list[]" id="prop_furnish_list" class="form-control" multiple>
										<option value="" disabled>Select Facilities</option>

										<?php
										$selectedFacilities = !empty($prop['prop_furnish_list']) ? explode(',', $prop['prop_furnish_list']) : [];

										$getFacilities = $this->db->query("SELECT * FROM yn_site_tags WHERE stg_type = 'furnished' ORDER BY stg_tgid");

										foreach ($getFacilities->result_array() as $facily) {
											$facilyId = $facily['stg_tgid'];
											$facilyName = $facily['stg_name'];
											$selectedFacility = in_array($facilyId, $selectedFacilities) ? 'selected' : ''; ?>

											<option value="<?= $facilyId ?>" <?= $selectedFacility ?>><?= $facilyName ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="youtube">Youtube Link</label>
									<input type="text" name="prop_youtube" class="form-control" id="youtube" value="<?= @$prop['prop_youtube'] ?>" placeholder="Video Link">
								</div>
							</div>

							<div class="col-6">
								<div class="form-group">
									<label for="youtube">Property Vendor</label>
									<select name="prop_vendor" class="form-control" id="">
										<option value="">Select Vendor</option>
										<?php
										$allusers = $this->db->query("SELECT * FROM yn_site_mem ");
										$users = $allusers->result_array();
										foreach ($users as $user) {
											$selected = (@$prop['prop_vendor'] == $user['mid']) ? 'selected' : '';
										?>
											<option value="<?= $user['mid'] ?>" <?= $selected ?>><?= $user['name'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							 <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="s_s9iskls90s">Google Map</label>
                                                        <small>You can get a map for free from here:
						<br /><b> <a href="https://www.embedgooglemap.net/" target="_blank"> Map Link </a></b>
					</small>
                                                        <textarea class="form-control mb-2 " placeholder="Google map code" name="prop_map"><?= @$prop['prop_map'] ?></textarea>
                                                    </div>
                                                </div>

							<div class="col-sm-12">
								<div class="form-group">
									<label for="s_s9iskls90s">Description</label>
									<textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="Property Details" name="prop_desc"><?= @$prop['prop_desc'] ?></textarea>
								</div>
							</div>
							<button class="btn mt-2 btn-warning btn-block py-2">Add / Edit Property</button>

					</form>
				</div>
				<div class="card-footer">Good luck!</div>
			</div>
</div>


<?php
			break;
		case 'all-properties':
			$getallprop = $this->db->query("select * from x_home_property order by prop_id desc limit $limit1, $limit2");
			$theallprops = $getallprop->result_array();
?>
	<div class="card w-100">
		<div class="card-header">All Property</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Bath</th>
					<th>BHK</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php

				$count = 1;

				foreach ($theallprops as $prop) { ?>
					<tr class="bg-white">
						<td><?= $count++; ?></td>
						<td><b><?= $prop['prop_name'] ?></b></td>
						<td><?= money_show($prop['prop_price']) ?></td>
						<td><?= $prop['prop_cat_name'] ?><br><?= $prop['prop_rent_sale'] ?></td>
						<td><?= $prop['prop_bathroom'] ?></td>
						<td><?= $prop['prop_bedroom'] ?></td>
						<td><?= read_me_user('property_status', $prop['prop_status']) ?> <br />
							<?= read_me_user('property_sale_rent', $prop['prop_rent_sale']) ?> </td>
						<td class="text-left">
							<div class="mr-2 btn-group">
								<button class="btn btn-outline-secondary">Options</button>
								<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-secondary"><span class="sr-only">Toggle Dropdown</span>
								</button>
								<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
									<!-- <a href="<?= base_url('index.php/property/') ?><?= $prop['prop_id'] ?>/<?= url_smart($prop['prop_name']) ?>" target="_blank"><button type="button" tabindex="0" class="dropdown-item">View</button></a> -->
									<a href="<?= base_url('index.php/admin/perform/custom/add-property') ?>?edit=<?= $prop['prop_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Edit</button></a>
									<!-- <a href="<?= base_url('index.php/admin/perform/web/contacts') ?>?cat=<?= $prop['prop_cat'] ?>"><button type="button" tabindex="0" class="dropdown-item">Interested Contacts</button></a> -->
									<a href="<?= base_url('index.php/admin/perform/custom/add-prop-img') ?>?pid=<?= $prop['prop_id'] ?>"><button type="button" tabindex="0" class="dropdown-item">Add Images</button></a>
									<?php if ($prop['prop_status'] == '0') { ?>
										<a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=active_prop">
											<button type="button" tabindex="0" class="dropdown-item">Active</button></a>
									<?php } else { ?>
										<a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=inactive_prop">
											<button type="button" tabindex="0" class="dropdown-item">In-Active</button></a>
									<?php } ?>

									<!-- <a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=feat_prop">
										<button type="button" tabindex="0" class="dropdown-item">Featured</button></a>

									<a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=unfeat_prop">
										<button type="button" tabindex="0" class="dropdown-item">Un-Featured</button></a>
									<a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=exc_prop">
										<button type="button" tabindex="0" class="dropdown-item">Exclusive</button></a>

									<a href="<?= base_url('index.php/admin_action/prop_modify') ?>?id=<?= $prop['prop_id'] ?>&what=nonexc_prop">
										<button type="button" tabindex="0" class="dropdown-item">Non-Exclusive</button></a> -->

									<a onclick="return confirm('Do you really want to delete this Property?');" href="<?= base_url('index.php/admin_action/delete') ?>?id=<?= $prop['prop_id'] ?>&what=prop">
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
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
						<?php
						$pagesare = $pageNum;
						for ($x = $pageNum - 10; $x <= $pageNum + 3; $x++) {
							$addclass = '';
							if ($pageNum == $x) {
								$addclass = 'bold';
							}
							if ($x > 0) {
						?>
								<li onclick="paging(<?= $x ?>)" class="page-item <?= $addclass ?>"><a href="#" class="page-link"><?= $x ?></a></li>
						<?php }
						} ?>
						<li class="page-item"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
<?php break;

		case 'add-prop-img':
			@$the_product_img = xss_clean($_GET['pid']);
			// 			$imgData = get_product_image_data($the_product_img);

			$send_product_images = 'add_prop_images';


?>
	<div class="main-card mb-3 card col-sm-5">
		<div class="card-body">
			<h5 class="card-title">Add/Edit Property Images </h5>
			<div>
				<form class="form-horizontal form-label-left" method="post"
					action="<?= base_url('admin_action/add_prop_images'); ?>"
					onsubmit="return uploadandform('<?= base_url('admin_action/add_prop_images') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
					enctype="multipart/form-data">
					<input type="hidden" name="p_id" value="<?= $the_product_img ?>">

					<table class="table table-borderless">
						<tbody>
							<tr>
								<td>
									<!--<input type="hidden" name="product_name" value="<?= @$imgData['img'] ?>"-->
									<!--	class="form-control" placeholder="Product Name">-->
									<input type="hidden" name="what" value="<?= $send_product_images ?>">

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
			<div class="card-header">View All Property Images
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
						$pid = clean($_GET['pid']);
						$getImages = $this->db->query("SELECT * FROM `x_home_prop_images` where pi_prop_id='$pid' order by pi_id desc limit 20 ");
						$theresl = $getImages->result_array();
						$getProducts = $this->db->query("SELECT * FROM `x_home_property` where prop_id = '$pid' ");
						$the_pros_ps = $getProducts->row_array();
						foreach ($theresl as $pro_img) {
						?>
							<tr>
								<td class="text-left text-muted">#<?= $pro_img['id'] ?></td>
								<td>
									<div class="widget-content-left flex2">
										<div class="widget-heading"><b><?= $the_pros_ps['prop_name'] ?></b></div>
									</div>
								</td>
								<td class="text-left">
									<img width="60px" class="rounded-square"
										src="<?= base_url('assets/avator/upload/' . $pro_img['pi_img_name']) ?>" />
								</td>
								<td class="text-left">

									<!-- <a
                                    href="<?= base_url('admin/perform/web/images') ?>?images=<?= @$pro_img['pid'] ?>">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-warning"><i
                                            class="pe-7s-pen btn-icon-pen"> </i></button></a>
                                </a> -->
									<a onclick="return confirm('Do you really want to delete this image');"
										href="<?= base_url('admin_action/delete') ?>?id=<?= $pro_img['pi_id'] ?>&what=prop-img">
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

		default:
			echo $sub_perform;
			break;
	}
?>
</div>