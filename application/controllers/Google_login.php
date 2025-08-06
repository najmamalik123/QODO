<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('google_login_model');
 }

 function login(){
  include_once APPPATH . "libraries/vendor/autoload.php";
  $google_client = new Google_Client();
  $google_client->setClientId('112177324296-hf2rmbq0bpm7sg7co64rbs7utq2rrmfo.apps.googleusercontent.com'); //Define your ClientID
  $google_client->setClientSecret('yY9iT3tn9Kex_YMdkMIU2ckt'); //Define your Client Secret Key
  $google_client->setRedirectUri('https://courslyst.com/google_login/login'); //Define your Redirect Uri
  $google_client->addScope('email');
  $google_client->addScope('profile');
  
  if(isset($_GET["code"])){
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
   if(!isset($token["error"])){
    $google_client->setAccessToken($token['access_token']);
    $this->session->set_userdata('access_token', $token['access_token']);
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();
    $current_datetime = date('Y-m-d H:i:s');
    if($this->google_login_model->Is_already_register($data['id'])){
        // login now.
        redirect('profile');
    }else{
$user_data=array(
    'name' =>$data['given_name'].' '.$data['family_name'],
    'email' =>$data['email'],
    'contact' =>'00000',
    'pass' =>'-------',
    'cover' =>'cover.jpg',
    'photo' =>'photo.jpg',
    'social_login' =>$data['id'],
  );
     $this->google_login_model->Insert_user_data($user_data,$data['email'],'00',$data['given_name'].' '.$data['family_name']);
     redirect('profile');
    }}
}

  // $login_button = '';
  // $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://yosoy.dev/wp-content/uploads/2018/11/Google-Sign-In.png" /></a>';
  // $data['login_button'] = $login_button;
  // $this->load->view('google_login', $data);


 }
}
?>
