<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.dingconnect.com/api/V1/GetCountries",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    // "api_key: CWiTAt9lSSf6Fs0MgO0054",
    "api_key: 5sIkXhACG4n5kaktzVECSl",
    "Cookie: visid_incap_1373684=W9x+2eX9SnqTQX976o3oKHP6p14AAAAAQUIPAAAAAACMqfJ0lIy4A94PIJ9/k566; visid_incap_1694192=CGL0RcqDS4y8rtfUDyl8RIn7p14AAAAAQUIPAAAAAAAgAZUccrSXJcreVE5ZcnLv; incap_ses_314_1694192=sszNShN26mgsFiNoe41bBOCRrV4AAAAAIX3OEAYdaCajfehID6IgsQ=="
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$someArray = json_decode($response, true);

// print_r ($someArray);

// echo count ($someArray['Items']);
// print_r($someArray['Items']['1']['CountryName']);



foreach ($someArray['Items'] as $key => $value) {
    echo $value["CountryName"] . ", " . $value["CountryIso"] . "<br>";
}
