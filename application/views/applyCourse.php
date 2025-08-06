<style type="text/css">
    .header-section{display: none;}
    .footer-section{display: none;}
    body{background: url(<?=base_url('assets/theme/images/')?>feature/to-access-bg.png);background-position: right right;background-attachment: fixed;}
</style>

<div style="position: fixed;left: 50%;top: 40%;z-index: 999;text-align: center;">
        <img src="<?=base_url('assets/avator/favicon.png')?>" style='height: 80px;' ><br/>
        <img src="<?=base_url('assets/avator/ajaxloader.gif')?>" style='height: 90px;' >
    </div>

<?php
$check_srch_cookie=$this->input->cookie('user_cook', TRUE);
if (isset($check_srch_cookie)) {
    $cookie_id=$_COOKIE['user_cook'];
  }

if (isset($_SESSION['yid']) && $_SESSION['yid']>0) {
    $user_id=$_SESSION['yid'];
 }
else
	$user_id=0;

$applythecourse=$this->db->query("INSERT INTO x_cou_apply_course (apply_cou_id,apply_cookie_id,apply_user_id)  VALUES ('$couID', '$cookie_id', '$user_id')");
sleep(1);
redirect($cou_link, 'refresh');
?>

    