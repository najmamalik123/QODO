<?php
defined('BASEPATH') or exit('No direct script access allowed');

class E_com extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	function add_to_cart()
	{
		if (isset($_POST['pid']) && $_POST['pid'] != "") {
			$pid = $_POST['pid'];
			$pcolor = $_POST['ec_color'];
			$pweight = $_POST['ec_weight'];

			// Ensure quantity is at least 1
			$qty = isset($_POST['ec_qtybtn']) && $_POST['ec_qtybtn'] >= 1 ? $_POST['ec_qtybtn'] : 1;

			$checkthepro = $this->db->query("SELECT * FROM `yn_ecom_products` WHERE p_id='$pid'");

			// $checkthepro = $this->db->query("SELECT * FROM `yn_ecom_products` JOIN `yn_ecom_products_img` ON yn_ecom_products.p_id = yn_ecom_products_img.pid WHERE p_id='$pid'");

			$thedetails = $checkthepro->row_array();

			if ($thedetails) {
				// Create an associative array for the product
				$pro = array(
					'p_id' => $thedetails['p_id'],
					'p_name' => $thedetails['p_name'],
					'p_price' => $thedetails['p_price'],
					'p_img' => $thedetails['img'],
					'p_shipping_location' => $thedetails['p_shipping_location'],
					'p_shipping_cost' => $thedetails['p_shipping_cost'],
					'p_qty' => $qty,
					'p_color' => $pcolor,
					'p_weight' => $pweight,


				);

				// Check if the cart exists in the session
				if (!isset($_SESSION['ecom_cart'])) {
					$_SESSION['ecom_cart'] = array(); // Initialize the cart as an empty array
				} elseif (isset($_SESSION['ecom_cart']) && is_array($_SESSION['ecom_cart']) && count($_SESSION['ecom_cart']) > 0) {
					// Check if the product already exists in the cart
					$check_product = array_search($pid, array_column($_SESSION['ecom_cart'], 'p_id'));
					if ($check_product !== false) {
					}
				}

				// Add the product to the cart
				$_SESSION['ecom_cart'][] = $pro;

				echo 'YNAPS_SUCCESS';
			} else {
				echo "Product not found.";
			}
		} else {
			echo "Invalid operation! Try again later.";
		}
	}

	function clearCartSession()
	{
		unset($_SESSION['ecom_cart']);

		echo 'YNAPS_SUCCESS';
	}



	function add_to_carttt()
	{

		if (isset($_POST['pid']) && $_POST['pid'] != "") {

			$pid = $_POST['pid'];
			if (isset($_POST['ec_qtybtn']) && $_POST['ec_qtybtn'] != "" && $_POST['ec_qtybtn'] >= 1) {
				$qty = $_POST['ec_qtybtn'];
			} else {
				$qty = 1;
			}
			$checkthepro = $this->db->query("select * from `yn_ecom_products` where p_id='$pid' ");
			$thedetails = $checkthepro->row_array();
			// print_r($thedetails);die;
			$p_id 			   		= $thedetails['p_id'];
			$p_name		   			= $thedetails['p_name'];
			$p_vehicle			   	= $thedetails['p_vehicle'];
			$p_model			   	= $thedetails['p_model'];
			$p_year			   		= $thedetails['p_year'];
			$p_fuel			   		= $thedetails['p_fuel'];
			$p_description			= $thedetails['p_descp'];
			$p_shipping_location   	= $thedetails['p_shipping_location'];
			$p_shipping_cost		= $thedetails['p_shipping_cost'];
			$p_price				= $thedetails['p_price'];
			$p_discount				= $thedetails['p_discount'];
			$p_sku					= $thedetails['p_sku'];
			$p_color				= $thedetails['p_color'];
			$p_size					= $thedetails['p_size'];
			$p_category				= $thedetails['p_category'];


			if ($p_id >= 1) {

				$pro = array();


				$p_id 			   		= $thedetails['p_id'];
				$p_name		   			= $thedetails['p_name'];
				$p_vehicle			   	= $thedetails['p_vehicle'];
				$p_model			   	= $thedetails['p_model'];
				$p_year			   		= $thedetails['p_year'];
				$p_fuel			   		= $thedetails['p_fuel'];
				$p_description			= $thedetails['p_descp'];
				$p_shipping_location   	= $thedetails['p_shipping_location'];
				$p_shipping_cost		= $thedetails['p_shipping_cost'];
				$p_price				= $thedetails['p_price'];
				$p_discount				= $thedetails['p_discount'];
				$p_sku					= $thedetails['p_sku'];
				$p_color				= $thedetails['p_color'];
				$p_size					= $thedetails['p_size'];
				$p_category				= $thedetails['p_category'];


				// $pro['pro_id']					= $p_id;
				// $pro['pro_price']				= $p_price;
				// $pro['pro_title']				= $p_title;
				// // $pro['pro_name']				= $p_name;
				// // $pro['moq']						= $moq;
				// $pro['pro_desc']				= strip_tags($p_desc);
				// $pro['pro_rating']				= $p_star;
				// $pro['pro_img1']				= $p_Image1;
				// $pro['pro_img2']				= $p_Image2;
				// $pro['pro_provider_name']		= $p_provider_name;
				// $pro['pro_provider_address']	= $p_provider_address;
				// $pro['pro_qty']					= $qty;
				// $pro['time']					= $time;

				if (!isset($_SESSION['ecom_cart']) || empty(@$_SESSION['ecom_cart'])) {
					$cart = array();
					$cart['0'] = $pro;
					$_SESSION['ecom_cart'] = $cart;
					echo 'YNAPS_SUCCESS';
				} else {
					$cart = array();
					$cart['0'] = $pro;
					$_SESSION['ecom_cart'] = $cart;

					// $sess_cart = $_SESSION['ecom_cart'];
					// $det_check = multiSearch($sess_cart, array('prop_id' => $pid));

					// if (empty($det_check)) {
					// 	array_push($sess_cart, $pro);
					// 	$_SESSION['ecom_cart'] = $sess_cart;
					// } else {
					// 	$theid = get_id_multi_array($_SESSION['ecom_cart'], 'prop_id', $pid);
					// 	unset($sess_cart[$theid]);
					// 	array_push($sess_cart, $pro);
					// 	$_SESSION['ecom_cart'] = $sess_cart;
					// }
					echo 'YNAPS_SUCCESS';
				}

				// if(!isset($_SESSION['ecom_cart']) || empty(@$_SESSION['ecom_cart']) ){

				// 	$cart=array();			

				// 	$cart['0']=$pro;
				// 	$_SESSION['ecom_cart']=$cart;
				// 	echo 'YNAPS_SUCCESS';

				// }else{
				// 	$sess_cart=$_SESSION['ecom_cart'];

				// 	$det_check=multiSearch($sess_cart,array('pid' => $pid));

				// 	if(empty($det_check) ){
				// 		array_push($sess_cart,$pro);
				// 		$_SESSION['ecom_cart']=$sess_cart;
				// 	}else{

				// 		$theid=get_id_multi_array($_SESSION['ecom_cart'], 'pid', $pid);
				// 		unset($sess_cart[$theid]);
				// 		array_push($sess_cart,$pro);
				// 		$_SESSION['ecom_cart']=$sess_cart;
				// 	}
				// 	echo 'YNAPS_SUCCESS';
				// }

			} else {
				echo " Currently, This Test is not availabe";
			}
		} else {
			echo " Invalid operation! try again later.";
		}
	}

	function rem_frm_cart($pid)
	{
		if (isset($_SESSION['ecom_cart']) || !empty(@$_SESSION['ecom_cart'])) {
			$sess_cart = $_SESSION['ecom_cart'];
			$theid = get_id_multi_array($_SESSION['ecom_cart'], 'pro_id', $pid);
			unset($sess_cart[$theid]);
			$_SESSION['ecom_cart'] = $sess_cart;
			//print_r($_SESSION['ecom_cart']);die;
			redirect(base_url('cart'));
		}
	}

	function checkout()
	{

		$theprods = $_SESSION['ecom_cart'];
		if (empty($_SESSION['ecom_cart']) || !isset($_SESSION['ecom_cart'])) {
			redirect(base_url('membership'));
		}

		// print_r($_SESSION['ecom_cart']);return;
		if (isset($_SESSION['yid'])) {
			$yid = $_SESSION['yid'];
		} else {
			$yid = 0;
		}

		$name = $this->input->post('name');
		$address = addslashes($this->input->post('address'));
		$pin = $this->input->post('pin');
		$city = $this->input->post('city');
		$country = $this->input->post('country');

		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$pname = $this->input->post('pname');
		$pprice = $this->input->post('pprice');
		$pcolor = $this->input->post('pcolor');
		$pweight = $this->input->post('pweight');
		$ptotal = $this->input->post('ptotal');
		$yid = $this->input->post('yid');


		$chk_user_date = date("Y-m-d H:i:s");
		// $chk_time_hour=$this->input->post('chk_time_hour');
		// $chk_time_min=$this->input->post('chk_time_min');
		$_SESSION['chk_code'] = $chk_code = rand(1111111, 9999999);

		$theordrid = generate_order_id();

		if ($name != '' && $email != '' && $phone != '') {

			$tot = 0;
			$prolist = $pro_name_list = $proQty = $proPrice = $proPres = '';
			$Cart_products = array();
			foreach ($theprods as $cart_prod) {
				// echo $cart_prod; die;
				$Cart_products = array();
				//$thedata_pro=get_prod($cart_prod['pid'],'cart');
				// $tot += ($cart_prod['pro_price'] * $cart_prod['pro_qty']);
				$tot = $ptotal;


				$Cart_products = [
					'checkout_order_id' => $theordrid,
					'xod_pid' => $cart_prod['p_id'],
					'xod_title' => $cart_prod['p_name'],
					'xod_image1' => $cart_prod['p_img'],
					'xod_price' => $cart_prod['p_price'],
					'xod_qty' => $cart_prod['p_qty'],
				];

				$this->db->insert('yn_ecom_orders_detail', $Cart_products);
				// echo 'done'; die;
			}

			$_SESSION['ecom_amount'] = $tot;
			// $theordrid=generate_order_id();
			// print_r($_SESSION['ecom_cart']);




			$getlogins = $this->db->query("insert into `yn_ecom_order` (so_name, address, so_email, so_phone, so_mid, so_order_id,so_date,so_price,chk_user_date, chk_code) values ('$name', '$address','$email', '$phone', '$yid', '$theordrid', now(),'$tot', '$chk_user_date', '$chk_code')");


			@session_start();
			$_SESSION['ecom_order_id'] = $theordrid;
			//$_SESSION['ecom_order_id']=$this->db->insert_id();
			$_SESSION['ecom_order_name'] = $name;
			// $site_details=db_variables();
			// $site_brief=$site_details['site_brief'];
			// $site_name=$site_details['site_name'];
			// $site_email=$site_details['site_email'];
			// $site_address=$site_details['site_address'];

			// $emaillist_act=array("$email","$site_email");
			//       $json_string = array( 'to' =>$emaillist_act,'category' => 'signup-form');
			//       $tos="$email";
			//       $subject09="Products Checkout";
			//       $preheader="You have successfully checkout for the Products";
			//       $greet="Hi, $name";
			//       $message="Thank you for the Checkout. <br/> We will get back to you shortly.";
			//       $message.="Please refer to the code: $chk_code for future purpose.";
			//       $link=base_url();
			//       $linkname='Browse Website';
			//       $message2="$site_brief";
			//       $greet2='Thank you so much';
			//       $myName_emailis="Membership";
			//       $messageto90=email_template($preheader,$greet,$message,$link,$linkname,$message2,$greet2,$site_name,$site_address);
			//       send_email($tos,$subject09,$messageto90,$site_name,$json_string);
		} else {
			echo "Please fill all the Details";
			die;
		}
		//$_SESSION['ecom_cart'] = null;

		echo 'YNAPS_SUCCESS';
	}
	///////////////////
}
