<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{


		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;



		// $this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('landing', $data);
		// $this->load->view('inc/_footer', $data);
	}

	public function home()
	{


		$data = db_variables();

		if ($data['home_page'] != '') {
			redirect(base_url($data['home_page']));
		}

		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
			$yid = $_SESSION['yid'];
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem WHERE mid != '$yid' ORDER BY rand() LIMIT 10");
		} else {
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem ORDER BY rand() LIMIT 10");
		}
		$vendors = $getVendors->result_array();
		$data['vendors'] = $vendors;

		$user_id = @$_SESSION['yid'];

		if ($user_id) {
			// Get following users
			$followingQuery = $this->db->query("SELECT f_follow_to FROM x_followers WHERE f_follow_by = ?", [$user_id]);
			$following = $followingQuery->result_array();

			// Extract follow ids
			$following_ids = array_column($following, 'f_follow_to');

			// Show own posts
			$following_ids[] = $user_id;

			// Prepare placeholders for query binding
			$placeholders = implode(',', array_fill(0, count($following_ids), '?'));

			// SQL query to fetch both original posts and retweeted posts
			$sql = "SELECT x_posts.*, yn_site_mem.*, NULL AS retweeted_by, p_created AS post_time FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id IN ($placeholders) UNION ALL SELECT x_posts.*, yn_site_mem.*,  x_post_retweets.r_user_id AS retweeted_by, x_post_retweets.r_created AS post_time FROM x_posts JOIN  x_post_retweets ON x_posts.p_id = x_post_retweets.r_post_id LEFT JOIN yn_site_mem ON x_posts.p_user_id = yn_site_mem.mid WHERE x_post_retweets.r_user_id IN ($placeholders) ORDER BY post_time DESC LIMIT 30";

			$getPosts = $this->db->query($sql, array_merge($following_ids, $following_ids));
		} else {
			// User is not logged in, show all posts
			$getPosts = $this->db->query("SELECT x_posts.*, yn_site_mem.*, NULL AS retweeted_by, p_created AS post_time FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid UNION ALL SELECT x_posts.*, yn_site_mem.*, x_post_retweets.r_user_id AS retweeted_by, x_post_retweets.r_created AS post_time FROM x_posts JOIN x_post_retweets ON x_posts.p_id = x_post_retweets.r_post_id LEFT JOIN yn_site_mem ON x_posts.p_user_id = yn_site_mem.mid ORDER BY post_time DESC LIMIT 30 ");
		}

		// Fetch posts
		$data['posts'] = $getPosts->result_array();


		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('home', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function investors()
	{
		$data = db_variables();
		$data['seo_title'] = 'Investors - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
			$yid = $_SESSION['yid'];
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem WHERE mid != '$yid' ORDER BY rand() LIMIT 10");
		} else {
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem ORDER BY rand() LIMIT 10");
		}
		$vendors = $getVendors->result_array();
		$data['vendors'] = $vendors;


		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('all_investors', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function developers()
	{
		$data = db_variables();
		$data['seo_title'] = 'All Developers - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
			$yid = $_SESSION['yid'];
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem WHERE mid != '$yid' AND is_vendor='1' ORDER BY rand() LIMIT 10");
		} else {
			$getVendors = $this->db->query("SELECT * FROM yn_site_mem WHERE is_vendor='1' ORDER BY rand() LIMIT 10");
		}
		$vendors = $getVendors->result_array();
		$data['vendors'] = $vendors;


		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('all_developers', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function videos()
	{
		$data = db_variables();
		$data['seo_title'] = 'Videos - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$conditions = array();

		// Fetching filter inputs
		$q      = isset($_GET['q']) ? trim($_GET['q']) : '';

		$conditions = [];

		if ($q != '') {
			$conditions[] = "ygl_name LIKE '%" . $this->db->escape_like_str($q) . "%' OR ygl_tags LIKE '%" . $this->db->escape_like_str($q) . "%'";
		}

		// ✅ Final SQL where clause
		$sql_filter = "1=1";

		if (count($conditions) > 0) {
			$sql_filter .= ' AND ' . implode(' AND ', $conditions);
		}



		// echo $sql_filter

		$getvideos = $this->db->query("SELECT * FROM yn_site_gallery WHERE $sql_filter ORDER BY ygl_id DESC ");
		$data['all_videos'] = $getvideos->result_array();

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('all_videos', $data);
		$this->load->view('inc/_footer', $data);
	}

	function message()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = 'Messages - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('chat', $data);
		$this->load->view('inc/_footer', $data);
	}
	public function video_link($id)
	{
		$data = db_variables();


		// echo $sql_filter

		$getvideos = $this->db->query("SELECT * FROM yn_site_gallery ORDER BY ygl_id DESC LIMIT 6");
		$data['all_videos'] = $getvideos->result_array();

		$getvideolink = $this->db->query("SELECT * FROM yn_site_gallery WHERE ygl_id = '$id' ORDER BY ygl_id DESC ")->row_array();
		$data['video_link'] = $getvideolink;

		$data['seo_title'] = $getvideolink['ygl_name'] . ' - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('video', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function properties()
	{
		$data = db_variables();
		$data['seo_title'] = 'Properties - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$conditions = array();

		// Fetching filter inputs
		$type       = isset($_GET['type']) ? trim($_GET['type']) : '';
		$city       = isset($_GET['city']) ? trim($_GET['city']) : '';
		$price_range = isset($_GET['price']) ? $_GET['price'] : '';
		$bedrooms   = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
		$bathrooms  = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '';
		$categories = isset($_GET['categories']) ? $_GET['categories'] : '';
		$developers = isset($_GET['developers']) ? $_GET['developers'] : '';

		$conditions = [];

		if ($type != '') {
			$conditions[] = "prop_rent_sale = '" . $this->db->escape_str($type) . "'";
		}

		if ($city != '') {
			$conditions[] = "prop_city_name LIKE '%" . $this->db->escape_like_str($city) . "%'";
		}

		if ($bedrooms != '') {
			$conditions[] = "prop_bedroom = '" . $this->db->escape_str($bedrooms) . "'";
		}


		if ($bathrooms != '') {
			$conditions[] = "prop_bathroom = '" . $this->db->escape_str($bathrooms) . "'";
		}

		if ($price_range != '') {
			list($selectedMin, $selectedMax) = explode('-', $price_range);

			if (is_numeric($selectedMin) && is_numeric($selectedMax)) {
				$conditions[] = "(
			CAST(SUBSTRING_INDEX(prop_price, '-', 1) AS UNSIGNED) <= " . $this->db->escape_str($selectedMax) . " AND 
			CAST(SUBSTRING_INDEX(prop_price, '-', -1) AS UNSIGNED) >= " . $this->db->escape_str($selectedMin) . "
		)";
			}
		}

		// ✅ Categories (multi-select or comma separated)
		// if (!empty($categories) && is_array($categories)) {
		// 	$categoryConditions = array_map(function ($category) {
		// 		return "FIND_IN_SET('" . $this->db->escape_str($category) . "', prop_cat)";
		// 	}, $categories);

		// 	$conditions[] = '(' . implode(' OR ', $categoryConditions) . ')';
		// }

		if ($categories != '') {
			$categories = "'" . str_replace(",", "','", $categories) . "'";
			$conditions[] = "prop_cat IN ($categories)";
		}

		if ($developers != '') {
			$developers = "'" . str_replace(",", "','", $developers) . "'";
			$conditions[] = "prop_vendor IN ($developers)";
		}


		// ✅ Final SQL where clause
		$sql_filter = "prop_status = '1'";

		if (count($conditions) > 0) {
			$sql_filter .= ' AND ' . implode(' AND ', $conditions);
		}


		// echo $sql_filter;


		$getProperties = $this->db->query("SELECT * FROM x_home_property WHERE $sql_filter");
		$data['properties'] = $getProperties->result_array();

		// print_r($getProperties->result_array());
		// die;
		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('all_properties', $data);
		$this->load->view('inc/_footer', $data);
	}



	function property_details($pid, $pname)
	{


		$data = db_variables();

		$getProperties = $this->db->query("SELECT * FROM x_home_property WHERE prop_id = '$pid' ");
		$property = $getProperties->row_array();
		$data['property'] = $property;


		$data['seo_title'] = $property['prop_name'] . ' - ' . $data['meta_title'];
		$data['seo_description'] = $property['prop_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;



		$this->load->view('inc/_header', $data);
		$this->load->view('property_details', $data);
		$this->load->view('inc/_footer', $data);
	}

	function developer_details($id, $name)
	{


		$data = db_variables();

		$data['id'] = $id;


		$data['seo_title'] = $property['name'] . ' - ' . $data['meta_title'];
		$data['seo_description'] = $property['about'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;



		$this->load->view('inc/_header', $data);
		$this->load->view('developer_details', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function hot_investments()
	{
		$data = db_variables();
		$data['seo_title'] = 'Hot Investments - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$getProperties = $this->db->query("SELECT * FROM x_home_property ");
		$data['properties'] = $getProperties->result_array();

		// print_r($getProperties->result_array());
		// die;
		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('hot_investments', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function foreign_investments()
	{
		$data = db_variables();
		$data['seo_title'] = 'Hot Investments - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$getProperties = $this->db->query("SELECT * FROM x_home_property ");
		$data['properties'] = $getProperties->result_array();

		// print_r($getProperties->result_array());
		// die;
		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/brain.php', $data);
		$this->load->view('foreign_investments', $data);
		$this->load->view('inc/_footer', $data);
	}

	function categories()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$getCategories = $this->db->query("SELECT * FROM yn_site_catagory ORDER BY sid DESC");
		$categories = $getCategories->result_array();
		$data['categories'] = $categories;

		$this->load->view('inc/_header', $data);
		$this->load->view('categories', $data);
		$this->load->view('inc/_footer', $data);
	}

	function admin()
	{
		redirect(base_url('admin/login'));
	}

	function error_404()
	{

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('error', $data);
		$this->load->view('inc/_footer', $data);
	}

	function page($slug)
	{
		$get_all_blocks = $this->db->query("select * from yn_admin_pages where pg_slug ='$slug' ");
		$the_pages_data = $get_all_blocks->row_array();


		$data = db_variables();
		$data['seo_title'] = $the_pages_data['pg_meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Ynaps.com';
		$data['page_data'] = $the_pages_data['content'];
		$data['meta_array'] = $data;


		$this->load->view('inc/_header', $data);
		$this->load->view('inc/_page_data.php', $data);
		$this->load->view('inc/_footer', $data);
	}

	function about()
	{
		$data = db_variables();
		$data['seo_title'] = 'About - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('about', $data);
		$this->load->view('inc/_footer', $data);
	}

	function member()
	{
		$data = db_variables();
		$data['seo_title'] = 'About - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		// 		$this->load->view('inc/_header', $data);
		// 		$this->load->view('inc/section', $data);
		$this->load->view('member', $data);
		// 		$this->load->view('inc/_footer', $data);
	}

	function details()
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('t_details', $data);
		$this->load->view('inc/_footer', $data);
	}

	function services()
	{

		if (check_service_status('1', '2', 'se') != '1') {
			redirect('error-404?e=this feature is not enabled.');
		}

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$getAllServices = $this->db->query("SELECT * FROM yn_site_services ORDER BY service_id ASC LIMIT 10");
		$all_services = $getAllServices->result_array();
		$data['services'] = $all_services;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('service', $data);
		$this->load->view('inc/_footer', $data);
	}

	function service($slug)
	{


		if (check_service_status('1', '2', 'se') != '1') {
			redirect('error-404?e=this feature is not enabled.');
		}

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$slug = clean($slug);
		if ($slug == '') {
			redirect(base_url('error-404?e=No Service found.'));
		}
		$getTheService = $this->db->query("SELECT * FROM yn_site_services WHERE slug = '$slug'");
		$theService = $getTheService->row_array();
		$data['theService'] = $theService;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('service_detail', $data);
		$this->load->view('inc/_footer', $data);
	}

	function pricing()
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('inc/pricing.php', $data);
		$this->load->view('inc/_footer', $data);
	}



	function support($cid = 0, $cname = null)
	{
		$this->contact();
	}
	function career($cid = 0, $cname = null)
	{
		$this->contact();
	}

	function contact($cid = 0, $cname = null)
	{
		$data = db_variables();
		$data['seo_title'] = 'Contact - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		$data['con_type'] = '0';
		if ($cid > '0') {
			$data['con_type'] = '6';
			$data['cid'] = $cid;
			$data['cname'] = unsmart_url($cname);
		}

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section.php', $data);
		$this->load->view('contact', $data);
		$this->load->view('inc/_footer', $data);
	}

	function calculator()
	{
		$data = db_variables();
		$data['seo_title'] = 'Calculator - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section.php', $data);
		$this->load->view('calculators', $data);
		$this->load->view('inc/_footer', $data);
	}


	function membership()
	{

		$data = db_variables();
		$data['seo_title'] = 'Membership - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		$data['con_type'] = '0';
		if ($cid > '0') {
			$data['con_type'] = '6';
			$data['cid'] = $cid;
			$data['cname'] = unsmart_url($cname);
		}

		$yid = $_SESSION['yid'];
		$user = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);


		// $this->load->view('inc/_header', $data);
		// $this->load->view('inc/section.php', $data);
		if ($user['user_plan'] == 'member') {
			redirect(base_url('profile'));
		} else {
			$this->load->view('inc/_header', $data);
			$this->load->view('membership', $data);
			$this->load->view('inc/_footer', $data);
		}
		// $this->load->view('inc/_footer', $data);
	}



	function accounts()
	{
		$this->account();
	}
	function account()
	{
		check_session('1', 'profile');
		$theoption = $this->uri->segment(3);
		switch ($theoption) {
			case 'login':
				$this->login();
				break;
			default:
				$this->login();
				break;
		}
	}

	public function signup($user_type = null)
	{
		check_session(1, 'profile');

		$data = db_variables();
		$data['seo_title'] = 'Signup - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$data['page_name'] = 'YNAPS';
		$data['user_type'] = $user_type;

		if (isset($_GET['refer'])) {
			$_SESSION['refer'] = $_GET['refer'];
		}

		$this->load->view('inc/_header', $data);
		$this->load->view('signup', $data);
		$this->load->view('inc/_footer', $data);
	}


	public function login()
	{
		check_session(1, 'profile');
		$data = db_variables();
		$data['seo_title'] = 'Login - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('login', $data);
		$this->load->view('inc/_footer', $data);
	}

	function login_otp_verify()
	{
		@session_start();
		//check_session('2','account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		if (isset($_SESSION['otp_verify']) && $_SESSION['otp_verify'] == '1') {
			redirect(base_url('profile'));
		}

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section',$data);
		$this->load->view('login_otp_verify', $data);
		$this->load->view('inc/_footer', $data);
	}

	function password()
	{
		if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
			redirect(base_url('profile'));
		}
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Password';
		$data['meta_array'] = $data;


		$this->load->view('inc/_header.php', $data);
		$this->load->view('password_reset.php', $data);
		$this->load->view('inc/_footer.php', $data);
	}

	function reset_password()
	{
		// if(isset($_SESSION['yid']) && $_SESSION['yid'] !=''){ redirect(base_url('profile')); }

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Reset Password';
		$data['meta_array'] = $data;

		$email = $this->input->get('mail');

		$getdats = $this->db->query("select pass_reset from yn_site_mem where email='$email' ");
		$thedetails = $getdats->row_array();

		$c = $this->input->get('c');
		if ($thedetails['pass_reset'] != $c) {
			redirect(base_url('error-404'));
		}

		$hash = $this->input->get('ha');

		if (sha1($email) . '90' != $hash) {
			redirect(base_url('profile'));
		} else {
			$data['e'] = $email;



			$this->load->view('inc/_header.php', $data);
			$this->load->view('password_reset2.php', $data);
			$this->load->view('inc/_footer.php', $data);
		}
	}

	function refund()
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['meta_array'] = $data;
		$data['page_name'] = 'Terms';



		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('refund', $data);
		$this->load->view('inc/_footer', $data);
	}
	function terms()
	{
		$data = db_variables();
		$data['seo_title'] = 'Terms & Conditions - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['meta_array'] = $data;
		$data['page_name'] = 'Terms';



		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section', $data);
		$this->load->view('terms', $data);
		$this->load->view('inc/_footer', $data);
	}
	function privacy()
	{
		$data = db_variables();
		$data['seo_title'] = 'Privacy Policy - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['meta_array'] = $data;
		$data['page_name'] = 'YNAPS';

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section', $data);
		$this->load->view('privacy', $data);
		$this->load->view('inc/_footer', $data);
	}

	function faq()
	{
		$data = db_variables();
		$data['seo_title'] = 'FAQ - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['meta_array'] = $data;
		$data['page_name'] = 'Terms';



		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('inc/faq', $data);
		$this->load->view('inc/_footer', $data);
	}

	function profile()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . ' - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$sql = " SELECT x_posts.*, yn_site_mem.*, NULL AS retweeted_by, p_created AS post_time FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = ? UNION ALL SELECT x_posts.*, yn_site_mem.*, x_post_retweets.r_user_id AS retweeted_by, x_post_retweets.r_created AS post_time FROM x_posts JOIN x_post_retweets ON x_posts.p_id = x_post_retweets.r_post_id LEFT JOIN yn_site_mem ON x_posts.p_user_id = yn_site_mem.mid WHERE x_post_retweets.r_user_id = ? ORDER BY post_time DESC LIMIT 30";
		$getPosts = $this->db->query($sql, [$yid, $yid]);
		$data['posts'] = $getPosts->result_array();

		$this->load->view('inc/_header', $data);
		$this->load->view('profile', $data);
		$this->load->view('inc/_footer', $data);
	}

	function liked()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . "'s Liked - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		// My Liked Posts
		$likedPosts = $this->db->query("SELECT x_posts.*, yn_site_mem.* FROM x_posts JOIN x_post_likes ON x_posts.p_id = x_post_likes.l_post_id LEFT JOIN yn_site_mem ON x_posts.p_user_id = yn_site_mem.mid WHERE x_post_likes.l_user_id = ? ORDER BY x_post_likes.l_created_at DESC LIMIT 30 ", [$yid]);
		$data['posts'] = $likedPosts->result_array();

		$this->load->view('inc/_header', $data);
		$this->load->view('liked', $data);
		$this->load->view('inc/_footer', $data);
	}

	function leads()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . "'s Leads - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;


		$this->load->view('inc/_header', $data);
		$this->load->view('leads', $data);
		$this->load->view('inc/_footer', $data);
	}


	function lead_details()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = " Lead Details - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$msid = $_GET['msid'];

		$myPosts = $this->db->query("SELECT * FROM yn_site_contact WHERE msid = '$msid' ");
		$posts = $myPosts->row_array();
		$data['details'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('lead_details', $data);
		$this->load->view('inc/_footer', $data);
	}

	function reels()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . "'s Reels - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$myPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = '$yid' ORDER BY p_created DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('reels', $data);
		$this->load->view('inc/_footer', $data);
	}

	function mentions()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . "'s Mentions - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$myPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = '$yid' ORDER BY p_created DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('mentions', $data);
		$this->load->view('inc/_footer', $data);
	}

	function add_property()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = "Add Property - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('add_property', $data);
		$this->load->view('inc/_footer', $data);
	}

	function my_property()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$data['seo_title'] = $themyuser_details['name'] . "'s Properties - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('my_property', $data);
		$this->load->view('inc/_footer', $data);
	}

	function userprofile($username)
	{
		$data = db_variables();
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
			redirect(base_url('profile'));
		}

		$getVendorData = $this->db->query("SELECT * FROM yn_site_mem WHERE username = '$username'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;
		$data['seo_title'] = $vendorData['name'] . "'s Profile - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$vendor_id = $vendorData['mid'];

		$myPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = '$vendor_id' ORDER BY p_created DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('user_profile', $data);
		$this->load->view('inc/_footer', $data);
	}

	function userliked($username)
	{
		$data = db_variables();
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
			redirect(base_url('profile'));
		}

		$getVendorData = $this->db->query("SELECT * FROM yn_site_mem WHERE username = '$username'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;
		$data['seo_title'] = $vendorData['name'] . "'s Liked - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$vendor_id = $vendorData['mid'];

		// User Liked Posts
		$likedPosts = $this->db->query("SELECT x_posts.*, yn_site_mem.* FROM x_posts JOIN x_post_likes ON x_posts.p_id = x_post_likes.l_post_id LEFT JOIN yn_site_mem ON x_posts.p_user_id = yn_site_mem.mid WHERE x_post_likes.l_user_id = ? ORDER BY x_post_likes.l_created_at DESC LIMIT 30 ", [$vendor_id]);
		$data['posts'] = $likedPosts->result_array();

		$this->load->view('inc/_header', $data);
		$this->load->view('user_liked', $data);
		$this->load->view('inc/_footer', $data);
	}

	function userreels($username)
	{
		$data = db_variables();
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
			redirect(base_url('profile'));
		}

		$getVendorData = $this->db->query("SELECT * FROM yn_site_mem WHERE username = '$username'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;
		$data['seo_title'] = $vendorData['name'] . "'s Reels - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$vendor_id = $vendorData['mid'];

		$myPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = '$vendor_id' ORDER BY p_created DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('user_reels', $data);
		$this->load->view('inc/_footer', $data);
	}

	function userproperties($username)
	{
		$data = db_variables();
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
			redirect(base_url('profile'));
		}

		$getVendorData = $this->db->query("SELECT * FROM yn_site_mem WHERE username = '$username'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;
		$data['seo_title'] = $vendorData['name'] . "'s Reels - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$vendor_id = $vendorData['mid'];

		$myPosts = $this->db->query("SELECT * FROM x_home_property LEFT JOIN yn_site_mem ON prop_vendor = mid WHERE prop_vendor = '$vendor_id' ORDER BY prop_id DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('user_properties', $data);
		$this->load->view('inc/_footer', $data);
	}

	function usermentions($username)
	{
		$data = db_variables();
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username) {
			redirect(base_url('profile'));
		}

		$getVendorData = $this->db->query("SELECT * FROM yn_site_mem WHERE username = '$username'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;
		$data['seo_title'] = $vendorData['name'] . "'s Mentions - " . $data['meta_title'];
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;



		$vendor_id = $vendorData['mid'];

		$myPosts = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_user_id = '$vendor_id' ORDER BY p_created DESC LIMIT 30");
		$posts = $myPosts->result_array();
		$data['posts'] = $posts;

		$this->load->view('inc/_header', $data);
		$this->load->view('user_mentions', $data);
		$this->load->view('inc/_footer', $data);
	}

	function otp_verify()
	{
		check_session(2, 'accounts');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$thedetails = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		// if ($thedetails['user_email_status'] == '1') {
		// 	redirect(base_url('profile'));
		// }

		if (isset($_SESSION['otp_verify']) && $_SESSION['otp_verify'] == '1') {
			redirect(base_url('profile'));
		}
		$data['profile_data'] = $thedetails;

		$this->load->view('inc/_header', $data);
		$this->load->view('otp_verify', $data);
		$this->load->view('inc/_footer', $data);
	}

	function edit($data_pass = null)
	{
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = 'Edit Profile - ' . $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Edit';
		$data['meta_array'] = $data;

		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('edit', $data);
		$this->load->view('inc/_footer', $data);
	}

	function kyc($data_pass = null)
	{
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = 'KYC Verification - ' . $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Edit';
		$data['meta_array'] = $data;

		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('kyc', $data);
		$this->load->view('inc/_footer', $data);
	}

	function become_investor($data_pass = null)
	{
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Edit';
		$data['meta_array'] = $data;

		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('manage_shop', $data);
		$this->load->view('inc/_footer', $data);
	}

	function manage_products($data_pass = null)
	{
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Edit';
		$data['meta_array'] = $data;

		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('manage_products', $data);
		$this->load->view('inc/_footer', $data);
	}

	function verify()
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$data['profile_data'] = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);


		check_session('2', 'account');
		$this->load->view('inc/_header', $data);
		$this->load->view('verify', $data);
		$this->load->view('inc/_footer', $data);
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
		redirect(base_url());
	}


	function explore($id = null, $cat = null)
	{


		// if (check_service_status('1', '2', 'bl') != '1') {
		// 	redirect('error-404?e=this feature is not enabled.');
		// }

		$data = db_variables();
		if ($cat == '') {
			$data['seo_title'] = 'News - ' .  $data['meta_title'];
		} else {
			$formatted_cat = ucwords(str_replace('-', ' ', $cat));
			$data['seo_title'] = $formatted_cat . ' - ' .  $data['meta_title'];
		}
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		$geththeblogs = $this->db->query("select * from yn_site_blogs order by blog_id desc");
		$total_num = $geththeblogs->num_rows(); //'100';
		$rec_per_page = '10';
		$this->load->library('pagination');
		$config['base_url'] = base_url('blog');
		$config['total_rows'] = $total_num;
		$config['per_page'] = $rec_per_page;
		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = "";
		$config['full_tag_close'] = '';
		$config['reuse_query_string'] = true;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config);

		@$page = $_GET['page'];
		if (isset($_GET['page'])) {
			$page = $page - 1;
		}
		$limit1 = $page * $rec_per_page;

		if ($id != '') {
			$filter = 'WHERE cat = ' . $id;
		}

		//echo "select * from yn_site_blogs order by blog_id desc  limit $limit1, $rec_per_page ";die;
		$geththeblogs = $this->db->query("select * from yn_site_blogs $filter order by blog_id desc limit $limit1, $rec_per_page ");
		$all_blogs = $geththeblogs->result_array();
		$data['blogs'] = $all_blogs;

		if (@$_GET['q'] != '') {
			$q = clean($_GET['q']);
			$allblogs = $this->db->query("select * from yn_site_blogs where title like '%$q%' order by blog_id desc");
		} else {
			$allblogs = $this->db->query("select * from yn_site_blogs order by blog_id desc  limit 10 ");
		}


		$show_blogs = $allblogs->result_array();
		$data['show_blogs'] = $show_blogs;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section.php', $data);
		$this->load->view('blog', $data);
		$this->load->view('inc/_footer', $data);
	}
	function theBlog($slug)
	{


		// if (check_service_status('1', '2', 'bl') != '1') {
		// 	redirect('error-404?e=this feature is not enabled.');
		// }

		count_view('bl', 'un');

		$data = db_variables();
		$config['base_url'] = base_url('blog');

		$geththeblog = $this->db->query("select * from yn_site_blogs where slug='$slug'");
		$theBlog = $geththeblog->row_array();
		$data['blog_rea'] = $theBlog;

		if (empty($theBlog)) {
			redirect(base_url('error-404?e=no blog found.'));
		}

		$data['seo_title'] = $theBlog['title'];
		$data['seo_description'] = trim_text(strip_tags($theBlog['comment']), 200);
		if ($theBlog['blog_img'] != '')
			$data['seo_image'] = base_url('assets/avator/upload/') . $theBlog['blog_img'];
		else
			$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'YNAPS';
		$data['meta_array'] = $data;

		$cat = $theBlog['category'];

		$geththeblogs = $this->db->query("select * from yn_site_blogs where category='$cat' order by blog_id desc limit 2 ");
		$all_blogs = $geththeblogs->result_array();
		$data['show_blogs'] = $all_blogs;


		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('theBlog', $data);
		$this->load->view('inc/_footer', $data);
	}

	function setcurrency()
	{
		$cur = xss_clean($_GET['c']);
		switch ($cur) {
			case 'USD':
			case 'INR':
				$_SESSION['currency'] = $cur;
				break;
			default:
				$_SESSION['currency'] = $cur;
				break;
		}
	}


	function pay_now()
	{
		@session_start();
		$cid = $_SESSION['ecom_order_id'];
		// check_session('2', 'account');

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$yid = $_SESSION['yid'];
		$thedetails = $this->ynaps_model->getprofile_data('*', $yid);
		$data['profile_data'] = $thedetails;

		$getListing = $this->db->query("SELECT * FROM `yn_ecom_order` where so_order_id='$cid'");
		$data['theorder'] = $getListing->row_array();
		// if (empty($data['theorder'])) {
		// 	redirect(base_url('profile'));
		// }

		$data['cid'] = $cid;

		$this->load->view('inc/_header', $data);
		// $this->load->view('inc/section', $data);
		$this->load->view('pay_now.php', $data);
		$this->load->view('inc/_footer', $data);
	}

	function thank_you()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('thank_you.php', $data);
		$this->load->view('inc/_footer', $data);
	}

	function search()
	{
		$data = db_variables();
		$data['seo_title'] = 'Search - ' . $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('search', $data);
		$this->load->view('inc/_footer', $data);
	}

	function search_backup()
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		$conditions = array();

		@$q = $_GET['q'];

		if ($q != '') {
			$conditions[] = "(name like '%$q%' OR usernae like '%$q%')";
		}

		$sql_filter = "user_status!='2'";
		if (count(@$conditions) > 0) {
			$sql_filter .= ' AND ' . implode(' AND ', @$conditions);
		}


		$allrecords = $this->db->query("select * from yn_site_mem $sql_filter order by mid desc");

		$total_num = $allrecords->num_rows();
		$data['total_num'] = $total_num;
		$rec_per_page = '40';
		$this->load->library('pagination');
		$config['base_url'] = base_url('search');
		$config['total_rows'] = $total_num;
		$config['per_page'] = $rec_per_page;
		$config['num_links'] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = "";
		$config['full_tag_close'] = '';
		$config['reuse_query_string'] = true;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config);

		@$page = $_GET['page'];
		if (isset($_GET['page'])) {
			$page = $page - 1;
		}
		$limit1 = $page * $rec_per_page;

		//echo "select * from x_edu_courses where $sql_filter order by course_id desc  limit 10";die;
		$allcourses = $this->db->query("select * from yn_site_mem $sql_filter order by mid desc limit $limit1,$rec_per_page");
		$show_courses = $allcourses->result_array();
		$data['show_courses'] = $show_courses;

		$this->load->view('inc/_header', $data);
		$this->load->view('search', $data);
		$this->load->view('inc/_footer', $data);
		//unset($_SESSION['filters']);
	}


	function auto_search($course)
	{
		$q = $this->input->post('search');
		switch ($course) {
			case 'course':

				$geththecourses = $this->db->query("select * from x_edu_courses where ( (course_name like '%$q%') and course_status='1') limit 8");
				// select * from x_edu_courses where course_status='1' order by course_id desc  limit 10
				// echo "select * from x_edu_courses where ( (course_name like '%$q%') and course_status='1' limit 8"; die;

				$thedetails_course = $geththecourses->result_array();
				foreach ($thedetails_course as $courses) { ?>
					<div class="col-12 py-2">
						<a
							href="<?= base_url('courses?q=') ?><?= preg_replace('/[^A-Za-z0-9\-]/', ' ', $courses['course_name']) ?>"><b><?= $courses['course_name'] ?></b></a>
					</div>
				<?php }
				break;
			default:
				$getproducts = $this->db->query("select * from rm_post,site_mem where (rmp_status !='0' and rmp_user=mid) and (rmp_title like '%$q%' or rmp_cat_name like '%$q%' or name like '%$q%') limit 5");
				$allproducts = $getproducts->result_array();
				foreach ($allproducts as $pro) { ?>
					<a href="<?= base_url('article') ?>?id=<?= $pro['rmp_id'] ?>" class='no_link_90'>
						<div class="list_details">
							<?= $pro['rmp_title'] ?></b> in <?= $pro['rmp_cat_name'] ?>
						</div>
					</a>
<?php }
				break;
		}
	}

	function shop()
	{

		if (check_service_status('1', '2', 'eco') != '1') {
			redirect('error-404?e=this feature is not enabled.');
		}

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		// Top products
		$topProducts = $this->db->query("SELECT * FROM yn_ecom_products WHERE p_sale_status = '5' ORDER BY p_id DESC LIMIT 4");
		$topProductsData = $topProducts->result_array();
		$data['topProducts'] = $topProductsData;



		$searchIng = "";
		if (isset($_GET['cate']) && $_GET['cate'] != "" && $_GET['cate'] != null) {
			$cate = $_GET['cate'];

			$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` where p_category ='$cate' order by p_id desc limit 100");
		} elseif (isset($_GET['scate']) && $_GET['scate'] != "" && $_GET['scate'] != null) {
			$scate = $_GET['scate'];

			$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` WHERE p_sub_category='$scate' ORDER BY p_id DESC LIMIT 100;");
		} elseif (isset($_GET['sscate']) && $_GET['sscate'] != "" && $_GET['sscate'] != null) {
			$sscate = $_GET['sscate'];

			$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` WHERE p_sub_sub_cat='$sscate' ORDER BY p_id DESC LIMIT 100;");
		} elseif (isset($_GET['q']) && $_GET['q'] != "" && $_GET['q'] != null) {
			$q = $_GET['q'];

			$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` WHERE p_name LIKE '%$q%' ORDER BY p_id DESC LIMIT 100;");
		} elseif (isset($_GET['min_price']) && isset($_GET['max_price'])) {
			$minPrice = $_GET['min_price'];
			$maxPrice = $_GET['max_price'];

			if (is_numeric($minPrice) && is_numeric($maxPrice)) {
				$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` WHERE p_price BETWEEN $minPrice AND $maxPrice ORDER BY p_id DESC LIMIT 100;");
			}
		} else {
			$getProducts = $this->db->query("SELECT * FROM `yn_ecom_products` order by p_id desc limit 100");
		}
		$the_prods = $getProducts->result_array();
		$data['prod'] = $the_prods;



		$gettags = $this->db->query("SELECT * FROM `yn_site_tags` order by stg_tgid asc limit 10");
		$all_tags = $gettags->result_array();
		$data['alltags'] = $all_tags;



		$thecats = $this->db->query("select * from yn_site_catagory order by sid asc limit 6");
		$all_cats = $thecats->result_array();
		$data['the_cats'] = $all_cats;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('shop.php', $data);
		$this->load->view('inc/_footer', $data);
	}

	function cart()
	{

		if (check_service_status('1', '2', 'eco') != '1') {
			redirect('error-404?e=this feature is not enabled.');
		}

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$allpoppro = $this->db->query("select * from yn_ecom_products ORDER BY p_id desc limit 5 ");
		$thepoppro = $allpoppro->result_array();
		$data['prod'] = $thepoppro;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('cart.php', $data);
		$this->load->view('inc/_footer', $data);
	}

	function product($pid, $pname)
	{
		// function product(){

		if (check_service_status('1', '2', 'eco') != '1') {
			redirect('error-404?e=this feature is not enabled.');
		}

		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;


		// featured products
		$featuredproducts = $this->db->query("SELECT * FROM yn_ecom_products WHERE p_sale_status = '2' ORDER BY p_id DESC LIMIT 3");
		$featuredproductsdata = $featuredproducts->result_array();
		$data['featuredProducts'] = $featuredproductsdata;


		$allpoppro = $this->db->query("select * from yn_ecom_products ORDER BY RAND() limit 5 ");
		$thepoppro = $allpoppro->result_array();
		$data['prod'] = $thepoppro;

		$getprd = $this->db->query("select * from yn_ecom_products where p_id='$pid'  ");
		$thepfd = $getprd->row_array();

		$getprd_img = $this->db->query("select * from  yn_ecom_products_img where pid='$pid'  ");
		$thepfd_mimg = $getprd_img->result_array();

		$data['product'] = $thepfd;
		$data['prod_img'] = $thepfd_mimg;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('product.php', $data);
		$this->load->view('inc/_footer', $data);
	}



	function test()
	{
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "</pre>";
		// $this->load->view('test');
	}


	///////////////////////	


	function checkout()
	{
		@session_start();
		check_session('2', 'login');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('checkout', $data);
		$this->load->view('inc/_footer', $data);
	}

	function help()
	{
		@session_start();
		check_session('2', 'login');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];
		$data['seo_description'] = $data['meta_desc'];
		$data['seo_image'] = $data['meta_image'];
		$data['seo_keywords'] = $data['meta_key'];
		$data['meta_array'] = $data;

		$this->load->view('inc/_header', $data);
		$this->load->view('inc/section', $data);
		$this->load->view('help', $data);
		$this->load->view('inc/_footer', $data);
	}

	public function fetch_my_posts()
	{
		$yid = $_SESSION['yid'];
		$offset = $this->input->post('offset');
		$limit = 5;

		$this->db->select('
        x_posts.*, 
        yn_site_mem.name, 
        yn_site_mem.username, 
        CONCAT("assets/mem/", yn_site_mem.mid, "/img/", yn_site_mem.photo) AS user_image');
		$this->db->from('x_posts');
		$this->db->join('yn_site_mem', 'x_posts.p_user_id = yn_site_mem.mid', 'left');
		$this->db->where('x_posts.p_user_id', $yid);
		$this->db->order_by('x_posts.p_created', 'DESC');
		$this->db->limit($limit, $offset);

		$query = $this->db->get()->result_array();

		echo json_encode($query);
	}

public function toggle_like()
{
    $post_id = $this->input->post('post_id');
    $user_id = $_SESSION['yid'];

    if (!$user_id) {
        echo json_encode(['status' => 'error', 'message' => 'Login required']);
        return;
    }

    // Check if user already liked
    $liked = $this->db->get_where('x_post_likes', [
        'l_post_id' => $post_id,
        'l_user_id' => $user_id
    ])->num_rows() > 0;

    if ($liked) {
        // Unlike
        $this->db->delete('x_post_likes', ['l_post_id' => $post_id, 'l_user_id' => $user_id]);
        $status = 'unliked';
    } else {
        // Like
        $this->db->insert('x_post_likes', ['l_post_id' => $post_id, 'l_user_id' => $user_id]);
        $status = 'liked';
    }

    // Recalculate likes count to avoid mismatch
    $count = $this->db->where('l_post_id', $post_id)->count_all_results('x_post_likes');

    $this->db->where('p_id', $post_id)
             ->update('x_posts', ['p_likes_count' => $count]);

    echo json_encode(['status' => $status, 'likes_count' => $count]);
}


	public function toggle_repeat()
	{
		$post_id = $this->input->post('post_id');
		$user_id = $_SESSION['yid'];

		if (!$user_id) {
			echo json_encode(['status' => 'error', 'message' => 'Login required']);
			return;
		}

		if (has_repeated_post($post_id, $user_id)) {
			// Remove repeat
			$this->db->delete('x_post_retweets', ['r_post_id' => $post_id, 'r_user_id' => $user_id]);
			$this->db->query("UPDATE x_posts SET p_share_count = p_share_count - 1 WHERE p_id = ?", [$post_id]);
			echo json_encode(['status' => 'unrepeated']);
		} else {
			// Add repeat
			$this->db->insert('x_post_retweets', ['r_post_id' => $post_id, 'r_user_id' => $user_id]);
			$this->db->query("UPDATE x_posts SET p_share_count = p_share_count + 1 WHERE p_id = ?", [$post_id]);
			echo json_encode(['status' => 'repeated']);
		}
	}

public function add_comment()
{
    $post_id = $this->input->post("post_id");
    $comment_text = trim($this->input->post("comment_text"));
    $user_id = $_SESSION['yid'];

    if (empty($comment_text)) {
        echo json_encode(["status" => "error", "message" => "Comment cannot be empty"]);
        return;
    }

    $comment_data = [
        "c_post_id" => $post_id,
        "c_user_id" => $user_id,
        "c_comment_text" => addslashes($comment_text),
        "c_created_at" => date("Y-m-d H:i:s")
    ];

    $this->db->insert("x_post_comments", $comment_data);
    $insert_id = $this->db->insert_id();

    if ($insert_id) {
        // ✅ Recalculate total comments count
        $comment_count = $this->db
            ->where("c_post_id", $post_id)
            ->count_all_results("x_post_comments");

        // ✅ Update x_posts table
        $this->db->where("p_id", $post_id)
                 ->update("x_posts", ["p_comments_count" => $comment_count]);

        // ✅ Get user name
        $user_name = get_user_name($user_id);

        echo json_encode([
            "status" => "success",
            "comment_text" => $comment_text,
            "user_name" => $user_name,
            "comment_count" => $comment_count // send updated count to frontend
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add comment"]);
    }
}

	public function get_comments($post_id)
	{
		$comments = get_comments_by_post($post_id);
		echo json_encode($comments);
	}


	public function retweetPost()
	{
		$user_id = $_SESSION['yid'];
		$post_id = $this->input->post('post_id');

		if (!$user_id || !$post_id) {
			echo json_encode(["status" => "error", "message" => "Invalid request."]);
			return;
		}

		// Check if the user has already retweeted the post
		$exists = $this->db->query("SELECT * FROM x_post_retweets WHERE r_user_id = ? AND r_post_id = ?", [$user_id, $post_id])->row_array();

		if (!$exists) {
			$this->db->query("INSERT INTO x_post_retweets (r_user_id, r_post_id) VALUES (?, ?)", [$user_id, $post_id]);
			$this->db->query("UPDATE x_posts SET p_share_count = p_share_count + 1 WHERE p_id = ?", [$post_id]);
			echo json_encode(["status" => "success", "action" => "retweeted"]);
		} else {
			$this->db->query("DELETE FROM x_post_retweets WHERE r_user_id = ? AND r_post_id = ?", [$user_id, $post_id]);
			$this->db->query("UPDATE x_posts SET p_share_count = GREATEST(p_share_count - 1, 0) WHERE p_id = ?", [$post_id]);
			echo json_encode(["status" => "success", "action" => "unretweeted"]);
		}
	}

	public function searchUsers()
	{
		$search = $this->input->post('search');
		$search = str_replace("@", "", $search);

		$query = $this->db->query("SELECT `mid`, `name`, `username`, `user_status`, `photo` FROM yn_site_mem WHERE `user_status` != '2' AND `name` LIKE ? OR `username` LIKE ?", ["%$search%", "%$search%"]);

		$users = $query->result_array();

		$output = "";
		foreach ($users as $vendor) {
			$profilePic = !empty($vendor['photo']) ? base_url('assets/mem/' . $vendor['mid'] . '/img/' . $vendor['photo']) : base_url('assets/default-avatar.png');
			$profileLink = base_url('userprofile/' . $vendor['username']);

			$output .= '
				<a href="' . $profileLink . '" class="bg-white p-3 border-bottom d-flex text-dark text-decoration-none account-item pf-item my-2 radius_2">
					<img src="' . $profilePic . '" class="img-fluid rounded-circle me-3" alt="profile-img">
					<div>
						<p class="fw-bold mb-0 pe-3 d-flex align-items-center">' . $vendor['name'];

			if ($vendor['user_status'] == '9') {
				$output .= '<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>';
			}

			$output .= '</p>
						<div class="text-muted fw-light">
							<p class="mb-1 small">@' . $vendor['username'] . '</p>
							<span class="text-muted d-flex align-items-center small"><span class="material-icons me-1 small">open_in_new</span>Investor</span>
						</div>
					</div>
					<div class="ms-auto btn-group" role="group">
						<input type="checkbox" class="btn-check follow-toggle" id="followBtn' . $vendor['mid'] . '" data-user-id="' . $vendor['mid'] . '" ' . (favourite_me_user($vendor['mid']) ? 'checked' : '') . '>
						<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn' . $vendor['mid'] . '">
							<span class="follow ' . (favourite_me_user($vendor['mid']) ? 'd-none' : '') . '">+ Follow</span>
							<span class="following ' . (favourite_me_user($vendor['mid']) ? '' : 'd-none') . '">Following</span>
						</label>
					</div>
				</a>';
		}

		echo $output;
	}

	function user_shop($shop_id)
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$this->load->helper('url');
		$total_segments = $this->uri->total_segments();
		$second_to_last_segment = $this->uri->segment($total_segments - 1);
		$last_segment = $this->uri->segment($total_segments);
		$pageSlug = base_url('user-shop/' . $last_segment);

		$all_records = $this->db->query("SELECT * FROM yn_ecom_products LEFT JOIN x_vendor_shop ON p_vendor = shop_uniq_id WHERE p_vendor = '$shop_id' AND p_status = '1'");
		$total_num = $all_records->num_rows();
		$rec_per_page = '20';
		$this->load->library('pagination');
		$config['base_url'] = $pageSlug;
		$config['total_rows'] = $total_num;
		$config['per_page'] = $rec_per_page;
		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = "";
		$config['full_tag_close'] = '';
		$config['reuse_query_string'] = true;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config);

		@$page = $_GET['page'];
		if (isset($_GET['page'])) {
			$page = $page - 1;
		}
		$limit1 = $page * $rec_per_page;

		// Shop products
		$shop_products = $this->db->query("SELECT * FROM yn_ecom_products LEFT JOIN x_vendor_shop ON p_vendor = shop_uniq_id LEFT JOIN yn_site_mem ON p_mid = mid WHERE p_vendor = '$shop_id' AND p_status = '1' ORDER BY p_id DESC LIMIT $limit1, $rec_per_page");
		$posts = $shop_products->result_array();
		$data['products'] = $posts;

		$getVendorData = $this->db->query("SELECT * FROM x_vendor_shop WHERE shop_uniq_id = '$shop_id'");
		$vendorData = $getVendorData->row_array();
		$data['profile_data'] = $vendorData;

		$this->load->view('inc/_header', $data);
		$this->load->view('user_shop', $data);
		$this->load->view('inc/_footer', $data);
	}

	function add_product()
	{
		@session_start();
		check_session('2', 'account');
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$yid = $_SESSION['yid'];
		$themyuser_details = $this->ynaps_model->getprofile_data('*', $_SESSION['yid']);
		$data['profile_data'] = $themyuser_details;

		$this->load->view('inc/_header', $data);
		$this->load->view('shop_add_product', $data);
		$this->load->view('inc/_footer', $data);
	}

	function post($postid)
	{
		$data = db_variables();
		$data['seo_title'] = $data['meta_title'];;
		$data['seo_description'] = $data['meta_title'];;
		$data['seo_image'] = base_url('assets/avator/og_img.jpg');
		$data['seo_keywords'] = 'keywords';
		$data['page_name'] = 'Profile';
		$data['meta_array'] = $data;

		$post_details = $this->db->query("SELECT * FROM x_posts LEFT JOIN yn_site_mem ON p_user_id = mid WHERE p_uniq_id = '$postid'");
		$post = $post_details->row_array();
		$data['post'] = $post;

		$this->load->view('inc/_header', $data);
		$this->load->view('post_details', $data);
		$this->load->view('inc/_footer', $data);
	}
}
