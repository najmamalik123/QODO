<?php
$url = 'https://api.sendgrid.com/';
$user = 'moringamadrid';
$pass = 'maria1961';
$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'x-smtpapi' => json_encode($json_string),
    'to'        => "$tos",
    'subject'   => "$subject09",
    'html'      => "$messageto90",
	'fromname' => $myName_emailis,
    'from'      => "techmapservices.in <info@techmapservices.in>"
  );
$request =  $url.'api/mail.send.json';
// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
@curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_3);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// obtain response
$response = curl_exec($session);
curl_close($session);
//print_r($response);
?>