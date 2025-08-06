<?php
function db_variables()
{
	$ci = &get_instance();
	$query = $ci->db->get('yn_admin_files');
	$admin_data = $query->result_array();
	$admin_data2 = array();
	$admin_data2['site_name'] = $admin_data['0']['name'];
	$admin_data2['site_map'] = $admin_data['0']['map'];
	$admin_data2['site_phone'] = $admin_data['0']['phone'];
	$admin_data2['site_email'] = $admin_data['0']['email'];
	$admin_data2['site_brief'] = $admin_data['0']['brief'];
	$admin_data2['site_address'] = $admin_data['0']['address'];
	$admin_data2['GA'] = $admin_data['0']['ga'];
	$admin_data2['AD'] = $admin_data['0']['ad'];
	$admin_data2['chat'] = $admin_data['0']['chat'];
	$admin_data2['f'] = $admin_data['0']['f'];
	$admin_data2['f2'] = $admin_data['0']['f2'];

	$admin_data2['meta_title'] = $admin_data['0']['meta_title'];
	$admin_data2['meta_desc'] = $admin_data['0']['meta_desc'];
	$admin_data2['meta_key'] = $admin_data['0']['meta_key'];
	$admin_data2['meta_image'] = $admin_data['0']['meta_image'];
	$admin_data2['home_page'] = $admin_data['0']['home_page'];
	$admin_data2['phone2'] = $admin_data['0']['phone2'];

	$admin_social_media = social_media_db(); // social media links
	$admin_data2['social_fb'] = $admin_social_media['fb'];
	$admin_data2['social_tw'] = $admin_social_media['tw'];
	$admin_data2['social_yt'] = $admin_social_media['yt'];
	$admin_data2['social_in'] = $admin_social_media['insta'];
	$admin_data2['social_linkedin'] = $admin_social_media['linkedin'];
	$admin_data2['app_and'] = $admin_social_media['app_and'];
	$admin_data2['app_ios'] = $admin_social_media['app_ios'];

	$admin_data2['demo_content'] = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
	$admin_data2['demo_img'] = 'https://via.placeholder.com/';

	$checkdb = $ci->db->query("select * from yn_site_keys where ki_type ='ser' ");
	$the_d_values = $checkdb->row_array();
	$_SESSION['web_services'] = $the_d_values['ki_key'];


	return $admin_data2;
}



function check_session($case, $url)
{
	switch ($case) {
		case '1': // signup , login page
			if (isset($_SESSION['yid']) && $_SESSION['yid'] != '') {
				redirect(base_url("index.php/main/$url"));
			}
			break;

		case '2': // profile page
			if (!isset($_SESSION['yid']) || $_SESSION['yid'] == '') {
				redirect(base_url("index.php/main/$url"));
			}
			break;

		case '3':
			if (!isset($_SESSION['yid']) || $_SESSION['yid'] == '') {
				echo 'Please login to continue.';
				die;
			}
			break;
		case 'check':
			if (!isset($_SESSION['yid']) || @$_SESSION['yid'] == '') {
				return '1';
			}
			break;

		default:
			return false();
			break;
	}
}
function emailCHECK($regmail, $ercode = null)
{
	if (!filter_var($regmail, FILTER_VALIDATE_EMAIL)) {
		echo $ercode . ' Sorry, ' . $regmail . ' is not a valid email !!!';
		exit;
	}
}
function social_media_db()
{
	$ci = &get_instance();
	$query = $ci->db->get('yn_admin_socialm');
	$admin_data = $query->row_array();
	return $admin_data;
}

function trim_text($string, $length, $dots = ".")
{
	return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}


function money_show($price)
{
	@$thecurre = strtoupper($_SESSION['currency']);
	if ($price == '0') {
		return '';
	}
	switch ($thecurre) {
		case 'INR':
			$thecurre2 = 'USD';
			$theprice = round($price, 2);
			// $theprice=convertCurrency($price,$thecurre2,$thecurre);
			return "₹ " . $theprice;
			break;
		case 'USD':
		default:
			$thecurre2 = 'INR';
			$theprice = round($price, 2);
			// $theprice=convertCurrency($price,$thecurre2,$thecurre);
			return "₹ " . $theprice;
			// return '$'.$price;
			break;
	}
}

function get_captcha($addclass)
{

	$ci = &get_instance();
	$checkdb = $ci->db->query("select * from yn_site_keys where ki_type ='ca' ");
	$the_d_values = $checkdb->row_array();
	$k1 = $the_d_values['ki_key'];
	$k2 = $the_d_values['ki_pass'];

?>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<div class="g-recaptcha <?= $addclass ?>" data-sitekey="<?= $k1 ?>"></div>
	<?php }

function send_email($tos, $subject09, $messageto90, $site_name, $json_string)
{
	$ci = &get_instance();
	$checkdb = $ci->db->query("select * from yn_site_keys where ki_type ='em' ");
	$the_d_values = $checkdb->row_array();

	$k1 = $the_d_values['ki_key'];
	$k2 = $the_d_values['ki_pass'];
	$from_email = $the_d_values['ki_v1'];

	$details = '{
    "Messages": [{
        "From": {
            "Email": "' . $from_email . '",
            "Name": "' . $site_name . '"
        },
        "To": [{
            "Email": "' . $tos . '"
        }],
        "Subject": "' . $subject09 . '",
        "HTMLPart": "' . $messageto90 . '"
    }]
}';

	// echo $details; die;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3.1/send');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $details);
	curl_setopt($ch, CURLOPT_USERPWD, $k1 . ':' . $k2);
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	// print_r($result);die;
	curl_close($ch);
}

function email_template($preheader, $greet, $message, $link, $linkname, $message2, $greet2, $site_name, $site_address)
{
	// $ci = &get_instance();
	// $thereturn = $ci->db->query("select * from yn_admin_files where asid='1'");
	// $the_d_values = $thereturn->row_array();
	// $messageto90 = $the_d_values['em_temp'];

	// // Replace PHP variables in HTML content
	// $messageto90 = str_replace('{preheader', $preheader, $messageto90);
	// $messageto90 = str_replace('{greet', $greet, $messageto90);
	// $messageto90 = str_replace('{message', "hi", $messageto90);
	// $messageto90 = str_replace('{link', $link, $messageto90);
	// $messageto90 = str_replace('{linkname', $linkname, $messageto90);
	// $messageto90 = str_replace('{message2', $message2, $messageto90);
	// $messageto90 = str_replace('{greet2', $greet2, $messageto90);
	// $messageto90 = str_replace('{site_name', $site_name, $messageto90);
	// $messageto90 = str_replace('{site_address', $site_address, $messageto90);

	return $messageto90 = "<!doctype html><html> <head> <meta name='viewport' content='width=device-width'/> <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/><style>img{border: none; -ms-interpolation-mode: bicubic; max-width: 100%;}body{background-color: #ffffff; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}table{border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;}table td{font-family: sans-serif; font-size: 14px; vertical-align: top;}/* ------------------------------------- BODY & CONTAINER ------------------------------------- */ .body{background-color: #ffffff; width: 100%;}/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */ .container{display: block; /* makes it centered */ max-width: 580px; padding: 10px; width: 580px;}/* This should also be a block element, so that it will fill 100% of the .container */ .content{box-sizing: border-box; display: block; max-width: 580px; padding: 0px;background: #fff;}/* ------------------------------------- HEADER, FOOTER, MAIN ------------------------------------- */ .main{padding: 10px; background: #fff; border-radius: 0px; width: 100%;}.wrapper{box-sizing: border-box; padding: 20px;}.footer{clear: both;padding: 30px;border-radius:6px;width: 100%;background: #dfe6ec;color: #fff !important;}.footer td, .footer p, .footer span, .footer a{color: #999999; font-size: 12px; text-align: left;}/* ------------------------------------- TYPOGRAPHY ------------------------------------- */ h1, h2, h3, h4{color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.1; margin: 0; Margin-bottom: 30px;}h1{font-size: 35px; font-weight: 300; text-transform: capitalize;}p, ul, ol{font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;}p li, ul li, ol li{list-style-position: inside; margin-left: 5px;}a{color: #3498db; text-decoration: underline;}/* ------------------------------------- BUTTONS ------------------------------------- */ .btn{box-sizing: border-box; width: 100%;}.btn > tbody > tr > td{padding-bottom: 15px;}.btn table{width: 60%;}.btn table td{background-color: #ffffff; border-radius: 5px; text-align: center;}.btn a{background-color: #ffffff; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; color: #3498db; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize;}.btn-primary table td{}.btn-primary a{background-color: #3498db; border-color: #3498db; color: #ffffff;}/* ------------------------------------- OTHER STYLES THAT MIGHT BE USEFUL ------------------------------------- */ .last{margin-bottom: 0;}.first{margin-top: 0;}.align-center{text-align: center;}.align-right{text-align: right;}.align-left{text-align: left;}.clear{clear: both;}.mt0{margin-top: 0;}.mb0{margin-bottom: 0;}.preheader{color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;}.powered-by a{text-decoration: none;}hr{border: 0; border-bottom: 1px solid #ffffff; Margin: 20px 0;}/* ------------------------------------- RESPONSIVE AND MOBILE FRIENDLY STYLES ------------------------------------- */ @media only screen and (max-width: 620px){table[class=body] h1{font-size: 28px !important; margin-bottom: 10px !important;}table[class=body] p, table[class=body] ul, table[class=body] ol, table[class=body] td, table[class=body] span, table[class=body] a{font-size: 16px !important;}table[class=body] .wrapper, table[class=body] .article{padding: 10px !important;}table[class=body] .content{padding: 0 !important;}table[class=body] .container{padding: 0 !important; width: 100% !important;}table[class=body] .main{border-left-width: 0 !important; border-radius: 0 !important; border-right-width: 0 !important;}table[class=body] .btn table{width: 100% !important;}table[class=body] .btn a{width: 100% !important;}table[class=body] .img-responsive{height: auto !important; max-width: 100% !important; width: auto !important;}}/* ------------------------------------- PRESERVE THESE STYLES IN THE HEAD ------------------------------------- */ @media all{.ExternalClass{width: 100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height: 100%;}.apple-link a{color: inherit !important; font-family: inherit !important; font-size: inherit !important; font-weight: inherit !important; line-height: inherit !important; text-decoration: none !important;}.btn-primary table td:hover{background-color: #34495e !important;}.btn-primary a:hover{background-color: #34495e !important; border-color: #34495e !important;}}</style> </head> <body class=''> <table border='0' cellpadding='0' cellspacing='0' class='body'> <tr> <td> </td><td class='container'> <div class='content'> <span class='preheader'>$preheader</span><table style='text-align: center;padding-top:40px;'><td></td></table> <table class='main'> <tr> <td class='wrapper'> <table border='0' cellpadding='0' cellspacing='0'><tr><td><img src='" . base_url() . "assets/avator/logo.png' style='height:40px'/><hr/></td></tr><tr> <td> <h1>$greet</h1><p style='font-size:16px;'>$message</p><table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'> <tbody> <tr> <td align='left'> <table border='0' cellpadding='0' cellspacing='0'> <tbody> <tr> <td> <a href='$link' style='width:100%;background:#000;border:0px;border-radius:7px !important;' target='_blank'>$linkname</a></td></tr></tbody> </table> </td></tr></tbody> </table> <hr/><p style='color:silver;'>$message2.</p><hr/><p>$greet2.</p></td></tr></table> </td></tr></table> <div class='footer'> <table border='0' cellpadding='0' cellspacing='0'> <tr> <td class='content-block'> <span class='apple-link'>$site_name, $site_address</span> <br>Don't like these emails? <a href='#'>Unsubscribe</a>. </td></tr><tr> <td class='content-block powered-by'> Website and email Powered by <a href='https://ynaps.com/'>YNAPS</a></td></tr><tr><td></td></tr></table> </div></div></td><td> </td></tr></table> </body></html>";

	// return $messageto90;
}

function uploadonlyimage($fileNAmeis, $directory, $qual)
{
	if (isset($_POST)) {
		$DestinationDirectory   = $directory;
		$Quality                = $qual;
		$BigImageMaxSize = '1800px';
		// check $_FILES["$fileNAmeis"] not empty
		if (!isset($_FILES["$fileNAmeis"]) || !is_uploaded_file($_FILES["$fileNAmeis"]['tmp_name'])) {
			die('Something wrong with uploaded file, something missing!');
			exit;
		}
		$refrenext = explode(".", $_FILES["$fileNAmeis"]["name"]);
		$extension = end($refrenext);
		$ImageName      = str_replace(' ', '', strtolower($_FILES["$fileNAmeis"]['name'])); //get image name
		$ImageName      = preg_replace('/[^A-Za-z0-9\-]/', '', $ImageName);
		$ImageSize      = $_FILES["$fileNAmeis"]['size']; // get original image size
		$TempSrc        = $_FILES["$fileNAmeis"]['tmp_name']; // Temp name of image file stored in PHP tmp folder
		$ImageType      = $_FILES["$fileNAmeis"]['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

		//Let's check allowed $ImageType, we use PHP SWITCH statement here
		switch (strtolower($ImageType)) {
			case 'image/png':
				$CreatedImage =  imagecreatefrompng($_FILES["$fileNAmeis"]['tmp_name']);
				break;
			case 'image/gif':
				$CreatedImage =  imagecreatefromgif($_FILES["$fileNAmeis"]['tmp_name']);
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				$CreatedImage = imagecreatefromjpeg($_FILES["$fileNAmeis"]['tmp_name']);
				break;
			default:
				die('Unsupported File!');
				exit;
		}

		list($CurWidth, $CurHeight) = getimagesize($TempSrc);
		$randomnumber = rand(111111111, 999999999);
		$NewImageName = $randomnumber . $ImageName . '.' . $extension;
		$DestRandImageName = $DestinationDirectory . $NewImageName;
		if (resizeImage($CurWidth, $CurHeight, $BigImageMaxSize, $DestRandImageName, $CreatedImage, $Quality, $ImageType)) {

			return 'SUCCXX' . $NewImageName;
			die;
			exit;
		} else {
			die('error generated');
			exit; //output error
		}
	}
}

function resizeImage($CurWidth, $CurHeight, $MaxSize, $DestFolder, $SrcImage, $Quality, $ImageType)
{
	// Get the aspect ratio of the source image
	$srcAspectRatio = $CurWidth / $CurHeight;

	// Calculate the new width and height based on the max size and aspect ratio
	if ($CurWidth <= $MaxSize && $CurHeight <= $MaxSize) {
		$NewWidth = $CurWidth;
		$NewHeight = $CurHeight;
	} elseif ($srcAspectRatio > 1) {
		$NewWidth = $MaxSize;
		$NewHeight = $MaxSize / $srcAspectRatio;
	} else {
		$NewWidth = $MaxSize * $srcAspectRatio;
		$NewHeight = $MaxSize;
	}

	// Create a new image with the calculated dimensions
	$thumb = imagecreatetruecolor($NewWidth, $NewHeight);

	// Preserve transparency for PNG images
	if ($ImageType == 'image/png') {
		imagealphablending($thumb, false);
		imagesavealpha($thumb, true);
	}

	// Resize the source image to the new dimensions
	imagecopyresampled($thumb, $SrcImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight);

	// Save the resized image to the destination folder
	switch ($ImageType) {
		case 'image/png':
			imagepng($thumb, $DestFolder);
			break;
		case 'image/gif':
			imagegif($thumb, $DestFolder);
			break;
		case 'image/jpeg':
		case 'image/pjpeg':
			imagejpeg($thumb, $DestFolder, $Quality);
			break;
		default:
			return false;
	}

	imagedestroy($thumb); //free up memory
	return true;
}


function date_format_1($datess, $style)
{
	if ($datess == '0000-00-00 00:00:00') {
		return '';
	}
	if (date("Y", strtotime($datess)) == '1970') {
		return '';
	}
	switch ($style) {
		case '1':
			echo date("d-M-Y", strtotime($datess));
			break;
		case '2':
			echo date("d-m-Y", strtotime($datess));
			break;
		case 't':
			echo date("d-M-y, h:i a", strtotime($datess));
			break;
		case 'alpha_date':
			echo date("F j, Y", strtotime($datess));
			break;
		case 'alpha_datetime':
			echo date("F j, Y, g:i a", strtotime($datess));
			break;
		case 'alpha_month_year':
			echo date("F Y", strtotime($datess));
			break;
		case 'sql':
			return date("Y/m/d", strtotime($datess));
			break;
		case 'dt':
			return date("m/d/Y", strtotime($datess));
			break;
		case 'Y':
			$date = new DateTime($datess);
			return $date->format('Y-m-d');
			break;
		default:
			echo date($style, strtotime($datess));
			break;
	}
}

function multiSearch(array $array, array $pairs)
// $theziprs=multiSearch($thezipr,array('ex_name' => 'zip'));
{
	$found = array();
	foreach ($array as $aKey => $aVal) {
		$coincidences = 0;
		foreach ($pairs as $pKey => $pVal) {
			if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
				$coincidences++;
			}
		}
		if ($coincidences == count($pairs)) {
			$found[$aKey] = $aVal;
		}
	}

	return $found;
}

function replace_accents($str)
{
	$str = htmlentities($str, ENT_COMPAT, "UTF-8");
	$str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
	return html_entity_decode($str);
}

function url_smart($url)
{
	return strtolower(url_title($url));
	$url = replace_accents($url);
	$url = str_replace(' ', '-', $url);
	$url = str_replace('%', '-p', $url);
	$url = str_replace(':', '', $url);
	return preg_replace('/\s+/s', '-', strtolower($url));
}
function unsmart_url($url)
{
	// return strtolower(url_title($url));
	// $url=replace_accents($url);
	// $url=str_replace('&','',$url);
	$url = str_replace('-', ' ', $url);
	// $url=str_replace(':','',$url);
	return preg_replace('/\s+/s', ' ', strtolower($url));
}


function get_id_multi_array($products, $field, $value)
{
	foreach ($products as $key => $product) {
		if ($product[$field] === $value)
			return $key;
	}
	return false;
}

function check_passwords($pwd, $ercode)
{
	if (strlen($pwd) < 8) {
		echo "$ercode Password too short! (should be atleast 8 Character long and should have atleast 1 number and a chrector.)";
		die;
	}
	if (!preg_match("#[0-9]+#", $pwd)) {
		echo "$ercode Password must include at least one number in password! (should be atleast 8 Character long and should have atleast 1 number and a chrector.)";
		die;
	}
	if (!preg_match("#[a-zA-Z]+#", $pwd)) {
		echo "$ercode Password must include at least one letter! (should be atleast 8 Character long and should have atleast 1 number and a chrector.)";
		die;
	}
}

function check_mobile($mobile)
{
	if (preg_match('/^[0-9]{10}+$/', $mobile) != '1') {
		echo 'Please check your mobile number, please do not add any extensions.';
		die;
	};
}

function check_verify($switch, $check, $class)
{
	switch ($switch) {
		case '1':
			if ($check == '1') {
				echo "<span class='fa fa-check-circle $class' data-toggle='tooltip' data-placement='bottom' title='Verified by ID'> </span>";
			} else {
				return false;
			}
			break;
		case '2':
			if ($check == '1') {
				echo "<span class='fa fa-check-circle $class' data-toggle='tooltip' data-placement='bottom' title='Verified by ticket'> <span class='u_text'>This is a ticket verified listing.</span> </span>";
			} else {
				return false;
			}
			break;

		default:
			return false;
			break;
	}
}




function get_cat($option, $limit)
{
	switch ($option) {
		case '1':
			$ci = &get_instance();
			$thereturn = $ci->db->query("select * from yn_site_catagory where display ='1' order by sid asc limit $limit");
			return $thereturn;
			break;
		case '2':
			$ci = &get_instance();
			$thereturns = $ci->db->query("select * from yn_site_catagory order by sid asc limit $limit");
			return $thereturns;
			break;
		case '3':
			$ci = &get_instance();
			$thereturns = $ci->db->query("select * from yn_site_catagory where ctid='$limit' ");
			return $thereturns->row_array();
			break;

		default:

			break;
	}
}

function getCartAmount_row()
{
	$products = @$_SESSION['ecom_cart'];
	$total = 0;
	foreach ($products as $product) {
		$total += $product['pro_price'];
	}
	return $total;
}

function read_me_product($what, $data1)
{
	switch ($what) {
		case 'product_status':
			switch ($data1) {
				case '1':
					return "<span class='mb-2 mr-2 badge badge-success'>Enable</span>";
					break;
				case '0':
					return "<span class='mb-2 mr-2 badge badge-warning'>Disable</span>";
					break;
			}
			break;
	}
	switch ($what) {
		case 'slider_status';
			switch ($data1) {
				case '1':
					return "<span class='mb-2 mr-2 badge badge-success'>SLIDER</span>";
					break;
				case '0' || '':
					return "<span class='mb-2 mr-2 badge badge-warning'>NONE</span>";
					break;
			}
			break;
	}
	switch ($what) {
		case 'trend_status';
			switch ($data1) {
				case '2':
					return "<span class='mb-2 mr-2 badge badge-success'>FEATURED</span>";
					break;
				case '0' || '':
					return "<span class='mb-2 mr-2 badge badge-warning'></span>";
					break;

				case '3':
					return "<span class='mb-2 mr-2 badge badge-dark'>Populer</span>";
					break;

				case '4':
					return "<span class='mb-2 mr-2 badge badge-primary'>Day Deal</span>";
					break;

				case '5':
					return "<span class='mb-2 mr-2 badge badge-warning'>Top Sale</span>";
					break;
			}
			break;
	}
	switch ($what) {
		case 'product_stock';
			switch ($data1) {
				case '1':
					return "<span class='mb-2 mr-2 badge badge-success'>STOCK</span>";
					break;
				case '0' || '':
					return "<span class='mb-2 mr-2 badge badge-warning'>Out OF STOCK</span>";
					break;
			}
			break;
	}
}


function get_web_img($data = 0, $toreturn = 0)
{
	$CI = get_instance();

	switch ($data) {
		case '0':
			$getallhomedata = $CI->db->query("select * from yn_site_img order by img_sort asc");
			$thedata = $getallhomedata->result_array();
			return $thedata;
			break;
		case 'list':
			$getallhomedata = $CI->db->query("select * from yn_site_img where img_place='$toreturn' order by img_sort asc ");
			$thedata = $getallhomedata->result_array();
			return $thedata;
			break;
		case 'byname':
			$getallhomedata = $CI->db->query("select * from yn_site_img where img_place='$toreturn' order by img_sort asc");
			$thedata = $getallhomedata->row_array();
			return $thedata;
			break;
		default:
			$getallhomedata = $CI->db->query("select * from yn_site_img where img_id='$data' order by img_sort asc ");
			$thedata = $getallhomedata->row_array();
			if ($toreturn != '0') {
				return $thedata[$toreturn];
			} else {
				return $thedata;
			}
			break;
	}
}

function data_convert($thecheck, $data)
{
	switch ($thecheck) {
		case 'active':
			if ($data == '1') {
				return 'Active';
			} else {
				return 'Not Active';
			}
			break;
	}
}

function get_domain($url)
{
	return parse_url($url, PHP_URL_HOST);
}
function uploadanyfile($fileName, $size)
{
	$allowedExts = array("pdf", "doc", "docx", "png", "jpg", "jpeg", "gif", "GIF", "ppt", "pptx", "PNG", "JPEG", "JPG", "psd", "txt", "xlsx", "xls", "rtf");
	$refrenext = explode(".", $_FILES["$fileName"]["name"]);
	$extension = end($refrenext);
	if ((
			($_FILES["$fileName"]["type"] == "application/pdf") ||
			($_FILES["$fileName"]["type"] == "application/acrobat") ||
			($_FILES["$fileName"]["type"] == "application/x-pdf") ||
			($_FILES["$fileName"]["type"] == "application/msword") ||
			($_FILES["$fileName"]["type"] == "application/rtf") ||
			($_FILES["$fileName"]["type"] == "application/vnd.ms-excel") ||
			($_FILES["$fileName"]["type"] == "application/vnd.ms-powerpoint") ||
			($_FILES["$fileName"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation") ||
			($_FILES["$fileName"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") ||
			($_FILES["$fileName"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") ||
			($_FILES["$fileName"]["type"] == "image/psd") ||
			($_FILES["$fileName"]["type"] == "application/psd") ||
			($_FILES["$fileName"]["type"] == "text/plain") ||
			($_FILES["$fileName"]["type"] == "application/photoshop") ||
			($_FILES["$fileName"]["type"] == "image/photoshop") ||
			($_FILES["$fileName"]["type"] == "image/PJPEG") ||
			($_FILES["$fileName"]["type"] == "image/pjpeg") ||
			($_FILES["$fileName"]["type"] == "image/PNG") ||
			($_FILES["$fileName"]["type"] == "image/png") ||
			($_FILES["$fileName"]["type"] == "image/GIF") ||
			($_FILES["$fileName"]["type"] == "image/gif") ||
			($_FILES["$fileName"]["type"] == "image/jpeg") ||
			($_FILES["$fileName"]["type"] == "image/JPG") ||
			($_FILES["$fileName"]["type"] == "image/jpg")) &&
		in_array($extension, $allowedExts)
	) {
		if ($_FILES["$fileName"]["error"] > 0) {
			$retuva = 'error in uploading may be the file type is not supported.!!';
		} else {
			$retuva = 'YNAPS_SUCES';
		}
	} else {
		$retuva = 'file not uploaded !! Invalid file type.';
	}
	return $retuva;
}

function get_client_ip()
{
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	} else if (isset($_SERVER['HTTP_FORWARDED'])) {
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	} else if (isset($_SERVER['REMOTE_ADDR'])) {
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	} else {
		$ipaddress = 'UNKNOWN';
	}

	return $ipaddress;
}
function code_to_country($code)
{

	$code = strtoupper($code);

	$countryList = array(
		'AF' => 'Afghanistan',
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas the',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island (Bouvetoya)',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei Darussalam',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros the',
		'CD' => 'Congo',
		'CG' => 'Congo the',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote dIvoire',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FO' => 'Faroe Islands',
		'FK' => 'Falkland Islands (Malvinas)',
		'FJ' => 'Fiji the Fiji Islands',
		'FI' => 'Finland',
		'FR' => 'France, French Republic',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia the',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island and McDonald Islands',
		'VA' => 'Holy See (Vatican City State)',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KP' => 'Korea',
		'KR' => 'Korea',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyz Republic',
		'LA' => 'Lao',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libyan Arab Jamahiriya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'AN' => 'Netherlands Antilles',
		'NL' => 'Netherlands the',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn Islands',
		'PL' => 'Poland',
		'PT' => 'Portugal, Portuguese Republic',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russian Federation',
		'RW' => 'Rwanda',
		'BL' => 'Saint Barthelemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent and the Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome and Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia (Slovak Republic)',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia, Somali Republic',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia and the South Sandwich Islands',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard & Jan Mayen Islands',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland, Swiss Confederation',
		'SY' => 'Syrian Arab Republic',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States of America',
		'UM' => 'United States Minor Outlying Islands',
		'VI' => 'United States Virgin Islands',
		'UY' => 'Uruguay, Eastern Republic of',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VE' => 'Venezuela',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe'
	);

	if (!$countryList[$code]) return $code;
	else return $countryList[$code];
}

function get_admin_rights()
{
	if ($_SESSION['aid'] == '' || $_SESSION['auth-rights'] < '3') {
		echo 'Seems Like you do not have such authority, Please Get Edit rights by Admin.';
		die;
		// redirect('index.php/logout.php');
	}
}

function get_page_data($page, $data, $series = null)
{
	$ci = &get_instance();

	switch ($data) {
		case '':
		case '0':
		case 'na':
			$get_data = $ci->db->query("select * from yn_admin_pages where name='$page'");
			$thedata_is = $get_data->row_array();
			return $thedata_is;
			break;

		case 'cache':
			$get_data = $ci->db->query("select * from yn_admin_pages where name='$page' ");
			$thedata_is = $get_data->row_array();
			return $thedata_is;
			break;

		case 'series':
			$get_data = $ci->db->query("select * from yn_admin_pages where name='$page' and type='$series' ");
			$thedata_is = $get_data->result_array();
			return $thedata_is;
			break;

		case 'type':
			$get_data = $ci->db->query("select * from yn_admin_pages where type='$page' ");
			$thedata_is = $get_data->result_array();
			return $thedata_is;
			break;

		default:
			$ci = &get_instance();
			$get_data = $ci->db->query("select * from yn_admin_pages where pid='$data' ");
			$thedata_is = $get_data->row_array();
			return $thedata_is;
			break;
	}
}

function getState($country, $style, $selected = 0)
{
	$ci = &get_instance();
	$gettallsstates = $ci->db->query("select * from yn_site_states where country_id ='$country' ");
	$thedetails_thedth = $gettallsstates->result_array();
	switch ($style) {
		case '1': ?><option value="">Select State</option>
			<?php foreach ($thedetails_thedth as $states_lisgs) { ?>
				<option value="<?= $states_lisgs['state_id'] ?>" <?php if ($selected == $states_lisgs['state_id']) {
																		echo "selected";
																	} ?>><?= $states_lisgs['state_name'] ?></option>
			<?php }
			break;
		case 'st_name':
			$gettallsstates = $ci->db->query("select * from yn_site_states where state_id ='$country' ");
			$thedetails_thedth = $gettallsstates->row_array();
			return $thedetails_thedth['state_name'];
			break;
		default:
			return 'ok';
			break;
	}
}

function getCity($state, $style, $selected = 0)
{
	$ci = &get_instance();
	$gettallsstates = $ci->db->query("select * from yn_site_cities where state_id ='$state' ");
	$thedetails_thedth = $gettallsstates->result_array();
	switch ($style) {
		case '1':
			foreach ($thedetails_thedth as $states_lisgs) { ?>
				<option value="<?= $states_lisgs['city_id'] ?>" <?php if ($selected == $states_lisgs['city_id']) {
																	echo "selected";
																} ?>><?= $states_lisgs['city_name'] ?></option>
		<?php }
			break;
		case 'ct_name':
			$gettallsstates = $ci->db->query("select * from yn_site_cities where city_id ='$state' ");
			$thedetails_thedth = $gettallsstates->row_array();
			return $thedetails_thedth['city_name'];
			break;
		default:
			return 'ok';
			break;
	}
}

function get_country($selected)
{
	$ci = &get_instance();
	$gettallsstates = $ci->db->query("select * from yn_site_countries");
	$thedetails_thedth = $gettallsstates->result_array();

	foreach ($thedetails_thedth as $states_lisgs) { ?>
		<option value="<?= $states_lisgs['pincode'] ?>" <?php if ($selected == $states_lisgs['pincode']) {
															echo "selected";
														} ?>><?= $states_lisgs['country_name'] ?></option>
		<?php  }
}

function getTags($style = null, $type = null, $limit = 50)
{
	switch ($style) {
		case '1':
			$ci = &get_instance();
			$gettex_89sd = $ci->db->query("select * from yn_site_tags where stg_type ='$type' limit $limit ");
			return $atheadmins = $gettex_89sd->result_array();
			break;
		case 'select':
			$ci = &get_instance();
			$gettex_89sd = $ci->db->query("select * from yn_site_tags where stg_type ='$type' limit $limit ");
			$atheadmins = $gettex_89sd->result_array();
			$theselect = '';
			foreach ($atheadmins as $select_atheadmins) {
				$theselect = $theselect . "<option value='" . $select_atheadmins['stg_tgid'] . "'>" . $select_atheadmins['stg_name'] . "</option>";
			}
			return $theselect;
			break;
		case 'byid':
			$ci = &get_instance();
			$gettex_89sd = $ci->db->query("select * from yn_site_tags where stg_tgid ='$type' ");
			$atheadmins = $gettex_89sd->row_array();
			echo $atheadmins['stg_name'];
			break;

		default:
			$ci = &get_instance();
			$gettex_89sd = $ci->db->query("select * from yn_site_tags where stg_type ='$type' ");
			return $atheadmins = $gettex_89sd->result_array();
			break;
	}
}

function is_verified()
{
	return ("<span class='fa fa-check-circle verified_tick'> </span>");
}

function user_relationship($relation)
{
	return $relation;
}

function select_right_side_bar($type_user)
{
	switch ($type_user) {
		case 'd':
			return 'user_side.php';
			break;
		case 'p':
			return 'user_side_p.php';
			break;
		case 'b':
			return 'user_side_b.php';
			break;
		case 'u':
			return 'user_side_user.php';
			break;
		case 'e':
			return 'user_side_e.php';
			break;
		default:
			return 'user_side_user.php';
			break;
	}
}

function check_admin_rights($req, $data1, $data2)
{
	if ($_SESSION['auth-rights'] < $req) {
		return 0;
	} else {
		return 1;
	}
}

function check_rights($user_type, $page_tosend)
{
	if ($user_type != $_SESSION['user_type']) {
		redirect(base_url($page_tosend));
	}
}

function user_check($stat_us)
{
	switch ($stat_us) {
		case '9': ?>
			<i class="fa-solid fa-hexagon-check" style="color:#7948CA;"></i>
	<?php break;
	}
}

function read_me_user($what, $data1, $data2 = 0)
{
	switch ($what) {
		case 'blog_type':
			switch ($data1) {
				case '1':
					return 'Blog';
					break;
				case '3':
					return 'News';
					break;
				case '2':
					return 'Offer';
					break;
			}
			break;
		case 'kyc_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>KYC Processing <span class='fa fa-clock'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-info'>KYC Verified <span class='fa-solid fa-hexagon-check'> </span></span>";
					break;
				case '2':
					return "<span class='mb-2 mr-2 badge badge-danger'>KYC Rejected <span class='fa fa-ban'> </span></span>";
					break;
				case '3':
					return "";
					break;
			}
		case 'property_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>Inactive <span class='fa fa-clock'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-info'>Active <span class='fa-solid fa-hexagon-check'> </span></span>";
					break;
			}
		case 'property_sale_rent':
			switch ($data1) {
				case 'Sale':
					return "<span class='mb-2 mr-2 badge badge-success'>For Sale <span class='fa fa-clock'></span></span>";
					break;
				case 'Rent':
					return "<span class='mb-2 mr-2 badge badge-info'>For Rent <span class='fa-solid fa-hexagon-check'> </span></span>";
					break;
			}

		case 'property_lead_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-warning'>Pending <span class='fa fa-clock' style='font-size:11px;'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-info'>Meeting <span class='fa-solid fa-hexagon-check' style='font-size:11px;'> </span></span>";
					break;

				case '2':
					return "<span class='mb-2 mr-2 badge badge-danger'>Closed <span class='fa-solid fa-ban' style='font-size:11px;'> </span></span>";
					break;
			}
		case 'shop_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>Processing <span class='fa fa-clock'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-info'>Approved <span class='fa-solid fa-hexagon-check'> </span></span>";
					break;
				case '2':
					return "<span class='mb-2 mr-2 badge badge-danger'>Rejected <span class='fa fa-ban'> </span></span>";
					break;
			}
		case 'user_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>Pending <span class='fa fa-clock'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-primary'>Active <span class='fa fa-check'></span></span>";
					break;
				case '2':
					return "<span class='mb-2 mr-2 badge badge-danger'>Suspended <span class='fa fa-ban'> </span></span>";
					break;
				case '9':
					return "<span class='mb-2 mr-2 badge badge-info'>Verified <span class='fa-solid fa-hexagon-check'> </span></span>";
					break;
			}
		case 'user_vendor':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>Not a Vendor <span class='fa fa-ban'> </span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-success'>Vendor<span class='fa fa-check'></span></span>";
					break;
			}
		case 'order_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge text-white bg-danger'>Ban <span class='fa fa-ban'></span>";
				case '1':
					return "<span class='mb-2 mr-2 badge text-white bg-warning'>Pending <span class='fa fa-clock'></span>";
					break;
				case '2':
					return "<span class='mb-2 mr-2 badge text-white bg-primary'>Active <span class='fa fa-archive'></span>";
				case '3':
					return "<span class='mb-2 mr-2 badge text-white bg-success'>Delivered <span class='fa fa-bus'></span>";
					break;
			}
			break;
		case 'gender':
			switch ($data1) {
				case 'm':
					return "Male";
					break;
				case 'f':
					return "Female";
					break;
				case 'o':
					return "Others";
					break;
			}
			break;
		case 'cou_status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-warning'>In-Active <span class='fa fa-clock'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-primary'>Active <span class='fa fa-check'></span></span>";
					break;
			}
			break;
		case 'status':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-danger'>In-Active <span class='fa-light fa-circle-xmark ml-2 text-white'></span></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-primary'>Active <span class='fa-solid fa-square-check ml-2'></span></span>";
					break;
			}
			break;
		case 'cou_feat':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-warning'>Non-Featured <span class='fa fa-clock'></span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-primary'>Featured <span class='fa fa-check'></span>";
					break;
			}
			break;
		case 'yes_no':
			switch ($data1) {
				case '1':
					return "<span class='mb-2 mr-2 badge badge-warning'>YES</span>";
					break;
				case '0':
					return "<span class='mb-2 mr-2 badge badge-primary'>NO</span>";
					break;
			}
			break;
		case 'admin':
			switch ($data1) {
				case '1':
					return "<span class='mb-2 mr-2 badge badge-warning'>View Leads</span>";
					break;
				case '2':
					return "<span class='mb-2 mr-2 badge badge-warning'>View</span>";
					break;
				case '3':
					return "<span class='mb-2 mr-2 badge badge-primary'>Edit basic</span>";
					break;
				case '4':
					return "<span class='mb-2 mr-2 badge badge-dark'>Edit</span>";
					break;
				case '5':
				case '6':
					return "<span class='mb-2 mr-2 badge badge-success'>Admin </span>";
					break;
				default:
					return $data1;
					return;
			}
			break;
		case 'attention':
			switch ($data1) {
				case '2':
					return "<span class='mb-2 mr-2 badge badge-danger'>Attention Needed</span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-success'>Attended</span>";
					break;
				default:
					return "<span class='mb-2 mr-2 badge badge-primary'>Pending</span>";
					break;
			}
			break;
		case 'cpay':
			switch ($data1) {
				case '0':
					return "Un-Paid";
					break;
				case '1':
					return "Paid";
					break;
				case '2':
					return "Free";
					break;
			}
			break;
		case 'cstatus':
			switch ($data1) {
				case '0':
					return "Pending";
					break;
				case '1':
					return "Confirmed";
					break;
				case '2':
					return "Cancelled";
					break;
				case '3':
					return "Shipped";
					break;
				case '4':
					return "Completed";
					break;
			}
			break;
		case 'user_type_status':
			switch ($data1) {
				case 'u':
					return "<span class='mb-2 mr-2 badge badge-warning'>User</span>";
					break;
				case 's':
					return "<span class='mb-2 mr-2 badge badge-primary'>Seller</span>";
					break;
			}
			break;
		case 'qstatus':
			switch ($data1) {
				case '1':
					return "Answered";
					break;
				case '2':
					return "Skipped";
					break;
				case '3':
					return "Reviewed";
					break;
			}
		case 'rating':
			switch ($data1) {
				case '0':
					return "<span class='mb-2 mr-2 badge badge-warning'>Not allowed</span>";
					break;
				case '1':
					return "<span class='mb-2 mr-2 badge badge-primary'>Allow</span>";
					break;
			}
			break;
			break;
	}
}

function get_age($dob)
{
	return date_diff(date_create($dob), date_create('today'))->y;
}

function get_profile_level($user)
{
	$ci = &get_instance();
	$get_basics = $ci->db->query("select * from yn_site_mem where mid='$user' ");
	$thedetailsa_4 = $get_basics->row_array();

	if ($thedetailsa_4['address'] != '' && $thedetailsa_4['photo'] != 'photo.jpg') {
		echo "80";
	} else {
		echo "50";
	}
}

function startup_thing($style, $startup)
{
	switch ($style) {
		case '1':
			echo "Self Funded - Based In Delhi - 2011";
			break;
	}
}


// DATA CONVERTERS
function XMLtoArray($XML)
{
	$xml_parser = xml_parser_create();
	xml_parse_into_struct($xml_parser, $XML, $vals);
	xml_parser_free($xml_parser);
	// wyznaczamy tablice z powtarzajacymi sie tagami na tym samym poziomie
	$_tmp = '';
	foreach ($vals as $xml_elem) {
		$x_tag = $xml_elem['tag'];
		$x_level = $xml_elem['level'];
		$x_type = $xml_elem['type'];
		if ($x_level != 1 && $x_type == 'close') {
			if (isset($multi_key[$x_tag][$x_level]))
				$multi_key[$x_tag][$x_level] = 1;
			else
				$multi_key[$x_tag][$x_level] = 0;
		}
		if ($x_level != 1 && $x_type == 'complete') {
			if ($_tmp == $x_tag)
				$multi_key[$x_tag][$x_level] = 1;
			$_tmp = $x_tag;
		}
	}
	// jedziemy po tablicy
	foreach ($vals as $xml_elem) {
		$x_tag = $xml_elem['tag'];
		$x_level = $xml_elem['level'];
		$x_type = $xml_elem['type'];
		if ($x_type == 'open')
			$level[$x_level] = $x_tag;
		$start_level = 1;
		$php_stmt = '$xml_array';
		if ($x_type == 'close' && $x_level != 1)
			$multi_key[$x_tag][$x_level]++;
		while ($start_level < $x_level) {
			$php_stmt .= '[$level[' . $start_level . ']]';
			if (isset($multi_key[$level[$start_level]][$start_level]) && $multi_key[$level[$start_level]][$start_level])
				$php_stmt .= '[' . ($multi_key[$level[$start_level]][$start_level] - 1) . ']';
			$start_level++;
		}
		$add = '';
		if (isset($multi_key[$x_tag][$x_level]) && $multi_key[$x_tag][$x_level] && ($x_type == 'open' || $x_type == 'complete')) {
			if (!isset($multi_key2[$x_tag][$x_level]))
				$multi_key2[$x_tag][$x_level] = 0;
			else
				$multi_key2[$x_tag][$x_level]++;
			$add = '[' . $multi_key2[$x_tag][$x_level] . ']';
		}
		if (isset($xml_elem['value']) && trim($xml_elem['value']) != '' && !array_key_exists('attributes', $xml_elem)) {
			if ($x_type == 'open')
				$php_stmt_main = $php_stmt . '[$x_type]' . $add . '[\'content\'] = $xml_elem[\'value\'];';
			else
				$php_stmt_main = $php_stmt . '[$x_tag]' . $add . ' = $xml_elem[\'value\'];';
			eval($php_stmt_main);
		}
		if (array_key_exists('attributes', $xml_elem)) {
			if (isset($xml_elem['value'])) {
				$php_stmt_main = $php_stmt . '[$x_tag]' . $add . '[\'content\'] = $xml_elem[\'value\'];';
				eval($php_stmt_main);
			}
			foreach ($xml_elem['attributes'] as $key => $value) {
				$php_stmt_att = $php_stmt . '[$x_tag]' . $add . '[$key] = $value;';
				eval($php_stmt_att);
			}
		}
	}
	return $xml_array;
}

function cookie_keyword()
{
	$ci = &get_instance();
	$rand_on = time() . rand(11111, 9999);
	$check_srch_cookie = $ci->input->cookie('user_cook', TRUE);
	if (!isset($check_srch_cookie) || $check_srch_cookie == '') {
		// create cookie to avoid hitting this case again
		$srch_cookie = array(
			'name'   => 'user_cook',
			'value'  => $rand_on,
			'expire' => 865000,
			'secure' => false
		);
		$ci->input->set_cookie($srch_cookie);
	}
}

function clean_url($string)
{
	// $string = preg_replace("~\b(?:https?://(?:www\.)?|www\.)\S+|[^A-Za-z0-9 ']~", '', $string); 
	$string = url_title($string);
	$string = preg_replace('/ +/', ' ', $string);
	$string = str_replace('', '-', $string);
	return ucfirst($string);
}

function clean($string, $nosp = 0)
{
	if ($nosp != 0) {
		$string = preg_replace('/\s+/', '', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	} else {
		return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
	}
}

function set_keyword_cookie($yid)
{
	$ci = &get_instance();
	//Assign LoggedIn UserID to the cookie keyword
	$check_srch_cookie = $ci->input->cookie('user_cook', TRUE);
	if (isset($check_srch_cookie)) {
		$cookie_id = $_COOKIE['user_cook'];
		$updateUserID = $ci->db->query("UPDATE x_cou_keywords SET user_id='$yid' where cookie_id='$cookie_id'");
	}
}
////////////////////////////// THIS IS CUSTOM //////////////////////////////////////////////////////////////////////

function show_cost($price)
{
	@$thecurre = $_SESSION['currency'];
	// if($price =='0'){return 'free';}
	switch ($thecurre) {
		case 'INR':
			$thecurre2 = 'USD';
			// $theprice=$price*77;
			$theprice = convertCurrency($price, $thecurre2, $thecurre);
			return "<span class='fa fa-rupee mr-1' ></span>" . $theprice . "<span data-toggle='tooltip' data-placement='top' title='Price may slightly vary as per currency conversion rate' class='muted-text' ></span>";
			break;
		case 'USD':
		default:
			$thecurre2 = 'INR';
			// $theprice=$price*77;
			$theprice = convertCurrency($price, $thecurre2, $thecurre);
			return "<span class='fa fa-rupee mr-1' ></span>" . $theprice . "<span data-toggle='tooltip' data-placement='top' title='* Price may slightly vary as per currency conversion rate' class='muted-text' ><small>*</small></span>";
			// return '$'.$price;
			break;
	}
}

function convertCurrency($amount, $from = 'USD', $to = 'INR')
{
	if ($amount == '0' || $amount == '') {
		return 'free';
	}

	// if($to !='INR'){
	$to = strtoupper($to);
	// }

	switch ($from) {
		case 'USD':
		default:
			if ($to == 'USD') {
				return number_format($amount) . ' USD' . "<span data-toggle='tooltip' data-placement='top' title='* Price may slightly vary as per currency conversion rate' class='muted-text' ></span>";
			} else {
				return number_format($amount * 80) . ' INR';
				// return $amount;
			}
			break;
		case 'INR':
			if ($to == 'INR') {
				return number_format($amount) . ' INR';
			} else {
				return number_format($amount / 80) . ' USD' . "<span data-toggle='tooltip' data-placement='top' title='* Price may slightly vary as per currency conversion rate' class='muted-text' ></span>";
			}
			break;
	}
}

function checkandset_currency()
{
	if (!isset($_SESSION['currency']) || $_SESSION['currency'] == '') {
		$_SESSION['currency'] = 'INR';
	}
}

function social_login($type, $data1 = null, $data2 = null)
{
	switch ($type) {
		case 'google';
			include_once APPPATH . "libraries/vendor/autoload.php";
			$google_client = new Google_Client();
			$google_client->setClientId('112177324296-hf2rmbq0bpm7sg7co64rbs7utq2rrmfo.apps.googleusercontent.com'); //Define your ClientID
			$google_client->setClientSecret('yY9iT3tn9Kex_YMdkMIU2ckt'); //Define your Client Secret Key
			$google_client->setRedirectUri('https://courslyst.com/google_login/login'); //Define your Redirect Uri
			$google_client->addScope('email');
			$google_client->addScope('profile');

			// echo $login_button = '<a href="'.$google_client->createAuthUrl().'" class="sign-in-with" ><img src="'.base_url('assets/theme/').'images/icon/google.png" class="sign-in-with" style="max-height:90px;" /><span>Sign Up with Google</span></a>';

			echo "<div class='account-header'>
                    <a href='" . $google_client->createAuthUrl() . "' class='sign-in-with'><img src='" . base_url('assets/theme/') . "images/icon/google.png' alt='icon'><span>Sign Up with Google</span></a>
            </div>";

			// <a href="#0" class="sign-in-with"><img src="./assets/images/icon/google.png" alt="icon"><span>Sign Up with Google</span></a>

			// $data['login_button'] = $login_button;
			break;
		case 'google2';
			include_once APPPATH . "libraries/vendor/autoload.php";
			$google_client = new Google_Client();
			$google_client->setClientId('112177324296-hf2rmbq0bpm7sg7co64rbs7utq2rrmfo.apps.googleusercontent.com'); //Define your ClientID
			$google_client->setClientSecret('yY9iT3tn9Kex_YMdkMIU2ckt'); //Define your Client Secret Key
			$google_client->setRedirectUri('https://courslyst.com/google_login/login'); //Define your Redirect Uri
			$google_client->addScope('email');
			$google_client->addScope('profile');

			// echo $login_button = '<a href="'.$google_client->createAuthUrl().'" class="sign-in-with" ><img src="'.base_url('assets/theme/').'images/icon/google.png" class="sign-in-with" style="max-height:90px;" /><span>Sign Up with Google</span></a>';

			echo "<div class='account-header'>
                    <a href='" . $google_client->createAuthUrl() . "' class='sign-in-with'><img src='" . base_url('assets/theme/') . "images/icon/google.png' alt='icon'><span>Login with Google</span></a>
            </div>";

			// <a href="#0" class="sign-in-with"><img src="./assets/images/icon/google.png" alt="icon"><span>Sign Up with Google</span></a>

			// $data['login_button'] = $login_button;
			break;
	}
}

function myfav_items($id, $check = 0)
{
	$CI = get_instance();
	if (!isset($_SESSION['myfav']) || empty($_SESSION['myfav']) || $check != '0') {
		// My favourites
		$get_myfav = $CI->db->query("select fav_id,fav_item_id from site_favourites where fav_user_id = '$id'");
		$myfav = $get_myfav->result_array();
		$_SESSION['myfav'] = $myfav;
	} else {
		return $myfav = $_SESSION['myfav'];
	}
	// return $myfav;
}

function favourite_me($itemID)
{
	$fav_class = 'fas fa-heart';
	$the_fav_mess = 'Mark as favourite';
	if ((isset($_SESSION['myfav']) || !empty($_SESSION['myfav']))) {
		$fav_items = $_SESSION['myfav'];

		if (array_search($itemID, array_column($fav_items, 'fav_item_id')) != '') {
			$fav_class = 'fa fa-heart';
			$the_fav_mess = 'Remove from favourite';
		}

		if (isset($_SESSION['yid'])) {
			$fav_class .= ' the_ani_btn';
		}
	} ?>
	<form id="fav<?= $itemID ?>" action="<?= base_url('action/user_favourite') ?>" method="post" class="fav_icons_btn the_imp_btn" onsubmit="return ajaxsubmitform('<?= base_url('action/user_favourite') ?>',this,'error_div','loder_div','#','1','favourite');" onclick="$('#fav<?= $itemID ?>').submit();" style='cursor: pointer;'>
		<input type="hidden" name="itemID" value="<?= $itemID ?>">
		<div class="" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="<?= $the_fav_mess ?>"><i class="<?= $fav_class ?>" id="tehe_fav<?= $itemID ?>"></i></div>
	</form>
<?php }

function myfav_users($id, $check = 0)
{
	$CI = get_instance();
	if (!isset($_SESSION['myfavUsers']) || empty($_SESSION['myfavUsers']) || $check != '0') {
		// My favourites
		$get_myfav = $CI->db->query("select * from x_followers where f_follow_by = '$id'");
		$myfav = $get_myfav->result_array();
		$_SESSION['myfavUsers'] = $myfav;
	} else {
		return $myfav = $_SESSION['myfavUsers'];
	}
	// return $myfav;
}

function favourite_me_user($itemID)
{
	if (isset($_SESSION['myfavUsers']) && !empty($_SESSION['myfavUsers'])) {
		$fav_items = $_SESSION['myfavUsers'];
		return array_search($itemID, array_column($fav_items, 'f_follow_to')) !== false;
	}
	return false;
}

function getCategory($id)
{
	$ci = &get_instance();
	$gettall_subcat = $ci->db->query("select * from yn_site_catagory where ctid ='$id'");
	$thescat_details = $gettall_subcat->row_array();
	$category = $thescat_details['name'];
	return $category;
}

function getShop($id)
{
	$ci = &get_instance();
	$gettall_subcat = $ci->db->query("select * from x_vendor_shop where shop_uniq_id ='$id'");
	$thescat_details = $gettall_subcat->row_array();
	$row = $thescat_details['shop_name'];
	return $row;
}


function getsubCat($catID, $style = '1')
{
	$ci = &get_instance();
	$gettall_subcat = $ci->db->query("select * from yn_site_sub_cat where sc_ctid ='$catID'");
	$thescat_details = $gettall_subcat->result_array();
	switch ($style) {
		case '1':
			echo '<option value="">Select SubCategory</option>';
			foreach ($thescat_details as $thescat) {
				echo '<option value="' . $thescat['sc_id'] . '">' . $thescat['sc_name'] . '</option>';
			}
			break;
		case 'sct_name':
			$gettall_subcat = $ci->db->query("select sc_name from yn_site_sub_cat where sc_id ='$catID' ");
			$thescat_details = $gettall_subcat->row_array();
			return $thescat_details['sc_name'];
			break;
	}
}

function getsub2Cat($catID, $scatID, $style = '1')
{
	$ci = &get_instance();
	$gettall_variant = $ci->db->query("select * from yn_site_sub2_cat where yn_site_sub2_cat_sid='$scatID' and yn_site_sub2_cat_cid='$catID'");
	$thevar_details = $gettall_variant->result_array();
	switch ($style) {
		case '1':
			echo '<option value="">Select Sub2Category</option>';
			foreach ($thevar_details as $thevar) {
				echo '<option value="' . $thevar['yn_site_sub2_cat_id'] . '">' . $thevar['yn_site_sub2_cat_name'] . '</option>';
			}
			break;
		case 'vname':
			$gettall_subcat = $ci->db->query("select yn_site_sub2_cat_name from yn_site_sub2_cat where yn_site_sub2_cat_id='$catID'");
			$thescat_details = $gettall_subcat->row_array();
			return $thescat_details['yn_site_sub2_cat_name'];
			break;
	}
}

function convertYoutube($string, $class = 0, $height = '400px')
{
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe src=\"//www.youtube.com/embed/$2\" width='100%' height='$height' allowfullscreen></iframe>",
		$string
	);
}

function get_cou_image($cou_img, $pr_img)
{
	if ($cou_img == '') {
		return base_url('assets/avator/upload/') . $pr_img;
	} else {
		return $cou_img;
	}
}


function con_24to12($date_tim, $min, $style, $today = 0)
{
	switch ($style) {
		case '1':
			if ($date_tim == 0) {
				$thataretu = '12 :' . $min . ' AM';
			} else
            if ($date_tim < 12) {
				$thataretu = $date_tim . ':' . $min . ' AM';
			} elseif ($date_tim == 12) {
				$thataretu = '12' . ':' . $min . ' PM';
			} else {
				$thataretu = $date_tim - 12 . ':' . $min . ' PM';
			}
			return $thataretu;
			break;
	}
}


function redirect_path($reffer, $url, $style)
{
	if ($reffer != '') {
		return $reffer;
	} else {
		return base_url($url);
	}
}

function get_product_image_data($imgID = null)
{
	$ci = &get_instance();
	$chkData = $ci->db->query("SELECT * FROM `yn_ecom_products_img` where pid = '$imgID' ");
	$arrResult = array();
	$TempData = null;
	if ($chkData->num_rows() > 0) {
		$TempData = $chkData->result_array();
		$arrResult = $TempData[0];
	} else {
		$arrResult = array();
	}
	return $arrResult;
}

// function ratings_star($rate, $style,$size=null)
// {
//     if ($rate != '' && $rate > 0) {
//         $rate = round($rate);
//         switch ($style) {
//             case 'star':
//                 if($size == null){$size='10px';}
//                 //$star_rate=$rate.' ';
//                 $star_rate = ' ';
//                 for ($k = $rate; $k > 0; $k--) {
//                     $star_rate = $star_rate . " <i class='fa fa-star' style='color:#F7B924;font-size:".$size.";'></i>";
//                 }

//                 for ($k = 5 - $rate; $k > 0; $k--) {
//                     $star_rate = $star_rate . " <i class='fa fa-star' style='color:#333;font-size:".$size.";'></i>";
//                 }
//                 echo $star_rate;
//                 break;
//         }
//     }
// }


function ratings_star($rate, $style, $size = null)
{
	if ($rate != '' && $rate > 0) {
		$rate = round($rate);
		switch ($style) {
			case 'star':
				if ($size == null) {
					$size = '10px';
				}
				//$star_rate=$rate.' ';
				$star_rate = ' ';
				for ($k = $rate; $k > 0; $k--) {
					$star_rate = $star_rate . '<svg class="text-warning" width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                        fill="currentColor"></path>
                </svg>';
				}

				for ($k = 5 - $rate; $k > 0; $k--) {
					$star_rate = $star_rate . '<svg class="text-warning" width="14" height="13" viewbox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z"
                        fill="currentColor"></path>
                </svg>';
				}
				echo $star_rate;
				break;
		}
	}
}




function get_overall_rating($all_reviews_are, $review_count)
{
	$total = 0;
	if (!empty($all_reviews_are)) {
		for ($r = 5; $r > 0; $r--) {
			$count = 0;
			foreach ($all_reviews_are as $review) {
				if ($review['cr_rating'] == $r) {
					$count++;
				}
			} //foreach
			$total += ($count * $r);
		} //for
	}
	if ($review_count == '0') {
		return '0';
	}
	return number_format($total / $review_count, '1');
}

function get_review_count($all_reviews_are, $r)
{
	$count = 0;
	if (!empty($all_reviews_are)) {
		foreach ($all_reviews_are as $review) {
			if ($review['cr_rating'] == $r) {
				$count++;
			}
		}
	}
	return $count;
}

function all_reviews_query($id)
{
	$ci = &get_instance();
	$getreviews = $ci->db->query("select * from x_edu_course_review,yn_site_mem where cr_user=mid and cr_type='review' and cr_status = 1 and  cr_lid = '$id' order by crid DESC");
	return $getreviews->result_array();
}
function all_reviews_query_count($id)
{
	$ci = &get_instance();
	$getreviews = $ci->db->query("select * from x_edu_course_review,yn_site_mem where cr_user=mid and cr_type='review' and cr_status = 1 and  cr_lid = '$id' order by crid DESC");
	return $getreviews->num_rows();
}

function getEnrolledMembers($id)
{
	$ci = &get_instance();
	$theEnrollments = $ci->db->query("select * from x_edu_enrollments,yn_site_mem where co_user_id=mid and co_course_id='$id' ORDER BY co_id DESC");
	return $theEnrollments;
}

function getEnrolledMembersCount($id)
{
	$ci = &get_instance();
	$theEnrollments = $ci->db->query("select * from x_edu_enrollments,yn_site_mem where co_user_id=mid and co_course_id='$id' ORDER BY co_id DESC");
	return $theEnrollments->num_rows();
}

function qbank_timer($start_timer, $end_timer, $exam_id)
{
	$countdown_time = strtotime("$end_timer");
	$diff = ($countdown_time - time());
	$countdown_time = strtotime("$start_timer") + $diff;
?>
	<script>
		var countDownDate = <?= $countdown_time ?> * 1000;
		restart_timer(countDownDate);

		function restart_timer(countDownDate) {

			var now = <?php echo strtotime("$start_timer"); ?> * 1000;

			// Update the count down every 1 second
			var x = setInterval(function() {
				now = now + 1000;
				// Find the distance between now an the count down date
				var distance = countDownDate - now;
				// Time calculations for days, hours, minutes and seconds
				var hours = Math.floor((distance % (1000 * 60 * 60 * 60)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				// Output the result in an element with id="demo"
				if (hours > 0) {
					document.getElementById("demo").innerHTML = "0" + hours + " : " + "0" + minutes + " : " + seconds;
				} else {
					document.getElementById("demo").innerHTML = "0" + minutes + " : " + seconds;
				}
				// If the count down is over, write some text 
				if (distance <= 1) {
					clearInterval(x);
					var url = base_url + 'qbtest_end?exam_id=' + <?= $exam_id ?>;
					window.location.href = url;
				}

			}, 1000);
		}
	</script>
<?php }

function calculate_score($exam_id, $qbid = '0')
{
	$yid = $_SESSION['yid'];
	$ci = &get_instance();

	$getheQbank = $ci->db->query("select * from x_edu_questions,x_edu_qbank_test,x_edu_qbank,x_edu_qbank_question where qbq_qbank_id=qb_id and qbq_ques_id=qid and qb_id=qbt_qbid and qid=qbt_qid and qbt_exam_id='$exam_id'");
	$score = $answered = $skip = $review = $wrong_answer = $unattempted = 0;

	if ($getheQbank->num_rows() > '0') {
		$thisQbank_res = $getheQbank->result_array();
		//$totalQues= $thisQbank_res[0]['qbquestions'];
		$totalQues = get_totalQues($thisQbank_res[0]['qb_id']);
		foreach ($thisQbank_res as $thisQ) {

			switch ($thisQ['qbt_status']) {
				case '1':
					if ($thisQ['qanswer'] == $thisQ['qbt_answer']) {
						$score++;
					} else {
						$wrong_answer++;
					}
					$answered++;
					break;
				case '2':
					$skip++;
					$unattempted++;
					break;
				case '3':
					$review++;
					$unattempted++;
					break;
			}
		}
		$unattempted += ($totalQues - $getheQbank->num_rows());
		return array($score * @$thisQ['qbmarks'], $answered, $skip, $review, $score, $wrong_answer, $unattempted);
	} elseif ($qbid > '0') {
		$getheQbank = $ci->db->query("select * from x_edu_qbank where qb_id='$qbid'");
		$thisQbank_res = $getheQbank->row_array();
		$totalQues = get_totalQues($qbid); //$thisQbank_res['qbquestions'];
	}
	return array('0', $answered, $skip, $review, '0', $totalQues, $totalQues);
}

function get_totalQues($qbid)
{
	$ci = &get_instance();
	$getheQbank = $ci->db->query("select * from x_edu_qbank_question where qbq_qbank_id='$qbid'");
	return $getheQbank->num_rows();
}

function redirect_to_url($page_url, $param = NULL)
{
	if (strpos($page_url, '?')) {
		$page_url .= '&' . $param;
	} else {
		$page_url .= '?' . $param;
	}
	redirect($page_url);
}

function total_series_ques($series_id)
{
	$ci = &get_instance();
	$totalQues = 0;
	$allcourses = $ci->db->query("select * from x_edu_qbank,x_edu_qbseries where series_id=qbseries and qbseries='$series_id' and (qbapp_web='web' OR qbapp_web='both') order by qb_id desc");
	$show_courses = $allcourses->result_array();
	foreach ($show_courses as $qbank) {
		$totalQues += $qbank['qbquestions'];
	}
	return $totalQues;
}

function calculate_rank($exam_id, $qbid = '0')
{
	$yid = $_SESSION['yid'];
	$ci = &get_instance();

	$getheQbank = $ci->db->query("select * from x_edu_qbank_user where qbu_qbid='$qbid' ORDER BY qbu_score DESC, qbu_end_time asc");

	if ($getheQbank->num_rows() > '0') {
		$thisQbank_res = $getheQbank->result_array();
		$key = array_search($exam_id, array_column(@$thisQbank_res, 'qbu_exam_id'));
		$rank = $key + 1;
	}
	return $rank;
}

function check_bookmark($ques)
{
	$ci = &get_instance();
	$yid = $_SESSION['yid'];
	$getheQuesBookmark = $ci->db->query("select * from x_edu_ques_bookmark where eqb_qid='$ques' and eqb_mem_id='$yid'");

	if ($getheQuesBookmark->num_rows() > '0') {
		return true;
	} else {
		return false;
	}
}

function check_report($ques)
{
	$ci = &get_instance();
	$yid = $_SESSION['yid'];
	$getheQuesReport = $ci->db->query("select * from x_edu_ques_report where erb_qid='$ques' and erb_mem_id='$yid'");

	if ($getheQuesReport->num_rows() > '0') {
		return true;
	} else {
		return false;
	}
}

function is_tab_selected($data, $data2)
{
	$current_url = $_SERVER['REQUEST_URI'];
	return $is_users_page = strpos($current_url, $data) !== false;
}

function get_followers_count($userID)
{
	$CI = &get_instance();
	$CI->load->database();

	$query = $CI->db->query("SELECT COUNT(*) AS total FROM x_followers WHERE f_follow_to = ?", [$userID]);
	$result = $query->row();

	return $result ? $result->total : 0;
}

function get_following_count($userID)
{
	$CI = &get_instance();
	$CI->load->database();

	$query = $CI->db->query("SELECT COUNT(*) AS total FROM x_followers WHERE f_follow_by = ?", [$userID]);
	$result = $query->row();

	return $result ? $result->total : 0;
}


if (!function_exists('has_liked_post')) {
	function has_liked_post($post_id, $user_id)
	{
		$ci = &get_instance();
		$ci->load->database();

		$ci->db->where('l_post_id', $post_id);
		$ci->db->where('l_user_id', $user_id);
		$query = $ci->db->get('x_post_likes');

		return $query->num_rows() > 0;
	}
}

if (!function_exists('has_repeated_post')) {
	function has_repeated_post($post_id, $user_id)
	{
		$ci = &get_instance();
		$ci->load->database();

		$ci->db->where('r_post_id', $post_id);
		$ci->db->where('r_user_id', $user_id);
		$query = $ci->db->get('x_post_retweets');

		return $query->num_rows() > 0;
	}
}

if (!function_exists('get_user_name')) {
	function get_user_name($user_id)
	{
		$ci = &get_instance();
		$ci->db->select("name");
		$ci->db->where("mid", $user_id);
		$query = $ci->db->get("yn_site_mem");
		return $query->row()->name;
	}
}

if (!function_exists('get_comments_by_post')) {
	function get_comments_by_post($post_id)
	{
		$ci = &get_instance();
		$ci->db->select('c.*, u.mid, u.name, u.username, u.photo');
		$ci->db->from('x_post_comments c');
		$ci->db->join('yn_site_mem u', 'c.c_user_id = u.mid', 'left');
		$ci->db->where('c.c_post_id', $post_id);
		$ci->db->order_by('c.c_created_at', 'DESC');

		return $ci->db->get()->result_array();
	}
}


function formatPostContent($content)
{
	// Convert URLs into clickable links
	$content = preg_replace_callback(
		'/(https?:\/\/[^\s]+)/',
		function ($matches) {
			return '<a href="' . $matches[0] . '" target="_blank" class="text-primary">' . $matches[0] . '</a>';
		},
		$content
	);

	// Convert hashtags into clickable links
	$content = preg_replace(
		'/#(\w+)/',
		// '<a href="' . base_url('hashtag/$1') . '" class="text-primary">#$1</a>',
		'<a href="#" class="text-primary">#$1</a>',
		$content
	);

	// Convert text-based emojis into Unicode emojis
	$emoji_map = [
		':-)' => '😊',
		':)' => '😊',
		':-D' => '😁',
		':D' => '😁',
		';-)' => '😉',
		';)' => '😉',
		':-P' => '😛',
		':P' => '😛',
		':-(' => '☹️',
		':(' => '☹️',
		':-|' => '😐',
		':|' => '😐'
	];
	$content = str_replace(array_keys($emoji_map), array_values($emoji_map), $content);

	return $content;
}

function update_last_seen($date, $mid)
{
	$ci = &get_instance();
	$chkData = $ci->db->query("UPDATE yn_site_mem SET `last_seen` = '$date' WHERE mid = $mid ");
	return $chkData;
}


// Times Ago Function
function timeAgo($date)
{
	$timestamp = strtotime($date);

	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60", "60", "24", "30", "12", "10");

	// $currentTime = time();
	$currentTime = date_default_timezone_set('Africa/Douala');
	if ($currentTime >= $timestamp) {
		$diff     = time() - $timestamp;
		for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
			$diff = $diff / $length[$i];
		}

		$diff = round($diff);
		return $diff . " " . $strTime[$i] . "(s) ago ";
	}
}

function timeAgo2($date)
{
	$timestamp = strtotime($date);
	if (!$timestamp) return 'Invalid date';

	$currentTime = time();
	$diff = $currentTime - $timestamp;

	if ($diff < 5) {
		return 'Just now';
	}

	$units = array("y" => 31536000, "mo" => 2592000, "d" => 86400, "h" => 3600, "m" => 60, "s" => 1);

	foreach ($units as $unit => $seconds) {
		if ($diff >= $seconds) {
			$value = floor($diff / $seconds);
			return $value . $unit;
		}
	}
}

if (!function_exists('create_notification')) {
	function create_notification($to_user_id, $from_user_id, $type, $type_id = null, $text = '', $link = '')
	{
		$CI = &get_instance();
		$CI->load->database();

		$data = [
			'n_to_user'    => $to_user_id,
			'n_from_user'  => $from_user_id,
			'n_type'       => $type,
			'n_type_id'    => $type_id,
			'n_text'       => $text,
			'n_link'       => $link,
			'n_status'     => 0,
			'n_created_at' => date('Y-m-d H:i:s'),
		];

		$CI->db->insert('x_notifications', $data);
	}
}

if (!function_exists('user_details')) {
	function user_details($user_id)
	{
		$ci = &get_instance();
		$ci->db->select('*');
		$ci->db->from('yn_site_mem');
		$ci->db->where('mid', $user_id);

		return $ci->db->get()->row_array();
	}
}

?>