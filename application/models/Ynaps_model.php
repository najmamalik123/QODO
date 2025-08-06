<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Ion Auth Model
 *
 * Version: 2.5.2
 *
 * Author:  Ben Edmunds
 * 		   ben.edmunds@gmail.com
 *	  	   @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Last Change: 3.22.13
 *
 * Changelog:
 * * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */

class ynaps_model extends CI_Model
{
	public function signup($signup_data, $email, $phone)
	{
		$query = $this->db->query("select email from yn_site_mem where email ='$email' ");

		// check mobile unique
		$query2 = $this->db->query("select email from yn_site_mem where contact ='$phone' ");
		if ($query2->num_rows() != '0') {
			echo "The phone number ($phone) you entered already exists in our records, please login or use different phone.";
			die;
		}

		if ($query->num_rows() == '0') {
			// print_r($signup_data); die;
			$this->db->insert('yn_site_mem', $signup_data);
			$yid = $this->db->insert_id();
			$_SESSION['yid'] = $yid;
			$_SESSION['plan'] = ' ';
			$roll_num = $yid . rand(1111, 9999) . date('ymd');
			$query2 = $this->db->query("UPDATE yn_site_mem SET roll_num ='$roll_num' where mid='$yid'");
			$_SESSION['roll_num'] = $roll_num;
			//Assign Login UserID to the cookie keyword
			//set_keyword_cookie($yid);
			return 'YNAPS_SUCCESS';
		} else {
			return "The email $email already exists in our records please choose other email or login.";
		}
	}

	function login_phone($phone, $pass = '')
	{
		// $pass=sha1($pass);
		// $query=$this->db->query("select * from yn_site_mem where contact='$phone' and pass ='$pass' and user_status !='2' ");
		$query = $this->db->query("select * from yn_site_mem where contact='$phone' and user_status !='2' ");
		if ($query->num_rows() == '1') {
			$dats_op = $query->row_array();

			if ($dats_op['user_status'] == '2') {
				echo "We are sorry, But your account is suspended. Please contact us for more.";
				die;
			}

			@session_start();
			$yid = $dats_op['mid'];
			$_SESSION['yid'] = $yid;
			$_SESSION['name'] = $dats_op['name'];
			$_SESSION['email'] = $dats_op['email'];
			$_SESSION['phone'] = $dats_op['contact'];
			$_SESSION['verify'] = $dats_op['verify'];
			$_SESSION['photo'] = $dats_op['photo'];
			$_SESSION['plan'] = $dats_op['user_plan'];
			$_SESSION['user_type'] = $dats_op['user_type'];
			$_SESSION['roll_num'] = $dats_op['roll_num'];
			//Assign Login UserID to the cookie keyword
			//set_keyword_cookie($yid);
			//myfav_items($yid);
			return true;
		} else {
			return false;
		}
	}


	function login($email, $pass)
	{
		$pass = sha1($pass);
		// echo $pass; die;
		$query = $this->db->query("select * from yn_site_mem where (email='$email' OR contact='$email') and pass ='$pass' and user_status !='2' ");
		if ($query->num_rows() == '1') {
			$dats_op = $query->row_array();

			if ($dats_op['user_status'] == '2') {
				echo "We are sorry, But your account is suspended. Please contact us for more.";
				die;
			}

			@session_start();
			$yid = $dats_op['mid'];
			$_SESSION['yid'] = $yid;
			$_SESSION['name'] = $dats_op['name'];
			$_SESSION['email'] = $dats_op['email'];
			$_SESSION['phone'] = $dats_op['contact'];
			$_SESSION['verify'] = $dats_op['verify'];
			$_SESSION['photo'] = $dats_op['photo'];
			$_SESSION['roll_num'] = $dats_op['roll_num'];
			$_SESSION['user_type'] = $dats_op['user_type'];
			$_SESSION['plan'] = $dats_op['user_plan'];
			//Assign Login UserID to the cookie keyword
			//set_keyword_cookie($yid);
			//myfav_items($yid);
			return true;
		} else {
			return false;
		}
	}


	function getprofile_data($data, $user)
	{
		$getdata = $this->db->query("select $data from yn_site_mem where mid='$user' ");
		return $getdata->row_array();
	}
	function get_startup_data($data, $user, $style)
	{
		$getdata = $this->db->query("select * from x_soo_startups where xst_mid='$user' and xst_status !='2' order by xst_id desc limit 1  ");
		return $getdata->row_array();
	}

	function get_location_ynaps($style, $data)
	{
		switch ($style) {
			case '1':
				$loca = $this->db->query("select city_name,state_name,country_name from site_cities c,site_states s,site_countries cu where (c.city_id='$data' and c.state_id=s.state_id and s.country_id=cu.country_id) ");
				$theresul = $loca->row_array();
				return $theresul;
				break;
		}
	}


	// ////
}
