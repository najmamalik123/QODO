<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_action extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function login()
	{
		$id = $this->input->post('u');
		$pass0 = $this->input->post('p');
		if ($id != '' && $pass0 != '') {
			$pass = sha1($_POST['p']);
			$getlogins = $this->db->query("select aid,user,pass,last_date,last_ip,rights from yn_admin where user='$id' ");
			$admin_data = $getlogins->row_array();
			$user = $admin_data['user'];
			$pass1 = $admin_data['pass'];

			@$captcha = $this->input->post('g-recaptcha-response');
			$this->load->view('inc/recaptchalib');
			// if (!$captcha) {
			// 	echo 'Please check the the captcha form.';
			// 	die;
			// }
			$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
			// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }

			if ($id == $user  && $pass == $pass1) {
				session_start();
				$_SESSION['auth-admin'] = '1';
				$_SESSION['auth-date'] = $admin_data['last_date'];
				$_SESSION['auth-ip'] = $admin_data['last_ip'];
				$_SESSION['auth-rights'] = $admin_data['rights'];
				$_SESSION['aid'] = $admin_data['aid'];

				redirect(base_url('admin/dash'));
			} else {
				redirect(base_url('admin/index?msg=Login Failed'));
			}
		} else {
			redirect(base_url('admin/index?msg=Login Failed'));
		}
	}

	function license()
	{
		$u = $this->input->post('u');
		$pass = $this->input->post('p');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$ip = $this->input->ip_address();

		if ($email == '') {
			echo 'We need a valid email to verify the license, please do provide one.';
			die;
		}

		@$captcha = $this->input->post('g-recaptcha-response');
		$this->load->view('inc/recaptchalib');
		if (!$captcha) {
			echo 'Please check the the captcha form.';
			die;
		}
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfgnxAUAAAAAD9TwtAKzP0dmqZenOeWb0OMCmrN&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
		// if($response['success'] == false){ echo 'Sorry, Captcha failed !!'; die; }


		$inser_data = $this->db->query("insert into yn_admin_license (li_key,li_start,li_end,li_status,li_domain,li_api_keys,li_name,li_email,li_ip) value ('$pass',now(),'','1','$u','','$name','$email','$ip') ");
		send_data_tonodlys('lic', $name, $email, $u, $pass);
		redirect(base_url('admin/dash?mess=license+Activated.'));
	}

	public function help()
	{
		echo 'ok, please call us at 9034664487';
	}

	public function admin()
	{
		get_admin_rights();
		$name = $this->input->post('name');
		$u = $this->input->post('u');
		$pass = $this->input->post('pass');
		$email = $this->input->post('email');
		$rights = $this->input->post('rights');
		$todo = $this->input->post('todo');
		$p = sha1($pass);
		if ($u != '' && ($pass != '' || $todo != '-1')) {
			if ($todo != '-1') {
				$aid = $todo;
				$checkusername = $this->db->query("select * from yn_admin where user='$u' and aid !='$todo' ");
				if ($checkusername->num_rows() != '0') {
					echo "Please use different username this is not availabe.";
					die;
				} else {
					$update_members = $this->db->query("update yn_admin set user='$u',email='$email',name='$name',rights='$rights' where aid='$aid' ");
					if ($pass != '') {
						$update_members = $this->db->query("update yn_admin set pass='$p' where aid='$aid' ");
					}
					echo 'YNAPS_SUCCESS';
					die;
				}
			} else {
				$checkusername = $this->db->query("select * from yn_admin where user='$u' ");
				if ($checkusername->num_rows() != '0') {
					echo "Please use different username this is not availabe.";
					die;
				} else {
					$adduser_admin = $this->db->query("insert into yn_admin (user,pass,rights,name,email) values ('$u','$p','$rights','$name','$email') ");
					echo 'YNAPS_SUCCESS';
					die;
				}
			}
		} else {
			echo "Please enter username and password.";
			die;
		}
	}

	public function add_tags()
	{
		$name = $this->input->post('name');
		$sort = $this->input->post('sort');
		$display = $this->input->post('display');
		$desc = $this->input->post('desc');
		$theid = $this->input->post('theid');
		$stg_type = $this->input->post('stg_type');
		if (trim($name) == '') {
			echo 'Please enter the tag name.';
			die;
		}

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/tags/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
			}
		} else {
			$cover = '';
		}

		if ($theid != '0' && $theid != '-1') {
			$update_qry = "update yn_site_tags set stg_name='$name'";
			if ($cover != '') {
				$update_qry .= ", stg_img='$cover'";
			}
			$getlogins = $this->db->query("$update_qry where stg_tgid='$theid' ");
		} else {

			$gethecount = $this->db->query("select stg_name from yn_site_tags where stg_name='$name' and stg_type='$stg_type' ");
			if ($gethecount->num_rows() != '0') {
				echo 'Tag with this name already exists please choose another name.';
				die;
			}

			$getlogins = $this->db->query("insert into yn_site_tags (stg_name,stg_type, stg_img) values ('$name','$stg_type', '$cover')");
		}

		echo 'YNAPS_SUCCESS1';
	}


	public function add_cat()
	{
		$name = $this->input->post('name');
		$sort = $this->input->post('sort');
		$display = $this->input->post('display');
		$desc = $this->input->post('desc');
		$link = $this->input->post('link');
		$type = $this->input->post('type');
		$icon = $this->input->post('icon');
		$theid = $this->input->post('theid');
		if (trim($name) == '') {
			echo 'Please enter the catagory name.';
			die;
		}

		$p_brand_img_Append = "";
		$p_brand_img2 		= "";
		if (!empty($_FILES['brand_image']['name'])) {
			$file_get_res5 = upload_doc('brand_image', "assets/avator/upload/", '');
			if (substr($file_get_res5, 0, 6) == 'SUCCXX') {
				$p_brand_img2 = substr($file_get_res5, 6);
				$p_brand_img_Append .= ", img='$p_brand_img2' ";
			} else {
				echo 'Incorrect Catagory Image! ';
			}
		}


		if ($theid != '0' && $theid != '-1') {
			$getlogins = $this->db->query("UPDATE yn_site_catagory set name='$name',sid='$sort',display='$display',`desc`='$desc',link='$link',type='$type' " . $p_brand_img_Append . ",icon='$icon' where ctid='$theid' ");
		} else {

			$gethecount = $this->db->query("select name from yn_site_catagory where name='$name' ");
			if ($gethecount->num_rows() != '0') {
				echo 'Catagory with this name already exists please choose another name.';
				die;
			}

			$getlogins = $this->db->query("INSERT into yn_site_catagory (name,sid,display,img,icon,`desc`,link,type) values ('$name','$sort','$display','$p_brand_img2','$icon','$desc','$link','$type')");
		}
		unset($_SESSION['categories']);

		echo 'YNAPS_SUCCESS';
	}

	public function edit_cat()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$sort = $this->input->post('sort');
		$display = $this->input->post('display');
		$desc = $this->input->post('desc');
		$link = $this->input->post('link');

		if (trim($name) == '') {
			echo 'Please enter the catagory name.';
			die;
		}
		$gethecount = $this->db->query("select name from yn_site_catagory where name='$name' and ctid !='$id' ");
		if ($gethecount->num_rows() != '0') {
			echo 'Catagory with this name already exists please choose another name.';
			die;
		}
		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
				$getlogins = $this->db->query("update yn_site_catagory set img='$cover' where ctid='$id' ");
			}
		}

		$getlogins = $this->db->query("UPDATE yn_site_catagory set name='$name',sid='$sort',display='$display',`desc`='$desc',link='$link' where ctid='$id' ");
		echo 'YNAPS_SUCCESS';
	}

	public function delete_cat()
	{
		$id = $this->input->post('id');
		$getlogins = $this->db->query("delete from yn_site_catagory where ctid='$id'");
		echo 'YNAPS_SUCCESS';
	}



	public function add_sub_cat()
	{
		$name = addslashes($this->input->post('name'));
		$sort = $this->input->post('sort');
		$cat = $this->input->post('cat');
		$desc = addslashes($this->input->post('desc'));
		$theid = addslashes($this->input->post('theid'));

		if (trim($name) == '') {
			echo 'Please enter the sub catagory name.';
			die;
		}
		if (trim($cat) == '') {
			echo 'Please select catagory name.';
			die;
		}
		$gethecount = $this->db->query("select sc_name from yn_site_sub_cat where sc_name='$name' and sc_ctid='$cat' ");
		if ($gethecount->num_rows() != '0') {
			echo 'Sub Catagory with this name already exists in this catagory please choose another name.';
			die;
		}

		if ($theid != '0' && $theid != '-1') {
			$getlogins = $this->db->query("update yn_site_sub_cat set sc_name='$name',sc_sort='$sort',sc_ctid='$cat',sc_text='$desc' where sc_id='$theid' ");
		} else {
			$getlogins = $this->db->query("insert into yn_site_sub_cat (sc_name,sc_ctid,sc_sort,sc_text) values ('$name','$cat','$sort','$desc')");
		}

		echo 'YNAPS_SUCCESS';
	}

	public function edit_sub_cat()
	{
		$id = $this->input->post('id');
		$name = addslashes($this->input->post('name'));
		$sort = $this->input->post('sort');
		$cat = $this->input->post('cat');
		$desc = addslashes($this->input->post('desc'));

		if (trim($name) == '') {
			echo 'Please enter the sub catagory name.';
			die;
		}
		$gethecount = $this->db->query("select sc_name from yn_site_sub_cat where sc_name='$name' and sc_ctid='$cat' and sc_id !='$id' ");
		if ($gethecount->num_rows() != '0') {
			echo 'sub Catagory with this name already exists in this catagory please choose another name.';
			die;
		}
		$getlogins = $this->db->query("update yn_site_sub_cat set sc_name='$name',sc_sort='$sort',sc_ctid='$cat',sc_text='$desc' where sc_id='$id' ");
		echo 'YNAPS_SUCCESS';
	}

	public function delete_sub_cat()
	{
		$id = $this->input->post('id');
		$getlogins = $this->db->query("delete from yn_site_sub_cat where sc_id='$id'");
		echo 'YNAPS_SUCCESS';
	}
	public function add_sub_cat2()
	{
		$name = $this->input->post('name');
		$sort = $this->input->post('sort');
		@$cat = $this->input->post('cat');
		$scat = $this->input->post('scat');

		if (trim($name) == '' || $scat == '') {
			echo 'Please enter the sub catagory name.';
			die;
		}
		// if(trim($cat) ==''){
		// 	echo 'Please select catagory name.'; die;
		// }
		$gethecount = $this->db->query("select mr_sub2_name from 	yn_site_sub2_cat where mr_sub2_name='$name' and mr_sub2_sid='$scat' ");
		if ($gethecount->num_rows() != '0') {
			echo 'Sub Catagory with this name already exists in this catagory please choose another name.';
			die;
		}
		$getlogins = $this->db->query("insert into 	yn_site_sub2_cat (mr_sub2_cid,mr_sub2_sid,mr_sub2_name,mr_sub2_sort) values ('$cat','$scat','$name','$sort')");
		echo 'YNAPS_SUCCESS';
	}

	public function edit_sub_cat2()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$sort = $this->input->post('sort');
		$cat = $this->input->post('cat');
		$scat = $this->input->post('scat');

		if (trim($name) == '') {
			echo 'Please enter the sub catagory name.';
			die;
		}
		$gethecount = $this->db->query("select yn_site_sub2_cat_name from yn_site_sub2_cat where yn_site_sub2_cat_name='$name' and yn_site_sub2_cat_sid='$scat' ");
		if ($gethecount->num_rows() != '0') {
			echo 'sub Catagory with this name already exists in this catagory please choose another name.';
			die;
		}
		$getlogins = $this->db->query("update yn_site_sub2_cat set yn_site_sub2_cat_name='$name',yn_site_sub2_cat_sort='$sort',yn_site_sub2_cat_sid='$scat' where yn_site_sub2_cat_id='$id' ");
		echo 'YNAPS_SUCCESS';
	}

	public function delete_sub_cat2()
	{
		$id = $this->input->post('id');
		$getlogins = $this->db->query("delete from yn_site_sub2_cat where yn_site_sub2_cat_id='$id'");
		echo 'YNAPS_SUCCESS';
	}


	// Add sliders etc
	function add_image()
	{
		@$what = $this->input->post('what');
		@$link = addslashes($this->input->post('link'));
		@$sort = $this->input->post('sort');
		@$text = addslashes($this->input->post('text'));
		@$ex = $this->input->post('ex');
		@$head = $this->input->post('head');
		@$typename = $this->input->post('typename');
		@$img_text2 = $this->input->post('img_text2');
		switch ($what) {
			case 'logo':
				switch ($ex) {
					case 'w':
						$file_name_tye = 'logo.png';
						break;
					case 'b':
						$file_name_tye = 'logo_light.png';
						break;
					case 'f':
						$file_name_tye = 'favicon.png';
						break;
					case 'og':
						$file_name_tye = 'og_image.png';
						break;
					case 'sm':
						$file_name_tye = 'sitemap.xml';
						break;
					case 'rb':
						$file_name_tye = 'robot.txt';
						break;
				}

				if (!empty($_FILES['file_name']['name'])) {
					if ($ex != 'sm' && $ex != 'rb') {
						$file_get_res = upload_doc('file_name', "assets/avator/", '', "$file_name_tye");
					} else {
						$file_get_res = upload_doc('file_name', "assets/", '', "$file_name_tye");
					}

					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
			case 'slider1':
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("insert into yn_site_img (img_place,img_link,img_name,img_sort,img_text,img_ex) values ('$what','$link','$cover','$sort','$text','$ex')");
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
			case 'about':
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("insert into yn_site_img (img_place,img_link,img_name,img_sort,img_text,img_ex,img_head) values ('$what','$link','$cover','$sort','$text','$ex','$head')");
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
			case 'partner':
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("insert into yn_site_img (img_place,img_link,img_name,img_sort,img_text,img_ex,img_head) values ('$what','$link','$cover','$sort','$text','$ex','$head')");
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
			default:
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("insert into yn_site_img (img_place,img_link,img_name,img_sort,img_text,img_ex,img_head,img_text2) values ('$typename','$link','$cover','$sort','$text','$ex','$head','$img_text2')");
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
		}
	}

	function edit_image()
	{
		$id = $this->input->post('imageid');
		$what = $this->input->post('what');
		$link = addslashes($this->input->post('link'));
		$sort = $this->input->post('sort');
		$text = addslashes($this->input->post('text'));
		$img_text2 = addslashes($this->input->post('img_text2'));

		@$head = $this->input->post('head');
		// @$typename=$this->input->post('typename');

		if (!empty($_FILES['file_name']['name'])) {
			$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
				$getlogins = $this->db->query("update yn_site_img set img_link='$link',img_name='$cover',img_sort='$sort',img_text='$text' where img_id='$id'");
				echo 'YNAPS_SUCCESS';
				die;
			}
		} else {
			$getlogins = $this->db->query("update yn_site_img set img_link='$link',img_sort='$sort',img_text='$text',img_head='$head',img_text2='$img_text2' where img_id='$id'");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	function site_blog()
	{
		@$what = $this->input->post('what');
		@$comment = addslashes($this->input->post('comment'));
		// if(str_word_count($comment) < 150 ){echo "The blog content should be atleast 150 words long."; die;}
		@$scomment = addslashes($this->input->post('scomment'));
		@$title = addslashes($this->input->post('title'));
		@$types = $this->input->post('types');
		@$blogid = $this->input->post('blogid');
		@$blog_link = $this->input->post('blog_link');
		@$till_date = $this->input->post('till_date');

		@$cat = $this->input->post('cat');
		@$slug = $this->input->post('slug');
		@$tags = $this->input->post('tags');
		@$cta = $this->input->post('cta');

		if ($slug == '') {
			$slug = $title;
		}
		$slug = url_smart($slug);

		$ip = $this->input->ip_address();
		if ($title != '' && $comment != '') {
			switch ($what) {
				case 'add_blog':

					$check_sliud = $this->db->query("select title from yn_site_blogs where slug='$slug' ");
					if ($check_sliud->num_rows() != 0) {
						echo 'The Slug entered is not unique please enter a unique slug, if you di not entered anything please enter something unique. :) #ERADSE1';
						die;
					}

					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("insert into yn_site_blogs (title,scomment,comment,blog_time,blog_ip,blog_img,blog_link,blog_type,blog_till_date,cat,slug,tags,cta) values ('$title','$scomment','$comment',now(),'$ip','$cover','$blog_link','$types','$till_date','$cat','$slug','$tags','$cta')");
							echo 'YNAPS_SUCCESS';
							die;
						}
					} else {
						echo 'Please select the image';
					}
					break;
				case 'edit_blog':

					$check_sliud = $this->db->query("select title from yn_site_blogs where slug='$slug' and blog_id !='$blogid' ");
					if ($check_sliud->num_rows() != 0) {
						echo 'The Slug entered is not unique please enter a unique slug, if you di not entered anything please enter something unique. :) #ERADSE1';
						die;
					}

					$cover = '';
					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("update yn_site_blogs set title='$title',scomment='$scomment',comment='$comment ',blog_img='$cover',blog_link='$blog_link',blog_till_date='$till_date' where blog_id='$blogid'");
						}
					}
					$getlogins = $this->db->query("update yn_site_blogs set title='$title',scomment='$scomment',comment='$comment',blog_link='$blog_link',cat='$cat',slug='$slug',tags='$tags',cta='$cta' where blog_id='$blogid'");
					echo 'YNAPS_SUCCESS';
					die;
					break;
			}
		} //if
	}



	function services()
	{
		@$what = $this->input->post('what');
		@$price = $this->input->post('price');
		@$scomment = addslashes($this->input->post('scomment'));
		@$name = addslashes($this->input->post('name'));
		@$service_id = $this->input->post('service_id');
		@$meta_desc = addslashes($this->input->post('meta_desc'));
		@$cat_id = $this->input->post('service_category');
		@$slug = $this->input->post('slug');
		@$service_order = $this->input->post('service_order');
		@$ser_class = $this->input->post('ser_class');

		if ($slug == '') {
			$slug = $name;
		}
		$slug = url_smart($slug);
		if ($name != '' && $scomment != '') {
			switch ($what) {
				case 'add_services':

					$check_sliud = $this->db->query("select service_id from yn_site_services where slug='$slug' ");
					if ($check_sliud->num_rows() != 0) {
						echo 'The Slug entered is not unique please enter a unique slug, if you di not entered anything please enter something unique. :) #ERADSE1';
						die;
					}


					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("insert into `yn_site_services` (service_name,price,service_image,service_description,service_meta_desc,category,slug,ser_class,service_order) values ('$name','$price','$cover','$scomment', '$meta_desc','$cat_id','$slug','$ser_class','$service_order')");
							echo 'YNAPS_SUCCESS';
							die;
						}
					} else {
						echo 'Please select the image';
					}
					break;
				case 'edit_services':
					$cover = '';
					if (!empty($_FILES['file_name']['name'])) {
						$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$cover = substr($file_get_res, 6);
							$getlogins = $this->db->query("update `yn_site_services` set service_name='$name',price='$price',service_image='$cover',service_description='$scomment' , service_meta_desc='$meta_desc',category='$cat_id' where service_id='$service_id'");
						}
					}

					$check_sliud = $this->db->query("select service_id from yn_site_services where slug='$slug' and service_id !='$service_id' ");
					if ($check_sliud->num_rows() != 0) {
						echo 'The Slug entered is not unique please enter a unique slug, if you di not entered anything please enter something unique. :) #ERADSE1';
						die;
					}

					$getlogins = $this->db->query("update `yn_site_services` set service_name='$name',price='$price',service_description='$scomment' , service_meta_desc='$meta_desc',category='$cat_id',slug='$slug',ser_class='$ser_class',service_order='$service_order' where service_id='$service_id'");
					echo 'YNAPS_SUCCESS';
					die;
					break;
			}
		} else {
			echo 'Please enter Service name and desc #ERADSE02';
		}
	}

	function sm()
	{
		get_admin_rights();
		$fb = $this->input->post('fb');
		$tw = $this->input->post('tw');
		$yt = $this->input->post('yt');
		$vi = $this->input->post('vi');
		$blog = $this->input->post('blog');
		$linkedin = $this->input->post('linkedin');
		$insta = $this->input->post('insta');

		$pint = $this->input->post('pint');
		$telegram = $this->input->post('telegram');

		$getlogins = $this->db->query("update yn_admin_socialm set fb='$fb',tw='$tw',yt='$yt',vimeo='$vi',insta='$insta',blog='$blog',linkedin='$linkedin',telegram='$telegram',pint='$pint' ");
		echo 'YNAPS_SUCCESS';
	}



	function app()
	{
		get_admin_rights();
		$ios = $this->input->post('ios');
		$and = $this->input->post('and');
		$getlogins = $this->db->query("update yn_admin_socialm set app_and='$and',app_ios='$ios'");
		echo 'YNAPS_SUCCESS';
	}

	function google()
	{
		$step = $this->input->post('step');
		switch ($step) {
			case '1':
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$add = $this->input->post('add');
				$web = $this->input->post('web');

				$web_url = $this->input->post('web_url');
				$comp_name = $this->input->post('comp_name');
				$tax = $this->input->post('tax');
				$phone2 = $this->input->post('phone2');

				if ($name != '' && $email != '' && $phone != '') {
					$update_admins = $this->db->query("update yn_admin_files set founder='$name',email='$email',phone='$phone',address='$add',name='$web',phone2='$phone2',tax='$tax',comp_name='$comp_name',web_url='$web_url' where asid='1' ");
				} else {
					echo 'please enter name , email and phone';
					die;
				}
				echo 'YNAPS_SUCCESS';

				break;

			case '1.1':
				$map = addslashes($this->input->post('map'));

				if ($map != '') {
					$update_admins = $this->db->query("update yn_admin_files set map='$map' where asid='1' ");
				} else {
					echo 'Please enter Map code.';
					die;
				}
				echo 'YNAPS_SUCCESS';

				break;

			case '2':
				$about = addslashes($this->input->post('about'));
				$brief = clean(addslashes($this->input->post('brief')));

				$meta_title = $this->input->post('meta_title');
				$meta_desc = $this->input->post('meta_desc');
				$meta_key = $this->input->post('meta_key');
				$meta_image = $this->input->post('meta_image');
				$home_page = $this->input->post('home_page');

				if ($brief != '') {
					$update_admins = $this->db->query("update yn_admin_files set brief='$brief',meta_title='$meta_title',meta_desc='$meta_desc',meta_key='$meta_key',home_page='$home_page' where asid='1' ");

					// $update_admins = $this->db->query("update yn_admin_pages set content='$about' where name='about' ");

				} else {
					echo 'Please enter All details';
					die;
				}
				echo 'YNAPS_SUCCESS';

				break;

			case '3':
				$ga = addslashes($this->input->post('ga'));
				$ad = addslashes($this->input->post('ad'));
				$map = addslashes($this->input->post('map'));
				$f = addslashes($this->input->post('f'));
				$f2 = addslashes($this->input->post('f2'));
				$chat = addslashes($this->input->post('chat'));
				$update_admins = $this->db->query("update yn_admin_files set ga='$ga',ad='$ad',map='$map',f='$f',f2='$f2',chat='$chat' where asid='1' ");
				echo 'YNAPS_SUCCESS';

				break;
		}
	}

	function add_testimonials()
	{
		get_admin_rights();
		$todo = $this->input->post('todo');
		$name = $this->input->post('name');
		$desi = $this->input->post('desi');
		$company = $this->input->post('company');
		$text = addslashes($this->input->post('text'));
		$order = $this->input->post('order');
		$star = $this->input->post('star');

		if ($todo != '-1') {
			@$cvr_prf = $_FILES['image_name']['name'];
			if ($cvr_prf != '') {
				$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$NewImageName = substr($file_get_res, 6);
					$addtesti = $this->db->query("update yn_admin_testimonials set image='$NewImageName'where tid='$todo'  ");
				}
			}
			$addtesti = $this->db->query("update yn_admin_testimonials set name='$name',role='$desi',company='$company',text='$text',li='$order',star='$star' where tid='$todo' ");
			echo 'YNAPS_SUCCESS';
			die;
		} else {
			$cvr_prf = $_FILES['image_name']['name'];
			$NewImageName = '';
			$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$NewImageName = substr($file_get_res, 6);
			}

			$addtesti = $this->db->query("insert into yn_admin_testimonials (name,image,role,company,text,li,star) values ('$name','$NewImageName','$desi','$company','$text','$order','$star')");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	function add_gallery()
	{
		get_admin_rights();
		$todo = $this->input->post('todo');
		$name = $this->input->post('ygl_name');
		$tags = $this->input->post('ygl_tags');
		$NewImageName = $this->input->post('image_name');


		// if ($todo != '-1') {
		// 	@$cvr_prf = $_FILES['image_name']['name'];
		// 	if ($cvr_prf != '') {
		// 		$file_get_res = upload_doc('image_name', "assets/avator/upload/", '');
		// 		if (substr($file_get_res, 0, 6) == 'SUCCXX') {
		// 			$NewImageName = substr($file_get_res, 6);
		// $addtesti = $this->db->query("update yn_site_gallery set ygl_img='$NewImageName'where ygl_id='$todo'  ");
		// 	}
		// }
		// $addtesti = $this->db->query("update yn_site_gallery set ygl_name='$name' where ygl_id='$todo' ");
		// echo 'YNAPS_SUCCESS';
		// 	die;
		// } else {
		// 	$cvr_prf = $_FILES['image_name']['name'];
		// 	$NewImageName = '';
		// 	$file_get_res = upload_doc('image_name', "assets/avator/upload/", '');
		// 	if (substr($file_get_res, 0, 6) == 'SUCCXX') {
		// 		$NewImageName = substr($file_get_res, 6);
		// 	}

		$addtesti = $this->db->query("insert into yn_site_gallery (ygl_name,ygl_img,ygl_tags) values ('$name','$NewImageName','$tags')");
		echo 'YNAPS_SUCCESS';
		die;
		// 	redirect($_SERVER['HTTP_REFERER']);
		// }
	}

	function edit_testimonials()
	{
		get_admin_rights();
		$name = $this->input->post('name');
		$desi = $this->input->post('desi');
		$company = $this->input->post('company');
		$text = addslashes($this->input->post('text'));
		$order = $this->input->post('order');
		$id = $this->input->post('id');

		if ($text == '') {
			$addtesti = $this->db->query("delete from yn_admin_testimonials where tid='$id' ");
			redirect($_SERVER['HTTP_REFERER']);
		}

		$cvr_prf = $_FILES['image_name']['name'];
		if ($cvr_prf != '') {
			$file_get_res = upload_doc('image_name', "assets/avator/webimg/t/", '');
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$NewImageName = substr($file_get_res, 6);
				$addtesti = $this->db->query("update yn_admin_testimonials set image='$NewImageName' ");
			}
		}
		$addtesti = $this->db->query("update yn_admin_testimonials set name='$name',role='$desi',company='$company',text='$text',li='$order' where tid='$id' ");
		redirect($_SERVER['HTTP_REFERER']);
	}



	function add_prop_images()
	{
		@$what = $this->input->post('what');
		@$p_id_up			= $this->input->post('p_id');
		// $proID = $this->input->post('proID')

		switch ($what) {
			case 'add_prop_images':

				if (!empty($_FILES['p_image1']['name'])) {

					$p_img1 = "";
					$appendQry = "";
					if (!empty($_FILES['p_image1']['name'])) {
						$file_get_res = upload_doc('p_image1', "assets/avator/upload/", '69');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$p_img1 = substr($file_get_res, 6);
							// $appendQry .= ",p_image1 = '$p_img1' ";
						} else {
							echo 'Incorrect Product Image 1';
							echo 'error1';
							die;
						}
					}

					$getlogins = $this->db->query(" INSERT `x_home_prop_images`
						SET `pi_prop_id` = '$p_id_up', `pi_img_name` = '$p_img1' , `pi_img_status` = '1' ");
					echo 'YNAPS_SUCCESS';
					die;
				}
				break;
			case 'edit_prop_images':

				$pid = $this->input->post('p_id');

				if (!empty($_FILES['p_image1']['name'])) {

					$p_img1 = "";
					$appendQry = "";
					if (!empty($_FILES['p_image1']['name'])) {
						$file_get_res = uploadonlyimage('p_image1', "assets/avator/upload/", '69');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$p_img1 = substr($file_get_res, 6);
							// $appendQry .= ",p_image1 = '$p_img1' ";
						} else {
							echo 'Incorrect Product Image 1';
							echo 'error1';
						}
					}

					$getlogins = $this->db->query("UPDATE  x_home_prop_images set pi_prop_id='$pid',img='$p_img1' where id='$p_id_up' ");
					echo 'YNAPS_SUCCESS';
					die;
				}
				break;
		}
		if (!empty($_FILES['p_image1']['name'])) {

			$p_img1 = "";
			$appendQry = "";
			if (!empty($_FILES['p_image1']['name'])) {
				$file_get_res = uploadonlyimage('p_image1', "assets/avator/upload/prod/", '69');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$p_img1 = substr($file_get_res, 6);
					// $appendQry .= ",p_image1 = '$p_img1' ";
				} else {
					echo 'Incorrect Product Image 1';
					echo 'error1';
				}
			}

			$getlogins = $this->db->query(" INSERT `yn_ecom_products_img`
						SET `pid` = '$pid', `img` = '$p_img1';");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	function add_product_images()
	{
		@$what = $this->input->post('what');
		@$p_id_up			= $this->input->post('pid');
		// $proID = $this->input->post('proID')

		switch ($what) {
			case 'add_product_images':

				if (!empty($_FILES['p_image1']['name'])) {

					$p_img1 = "";
					$appendQry = "";
					if (!empty($_FILES['p_image1']['name'])) {
						$file_get_res = upload_doc('p_image1', "assets/avator/upload/", '69');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$p_img1 = substr($file_get_res, 6);
							// $appendQry .= ",p_image1 = '$p_img1' ";
						} else {
							echo 'Incorrect Product Image 1';
							echo 'error1';
							die;
						}
					}

					$getlogins = $this->db->query(" INSERT `yn_ecom_products_img`
						SET `pid` = '$p_id_up', `img` = '$p_img1';");
					echo 'YNAPS_SUCCESS';
					die;
				}
				break;
			case 'edit_product_images':

				$pid = $this->input->post('p_id');

				if (!empty($_FILES['p_image1']['name'])) {

					$p_img1 = "";
					$appendQry = "";
					if (!empty($_FILES['p_image1']['name'])) {
						$file_get_res = uploadonlyimage('p_image1', "assets/avator/upload/", '69');
						if (substr($file_get_res, 0, 6) == 'SUCCXX') {
							$p_img1 = substr($file_get_res, 6);
							// $appendQry .= ",p_image1 = '$p_img1' ";
						} else {
							echo 'Incorrect Product Image 1';
							echo 'error1';
						}
					}

					$getlogins = $this->db->query("UPDATE  yn_ecom_products_img set pid='$pid',img='$p_img1' where id='$p_id_up' ");
					echo 'YNAPS_SUCCESS';
					die;
				}
				break;
		}
		if (!empty($_FILES['p_image1']['name'])) {

			$p_img1 = "";
			$appendQry = "";
			if (!empty($_FILES['p_image1']['name'])) {
				$file_get_res = uploadonlyimage('p_image1', "assets/avator/upload/prod/", '69');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$p_img1 = substr($file_get_res, 6);
					// $appendQry .= ",p_image1 = '$p_img1' ";
				} else {
					echo 'Incorrect Product Image 1';
					echo 'error1';
				}
			}

			$getlogins = $this->db->query(" INSERT `yn_ecom_products_img`
						SET `pid` = '$pid', `img` = '$p_img1';");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	function manage_prod()
	{
		$imgid = $_GET['imgid'];
		$pid = $_GET['pid'];

		if ($imgid != '' && $pid != '') {
			$update_data = $this->db->query("update yn_ecom_products set p_cover='$imgid' where p_id='$pid' ");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function edit_product_images($id)
	{
		$pid = $this->input->post('p_id');

		if (!empty($_FILES['p_image1']['name'])) {

			$p_img1 = "";
			$appendQry = "";
			if (!empty($_FILES['p_image1']['name'])) {
				$file_get_res = uploadonlyimage('p_image1', "assets/avator/upload/prod/", '69');
				if (substr($file_get_res, 0, 6) == 'SUCCXX') {
					$p_img1 = substr($file_get_res, 6);
					// $appendQry .= ",p_image1 = '$p_img1' ";
				} else {
					echo 'Incorrect Product Image 1';
					echo 'error1';
				}
			}

			$getlogins = $this->db->query("UPDATE  yn_ecom_products_img set pid='$pid',img='$p_img1' where id='$id' ");
			echo 'YNAPS_SUCCESS';
			die;
		}
	}

	// Product Top Trend
	function product_deal()
	{
		get_admin_rights();
		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {

				case 'make_feature':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='2' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'make_populer':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='3' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'make_day_deal':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='4' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'make_top_sale':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='5' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;


				case 'make_feature_product_add':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='1' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'make_feature_product_remove':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_sale_status='0' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'add_to_slider':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_slider_status='1' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'remove_from_slider':
					$upadtsspost = $this->db->query("UPDATE `yn_ecom_products`set p_slider_status='0' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				default:
					break;
			}
		} else {
			redirect(base_url('logout'));
		}
	}




	function feature()
	{

		get_admin_rights();

		$op = $this->input->post('what');
		$id = $this->input->post('id');

		switch ($op) {
			case 'add_feature':

				$pf_vehicle = $this->input->post('vehicle');
				$pf_model = $this->input->post('model');
				$pf_year = $this->input->post('year');
				$pf_fuel = $this->input->post('fuel');


				$insert_query = "INSERT INTO yn_prod_feature ( pf_vehicle, pf_model, pf_year, pf_fuel) VALUES ( '$pf_vehicle', '$pf_model', '$pf_year', '$pf_fuel')";
				$insert_result = $this->db->query($insert_query);

				if ($insert_result) {
					echo 'YNAPS_SUCCESS';
					die;
				}

				break;


			case 'edit_feature':

				$pf_vehicle = $this->input->post('vehicle');
				$pf_model = $this->input->post('model');
				$pf_year = $this->input->post('year');
				$pf_fuel = $this->input->post('fuel');


				$update_query = "UPDATE yn_prod_feature SET pf_vehicle='$pf_vehicle', pf_model='$pf_model', pf_year='$pf_year', pf_fuel='$pf_fuel' WHERE pf_id='$id'";

				$update_result = $this->db->query($update_query);

				if ($update_result) {
					echo 'YNAPS_SUCCESS';
					die;
				}

				break;

			default:

				echo "Not matched";
		}
	}





	function coupon()

	{

		get_admin_rights();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
		// $this->form_validation->set_rules('coupon_desc', 'Description', 'required');
		$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required');
		$this->form_validation->set_rules('min_ord_amount', 'Min Order Amount', 'required');
		$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required');
		$this->form_validation->set_rules('discount_percent', 'Discount Percentage', 'required');
		// $this->form_validation->set_rules('start_date', 'Start Date', 'required');
		// $this->form_validation->set_rules('end_date', 'Expiry Date', 'required');
		// $this->form_validation->set_rules('coupon_limit', 'Coupon Limit', 'required');
		// $this->form_validation->set_rules('coupon_valid_for', 'Coupon Use Type', 'required');
		$op = $this->input->post('what');
		$id = $this->input->post('id');

		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			if (strpos($_SERVER['HTTP_REFERER'], '?') !== false) {
				$add = '&msg=success';
			} else {
				$add = '?msg=success';
			}
			if ($this->form_validation->run()) {
				switch ($op) {
					case 'add_coupon':
						$coupon_code = $this->input->post('coupon_code');
						$coupon_desc = $this->input->post('coupon_desc');
						$coupon_type = $this->input->post('coupon_type');
						$min_ord_amount = $this->input->post('min_ord_amount');
						$discount_amount = $this->input->post('discount_amount');
						$discount_percent = $this->input->post('discount_percent');
						$max_discount = $this->input->post('max_discount');
						$coupon_plan_id = $this->input->post('coupon_plan_id');
						$start_date = $this->input->post('start_date');
						$end_date = $this->input->post('end_date');
						$coupon_limit = $this->input->post('coupon_limit');
						$coupon_valid_for = $this->input->post('coupon_valid_for');

						$upadtsspost = $this->db->query("INSERT INTO yn_ecom_coupon  (`coupon_code`,`coupon_desc`,`coupon_type`,`min_ord_amount`,`discount_amount`,`discount_percent`,`max_discount`,`coupon_plan_id`,`coupon_plan_name`,`start_date`,`end_date`,`coupon_limit`,`coupon_valid_for`) VALUE ('$coupon_code','$coupon_desc','$coupon_type','$min_ord_amount','$discount_amount','$discount_percent','$max_discount','$coupon_plan_id','','$start_date','$end_date','$coupon_limit','$coupon_valid_for') ");
						echo 'YNAPS_SUCCESS';
						die;
						redirect($_SERVER['HTTP_REFERER'] . $add);
						break;

					case 'edit_coupon':
						$coupon_code = $this->input->post('coupon_code');
						$coupon_desc = $this->input->post('coupon_desc');
						$coupon_type = $this->input->post('coupon_type');
						$min_ord_amount = $this->input->post('min_ord_amount');
						$discount_amount = $this->input->post('discount_amount');
						$discount_percent = $this->input->post('discount_percent');
						$max_discount = $this->input->post('max_discount');
						$coupon_plan_id = $this->input->post('coupon_plan_id');
						$start_date = $this->input->post('start_date');
						$end_date = $this->input->post('end_date');
						$coupon_limit = $this->input->post('coupon_limit');
						$coupon_valid_for = $this->input->post('coupon_valid_for');

						$upadtsspost = $this->db->query("UPDATE yn_ecom_coupon  SET `coupon_code`='$coupon_code',`coupon_desc`='$coupon_desc',`coupon_type`='$coupon_type',`min_ord_amount`='$min_ord_amount',`discount_amount`='$discount_amount',`discount_percent`='$discount_percent',`max_discount`='$max_discount',`coupon_plan_id`='$coupon_plan_id',`coupon_plan_name`='',`start_date`='$start_date',`end_date`='$end_date',`coupon_limit`='$coupon_limit',`coupon_valid_for`='$coupon_valid_for' WHERE coupon_id = '$id'");

						echo 'YNAPS_SUCCESS';

						die;

						redirect($_SERVER['HTTP_REFERER'] . $add);

						break;



					default:

						echo "Not matched";
				}
			} else {
				echo 'Please Enter all the requred fields';
				die;
			}
		}
	}

	function user_modify()
	{
		get_admin_rights();
		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		$course_id = $this->input->GET('course_id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {
				case 'verify_user':
					$upadtsspost = $this->db->query("update yn_site_mem set user_status='9' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'active_user':
					$upadtsspost = $this->db->query("update yn_site_mem set user_status='1' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'make_vendor':
					$upadtsspost = $this->db->query("update yn_site_mem set is_vendor='1' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'remove_vendor':
					$upadtsspost = $this->db->query("update yn_site_mem set is_vendor='0' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'ban_user':
					$upadtsspost = $this->db->query("update yn_site_mem set user_status='2' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'active_data_v':
					$upadtsspost = $this->db->query("update x_cou_datav set dtv_status='0' ");
					$upadtsspost = $this->db->query("update x_cou_datav set dtv_status='1' where dtv_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'active_data_v2':
					$upadtsspost = $this->db->query("update yn_site_mem set user_status='2' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'reset_pass':
					$rand = rand(11111111, 9999999);
					$pass = sha1($rand);
					$upadtsspost = $this->db->query("update yn_site_mem set pass_nc='$rand',pass='$pass' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'attended':
					$upadtsspost = $this->db->query("update yn_site_contact set l_status='1' where msid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'attneed':
					$upadtsspost = $this->db->query("update yn_site_contact set l_status='2' where msid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'approve_tm':
					$upadtsspost = $this->db->query("update yn_admin_testimonials set status='1' where tid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'pending_tm':
					$upadtsspost = $this->db->query("update yn_admin_testimonials set status='0' where tid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'rating_done':
					$upadtsspost = $this->db->query("update x_edu_course_review set cr_status='1' where crid='$id'");
					$this->db->select('AVG(cr_rating)');
					$this->db->where('cr_status', 1);
					$result = $this->db->get('x_edu_course_review')->row_array();
					// print_r($result);
					// die;
					$dataImplode = implode(" ", $result);
					$this->db->query("UPDATE `x_edu_courses` SET `course_rating`= '$dataImplode' WHERE `course_id` = '$course_id'");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'rating_undone':
					$upadtsspost = $this->db->query("update x_edu_course_review set cr_status='0' where crid='$id'");
					$this->db->select('AVG(cr_rating)');
					$this->db->where('cr_status', 1);
					$result = $this->db->get('x_edu_course_review')->row_array();
					// print_r($result);
					// die;
					$dataImplode = implode(" ", $result);
					$this->db->query("UPDATE `x_edu_courses` SET `course_rating`= '$dataImplode' WHERE `course_id` = '$course_id'");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				default:

					break;
			}
		} else {
			redirect(base_url('logout'));
		}
	}

	function delete()
	{
		$id = $_GET['id'];
		$what = $_GET['what'];

		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > 3) {
			switch ($what) {

				case 'post':
					$del_datas = $this->db->query("delete from x_posts where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'feature':
					$del_datas = $this->db->query("delete from yn_prod_feature where pf_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'adm':
					$del_datas = $this->db->query("delete from yn_admin where aid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'navig':
					$del_datas = $this->db->query("delete from yn_site_nav where nv_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'image_galls':
					$del_datas = $this->db->query("delete from yn_site_gallery where ygl_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'fl1':
					$del_datas = $this->db->query("delete from u_flavours where fl_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'navifiel':
					$del_datas = $this->db->query("delete from yn_site_nav_items where nv_imid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'locality':
					$del_datas = $this->db->query("delete from yn_site_locality where loc_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'intrest':
					$del_datas = $this->db->query("delete from `x-intrested-clients` where id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'theme':
					$del_datas = $this->db->query("delete from `yn_site_theme` where thm_id='$id' ");

					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'msg':
					$del_datas = $this->db->query("delete from yn_site_contact where msid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'rating':
					$del_datas = $this->db->query("delete from x_edu_course_review where crid='$id' ");
					$this->db->select('AVG(cr_rating)');
					$this->db->where('cr_status', 1);
					$result = $this->db->get('x_edu_course_review')->row_array();
					// print_r($result);
					// die;
					$dataImplode = implode(" ", $result);
					$this->db->query("UPDATE `x_home_property` SET `prop_rating`= '$dataImplode' WHERE `prop_id` = '$prop_id'");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'provid':
					$del_datas = $this->db->query("delete from x_cou_prov where pr_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'clb':
					$del_datas = $this->db->query("delete from site_callback where clid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'images':
					$del_datas = $this->db->query("delete from yn_ecom_products_img where id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'order':
					$del_datas = $this->db->query("delete from yn_ecom_order where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'subs':
					$del_datas = $this->db->query("delete from yn_site_subscribe where sbc_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'faq':
					$del_datas = $this->db->query("delete from yn_site_faq where faq_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
				case 'tags':
					$del_datas = $this->db->query("delete from yn_site_tags where stg_tgid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'widget':
					$del_datas = $this->db->query("delete from yn_widgets where wd_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'cats':
					$del_datas = $this->db->query("delete from yn_site_catagory where ctid='$id' ");

					// Check Subcategories of this id
					$checkSubCatOfCat = $this->db->query("SELECT sc_id FROM yn_site_sub_cat WHERE sc_ctid = '$id'");
					if ($checkSubCatOfCat->num_rows > 0) {
						$del_datas = $this->db->query("delete from yn_site_sub_cat where sc_ctid='$id' ");
					}

					// Check Sub-subcategories of this id
					$checkSubSubCatOfCat = $this->db->query("SELECT mr_sub2_id FROM yn_site_sub2_cat WHERE mr_sub2_cid = '$id'");
					if ($checkSubSubCatOfCat->num_rows > 0) {
						$del_datas = $this->db->query("delete from yn_site_sub2_cat where mr_sub2_cid='$id' ");
					}
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'product':
					$del_datas = $this->db->query("delete from yn_ecom_products where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'scat2':
					$del_datas = $this->db->query("delete from yn_site_sub2_cat where mr_sub2_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'csats':
					$del_datas = $this->db->query("delete from yn_site_sub_cat where sc_id='$id' ");
					$checkSubSubCatOf_subCat = $this->db->query("SELECT mr_sub2_id FROM yn_site_sub2_cat WHERE mr_sub2_sid = '$id'");
					if ($checkSubSubCatOf_subCat->num_rows > 0) {
						$del_datas = $this->db->query("delete from yn_site_sub2_cat where mr_sub2_sid='$id' ");
					}
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'user':
					$del_datas = $this->db->query("delete from yn_site_mem where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'tst':
					$del_datas = $this->db->query("delete from yn_admin_testimonials where tid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'img':
					$del_datas = $this->db->query("delete from yn_site_img where img_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'prop-img':
					$del_datas = $this->db->query("delete from x_home_prop_images where pi_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'block_co':
					$del_datas = $this->db->query("delete from yn_admin_pages where pid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'course_data':
					$del_datas = $this->db->query("delete from x_cou_courses where cou_version='$id' ");
					$del_datas = $this->db->query("delete from x_cou_datav where dtv_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'blog':
					$del_datas = $this->db->query("delete from yn_site_blogs where blog_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'service':
					$del_datas = $this->db->query("delete from `yn_site_services` where service_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'adm':
					$check_last_admin = $this->db->query("select aid from yn_admin");
					if ($check_last_admin->num_rows() != '1') {
						$this->db->query("delete from yn_admin where aid='$id' ");
						$referer = $_SERVER['HTTP_REFERER'];
						if (strpos($referer, '?') !== false) {
							$referer .= '&msg=success';
						} else {
							$referer .= '?msg=success';
						}
						header('Location: ' . $referer);
					} else {
						echo "This is the last Admin you cant delete this.";
						die;
					}
					break;
			}
		} else {
			// redirect(base_url('logout'));

			echo 'Seems Like you do not have such authority, Please Get Edit rights by Admin.';
			die;
		}
	}

	function page_data()
	{
		get_admin_rights();
		$text = addslashes($this->input->post('text'));
		// $page = $this->input->post('page');
		$link = $this->input->post('link');
		$page_id = $this->input->post('page_id');
		$status = @$this->input->post('status');

		$pg_meta_key = $this->input->post('pg_meta_key');
		$pg_meta_dec = $this->input->post('pg_meta_dec');
		$pg_meta_title = $this->input->post('pg_meta_title');
		$pg_slug = ($this->input->post('pg_slug'));

		if (!empty($_FILES['file_name']['name'])) {
			$dest = "assets/avator/upload/content/";
			$order_id = rand('1111111', '9999999');
			$file_get_res = upload_doc('file_name', $dest, $order_id);
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
				$update_admins = $this->db->query("update yn_admin_pages set pg_meta_title='$pg_meta_title',pg_meta_dec='$pg_meta_dec', pg_meta_key='$pg_meta_key', content='$text', content_file='$cover', content_link='$link', status='$status' where pid='$page_id' ");
			}
		} else {

			$update_admins = $this->db->query("update yn_admin_pages set pg_meta_title='$pg_meta_title',pg_meta_dec='$pg_meta_dec', pg_meta_key='$pg_meta_key', content='$text', content_link='$link', status='$status' where pid='$page_id' ");
		}
		echo 'YNAPS_SUCCESS';
		die;
	}
	function enable()
	{

		// get_admin_rights();
		$status = $this->input->post('status');

		// if(){}
		$update_admins = $this->db->query("update `x-signup` set status='$status' where sid=1");
		echo 'YNAPS_SUCCESS';
		die;
	}
	function service_modify()
	{
		get_admin_rights();
		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {
				// case 'active_serv':
				// $upadtsspost=$this->db->query("update x_ps_service set serv_status='1' where serv_id='$id' ");
				// redirect($_SERVER['HTTP_REFERER'].'?msg=success');
				// break;
				case 'active_ord':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='2' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				// case 'ban_serv':
				// 	$upadtsspost=$this->db->query("update x_ps_service set serv_status='2' where serv_id='$id' ");
				// 	redirect($_SERVER['HTTP_REFERER'].'?msg=success');
				// 	break;

				case 'paid':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='2' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'unpaid':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='0' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				case 'ban_ord':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='0' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'pen_ord':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='1' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'del_ord':
					$upadtsspost = $this->db->query("update yn_ecom_order set so_status='3' where so_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'reset_pass':
					$rand = rand(11111111, 9999999);
					$pass = sha1($rand);
					$upadtsspost = $this->db->query("update yn_site_mem set pass_nc='$rand',pass='$pass' where mid='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				default:

					break;
			}
		} else {
			redirect(base_url('logout'));
		}
	}

	function add_page_data()
	{
		get_admin_rights();
		$text = addslashes($this->input->post('text'));
		$page = $this->input->post('page');
		$type2 = $this->input->post('type2');
		$link = $this->input->post('link');

		$pg_meta_key = $this->input->post('pg_meta_key');
		$pg_meta_dec = $this->input->post('pg_meta_dec');
		$pg_meta_title = $this->input->post('pg_meta_title');
		$pg_slug = ($this->input->post('pg_slug'));



		if ($pg_slug == '' && $pg_slug != 'YN_PP') {
			echo 'Please enter a Slug';
			die;
		}

		//chcekslug
		$check_slug = $this->db->query("select * from yn_admin_pages where pg_slug='$pg_slug' and  pg_slug !='YN_PP' ");
		if ($check_slug->num_rows() != 0) {
			echo 'There is a page with same SLUG please use a different slug';
			die;
		}


		$cover = '';
		$status = @$this->input->post('status');

		// $checks_sops=$this->db->query("select * from yn_admin_pages where name='$page' ");
		// if($checks_sops->num_rows() >0){echo "Please add a unique name"; die;}

		if (!empty($_FILES['file_name']['name'])) {
			$dest = "assets/avator/upload/content/";
			$order_id = rand('1111111', '9999999');
			$file_get_res = upload_doc('file_name', $dest, $order_id);
			if (substr($file_get_res, 0, 6) == 'SUCCXX') {
				$cover = substr($file_get_res, 6);
			}
		}




		$update_admins = $this->db->query("insert into yn_admin_pages (content, name, type, content_link, content_file, status,pg_meta_dec,pg_meta_img,pg_meta_title,pg_meta_key,pg_slug) values ('$text', '$page', '$type2', '$link', '$cover', '$status','$pg_meta_dec','#','$pg_meta_title','$pg_meta_key','$pg_slug') ");
		echo 'YNAPS_SUCCESS';
		die;
	}
	//////////////////////////////////////////// THIS IS CUSTOM //////////////////////////////////////

	function add_faq()
	{
		//get_admin_rights();
		$que = $this->input->post('que');
		$ans = $this->input->post('ans');

		$addtesti = $this->db->query("insert into yn_site_faq (faq_que,faq_ans,faq_status) values ('$que','$ans','1')");
		echo 'YNAPS_SUCCESS';
		die;
	}
	function edit_faq()
	{
		//get_admin_rights();
		$id = $this->input->post('id');
		$que = $this->input->post('que');
		$ans = $this->input->post('ans');

		$addtesti = $this->db->query("update yn_site_faq set faq_que='$que',faq_ans='$ans' where faq_id='$id'");
		echo 'YNAPS_SUCCESS';
		die;
	}


	function add_widget()
	{
		//get_admin_rights();
		$que = $this->input->post('que');
		$ans = addslashes($this->input->post('ans'));

		$addtesti = $this->db->query("insert into yn_widgets (wd_name,wd_text,wd_status) values ('$que','$ans','1')");
		echo 'YNAPS_SUCCESS';
		die;
	}
	function edit_widget()
	{
		//get_admin_rights();
		$id = $this->input->post('id');
		$que = $this->input->post('que');
		$ans = $this->input->post('ans');
		$wd_status = $this->input->post('wd_status');

		$addtesti = $this->db->query("update yn_widgets set wd_name='$que',wd_text='$ans',wd_status='1' where wd_id='$id'");
		echo 'YNAPS_SUCCESS';
		die;
	}

	function site_prov()
	{
		@$comment = addslashes($this->input->post('comment'));
		// if(str_word_count($comment) < 150 ){echo "The blog content should be atleast 150 words long."; die;}
		@$scomment = addslashes($this->input->post('scomment'));
		@$title = $this->input->post('title');
		@$blogid = $this->input->post('blogid');
		@$blog_link2 = $this->input->post('blog_link2');
		@$blog_link = $this->input->post('blog_link');
		@$pr_priority = $this->input->post('pr_priority');
		@$what = $this->input->post('what');
		$ip = $this->input->ip_address();

		switch ($what) {
			case 'add_prov':
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("insert into x_cou_prov (pr_name,pr_title,pr_image,pr_desc,pr_date,pr_priority) values ('$blog_link','$title','$cover','$scomment',now(),'$pr_priority')");
						echo 'YNAPS_SUCCESS';
						die;
					}
				} else {
					echo 'Please select the image';
				}
				break;
			case 'edit_prov':
				$cover = '';
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("update x_cou_prov set pr_title='$title',pr_desc='$scomment',pr_image='$cover',pr_name='$blog_link',pr_priority='$pr_priority' where pr_id='$blogid'");

						if ($blog_link2 != '') {
							$getlogins = $this->db->query("update x_cou_courses set cou_merchant_name='$blog_link' where cou_merchant_name='$blog_link2'");
						}
					}
				} else
					$getlogins = $this->db->query("update x_cou_prov set pr_title='$title',pr_desc='$scomment',pr_name='$blog_link',pr_priority='$pr_priority' where pr_id='$blogid'");
				echo 'YNAPS_SUCCESS';
				die;
				break;
		}
	}

	function add_versi()
	{
		@$comment = addslashes($this->input->post('comment'));
		// if(str_word_count($comment) < 150 ){echo "The blog content should be atleast 150 words long."; die;}
		@$scomment = addslashes($this->input->post('scomment'));
		@$title = $this->input->post('title');
		@$blogid = $this->input->post('blogid');
		@$blog_link = $this->input->post('blog_link');
		@$what = $this->input->post('what');
		$ip = $this->input->ip_address();

		switch ($what) {
			case 'add_versi':
				$getlogins = $this->db->query("insert into x_cou_datav (dtv_name,dtv_desc,dtv_did,dtv_date,dtv_status) values ('$blog_link','$scomment','$title',now(),'0')");
				echo 'YNAPS_SUCCESS';
				die;
				break;
			case 'edit_prov':
				$cover = '';
				if (!empty($_FILES['file_name']['name'])) {
					$file_get_res = upload_doc('file_name', "assets/avator/upload/", '');
					if (substr($file_get_res, 0, 6) == 'SUCCXX') {
						$cover = substr($file_get_res, 6);
						$getlogins = $this->db->query("update x_cou_datav set pr_title='$title',pr_desc='$scomment',pr_image='$cover',pr_name='$blog_link' where pr_id='$blogid'");
					}
				} else
					$getlogins = $this->db->query("update x_cou_datav set pr_title='$title',pr_desc='$scomment',pr_name='$blog_link' where pr_id='$blogid'");
				echo 'YNAPS_SUCCESS';
				die;
				break;
		}
	}


	function theme_activate($theme)
	{
		$update_heme = $this->db->query("update yn_site_theme set thm_status='0' ");
		$update_heme = $this->db->query("update yn_site_theme set thm_status='1' where thm_id='$theme' ");
		redirect($_SERVER['HTTP_REFERER'] . '&msg=Theme Activated.');
	}

	function theme_manager()
	{
		$thm_name = clean(strtolower($this->input->post('thm_name')), 'nospace');
		$thm_name = preg_replace('/\s+/', '', $thm_name);


		if ($thm_name == '') {
			echo 'Please enter a theme Name';
			die;
		}


		$yn_head = addslashes("<meta charset='UTF-8'> <meta http-equiv='x-ua-compatible' content='ie=edge'> <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0'> <title>yn_seo_title</title> <link rel='icon' href='{{base_url}}assets/avator/favicon.png' sizes='32x32'> <link rel='apple-touch-icon' href='{{base_url}}assets/avator/favicon.png'> <meta name='msapplication-TileImage' content='{{base_url}}assets/avator/favicon.png'> <link rel='stylesheet' href='https://ynaps.com/API/css/fonts.css' type='text/css'> <link rel='stylesheet' type='text/css' href='{{base_url}}assets/css/theme.css'> <link rel='stylesheet' type='text/css' href='{{base_url}}assets/css/ynaps_style.css'> <link rel='stylesheet' href='https://ynaps.com/API/css/ynaps_uni_style.css' type='text/css'><link rel='stylesheet' href='https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css'> <link rel='stylesheet' type='text/css' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'> <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> <script src='https://kit.fontawesome.com/a4ddad7fd6.js' crossorigin='anonymous'></script> <link rel='stylesheet' type='text/css' href='{{base_url}}assets/addons/popup/sweetalert.css'> <meta name='title' content='yn_seo_title'> <meta name='keywords' content='yn_seo_keywords'/> <meta name='description' content='yn_seo_description'> <meta property='og:title' content='yn_seo_title'/> <meta property='og:image' content='yn_seo_image'/> <meta property='og:description' content='yn_seo_description'/> <meta property='og:site_name' content='yn_site_name'/> <meta itemprop='name' content='yn_site_name'/> <meta itemprop='description' content='yn_seo_description'/> <meta property='og:title' content='yn_seo_title'/> <meta itemprop='image' content='yn_seo_image'/> <meta name='twitter:card' content='yn_seo_image'/> <meta name='twitter:url' content='yn_site_name'/> <meta name='twitter:title' content='yn_seo_title'/> <meta name='twitter:description' content='yn_seo_description'/> <meta name='twitter:image' content='yn_seo_image'/> </head><body class='ynaps_body'>");

		$yn_foot = addslashes('<script src="{{base_url}}assets/js/main.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script></script><script src="{{base_url}}assets/admin/scripts/jquery.form.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script><script src="{{base_url}}assets/js/functions.js"></script> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> <script type="text/javascript">function load_new_state(obj){var thecountry=$(obj).children("option:selected").val(); $("#get_state_data").load("<?=base_url("ynaps_load/load_state?country=")?>"+thecountry);}function load_new_city(obj){var thestate=$(obj).children("option:selected").val(); $("#get_cities_data").load("<?=base_url("ynaps_load/load_city?state=")?>"+thestate);}function load_new_area(obj){var thestate=document.getElementById("state").value; var thecity=$(obj).children("option:selected").val(); $("#get_area_data").load("<?=base_url("ynaps_load/load_area?state=")?>"+thestate+"&city="+thecity);}function getSelCity(obj){var thecity=$(obj).children("option:selected").val(); var citySelect=document.getElementById("getCity"); var selectedCity=citySelect.options[citySelect.selectedIndex].text; document.getElementById("selcity_name").value=selectedCity; document.getElementById("city_frm").submit();}function load_subcat(obj){var thecat=$(obj).children("option:selected").val(); $("#get_subcat_data").load("<?=base_url("ynaps_load/load_subcat?cat=")?>"+thecat);}function show_hide(show_d,hide_d){$("."+hide_d).fadeOut(); $("."+show_d).fadeIn();}</script> </body></html>');

		$yn_head2 = addslashes("<!DOCTYPE html><html class='no-js' lang='en'><head><link rel='stylesheet' href='{{base_url}}assets/theme/{{theme}}/css/vendor/bootstrap.min.css'>");

		$yn_foot2 = addslashes("<script src='{{base_url}}assets/theme/{{theme}}/js/vendor/modernizr.min.js'></script>");


		$check_theme = $this->db->query("select * from yn_site_theme where thm_name ='$thm_name' ");
		if ($check_theme->num_rows() == 0) {
			$update_heme = $this->db->query("update yn_site_theme set thm_status='0' ");
			$this->db->query("insert into yn_site_theme (thm_name,thm_status,thm_date,thm_header1,thm_footer1,thm_header2,thm_footer2) values ('$thm_name','1',now(),'$yn_head','$yn_foot','$yn_head2','$yn_foot2') ");

			// create the navigations. 
			setup_theme_data('navi', '1', '1');
			setup_theme_data('footer_codes', '1', '1');


			// 

			function rmdir_recursive($dir)
			{
				foreach (scandir($dir) as $file) {
					if ('.' === $file || '..' === $file) continue;
					if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
					else unlink("$dir/$file");
				}
				rmdir($dir);
			}


			if ($_FILES["zip_file"]["name"]) {
				$filename = $_FILES["zip_file"]["name"];
				$source = $_FILES["zip_file"]["tmp_name"];
				$type = $_FILES["zip_file"]["type"];

				$name = explode(".", $filename);
				$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
				foreach ($accepted_types as $mime_type) {
					if ($mime_type == $type) {
						$okay = true;
						break;
					}
				}

				$continue = strtolower($name[1]) == 'zip' ? true : false;
				if (!$continue) {
					$message = "The file you are trying to upload is not a .zip file. Please try again.";
				}

				/* PHP current path */
				$path = dirname(__FILE__) . '/../../assets/theme/';  // absolute path to the directory where zipper.php is in
				$filenoext = basename($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
				$filenoext = basename($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

				// $targetdir = $path . $filenoext; // target directory
				$targetdir = $path . $thm_name; // target directory
				$targetzip = $path . $filename; // target zip file

				/* create directory if not exists', otherwise overwrite */
				/* target directory is same as filename without extension */

				if (is_dir($targetdir))  rmdir_recursive($targetdir);


				mkdir($targetdir, 0777);


				/* here it is really happening */

				if (move_uploaded_file($source, $targetzip)) {
					$zip = new ZipArchive();
					$x = $zip->open($targetzip);  // open the zip file to extract
					if ($x === true) {
						$zip->extractTo($targetdir); // place in the directory with same name  
						$zip->close();

						unlink($targetzip);
					}
					// $message = "Your .zip file was uploaded and unpacked./";
					redirect($_SERVER['HTTP_REFERER'] . '&msg=success.');
				} else {
					// $message = "There was a problem with the upload. Please try again.";
					redirect($_SERVER['HTTP_REFERER'] . '&msgg=There was a problem with the upload. Please try again.');
				}
			}
		} else {
			redirect($_SERVER['HTTP_REFERER'] . '&msgg=Theme+Name+Already+Exists.');
		}
	}

	function add_products()
	{

		@$what = $this->input->post('what');
		@$p_description = addslashes($this->input->post('p_desc'));
		@$p_product_name	  	= $this->input->post('product_name');
		@$p_id_up			  	= $this->input->post('p_id');
		// @$p_color		  	= $this->input->post('p_color');
		// @$p_size		  	= $this->input->post('p_size');
		// @$p_weight		  	= $this->input->post('p_weight');
		// @$p_shipping_location		  	= $this->input->post('p_shipping_location');
		// @$p_shipping_cost		  	= $this->input->post('p_shipping_cost');

		@$p_category		  	= $this->input->post('p_category');
		// @$p_sub_category	  	= $this->input->post('p_sub_category');
		// @$p_sub_sub_cat			= $this->input->post('p_sub_sub_cat');
		@$p_price			  	= $this->input->post('p_price');
		// @$p_mrp				  	= $this->input->post('p_mrp');
		// @$p_stock			  	= $this->input->post('p_stock');

		// @$p_vehicle	  	= $this->input->post('p_vehicle');
		// @$p_model			  	= $this->input->post('p_model');
		// @$p_year				  	= $this->input->post('p_year');
		// @$p_fuel			  	= $this->input->post('p_fuel');


		// $p_discount = (($p_mrp - $p_price) / $p_mrp) * 100;

		// @$p_brand			  	= $this->input->post('p_brand');
		// @$product_rating	  	= $this->input->post('product_rating');
		// @$p_provider		  	= $this->input->post('p_provider');
		// @$p_variant		 	  	= $this->input->post('p_variant');
		// @$p_number_of_reviews 	= $this->input->post('p_number_of_reviews');

		// @$p_cta 	= $this->input->post('p_cta');
		// @$p_tags 	= $this->input->post('p_tags');
		// @$p_sku 	= $this->input->post('p_sku');
		// @$p_gurantee 	= $this->input->post('p_gurantee');
		// @$p_vendor 	= $this->input->post('p_vendor');

		// if($p_sku ==''){$p_sku=rand(1111,999999);}


		// if(!empty($p_variant)){
		// 	$input_str =implode(',',$p_variant);
		// $pattern = "/(\w+)\|(\w+)/";
		// // Find all matches of the pattern in the input string
		// preg_match_all($pattern, $input_str, $matches, PREG_SET_ORDER);

		// // Extract substrings from the matches
		// $substrings1 = array();
		// $substrings2 = array();
		// foreach ($matches as $match) {
		//     $substrings1[] = $match[1];
		//     $substrings2[] = $match[2];
		// }

		// // Print the extracted substrings
		// $p_variant = str_replace(' ','',implode(", ", $substrings1));
		// $p_variant_text = str_replace(' ','',implode(", ", $substrings2));
		// }else{
		// 	$p_variant = '';
		// $p_variant_text = '';
		// }

		// if (trim($p_product_name) == '') {
		// 	echo 'Please Enter Product Name!';
		// 	die;
		// }
		// if (trim($p_description) == '') {
		// 	echo 'Please Enter Product Description!';
		// 	die;
		// }



		switch ($what) {
			case 'add_product':
				$getlogins = $this->db->query("INSERT INTO yn_ecom_products 
    (`p_name`, `p_category`, `p_descp`, `p_price`)
    VALUES 
    ('$p_product_name', '$p_category','$p_description', '$p_price')");
				if ($getlogins) {
					echo 'YNAPS_SUCCESS';
					die;
				} else {
					echo "Sorry! Product could not added! try again. ";
				}
				break;
			case 'edit_product':
				$getlogins = $this->db->query(" UPDATE `yn_ecom_products`
						SET `p_name` = '$p_product_name',
						  `p_category` = '$p_category',
						  `p_sub_category` = '$p_sub_category',
						  `p_sub_sub_cat` = '$p_sub_sub_cat',
						  `p_descp` = '$p_description',
						  `p_price` = '$p_price',
						  `p_discount` = '$p_discount',
						  `p_mrp` = '$p_mrp',
						  `p_stock` = '$p_stock',
						  `p_star` = '$product_rating',
						  `p_gurantee` = '$p_gurantee',
						  `p_sku` = '$p_sku',
						  `p_vendor` = '$p_vendor',

						  `p_color`= '$p_color',
						   `p_size`= '$p_size', 
						   `p_weight`= '$p_weight',
							`p_shipping_location`= '$p_shipping_location',
							`p_shipping_cost`=  '$p_shipping_cost', 
							`p_vehicle`= '$p_vehicle',
							 `p_model`= '$p_model', 
							`p_year`= '$p_year', 
							`p_fuel`= '$p_fuel'

						   WHERE `p_id` = '$p_id_up'; ");
				echo 'YNAPS_SUCCESS';
				die;
				break;
		}
	}

	// Enable | Disable Products
	function product_modify()
	{
		get_admin_rights();
		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {

				case 'enable_product':
					$upadtsspost = $this->db->query("UPDATE yn_ecom_products set p_status='1' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;
				case 'disable_product':
					$upadtsspost = $this->db->query("UPDATE yn_ecom_products set p_status='0' where p_id='$id' ");
					$referer = $_SERVER['HTTP_REFERER'];
					if (strpos($referer, '?') !== false) {
						$referer .= '&msg=success';
					} else {
						$referer .= '?msg=success';
					}
					header('Location: ' . $referer);
					break;

				default:
					break;
			}
		} else {
			redirect(base_url('logout'));
		}
	}



	function form()
	{
		@$name = $this->input->post('name');
		if ($name != '') {
			$inser_093 = $this->db->query("insert into yn_site_forms (frm_name,frm_status) values ('$name','1') ");
		}
		echo 'YNAPS_SUCCESS';
		die;
	}

	function ffv()
	{
		@$frf_id = $this->input->post('frf_id');
		@$ffv = $this->input->post('ffv');
		$inser_093 = $this->db->query("insert into yn_site_form_field_values (ffv_flid,ffv_name,ffv_val) values ('$frf_id','$ffv','$ffv') ");
		echo 'YNAPS_SUCCESS';
		die;
	}

	function form_fields()
	{
		@$frm = $this->input->post('frm');
		@$type = $this->input->post('type');
		@$name = $this->input->post('name');
		@$label = $this->input->post('label');

		if ($name != '' && $type != '') {

			$sele_check = $this->db->query("select * from yn_site_form_fields where frf_frmid	='$frm' and frf_name='$name'  ");
			if ($sele_check->num_rows() == 0) {

				$insert_date = $this->db->query("insert into yn_site_form_fields (frf_frmid,frf_name,frf_type,frf_label) values ('$frm','$name','$type','$label') ");
				echo 'YNAPS_SUCCESS';
				die;
			} else {
				echo 'Form with the same field name exists, please use a different name';
				die;
			}
		} else {
			echo 'Please select input type and input name';
			die;
		}

		$inser_093 = $this->db->query("insert into yn_site_forms (frm_name,frm_status) values ('$name','1') ");
		echo 'YNAPS_SUCCESS';
		die;
	}


	public function add_tags_type()
	{
		$name = $this->input->post('name');
		$theid = $this->input->post('theid');
		$tgtype = $this->input->post('tgtype');
		if (trim($name) == '') {
			echo 'Please enter the tag type name.';
			die;
		}

		if ($theid != '0' && $theid != '-1') {
			$getlogins = $this->db->query("update yn_site_tags_type set stst_name='$name' where stst_id='$theid'");
		} else {
			$getlogins = $this->db->query("insert into yn_site_tags_type (stst_name,stg_type) values ('$name','$tgtype')");
		}

		echo 'YNAPS_SUCCESS';
	}

	function modify_loc()
	{
		get_admin_rights();

		$op = $this->input->GET('what');
		$id = $this->input->GET('id');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {
				case 'en_cntry':
					$upadtsspost = $this->db->query("update yn_site_countries set status='1' where country_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'dis_cntry':
					$upadtsspost = $this->db->query("update yn_site_countries set status='0' where country_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'en_state':
					$upadtsspost = $this->db->query("update yn_site_states set status='1' where state_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'dis_state':
					$upadtsspost = $this->db->query("update yn_site_states set status='0' where state_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'disable_states':
					$upadtsspost = $this->db->query("update yn_site_states set status='0'");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'en_city':
					$upadtsspost = $this->db->query("update yn_site_cities set status='1' where city_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'dis_city':
					$upadtsspost = $this->db->query("update yn_site_cities set status='0' where city_id='$id' ");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				case 'disable_cities':
					$upadtsspost = $this->db->query("update yn_site_cities set status='0'");
					redirect_to_url($_SERVER['HTTP_REFERER'], 'msg=success');
					break;
				default:
					echo 'error';
					break;
			}
			if (isset($_SESSION['cities'])) {
				unset($_SESSION['cities']);
			}
		}
	}

	function download()
	{
		if (check_admin_rights('4', '', '') == 0) {
			echo 'Seems Like you do not have such authority, Please Get Edit rights by Admin.';
			die;
		}
		$download = $values = 0;


		$op = $this->input->GET('do');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {

				case 'mem':
					$getall_userdata = $this->db->query("select name,email,contact,date,address,last_seen,gender,about,dnd from yn_site_mem ");
					$filename = "nodlys_members_list.xls";
					$download = 1;
					break;
				case 'lead':
					$getall_userdata = $this->db->query("select name,email,phone,subject,msg,date,ip,l_status from yn_site_contact ");
					$filename = "nodlys_leads_list.xls";
					$download = 1;
					break;
				case 'subs':
					$getall_userdata = $this->db->query("select sbc_email,sbc_date from yn_site_subscribe ");
					$filename = "nodlys_subs_list.xls";
					$download = 1;
					break;
				case 'orders':
					$getall_userdata = $this->db->query("select name,email,contact,date,address,last_seen,gender,about,dnd from yn_site_mem ");
					$filename = "nodlys_orders_list.xls";
					$download = 1;
					break;

				default:
					echo "Not matched";
					die;
					break;
			}

			if ($download == 1) {
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel");

				$flag = false;
				$data = $getall_userdata->result_array();
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
			} else {
				echo 'Download is not getting ready.';
				die;
			}
		}
	}

	function reset()
	{
		get_admin_rights();
		$download = $values = 0;

		$op = $this->input->GET('do');
		if ($_SESSION['aid'] != '' && $_SESSION['auth-rights'] > '3') {
			switch ($op) {

				case 'mem':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_mem;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_mem_skills;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_mem_business;");
					break;
				case 'lead':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_contact;");
					break;
				case 'services':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_services;");
					break;
				case 'subs':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_subscribe;");
					break;
				case 'orders':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_ecom_cr_order;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_ecom_order;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_ecom_orders_detail;");
					break;
				case 'cats':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_catagory;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_sub2_cat;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_sub_cat;");
					break;
				case 'gala':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_gallery;");
					break;
				case 'keys':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_tags;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_tags_type;");
					break;
				case 'prod':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_ecom_products;");
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_ecom_products_img;");
					break;
				case 'buss':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_mem_business;");
					break;

				case 'blog':
					$getall_userdata = $this->db->query("TRUNCATE TABLE yn_site_blogs;");
					break;

				default:
					echo "Not matched";
			}
		}

		if (strpos($_SERVER['HTTP_REFERER'], '?') !== false) {
			$redirect_url = $_SERVER['HTTP_REFERER'] . '&msg=success';
		} else {
			$redirect_url = $_SERVER['HTTP_REFERER'] . '?msg=success';
		}

		header('Location: ' . $redirect_url);
	}

	public function bdbackup()
	{
		$tables = $this->db->list_tables();

		$backup = '';

		foreach ($tables as $table) {
			$backup .= 'DROP TABLE IF EXISTS `' . $table . '`;' . PHP_EOL;

			$create_table = $this->db->query('SHOW CREATE TABLE ' . $table)->row_array();
			$backup .= $create_table['Create Table'] . ';' . PHP_EOL;

			$fields = $this->db->list_fields($table);

			$table_data = $this->db->query('SELECT * FROM ' . $table)->result_array();

			if ($fields && $table_data) {
				$insert_field = 'INSERT INTO `' . $table . '` (';
				foreach ($fields as $field) {
					$insert_field .= '`' . $field . '`,';
				}
				$insert_field = rtrim($insert_field, ',');
				$insert_field .= ') VALUES ';

				foreach ($table_data as $table_row) {
					$insert_values = '(';
					foreach ($table_row as $column => $value) {
						$insert_values .= "'" . addslashes($value) . "',";
					}
					$insert_values = rtrim($insert_values, ',');
					$insert_values .= ')';
					$backup .= $insert_field . $insert_values . ';' . PHP_EOL;
				}
			}

			$backup .= PHP_EOL . PHP_EOL;
		}

		$file_name = 'backup-' . date('Y-m-d') . '.sql';

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file_name . '"');

		echo $backup;
	}

	function yn_site_nav()
	{
		$name = $this->input->post('name');
		$edit = $this->input->post('edit');

		if ($edit != '') {
			$thecheck = $this->db->query("select * from yn_site_nav where nv_m_name ='$name' and nv_id !='$edit'  ");
			if ($thecheck->num_rows() != 0) {
				echo 'A Navigation with this name already Exists';
				die;
			} else {
				$addthsis = $this->db->query("update yn_site_nav set nv_m_name ='$name' where nv_id !='$edit'  ");
			}
			echo 'YNAPS_SUCCESS';
		} else {

			$thecheck = $this->db->query("select * from yn_site_nav where nv_m_name ='$name'  ");
			if ($thecheck->num_rows() != 0) {
				echo 'A Navigation with this name already Exists';
				die;
			} else {
				$addthsis = $this->db->query("insert into yn_site_nav (nv_m_name) values ('$name') ");
			}
			echo 'YNAPS_SUCCESS';
		}
	}

	function add_navi_link()
	{
		@$frm = $this->input->post('frm');
		@$type = $this->input->post('type');
		@$name = $this->input->post('name');
		@$label = addslashes($this->input->post('label'));
		@$sort = $this->input->post('sort');
		@$link = $this->input->post('link');
		@$nv_class_css = $this->input->post('nv_class_css');

		if ($label != '' && $type != '') {

			$insert_date = $this->db->query("insert into yn_site_nav_items (nv_nvid,nv_weight,nv_link,nv_name,nv_new_tab,nv_class_css) values ('$frm','$sort','$link','$label','$type','$nv_class_css') ");
			echo 'YNAPS_SUCCESS';
			die;
		} else {
			echo 'Please select input type and input name';
			die;
		}

		$inser_093 = $this->db->query("insert into yn_site_forms (frm_name,frm_status) values ('$name','1') ");
		echo 'YNAPS_SUCCESS';
		die;
	}



	//end the class
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
