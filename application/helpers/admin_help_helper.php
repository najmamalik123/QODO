<?php
function admin_meta(){ $thedata="
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>ADMIN </title>

    <!-- Bootstrap -->
    <link href='".base_url()."assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link href='".base_url()."assets/admin/vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
    <!-- NProgress -->
    <link href='".base_url()."assets/admin/vendors/nprogress/nprogress.css' rel='stylesheet'>
    <!-- bootstrap-wysiwyg -->
    <link href='".base_url()."assets/admin/vendors/google-code-prettify/bin/prettify.min.css' rel='stylesheet'>

    <!-- Custom styling plus plugins -->
    <link href='".base_url()."assets/admin/build/css/custom.min.css' rel='stylesheet'>
    <link href='".base_url()."assets/css/admin_style.css' rel='stylesheet'>


        <link href='".base_url()."assets/addons/popup/sweetalert.css' rel='stylesheet'>
        <script src='".base_url()."assets/addons/popup/sweetalert.min.js'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='".base_url()."assets/js/jquery.form.min.js' ></script>
        <script src='".base_url()."assets/js/functions.js' ></script>


    ";
    return $thedata;
}

function get_active_class($search){
        switch($search){
            case 'tags':
                    echo "mm-active_test";
            break;
        }
    
}