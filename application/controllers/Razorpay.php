<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package Razorpay :  CodeIgniter Razorpay Gateway
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Razorpay Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Razorpay extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Site', 'site');     
    }
    // index page
    public function index()
    {
        $data = db_variables();
        $data['title'] = 'Razorpay | TechArise';
        // $data['productInfo'] = $this->site->getProduct();           

        $data['seo_title'] = 'Get Expert Beauty, Cleaning &amp; Repair Services at Home';
        $data['seo_description'] = "Get Expert Beauty, Cleaning &amp; Repair Services at Home";
        $data['seo_image'] = base_url('assets/avator/og_img.jpg');
        $data['seo_keywords'] = 'Get Expert Beauty, Cleaning &amp; Repair Services at Home';
        $data['page_name'] = 'Ynaps.com';

        $this->load->view('inc/_header', $data);
        $this->load->view('razorpay/pay_raz.php', $data);
        $this->load->view('inc/_footer', $data);
    }

    // checkout page
    public function checkout($id)
    {
        $data = db_variables();
        $data['title'] = 'Checkout payment | TechArise';
        // $this->site->setProductID($id);
        // $data['itemInfo'] = $this->site->getProductDetails(); 
        $data['return_url'] = site_url() . 'razorpay/callback';
        $data['surl'] = site_url() . 'razorpay/success';;
        $data['furl'] = site_url() . 'razorpay/failed';;
        $data['currency_code'] = 'INR';

        $this->load->view('inc/_header', $data);
        $this->load->view('razorpay/raz_check.php', $data);
        $this->load->view('inc/_footer', $data);
    }

    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)
    {
        $url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        //curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }

    // callback method
    public function callback()
    {

        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {

            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $merchant_order_id = $this->input->post('merchant_order_id');
            // echo $merchant_order_id; die;

            $email = $this->input->post('email');
            $phone = $this->input->post('phone');

            // if(isset($_POST['series_name']) && $_POST['series_name']!=''){
            //     $or_type='series';
            //     $series_name = @$this->input->post('series_name');
            // }

            // if(isset($_POST['courseName']) && $_POST['courseName']!=''){
            //     $or_type='course';
            //     $series_name = @$this->input->post('courseName');
            // }

            $ecom_order_name = $this->input->post('ecom_order_name');
            //  echo $ecom_order_name; die;
            $success = false;
            $error = '';
            try {
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    echo $error = 'Curl error: ' . curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                    //echo "<pre>";print_r($response_array);die;
                    //Check success response
                    if ($http_status === 200 and isset($response_array['error']) === false) {
                        $success = true;
                    } else {
                        $success = false;
                        if (!empty($response_array['error']['code'])) {
                            $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
                        } else {
                            $error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
                        }
                    }
                }
                //close connection
                curl_close($ch);
            }
            // catch (Exception $e) {
            //     $success = false;
            //     $this->db->query("insert into yn_ecom_cr_order (or_orid,or_status,or_mid,or_amount,or_date_created,or_type) values ('$merchant_order_id','2','1','$amount',now(), '$or_type') ");
            //     $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            // }

            catch (Exception $e) {
                $success = false;
                $this->db->query("UPDATE `yn_ecom_order` SET `so_status`='1' WHERE so_order_id='$merchant_order_id' ");
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }

            if ($success === true) {

                // if($or_type=='course'){
                //     $this->db->query("UPDATE `x_edu_enrollments` SET `co_payment_status`='1',`co_status`='1' WHERE co_order_id='$merchant_order_id' ");
                // }elseif($or_type=='series'){
                //     $this->db->query("UPDATE `x_edu_series_enroll` SET `se_payment_status`='1',`se_status`='1' WHERE se_order_id='$merchant_order_id' ");
                // }
                // $this->db->query("insert into yn_ecom_cr_order (or_orid, or_status, or_mid,or_amount,or_date_created,or_type) values ('$merchant_order_id','1','1','$amount',now(), '$or_type')");        

                $yid = $_SESSION['yid'];
                $this->db->query("UPDATE `yn_ecom_order` SET `so_status`='2' WHERE so_order_id='$merchant_order_id'");
                $this->db->query("UPDATE `yn_site_mem` SET `user_plan`='member' WHERE mid='$yid'");

                $site_details = db_variables();
                $site_brief = $site_details['site_brief'];
                $site_name = $site_details['site_name'];
                $site_email = $site_details['site_email'];
                $site_address = $site_details['site_address'];

                $emaillist_act = array("$theuser_email", "$site_email");
                $json_string = array('to' => $emaillist_act, 'category' => 'signup-form');
                $tos = "$theuser_email";
                $subject09 = "Order placed successfully #$merchant_order_id";
                $preheader = "You have successfully checkout for the Products";
                $greet = "Hi, $ecom_order_name";
                $message = "Thank you for Joining. <br/> Your course starts from Today";
                $message .= "<br/><br/>Your Order ID: <br>" . $merchant_order_id;
                // $message.="<br/>Course Name: <br/>".$courseName;

                $link = base_url();
                $linkname = 'Browse Website';
                $message2 = "$site_brief";
                $greet2 = 'Thank you so much';
                $myName_emailis = "Membership";
                $messageto90 = email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address);
                send_email($tos, $subject09, $messageto90, $site_name, $json_string);


                if (!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                if (!$order_info['order_status_id']) {
                    $this->db->query("insert into yn_ecom_cr_order (or_orid,or_status,or_mid,or_amount,or_date_created,or_type) values ('$merchant_order_id','5','1','$amount',now(), '$or_type') ");
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    $this->db->query("insert into yn_ecom_cr_order (or_orid,or_status,or_mid,or_amount,or_date_created,or_type) values ('$merchant_order_id','6','1','$amount',now(), '$or_type') ");
                    redirect($this->input->post('merchant_surl_id'));
                }
            } else {


                if ($or_type == 'course') {
                    $this->db->query("UPDATE `x_edu_enrollments` SET `co_payment_status`='1',`co_status`='1' WHERE co_order_id='$merchant_order_id' ");
                } elseif ($or_type == 'series') {
                    $this->db->query("UPDATE `x_edu_series_enroll` SET `se_payment_status`='1',`se_status`='1' WHERE se_order_id='$merchant_order_id' ");
                }


                $this->db->query("insert into yn_ecom_cr_order (or_orid,or_status,or_mid,or_amount,or_date_created, or_type) values ('$merchant_order_id','3','1','$amount',now(), '$or_type') ");

                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            $this->db->query("insert into yn_ecom_cr_order (or_orid,or_status,or_mid,or_amount,or_date_created, or_type) values ('$merchant_order_id','0','1','$amount',now(), '$or_type') ");
            echo 'An error occured. Contact site administrator, please!';
        }
    }


    public function success()
    {
        $data['title'] = 'Razorpay Success | TechArise';
        $this->load->view('razorpay/success', $data);
    }
    public function failed()
    {
        $data['title'] = 'Razorpay Failed | TechArise';
        $this->load->view('razorpay/failed', $data);
    }
}
