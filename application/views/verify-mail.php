<?php
include_once('inc/config.php');
@$m=$_GET['h'];
@$h=$_GET['m'];
$hemail=substr($h,4);
if(sha1($m) != $hemail){
 $msg="Link Broken (<a href='resend-email.php?email=$m'>Resend Link</a>) Please contact us if you can't verify your email.";   
}else{
    $msg='Thankyou for verifying your email';
    $updatemem=mysqli_query($conn,"update mem set verify='1' where email='$m'");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?=$site_name?>
        </title>
        <meta http-equiv="refresh" content="10;url=index.php">
            <?=$meta_index?>
            <?=$GA?>
        <?=$meta_data?>
    </head>
        <body>
            <?php include_once('inc/header.php'); ?>
            <div class="max_width_gen body_div">
                <div class="slider_div"><?php include_once('inc/slider.php'); ?></div>
                <div class='the_option_data'>
                    <h2>
                        <?=$msg?>
                    </h2>
                </div>
                
            </div>
            <?php include_once('inc/footer.php'); ?>
        </body>
</html>

