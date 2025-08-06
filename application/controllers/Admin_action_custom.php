<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_action_custom extends CI_Controller
{


	function delete()
	{
		$id = $_GET['id'];
		$what = $_GET['what'];
		@$id = $_GET['id'];

		if ($_SESSION['aid'] != '') {
			switch ($what) {
				case 'shop':
					$del_datas = $this->db->query("delete from x_vendor_shop where shop_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'kyc':
					$del_datas = $this->db->query("delete from x_kyc where kyc_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'course':
					$del_datas = $this->db->query("delete from x_edu_courses where course_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'enrollment':
					$del_datas = $this->db->query("DELETE FROM `x_edu_enrollments` where or_order_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'material':
					$del_datas = $this->db->query("DELETE FROM `x_edu_study_material` where sm_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'tst':
					$del_datas = $this->db->query("delete from x_edu_rankers where tid='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
				case 'series':
					$del_datas = $this->db->query("delete from x_edu_qbseries where series_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], '?msg=success');
					break;
			}
		} else {
			redirect(base_url('logout'));
		}
	}

	function modify()
	{
		get_admin_rights();
		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > 3) {

			if (strpos($_SERVER['HTTP_REFERER'], '?') !== false) {
				$add = '&msg=success';
			} else {
				$add = '?msg=success';
			}

			switch ($op) {
				case 'shop_apr':
					$mid = $this->input->GET('mid');
					$shop_id = $this->input->GET('shop_id');

					$this->db->query("update `x_vendor_shop` set shop_status='1' where shop_id='$id' and shop_uniq_id = '$shop_id'");
					$this->db->query("UPDATE `yn_site_mem` SET user_shop_id = '$shop_id' WHERE mid = '$mid'");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'shop_rej':
					$mid = $this->input->GET('mid');
					$shop_id = $this->input->GET('shop_id');

					$this->db->query("update `x_vendor_shop` set shop_status='2' where shop_id='$id' and shop_uniq_id = '$shop_id'");
					$this->db->query("UPDATE `yn_site_mem` SET user_shop_id = NULL WHERE mid = '$mid' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'kyc_apr':
					$mid = $this->input->GET('mid');
					$this->db->query("update `x_kyc` set kyc_status='1' where kyc_id='$id' ");
					$this->db->query("update `yn_site_mem` set kyc_status='1' where mid='$mid' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'kyc_rej':
					$mid = $this->input->GET('mid');
					$this->db->query("update `x_kyc` set kyc_status='2' where kyc_id='$id' ");
					$this->db->query("update `yn_site_mem` set kyc_status='2' where mid='$mid' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;

				case 'approved':
					$this->db->query("update `x_edu_enrollments` set co_status='1' where co_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'rejected':
					$this->db->query("update `x_edu_enrollments` set co_status='2' where co_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'enable_sm':
					$this->db->query("update `x_edu_study_material` set sm_status='1' where sm_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'disable_sm':
					$this->db->query("update `x_edu_study_material` set sm_status='0' where sm_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'delete_sm_file':
					$this->db->query("update `x_edu_study_material` set sm_file='' where sm_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'enable_course':
					$this->db->query("update `x_edu_courses` set course_status='1' where course_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'disable_course':
					$this->db->query("update `x_edu_courses` set course_status='0' where course_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'cou_feat':
					$this->db->query("update `x_edu_courses` set course_featured='1' where course_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'cou_nonf':
					$this->db->query("update `x_edu_courses` set course_featured='0' where course_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'enable_q':
					$this->db->query("update `x_edu_questions` set qstatus='1' where qid='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'disable_q':
					$this->db->query("update `x_edu_questions` set qstatus='0' where qid='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'enable_qb':
					$this->db->query("update `x_edu_qbank` set qbstatus='1' where qb_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'disable_qb':
					$this->db->query("update `x_edu_qbank` set qbstatus='0' where qb_id='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'accept_doubt':
					$this->db->query("update `x_edu_material_review` set mr_status='1' where mrid='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				case 'reject_doubt':
					$this->db->query("update `x_edu_material_review` set mr_status='0' where mrid='$id' ");
					redirect($_SERVER['HTTP_REFERER'] . $add);
					break;
				default:
					echo "Not matched";
			}
		}
	}

	function download_data()
	{
		get_admin_rights();
		$download = $values = 0;
		$op = $this->input->GET('what');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] == '2') {
			switch ($op) {
				case 'ord':
					$data_query = $this->db->query('select * from `x-orders`');
					$filename = "cou_course_data.xls";
					$download = 1;
					break;
				case 'sm':
					$data_query = $this->db->query('select sm_id, sm_name, sm_link from `x_edu_study_material`');
					$filename = "study_material.xls";
					$download = 1;
					break;
				case 'q':
					$data_query = $this->db->query('select qid, qtitle, qoption1, qoption2, qoption3, qoption4, qanswer, qmarks, qdesc, qapp_web from `x_edu_questions`');
					$filename = "questions.xls";
					$download = $values = 1;
					break;
				case 'qbank':
					$data_query = $this->db->query('select qb_id, qbtitle, qbdesc, qbtotal, qbtime from `x_edu_qbank`');
					$filename = "qbank.xls";
					$download = 1;
					$values = 2;
					break;
				case 'cou':
					$data_query = $this->db->query('select course_id,course_name,course_dur,course_price from `x_edu_courses`');
					$filename = "course_data.xls";
					$download = 1;
					break;
				case 'key':
					$data_query = $this->db->query("SELECT t1.*, IF(user_id='0','Guest',t2.name) as UserName, t2.email, t2.contact, t2.address FROM x_cou_keywords t1 LEFT JOIN yn_site_mem t2 ON t1.user_id = t2.mid order by key_id");
					$filename = "cou_keyword_data.xls";
					$download = 1;
					break;
				case 'users':
					$data_query = $this->db->query('select * from yn_site_mem');
					$filename = "cou_users_data.xls";
					$download = 1;
					break;
				default:
					echo "Not matched";
			}

			if ($download == 1) {
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");

				$flag = false;
				$data = $data_query->result_array();
				foreach ($data as $row) {
					if (!$flag) {
						// display field/column names as first row
						echo implode("\t", array_keys($row)) . "\r\n";
						$flag = true;
					}

					if ($values == "1") {
						$qtitle = strip_tags($row['qtitle']);
						echo $row['qid'] . "\t" . $qtitle . "\t" . $row['qoption1'] . "\t" . $row['qoption2'] . "\t" . $row['qoption3'] . "\t" . $row['qoption4'] . "\t"  . $row['qanswer'] . "\t" . $row['qmarks'] . "\t" . $row['qdesc'] . "\t" . "\r\n";
					} else if ($values == "2") {
						//print_r($row);die;
						$qbtitle = strip_tags($row['qbtitle']);
						$qbdesc = strip_tags($row['qbdesc']);
						echo $row['qb_id'] . "\t" . $qbtitle . "\t" . $qbdesc . "\t" . $row['qbtotal'] . "\t" . $row['qbtime'] . "\t" . "\r\n";
					} else {
						echo implode("\t", array_values($row)) . "\r\n";
					}
				}
			}
		}
	}


	function add_data()
	{
		@$the_id = $this->input->post('the_id');
		@$what = $this->input->post('what');
		@$desc = addslashes($this->input->post('desc'));
		@$name = $this->input->post('name');
		@$link = $this->input->post('link');
		@$price = $this->input->post('course_price');

		@$course_lessons = $this->input->post('course_lessons');
		@$rating = $this->input->post('rating');
		@$cat = $this->input->post('cat');
		@$scat = $this->input->post('scat');
		@$crs_tags = $this->input->post('crs_tags');
		@$course_dur = $this->input->post('course_dur');
		@$course_lang = $this->input->post('course_lang');
		@$course_video = $this->input->post('course_video');
		@$course_app_web = $this->input->post('course_app_web');

		$course_id = '0';
		$category_name = $subcategory_name = '';
		$cover = '';
		if ($cat > '0') {
			$category = get_cat('3', $cat);
			$category_name = $category['name'];
		}
		if ($scat > '0') {
			$subcategory_name = getsubCat($scat, 'sct_name');
		}

		//print_r($_POST);
		if ($name != '') {
			switch ($what) {
				case 'add_course':

					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/courses/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
						}
					} else {
						$cover = '';
					}

					if (!empty($_FILES['file_name2']['name'])) {
						$file_get_res = upload_doc('file_name2', "assets/avator/upload/courses/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover2 = substr($file_get_res, 6);
						}
					} else {
						$cover2 = '';
					}

					$getlogins = $this->db->query("INSERT INTO `x_edu_courses`( `course_name`, `course_img`, `course_desc`, `course_price`, course_cat, course_category, course_scat, course_scategory, course_rating, course_lessons, course_dur, course_lang, course_video, course_status, course_app_web,co_img_2) VALUES ('$name','$cover','$desc','$price','$cat','$category_name','$scat','$subcategory_name','$rating','$course_lessons', '$course_dur','$course_lang', '$course_video', '1', '$course_app_web','$cover2')");

					$course_id = $this->db->insert_id();
					break;
				case 'edit_course':
					$cover = '';
					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/courses/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("UPDATE x_edu_courses set course_img='$cover' where course_id='$the_id'");
						}
					}


					if (!empty($_FILES['file_name2']['name'])) {
						$file_get_res = upload_doc('file_name2', "assets/avator/upload/courses/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover2 = substr($file_get_res, 6);
							$getlogins = $this->db->query("UPDATE x_edu_courses set co_img_2='$cover2' where course_id='$the_id'");
						}
					}


					$getlogins = $this->db->query("UPDATE x_edu_courses set course_name='$name', course_desc='$desc', course_price='$price', course_cat='$cat', course_category='$category_name', course_scat='$scat', course_scategory='$subcategory_name', course_rating='$rating', course_lessons='$course_lessons', course_dur='$course_dur', course_lang='$course_lang', course_video='$course_video', course_app_web='$course_app_web' where course_id='$the_id'");


					$this->db->query("DELETE FROM x_edu_course_tags where ct_course_id='$the_id'");

					$course_id = $the_id;
					break;

				case 'add_smaterial':
					$course_id = $this->input->post('course_id');
					$sm_sort = $this->input->post('sm_sort');
					$sm_qbank_id = $this->input->post('sm_qbank_id');
					if (!empty($_FILES['file_name']['name'])) {
						$dest = "assets/avator/upload/smaterial/";
						$order_id = rand('1111111', '9999999');
						$file_get_res = upload_doc('file_name', $dest, $order_id);
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
						}
					} else {
						$cover = '';
					}

					$getlogins = $this->db->query("INSERT INTO `x_edu_study_material`( `sm_name`, `sm_file`, `sm_desc`, `sm_link`, `sm_course_id`, sm_status, sm_qbank_id) VALUES ('$name','$cover','$desc','$link', '$course_id', '1', '$sm_qbank_id')");

					$sm_id = $this->db->insert_id();
					break;
				case 'edit_smaterial':
					$course_id = $this->input->post('course_id');
					$sm_sort = $this->input->post('sm_sort');
					$sm_qbank_id = $this->input->post('sm_qbank_id');
					$cover = '';
					if (!empty($_FILES['file_name']['name'])) {
						$dest = "assets/avator/upload/smaterial/";
						$order_id = rand('1111111', '9999999');
						$file_get_res = upload_doc('file_name', $dest, $order_id);
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("UPDATE x_edu_study_material set sm_name='$name', sm_file='$cover',  sm_desc='$desc', sm_link='$link', `sm_course_id`='$course_id', `sm_qbank_id`='$sm_qbank_id' where sm_id='$the_id'");
						}
					} else {

						$getlogins = $this->db->query("UPDATE x_edu_study_material set sm_name='$name',  sm_desc='$desc', sm_link='$link', `sm_course_id`='$course_id', `sm_qbank_id`='$sm_qbank_id' where sm_id='$the_id'");
					}

					break;
			}

			if (isset($_POST['crs_tags']) && $course_id > 0) {
				if (count($crs_tags) > 0) {
					$course_tags = '';
					@$crsTags = @implode(',', $crs_tags);
					$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($crsTags) ");
					$allthedetails = $get_alllists->result_array();
					$course_tags = '';
					foreach ($allthedetails as $thelists_data) {
						$course_tags = $course_tags . ', ' . $thelists_data['stg_name'];
					}
					@$course_tags = substr($course_tags, 2);
					for ($t = 0; $t < count($crs_tags); $t++) {
						$tgid = $crs_tags[$t];
						$this->db->query("INSERT INTO `x_edu_course_tags` (`ct_course_id`,`ct_tag_id`) VALUES ('$course_id', '$tgid')");
					}
					$this->db->query("UPDATE x_edu_courses SET course_tags='$course_tags' WHERE  course_id='$the_id'");
				}
			}


			echo 'YNAPS_SUCCESS';
			die;
		} //if
	}

	function question()
	{
		@$the_id = $this->input->post('the_id');
		@$what = $this->input->post('what');
		@$qdesc = addslashes($this->input->post('qdesc'));
		@$qtitle = addslashes($this->input->post('qtitle'));
		@$qoption1 = addslashes($this->input->post('qoption1'));
		@$qoption2 = addslashes($this->input->post('qoption2'));
		@$qoption3 = addslashes($this->input->post('qoption3'));
		@$qoption4 = addslashes($this->input->post('qoption4'));
		@$qanswer = $this->input->post('qanswer');
		@$qmarks = $this->input->post('qmarks');
		@$qapp_web = $this->input->post('qapp_web');
		@$ques_subj = $this->input->post('ques_subj');
		@$ques_paper = $this->input->post('ques_paper');

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/questions/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
				$qimg_url = base_url('assets/avator/upload/questions/') . $cover;
			}
		} else {
			$cover = $qimg_url = '';
		}

		//print_r($_POST);
		if ($qtitle != '') {
			switch ($what) {
				case 'add_question':
					$getlogins = $this->db->query("INSERT INTO `x_edu_questions`(`qtitle`, `qdesc`, `qoption1`, `qoption2`, `qoption3`, `qoption4`, `qanswer`, `qimg`, `qmarks`, `qapp_web`,`qimg_url`) VALUES ('$qtitle','$qdesc','$qoption1','$qoption2','$qoption3','$qoption4','$qanswer','$cover','$qmarks','$qapp_web','$qimg_url')");

					$qid = $this->db->insert_id();
					break;
				case 'edit_question':
					$update_qry = "UPDATE `x_edu_questions` SET `qtitle`='$qtitle',`qdesc`='$qdesc',`qoption1`='$qoption1',`qoption2`='$qoption2',`qoption3`='$qoption3',`qoption4`='$qoption4',`qanswer`='$qanswer',`qmarks`='$qmarks',`qapp_web`='$qapp_web'";
					if ($cover != '') {
						$update_qry .= ",`qimg`='$cover', `qimg_url`='$qimg_url'";
					}

					$getlogins = $this->db->query("$update_qry WHERE qid='$the_id'");

					$this->db->query("DELETE FROM x_edu_subject_question where sq_ques_id='$the_id'");
					//$this->db->query("DELETE FROM x_edu_qbank_question where pq_ques_id='$the_id'");

					$qid = $the_id;
					break;
			}

			if (isset($_POST['ques_subj']) && $qid > 0) {
				if (count($ques_subj) > 0) {
					for ($t = 0; $t < count($ques_subj); $t++) {
						$tgid = $ques_subj[$t];
						//echo "INSERT INTO `x_edu_subject_question` (`sq_ques_id`,`sq_subj_id`) VALUES ('$qid', '$tgid')";die;
						$this->db->query("INSERT INTO `x_edu_subject_question` (`sq_ques_id`,`sq_subj_id`) VALUES ('$qid', '$tgid')");
					}
				}
			}

			// if(isset($_POST['ques_paper']) && $qid>0){
			// 	if(count($ques_paper)>0){
			// 		for($t=0; $t<count($ques_paper); $t++){
			// 			$tgid=$ques_paper[$t];
			// 			$this->db->query("INSERT INTO `x_edu_subject_question` (`pq_ques_id`,`pq_paper_id`) VALUES ('$qid', '$tgid')");
			// 		}
			// 	}
			// }


			echo 'YNAPS_SUCCESS';
			die;
		} //if
	}

	function qbank()
	{
		@$the_id = $this->input->post('the_id');
		@$what = $this->input->post('what');
		@$qbtitle = addslashes($this->input->post('qbtitle'));
		@$qbdesc = addslashes($this->input->post('qbdesc'));
		@$qbshort_desc = addslashes($this->input->post('qbshort_desc'));
		@$qbnmarks = $this->input->post('qbnmarks');
		@$qbmarks = $this->input->post('qbmarks');
		@$qbtotal = $this->input->post('qbtotal');
		@$qbtime = $this->input->post('qbtime');
		@$qbquestions = $this->input->post('qbquestions');
		@$qbstatus = $this->input->post('qbstatus');
		@$qbapp_web = $this->input->post('qbapp_web');
		@$qbcat = $this->input->post('qbcat');
		@$qbscat = $this->input->post('qbscat');
		@$qbmode = $this->input->post('qbmode');

		$qbcategory = $qbscategory = '';
		if ($qbcat > '0') {
			$category = get_cat('3', $qbcat);
			$qbcategory = $category['name'];
		}
		if ($qbscat > '0') {
			$qbscategory = getsubCat($qbscat, 'sct_name');
		}

		@$qb_ques = $this->input->post('qb_ques');
		@$qbseries = $this->input->post('qbseries');

		//print_r($_POST);
		if ($qbtitle != '' && $qbmode != '') {
			switch ($what) {
				case 'add_qbank':
					$qbdate = date('y-m-d');
					$getlogins = $this->db->query("INSERT INTO `x_edu_qbank`(`qbtitle`, `qbdesc`, `qbnmarks`, `qbmarks`, `qbtotal`, `qbtime`, `qbquestions`, `qbstatus`, `qbshort_desc`, `qbapp_web`, `qbcat`, `qbcategory`, `qbscat`, `qbscategory`, `qbmode`, `qbseries`, `qbdate`) VALUES ('$qbtitle','$qbdesc','$qbnmarks','$qbmarks','$qbtotal','$qbtime','$qbquestions','$qbstatus','$qbshort_desc', '$qbapp_web', '$qbcat','$qbcategory','$qbscat','$qbscategory', '$qbmode', '$qbseries', '$qbdate')");

					$qbid = $this->db->insert_id();
					break;
				case 'edit_qbank':
					//Updating SERIES of QBANK			
					//$getlogins=$this->db->query("UPDATE `x_edu_qbank` SET `qbtitle`='$qbtitle',`qbdesc`='$qbdesc',`qbnmarks`='$qbnmarks',`qbmarks`='$qbmarks',`qbtotal`='$qbtotal',`qbtime`='$qbtime',`qbquestions`='$qbquestions',`qbstatus`='$qbstatus',`qbshort_desc`='$qbshort_desc',`qbapp_web`='$qbapp_web',`qbcat`='$qbcat',`qbcategory`='$qbcategory',`qbscat`='$qbscat',`qbscategory`='$qbscategory', `qbmode`='$qbmode', `qbseries`='$qbseries' WHERE `qb_id`='$the_id'");
					//without Updating SERIES of QBANK
					$getlogins = $this->db->query("UPDATE `x_edu_qbank` SET `qbtitle`='$qbtitle',`qbdesc`='$qbdesc',`qbnmarks`='$qbnmarks',`qbmarks`='$qbmarks',`qbtotal`='$qbtotal',`qbtime`='$qbtime',`qbquestions`='$qbquestions',`qbstatus`='$qbstatus',`qbshort_desc`='$qbshort_desc',`qbapp_web`='$qbapp_web',`qbcat`='$qbcat',`qbcategory`='$qbcategory',`qbscat`='$qbscat',`qbscategory`='$qbscategory', `qbmode`='$qbmode' WHERE `qb_id`='$the_id'");

					$this->db->query("DELETE FROM x_edu_qbank_question where qbq_qbank_id='$the_id'");

					$qbid = $the_id;
					break;
			}

			if (isset($_POST['qb_ques']) && $qbid > 0) {
				if (count($qb_ques) > 0) {
					for ($t = 0; $t < count($qb_ques); $t++) {
						$tgid = $qb_ques[$t];
						$this->db->query("INSERT INTO `x_edu_qbank_question` (`qbq_qbank_id`,`qbq_ques_id`) VALUES ('$qbid', '$tgid')");
					}
				}
			}

			echo 'YNAPS_SUCCESS';
			die;
		} //if
	}

	function import_questions()
	{

		$filename = $_FILES['file_name']['tmp_name'];
		$count = '0';
		if ($filename == '') {
			echo 'select a valid file';
			die;
		}
		$file = fopen($filename, "r");
?>
		<a href="<?= base_url('admin/perform/custom/all-questions') ?>">
			<h5 class="card-title text-right">All Questions</h5>
		</a>
		<?php
		$cou_xls_code = rand(1111, 9999);
		while (($couData = fgetcsv($file, 10000, ",")) !== FALSE) {
			if ($count > 0) { //print_r($couData);die;
				$qid = clean($couData[0]);

				//if($qid ==''){$qid=rand(11111,99999999);}

				$numsku = $this->db->query("SELECT qid FROM x_edu_questions WHERE qid='$qid'");
				$num_sku = $numsku->num_rows();

				@$qtitle = addslashes($couData[1]);
				@$qoption1 = $couData[2];
				@$qoption2 = $couData[3];
				@$qoption3 = $couData[4];
				@$qoption4 = $couData[5];
				@$qanswer = $couData[6];
				@$qmarks = $couData[7];
				@$qdesc = addslashes($couData[8]);
				@$qimg_url = addslashes($couData[9]);

				if ($num_sku != 0) {
					$cou = $numsku->row_array();
					$qid = $cou['qid'];
					//echo "UPDATE `x_edu_questions` SET `qtitle`='$qtitle',`qdesc`='$qdesc',`qoption1`='$qoption1',`qoption2`='$qoption2',`qoption3`='$qoption3',`qoption4`='$qoption4',`qanswer`='$qanswer',`qmarks`='$qmarks',`qapp_web`='$qapp_web'";die;
					$update_qry = "UPDATE `x_edu_questions` SET `qtitle`='$qtitle',`qdesc`='$qdesc',`qoption1`='$qoption1',`qoption2`='$qoption2',`qoption3`='$qoption3',`qoption4`='$qoption4',`qanswer`='$qanswer',`qmarks`='$qmarks',`qimg_url`='$qimg_url'";
					//echo "$update_qry WHERE qid='$qid'";die;		
					$up_data = $this->db->query("$update_qry WHERE qid='$qid'");
					if ($up_data) {
						echo 'Question: ' . $qtitle . ' (QID: ' . $qid . ' ) <u>UPDATED</u> <br/>';
					} else {
						echo $this->db->_error_number() . ' - ' . $this->db->_error_message();
					}
				} else {
					$addd_data = $this->db->query("INSERT INTO `x_edu_questions`(`qtitle`, `qdesc`, `qoption1`, `qoption2`, `qoption3`, `qoption4`, `qanswer`, `qmarks`, `qstatus`,`qimg_url`) VALUES ('$qtitle', '$qdesc', '$qoption1', '$qoption2','$qoption3', '$qoption4', '$qanswer', '$qmarks', '1','$qimg_url')");
					if ($addd_data) {
						echo 'Question: ' . $qtitle . ' (QID: ' . $qid . ' ) <u>Insered</u> <br/>';
					} else {
						echo $this->db->_error_number() . ' - ' . $this->db->_error_message();
					}
				}
			}
			$count++;
		} //while
		?>
		<p> Please DO not refresh this page, this may lead to duplicate data.<br />
			<a href="<?= base_url('admin/perform/custom/import-questions') ?>">
				<h5 class="card-title text-right">Go Back to Import Questions</h5>
			</a>
	<?php
		fclose($file);
	}


	////////////////////////////////////////////////////////
	function reply_doubt()
	{
		@$the_id = $this->input->post('the_id');
		@$reply = addslashes($this->input->post('reply'));
		//echo "UPDATE `x_edu_material_review` SET `mr_reply`='$reply' WHERE mrid='$the_id'";
		$update_qry = $this->db->query("UPDATE `x_edu_material_review` SET `mr_reply`='$reply' WHERE mrid='$the_id'");
		echo 'YNAPS_SUCCESS';
	}

	function add_rankers()
	{
		get_admin_rights();
		$todo = $this->input->post('todo');
		$name = $this->input->post('name');
		$desi = $this->input->post('desi');
		$company = $this->input->post('company');
		$text = addslashes($this->input->post('text'));
		$order = $this->input->post('order');

		if ($todo != '-1') {
			@$cvr_prf = $_FILES['image_name']['name'];
			if ($cvr_prf != '') {
				$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$NewImageName = substr($file_get_res, 6);
					$addtesti = $this->db->query("update x_edu_rankers set image='$NewImageName'where tid='$todo'  ");
				}
			}
			$addtesti = $this->db->query("update x_edu_rankers set name='$name',role='$desi',company='$company',text='$text',li='$order' where tid='$todo' ");
			echo 'YNAPS_SUCCESS';
			die;
		} else {
			$cvr_prf = $_FILES['image_name']['name'];
			$NewImageName = '';
			$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$NewImageName = substr($file_get_res, 6);
			}

			$addtesti = $this->db->query("insert into x_edu_rankers (name,image,role,company,text,li) values ('$name','$NewImageName','$desi','$company','$text','$order')");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	function edit_rankers()
	{
		get_admin_rights();
		$name = $this->input->post('name');
		$desi = $this->input->post('desi');
		$company = $this->input->post('company');
		$text = addslashes($this->input->post('text'));
		$order = $this->input->post('order');
		$id = $this->input->post('id');

		if ($text == '') {
			$addtesti = $this->db->query("delete from x_edu_rankers where tid='$id' ");
			redirect($_SERVER['HTTP_REFERER']);
		}

		$cvr_prf = $_FILES['image_name']['name'];
		if ($cvr_prf != '') {
			$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$NewImageName = substr($file_get_res, 6);
				$addtesti = $this->db->query("update x_edu_rankers set image='$NewImageName' ");
			}
		}
		$addtesti = $this->db->query("update x_edu_rankers set name='$name',role='$desi',company='$company',text='$text',li='$order' where tid='$id' ");
		redirect($_SERVER['HTTP_REFERER']);
	}

	function qbank_series()
	{
		@$the_id = $this->input->post('the_id');
		@$what = $this->input->post('what');
		@$series_title = addslashes($this->input->post('series_title'));
		@$series_desc = addslashes($this->input->post('series_desc'));
		@$series_attempted = $this->input->post('series_attempted');
		@$series_start_date = $this->input->post('series_start_date');
		@$series_end_date = $this->input->post('series_end_date');
		@$series_qbanks_num = $this->input->post('series_qbanks_num');
		@$series_cat = $this->input->post('series_cat');
		@$series_rating = $this->input->post('series_rating');

		//print_r($_FILES['series_schedule']);die;
		if (!empty($_FILES['series_schedule']['name'])) {
			$file_get_res = upload_doc('series_schedule', "assets/avator/upload/series_schedule/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$NewImageName = substr($file_get_res, 6);
				$upd_schedule = ", `series_schedule`='$NewImageName'";
			} else {
				$NewImageName = '';
			}
		}
		@$series_discussion = $this->input->post('series_discussion');
		@$series_amount = $this->input->post('series_amount');

		$series_category = '';
		if ($series_cat > '0') {
			$category = get_cat('3', $series_cat);
			$series_category = $category['name'];
		}

		//print_r($_POST);
		if ($series_title != '' && $series_attempted != '') {
			switch ($what) {
				case 'add_qbank_series':
					$getlogins = $this->db->query("INSERT INTO `x_edu_qbseries`(`series_title`, `series_attempted`, `series_start_date`, `series_end_date`, `series_qbanks_num`, `series_cat`, `series_rating`, `series_category`, `series_desc`, `series_discussion`, `series_schedule`, `series_amount`) VALUES ('$series_title','$series_attempted','$series_start_date','$series_end_date','$series_qbanks_num','$series_cat','$series_rating', '$series_category', '$series_desc', '$series_discussion', '$NewImageName', '$series_amount')");

					//$the_id = $this->db->insert_id();
					break;
				case 'edit_qbank_series':

					$getlogins = $this->db->query("UPDATE `x_edu_qbseries` SET `series_title`='$series_title',`series_attempted`='$series_attempted',`series_start_date`='$series_start_date',`series_end_date`='$series_end_date',`series_qbanks_num`='$series_qbanks_num',`series_cat`='$series_cat',`series_rating`='$series_rating', `series_category`='$series_category', `series_desc`='$series_desc', `series_discussion`='$series_discussion', `series_amount`='$series_amount'" . $upd_schedule . " WHERE `series_id`='$the_id'");

					break;
			}

			echo 'YNAPS_SUCCESS';
			die;
		} //if
	}

	function add_notify()
	{

		$site_details = db_variables();

		$site_brief = $site_details['site_brief'];

		$site_name = $site_details['site_name'];

		$site_email = $site_details['site_email'];

		$site_address = $site_details['site_address'];



		$subject = $this->input->post('subject');

		$message = addslashes($this->input->post('message'));

		$mid = $this->input->post('mid');

		@$sms_notify = $this->input->post('sms_notify');

		$email = $this->input->post('email');


		// echo $email;

		// die;

		if (@$sms_notify == 'on') {

			@$sms_notify = '1';
		}

		$email_notify = $this->input->post('email_notify');

		if ($email_notify == 'on') {

			$email_notify = '1';
		}

		// $app_notify = $this->input->post('app_notify');


		// if ($app_notify == 'on') {

		// 	$app_notify = '1';
		// }



		$tos = $email;

		$subject09 = $subject;

		$preheader = $site_name;

		$greet = "Hi";

		$messages = $message;

		$link = base_url();

		$linkname = 'Browse Website';

		$message2 = "$site_brief";

		$greet2 = 'Thank you so much';

		$messageto90 = email_template($preheader, $greet, $messages, $link, $linkname, $message2, $greet2, $site_name, $site_address);

		send_email($tos, $subject09, $messages, $site_name, '');


		// $getAppTOKEN = $this->db->query("SELECT mid FROM site_mem WHERE mid = '$mid'");
		// $deviceToken = $getAppTOKEN->row_array();

		// $token = $deviceToken['mid'];
		// send_APP_notification($token, $messages, "user");

		// $this->db->query("INSERT INTO `site_notification` (`nyid`,`nsubject`,`nmessage`,`notif_by`) VALUES ('$mid','$subject','$message','$site_name')");


		echo 'YNAPS_SUCCESS';
	}

	function add_property()
	{
		$what 				= $this->input->post('what');
		@$prop_id 			= $this->input->post('prop_id');
		$prop_name 			= addslashes($this->input->post('prop_name'));
		$prop_category 		= $this->input->post('prop_category');
		$prop_sub_category 	= $this->input->post('prop_sub_category');
		$prop_rent_sale 	= $this->input->post('prop_rent_sale');
		$prop_area 			= addslashes($this->input->post('prop_area'));
		$prop_bedroom 		= $this->input->post('prop_bedroom');
		$prop_bathroom 		= $this->input->post('prop_bathroom');
		$prop_facing 		= $this->input->post('prop_facing');
		$prop_furnished 	= $this->input->post('prop_furnished');
		$prop_floor 		= $this->input->post('prop_floor');
		$prop_total_floors	= $this->input->post('prop_total_floors');
		$prop_balcony		= $this->input->post('prop_balcony');
		$prop_state			= $this->input->post('prop_state');
		$prop_city			= $this->input->post('prop_city');
		$prop_youtube			= $this->input->post('prop_youtube');
		$prop_address		= addslashes($this->input->post('prop_address'));
		$prop_price			= $this->input->post('prop_price');
		$old_img			= $this->input->post('old_img');
		$prop_amenity_list	= $this->input->post('prop_amenity_list');
		$prop_furnish_list	= $this->input->post('prop_furnish_list');
		$prop_desc 			= addslashes($this->input->post('prop_desc'));
		$prop_vendor	= $this->input->post('prop_vendor');
		$prop_map	= $this->input->post('prop_map');

		if (empty($prop_name)) {
			echo "Property name is required";
			die;
		}

		if (empty($prop_category)) {
			echo "Category is required";
			die;
		}

		if (empty($prop_sub_category)) {
			echo "Sub category is required";
			die;
		}

		if (empty($prop_rent_sale)) {
			echo "Property for is required";
			die;
		}

		if (empty($prop_area)) {
			echo "Property Area is required";
			die;
		}

		if (empty($prop_bedroom)) {
			echo "Number of Bedrooms is required";
			die;
		}

		if (empty($prop_bathroom)) {
			echo "Number of Bathrooms is required";
			die;
		}

		if (empty($prop_facing)) {
			echo "Property facing is required";
			die;
		}

		if (empty($prop_furnished)) {
			echo "is Furbished is required";
			die;
		}

		if ($prop_floor == '') {
			echo "Floor is required";
			die;
		}

		if ($prop_total_floors == '') {
			echo "Total floors is required";
			die;
		}

		if ($prop_balcony == '') {
			echo "Total balconies is required";
			die;
		}

		if (empty($prop_state)) {
			echo "State is required";
			die;
		}

		if (empty($prop_city)) {
			echo "City is required";
			die;
		}

		if (empty($prop_address)) {
			echo "Address is required";
			die;
		}

		if (empty($prop_price)) {
			echo "Price is required";
			die;
		}
				if (empty($prop_map)) {
			echo "Map is required";
			die;
		}

		$prop_state_name = getState($prop_state, 'st_name');
		$prop_city_name = getCity($prop_city, 'ct_name');
		$prop_cat_name = getCategory($prop_category);
		$prop_scat_name = getsubCat($prop_sub_category, 'sct_name');

		if (!empty($_FILES['prop_img1']['name'])) {
			$file_get_res = upload_doc('prop_img1', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$prop_img1 = substr($file_get_res, 6);
			}
		} elseif (!empty($old_img)) {
			$prop_img1 = $old_img;
		} else {
			echo "Thumbnail image is required";
			die;
		}

		switch ($what) {
			case 'add_property':
				$this->db->query("INSERT INTO `x_home_property` (`prop_name`, `prop_cat`, `prop_scat`, `prop_rent_sale`, `prop_area`, `prop_bedroom`, `prop_bathroom`, `prop_facing`, `prop_furnished`, `prop_floor`, `prop_total_floors`, `prop_balcony`, `prop_price`, `prop_img1`, `prop_desc`,`prop_state`,`prop_city`,`prop_address`,`prop_state_name`,`prop_city_name`, `prop_cat_name`, `prop_scat_name`,`prop_youtube`,`prop_vendor`,`prop_map`) VALUES ('$prop_name', '$prop_category', '$prop_sub_category', '$prop_rent_sale', '$prop_area', '$prop_bedroom', '$prop_bathroom', '$prop_facing', '$prop_furnished', '$prop_floor', '$prop_total_floors', '$prop_balcony', '$prop_price', '$prop_img1', '$prop_desc', '$prop_state', '$prop_city', '$prop_address', '$prop_state_name', '$prop_city_name', '$prop_cat_name', '$prop_scat_name' , '$prop_youtube','$prop_vendor','$prop_map')");

				$inserted_id = $this->db->insert_id();

				// Amenitiies
				$theAmenities = '';
				if (isset($_POST['prop_amenity_list'])) {
					if (count($prop_amenity_list) > 0) {
						@$theAmenities = @implode(',', $prop_amenity_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theAmenities) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o = '';
						foreach ($allthedetails as $thelists_data) {
							$tgid = $thelists_data['stg_tgid'];
							$thelist_de_19o = $thelist_de_19o . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_amenity`(`pa_prop_id`,`pa_tag_id`) VALUES ('$inserted_id', '$tgid')");
						}
						@$theAmenities = substr($thelist_de_19o, 1);
					}
				}

				// Facilities
				$theFurnish = '';
				if (isset($_POST['prop_furnish_list'])) {
					if (count($prop_furnish_list) > 0) {
						@$theFurnish = @implode(',', $prop_furnish_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theFurnish) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o1098 = '';
						foreach ($allthedetails as $thelists_data) {
							$tfid = $thelists_data['stg_tgid'];
							$thelist_de_19o1098 = $thelist_de_19o1098 . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_furnished`(`pf_prop_id`,`pf_tag_id`) VALUES ('$inserted_id', '$tfid')");
						}
						@$theFurnish = substr($thelist_de_19o1098, 1);
					}
				}

				if ($theFurnish != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_furnish_list='$theFurnish' WHERE `prop_id`='$inserted_id'");
				}

				if ($theAmenities != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_amenity_list='$theAmenities' WHERE `prop_id`='$inserted_id'");
				}

				echo "YNAPS_SUCCESS";
				die;
				break;

			case 'edit_property':
				$this->db->query("UPDATE `x_home_property` SET `prop_name`='$prop_name', `prop_cat`='$prop_category', `prop_scat`='$prop_sub_category', `prop_rent_sale`='$prop_rent_sale', `prop_area`='$prop_area', `prop_bedroom`='$prop_bedroom', `prop_bathroom`='$prop_bathroom', `prop_facing`='$prop_facing', `prop_furnished`='$prop_furnished', `prop_floor`='$prop_floor', `prop_total_floors`='$prop_total_floors', `prop_balcony`='$prop_balcony', `prop_price`='$prop_price', `prop_img1`='$prop_img1', `prop_desc`='$prop_desc', `prop_state`='$prop_state', `prop_city`='$prop_city', `prop_address`='$prop_address', `prop_state_name`='$prop_state_name',`prop_city_name`='$prop_city_name', `prop_cat_name`='$prop_cat_name', `prop_scat_name`='$prop_scat_name' , `prop_youtube`='$prop_youtube' , `prop_vendor`='$prop_vendor' , `prop_map` = '$prop_map' WHERE `prop_id`='$prop_id'");

				$this->db->query("DELETE FROM x_home_prop_amenity WHERE pa_prop_id='$prop_id'");
				$this->db->query("DELETE FROM x_home_prop_furnished WHERE pf_prop_id='$prop_id'");

				// Amenitiies
				$theAmenities = '';
				if (isset($_POST['prop_amenity_list'])) {
					if (count($prop_amenity_list) > 0) {
						@$theAmenities = @implode(',', $prop_amenity_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theAmenities) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o = '';
						foreach ($allthedetails as $thelists_data) {
							$tgid = $thelists_data['stg_tgid'];
							$thelist_de_19o = $thelist_de_19o . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_amenity`(`pa_prop_id`,`pa_tag_id`) VALUES ('$prop_id', '$tgid')");
						}
						@$theAmenities = substr($thelist_de_19o, 1);
					}
				}

				// Facilities
				$theFurnish = '';
				if (isset($_POST['prop_furnish_list'])) {
					if (count($prop_furnish_list) > 0) {
						@$theFurnish = @implode(',', $prop_furnish_list);

						$get_alllists = $this->db->query("select * from yn_site_tags where stg_tgid IN ($theFurnish) ");
						$allthedetails = $get_alllists->result_array();
						$thelist_de_19o1098 = '';
						foreach ($allthedetails as $thelists_data) {
							$tfid = $thelists_data['stg_tgid'];
							$thelist_de_19o1098 = $thelist_de_19o1098 . ',' . $thelists_data['stg_tgid'];

							$this->db->query("INSERT INTO `x_home_prop_furnished`(`pf_prop_id`,`pf_tag_id`) VALUES ('$prop_id', '$tfid')");
						}
						@$theFurnish = substr($thelist_de_19o1098, 1);
					}
				}

				if ($theFurnish != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_furnish_list='$theFurnish' WHERE `prop_id`='$prop_id'");
				}

				if ($theAmenities != '') {
					$this->db->query("UPDATE `x_home_property` SET prop_amenity_list='$theAmenities' WHERE `prop_id`='$prop_id'");
				}
				echo "YNAPS_SUCCESS";
				die;
				break;
		}
	}
}
