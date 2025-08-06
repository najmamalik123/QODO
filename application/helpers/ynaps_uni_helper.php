<?php
function check_service_status($style, $more, $service_code)
{

    if (@$_SESSION['admin_data']['the_d_values'] == '' || !isset($_SESSION['admin_data']['the_d_values'])) {
        $ci = &get_instance();
        $checkdb = $ci->db->query("select * from yn_site_keys where ki_type ='ser' ");
        $the_d_values = $checkdb->row_array();

        $_SESSION['admin_data']['the_d_values'] = $the_d_values['ki_key'];
        $_SESSION['the_d_values'] = $the_d_values['ki_key'];
    }
    $theservlist = $_SESSION['admin_data']['the_d_values'];

    switch ($style) {
        case '1':
            $the_array_4 = explode(',', $theservlist);
            if (in_array($service_code, $the_array_4)) {
                return '1';
            }
            break;
    }
}

// send_data_tonodlys('lic','$name','$email','$u','$pass');
function send_data_tonodlys($lic, $name, $email, $u, $pass)
{
    $postParameter = array(
        'lic' => $lic,
        'name' => $name,
        'email' => $email,
        'job' => '1',
        'u' => $u,
        'pass' => $pass
    );

    $curlHandle = curl_init('https://ynaps.com/API/nodlys.php');
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($curlHandle);
    echo json_encode($curlResponse);
    curl_close($curlHandle);
}

function get_data_from_nodlys($job, $key, $data)
{
    $postParameter = array(
        'lic' => $key,
        'name' => $data,
        'job' => $job
    );

    $curlHandle = curl_init('https://ynaps.com/API/nodlys.php');
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postParameter);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($curlHandle);
    return $curlResponse;
    curl_close($curlHandle);
}


function upload_doc($fileNAmeis, $directory, $targetFileName = '', $file_name = '')
{
    if (isset($_POST)) {
        $DestinationDirectory   = $directory;

        if (!isset($_FILES["$fileNAmeis"]) || !is_uploaded_file($_FILES["$fileNAmeis"]['tmp_name'])) {
            die('Something wrong with uploaded file, something missing!');
            exit;
        }
        $refrenext = explode(".", $_FILES["$fileNAmeis"]["name"]);
        $extension = end($refrenext);
        $FileName      = str_replace(' ', '', strtolower($_FILES["$fileNAmeis"]['name'])); //get image name
        $FileName      = preg_replace('/[^A-Za-z0-9\-]/', '', $FileName);
        $ImageSize      = $_FILES["$fileNAmeis"]['size']; // get original image size
        $TempSrc        = $_FILES["$fileNAmeis"]['tmp_name']; // Temp name of image file stored in PHP tmp folder
        $FileType      = $_FILES["$fileNAmeis"]['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

        // if ($targetFileName == '') {
        $randomnumber = rand(111111111, 999999999);
        if ($file_name == '') {
            $targetFileName = $randomnumber . $FileName . '.' . $extension;
            $NewImageName3 = $targetFileName . '.' . $extension;
        } else {
            $targetFileName = $file_name;
            $NewImageName3 = $file_name;
        }
        // }

        $DestinationDirectory .= $NewImageName3;
        if (move_uploaded_file($_FILES["$fileNAmeis"]['tmp_name'], $DestinationDirectory)) {
            return 'SUCCXX' . $NewImageName3;
            die;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



function get_codes($what, $style)
{
    $ci = &get_instance();
    $checkdb = $ci->db->query("select * from yn_site_theme where thm_status='1' ");
    $checkdb_css_r = $checkdb->row_array();
    $thm_name = $checkdb_css_r['thm_name'];

    switch ($what) {
        case 'header':
            $thhe1_1 = str_replace("{{base_url}}", base_url('/'), $checkdb_css_r['thm_header2']);
            echo str_replace("{{theme}}", $thm_name, $thhe1_1);

            $he_he2 = str_replace("{{base_url}}", base_url('/'), $checkdb_css_r['thm_header1']);


            $seo_title = $style['seo_title'];
            $seo_description = $style['seo_description'];
            $seo_image = $style['seo_image'];
            $seo_keywords = $style['seo_keywords'];

            $he_he2 = str_replace('yn_seo_title', "$seo_title", $he_he2);
            $he_he2 = str_replace('yn_seo_description', "$seo_description", $he_he2);
            $he_he2 = str_replace('yn_seo_image', "$seo_image", $he_he2);
            $he_he2 = str_replace('yn_seo_keywords', "$seo_keywords", $he_he2);

            echo str_replace("{{theme}}", $thm_name, $he_he2);
            break;
        case 'footer':
            $thhe1_1 = str_replace("{{base_url}}", base_url('/'), $checkdb_css_r['thm_footer1']);
            echo str_replace("{{theme}}", $thm_name, $thhe1_1);
            $he_he2 = str_replace("{{base_url}}", base_url('/'), $checkdb_css_r['thm_footer2']);
            echo str_replace("{{theme}}", $thm_name, $he_he2);

            $checkdb = $ci->db->query("select * from  yn_admin_files where asid='1' ");
            $checkdb_css_r = $checkdb->row_array();
            if (check_service_status('1', '2', 'mobf') == '1') {
            echo $checkdb_css_r['mo_footer'];
            }if (check_service_status('1', '2', 'wabt') == '1') {
            echo $checkdb_css_r['wa_btn'];
            }


            break;
    }
}

function get_nav($place, $what)
{
    $ci = &get_instance();
    switch ($place) {
        case 'header':
            $sele_check = $ci->db->query("select * from yn_site_nav_items,yn_site_nav where nv_id=nv_nvid and nv_m_name ='$place' order by nv_weight asc ");
            return $the_deas = $sele_check->result_array();
            break;
        case 'all':
            $sele_check = $ci->db->query("select * from yn_site_nav_items,yn_site_nav where nv_id=nv_nvid and nv_m_name ='$what' order by nv_weight asc ");
            return $the_deas = $sele_check->result_array();
            break;
    }
}

function nav_link($link)
{
    echo str_replace("{{base_url}}", base_url(), $link);
}

function setup_theme_data($type, $data, $data2)
{
    $ci = &get_instance();
    switch ($type) {
        case 'navi':

            $thecheck = $ci->db->query("select * from yn_site_nav where nv_m_name ='header' ");
            if ($thecheck->num_rows() == 0) {
                $addthsis = $ci->db->query("insert into yn_site_nav (nv_m_name) values ('header') ");
            }
            $thecheck = $ci->db->query("select * from yn_site_nav where nv_m_name ='footer' ");
            if ($thecheck->num_rows() == 0) {
                $addthsis = $ci->db->query("insert into yn_site_nav (nv_m_name) values ('footer') ");
            }
            $thecheck = $ci->db->query("select * from yn_site_nav where nv_m_name ='footer1' ");
            if ($thecheck->num_rows() == 0) {
                $addthsis = $ci->db->query("insert into yn_site_nav (nv_m_name) values ('footer1') ");
            }
            $thecheck = $ci->db->query("select * from yn_site_nav where nv_m_name ='footer2' ");
            if ($thecheck->num_rows() == 0) {
                $addthsis = $ci->db->query("insert into yn_site_nav (nv_m_name) values ('copy') ");
            }
            if ($thecheck->num_rows() == 0) {
                $addthsis = $ci->db->query("insert into yn_site_nav (nv_m_name) values ('copy') ");
            }
            break;

            case 'footer_codes':

            $btn=addslashes("<div class='wa_float d-none d-sm-block' ><a href='wa.me/91'> <i class='text_shadow fa-brands fa-whatsapp fa-fade fa-lg'></i> </a></div>");
            $dis=addslashes("<div id='disqus_thread'></div>
                            <script>
                                /**
                                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                                /*
                                var disqus_config = function () {
                                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                };
                                */
                                (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://askmecity.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                                })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href='https://disqus.com/?ref_noscript'>comments powered by Disqus.</a></noscript>
                            <script id='dsq-count-scr' src='//askmecity.disqus.com/count.js' async></script>");
                            $ftr=addslashes("<div class='d-sm-none d-block the_mobile_fooeter p-2 col-12 shadow_2 pt-3'>
    <div class='row'>
        
<div class='col text-center'>
            <a href='services' >
                <span class='fa fa-globe the_9osp_s'></span>
            <br/><small>Services</small>
        </a>
        </div>

        <div class='col text-center'>
            <a href='tel:9034664487' >
                <span class='fa fa-phone-alt the_9osp_s'></span>
            <br/><small>Call Me</small>
        </a>
        </div>

        <!-- <div class='col text-center' id='footer-more-toggle'> -->
      <div class='col text-center'>
            <a href='https://wa.me/919034664487'>
                <span class='fa fa-whatsapp the_9osp_s'></span>
            <br/>
            <small>
WhatsApp Me 
            </small>
        </a>
        </div>
    </div>
</div>  


<div class='themain_leoafers d-sm-none' id='theloader_90' onclick='setTimeout(function() { $('#theloader_90').hide(); }, 2000);'>
    <div class='p-3 bg-white themains_s90s theshadows'>
        <img src='<?=base_url('assets/avator/Ajax-loader.gif')?>'>
    </div>
</div>

<div class='cookie_warning p-4 shadow bg-white round1'>
    <b>Are you on Diting?, We do use cookie !</b>
    <br/><small>Please see our <a href='privacy'>privacy</a> for our cookie policy. 
    <br/> please do accept them, We wont track you. 
    </small>
    <hr/>
    <button class='btn' onclick='accept_cookie();'>
        Accept Cookie
    </button>
        <i class='fa-duotone fa-cookie-bite fa-bounce pull-right mt-3'></i>
</div>


");


            $update_the=$ci->db->query("update yn_admin_files set wa_btn='$btn',disqus='$dis',mo_footer='$ftr' where asid='1' ");
            break;
    }
}

function get_sm()
{
    $admin_social_media = social_media_db(); // social media links
    $admin_data2['social_fb'] = $admin_social_media['fb'];
    $admin_data2['social_tw'] = $admin_social_media['tw'];
    $admin_data2['social_yt'] = $admin_social_media['yt'];
    $admin_data2['social_in'] = $admin_social_media['insta'];
    $admin_data2['social_linkedin'] = $admin_social_media['linkedin'];
    $admin_data2['app_and'] = $admin_social_media['app_and'];
    $admin_data2['app_ios'] = $admin_social_media['app_ios']; ?>

    <h5 class="m-0">Follow us on our social Media</h5>
    <ul class="social-share icon-transparent">
        <?php
        if ($admin_social_media['fb'] != '' && $admin_social_media['fb'] != '#') { ?>
            <li><a href="<?= $admin_social_media['fb'] ?>" target='_blank' class="color-fb"><i class="icon-facebook"></i></a></li>
        <?php }
        if ($admin_social_media['tw'] != '' && $admin_social_media['tw'] != '#') { ?>
            <li><a href="<?= $admin_social_media['tw'] ?>" target='_blank' class="color-fb"><i class="icon-twitter"></i></a></li>
        <?php }
        if ($admin_social_media['yt'] != '' && $admin_social_media['yt'] != '#') { ?>
            <li><a href="<?= $admin_social_media['yt'] ?>" target='_blank' class="color-fb"><i class="icon-youtube"></i></a></li>
        <?php }
        if ($admin_social_media['insta'] != '' && $admin_social_media['insta'] != '#') { ?>
            <li><a href="<?= $admin_social_media['insta'] ?>" target='_blank' class="color-fb"><i class="icon-instagram"></i></a></li>
        <?php }
        if ($admin_social_media['linkedin'] != '' && $admin_social_media['linkedin'] != '#') { ?>
            <li><a href="<?= $admin_social_media['linkedin'] ?>" target='_blank' class="color-fb"><i class="fa fa-linkedin"></i></a></li>
        <?php }
        if ($admin_social_media['app_and'] != '' && $admin_social_media['app_and'] != '#') { ?>
            <li><a href="<?= $admin_social_media['app_and'] ?>" target='_blank' class="color-fb"><i class="fa fa-android"></i></a></li>
        <?php }
        if ($admin_social_media['app_ios'] != '' && $admin_social_media['app_ios'] != '#') { ?>
            <li><a href="<?= $admin_social_media['app_ios'] ?>" target='_blank' class="color-fb"><i class="fa fa-apple"></i></a></li>
        <?php }  ?>
    </ul>
    <?php }

function get_web_elements($element_name, $style, $data)
{
    switch ($element_name) {
        case 'subs':
            if (check_service_status('1', '2', 'subs') == '1') { ?>
                <h4 class="widget-title">Contacts</h4>
                <div class="inner">
                    <p class="description">Enter your email address to register to our newsletter subscription</p>
                    <div class="input-group footer-subscription-form">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="edu-btn btn-medium" type="button">Subscribe <i class="icon-4"></i></button>
                    </div>
                </div>
                <?php }
            break;
        case 'app':
            $admin_social_media = social_media_db();
            $app_and = $admin_social_media['app_and'];
            $app_ios = $admin_social_media['app_ios'];
            if (check_service_status('1', '2', 'app') == '1') {
                if ($app_and != '' && $app_and != '#') { ?>
                    <a href="<?= $app_and ?>" target='_blank'>
                        <img src="<?= base_url('assets/avator/apps/app-and.png') ?>" style='height: 30px;'>
                    </a>
                <?php }
                if ($app_ios != '' && $app_ios != '#') { ?>
                    <a href="<?= $app_ios ?>" target='_blank'>
                        <img src="<?= base_url('assets/avator/apps/app-ios.png') ?>" style='height: 30px;'>
                    </a>
<?php }
            }
            break;

        case 'blog':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_site_blogs where status='1' order by blog_id desc limit $data ");
            return $all_blogs = $getallblogs->result_array();
            break;

            case 'portfo':
            $ci = &get_instance();
            $get_sliders = $ci->db->query("select * from yn_site_img where img_place ='port' and img_status='1' order by img_sort desc limit $data");
            return $allsliedsrs = $get_sliders->result_array();
            break;

        case 'cat':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_site_catagory order by sid asc limit $data");
            return $all_blogs = $getallblogs->result_array();
            break;

             case 'partnr':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_site_img where img_place = 'partner' and img_status='1' order by img_id asc limit $data");
            return $all_blogs = $getallblogs->result_array();
            break;

            case 'services':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_site_services order by service_order desc limit $data");
            return $all_blogs = $getallblogs->result_array();
            break;

            case 'testi':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_admin_testimonials order by li asc limit $data");
            return $all_blogs = $getallblogs->result_array();
            break;

            case 'widget':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_widgets order by wd_id asc limit $data");
            return $all_blogs = $getallblogs->result_array();
            break;

        case 'disqs':
            $ci = &get_instance();
            $getallblogs = $ci->db->query("select * from yn_admin_files  where asid='1' ");
            $all_blogs = $getallblogs->row_array();
            return $all_blogs['disqus'];
            break;
    }
}

function send_sms($mobileno, $textsms, $var1 = 0, $var2 = 0, $temp = 0)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_URL => "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=b995c4c8-f3ac-11ea-9fa5-0200cd936042&to=$mobileno&from=NYNAPS&templatename=$temp&var1=$var1&var2=$var2",
        CURLOPT_URL => "https://test-2factor.in/API/R1/?module=TRANS_SMS&apikey=b995c4c8-f3ac-11ea-9fa5-0200cd936042&to=$mobileno&from=NYNAPS&templatename=$temp&var1=$var1&var2=$var2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $result = $response;
    $ip = $_SERVER['REMOTE_ADDR'];
    // $CI->db->query("insert into site_sms (sms_status,sms_msg,sms_to,sms_date,sms_ip,sms_error) values ('$result','$textsms','$mobileno',now(),'$ip','0') ");
}

function widget($id){
    $ci = &get_instance();
    $getallblogs = $ci->db->query("select * from yn_widgets where wd_id='$id'");
    $all_blogs = $getallblogs->row_array();
    echo $all_blogs['wd_text'];
}

function count_view(){
    $ci=&get_instance();
    $rand_on=time().rand(11111,9999);
    $check_srch_cookie=$ci->input->cookie('nodly_user', TRUE);
    if (!isset($check_srch_cookie) || $check_srch_cookie =='' ) {
        // create cookie to avoid hitting this case again
        $srch_cookie = array(
            'name'   => 'nodly_user',
            'value'  => $rand_on,
            'expire' => 865000,
            'secure' => false
        );
        $ci->input->set_cookie($srch_cookie);
    }

    


}


?>