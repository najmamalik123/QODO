<?php
include_once('inc/config.php');
if(!isset($_SESSION['mobile']) || $_SESSION['mobile'] ==''){
    redirect('logout.php'); die;
}
$otp=rand(1111,9999);
$_SESSION['otp']=sha1($otp);
$mobileno=$_SESSION['mobile'];
$textsms="Hi, your OTP for creating account on $site_name is $otp.";
include_once('inc/sms.php');
redirect('otp-verify.php?sms=resent');
?>