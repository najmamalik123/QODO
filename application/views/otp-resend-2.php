<?php
include_once('inc/config.php');
if(!isset($_SESSION['phone']) || $_SESSION['phone'] ==''){
    redirect('logout.php'); die;
}
$otp=rand(1111,9999);
$_SESSION['otp']=sha1($otp);
$mobileno=$_SESSION['phone'];
$textsms="Hi, your OTP for login to $site_name is $otp.";
include_once('inc/sms.php');
redirect('login.php?otp=1');
?>