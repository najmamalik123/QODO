<?php
include_once('config.php');
function getpayment_methods($item,$price){
global $usdrate; ?>
<script src='https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js'></script>
<div class="divide_8yments">
<h2>Pay in indian currency</h2>
    <h3 style="font-size:12px;">Here you can enter the email that you wish to receive the invoice.</h3>
   <center>
<!--    <a href="https://www.instamojo.com/ynaps/ynaps-service-booking-amount/" rel="im-checkout" data-behaviour="remote" data-style="dark" data-text="Pay the booking amount INR 140"></a>-->
       <a href="https://www.instamojo.com/ynaps/test-ynaps/" rel="im-checkout" data-behaviour="remote" data-style="light" data-text="Checkout With Instamojo"></a>
<script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>
    </center>
    <img src="avator/payment-p.jpg" style='width:80%;margin-left:10%;'/>
</div>
<div class="divide_8yments">
<h2>Pay in USD  $ 2.0</h2>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="iamrahulkumar001@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="<?=$item?>">
<input type="hidden" name="amount" value="2">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<center><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"></center>
</form>
<center><img src="avator/paypal-bestdeal.png" style='height:80px;margin-top:30px;'/></center>
</div>
<?php }

function session_check(){
    if(!isset($_SESSION['yid']) || $_SESSION['yid']==''){
        $session_check_r='0';
    }else{
        $session_check_r='1';
    }
    return $session_check_r;
}
function currency_convert($amount,$currency){
    global $usdrate;
    if($currency =='INR'){
        return $amount;
    }else{
        $amount=round($amount/$usdrate,2);
        return $amount;
    }
}

function searcher_bar($i,$search,$class){
    switch($i){
        case 1:
            ?>
<form action='recipe.php' method="get"><input type="text" name='search' placeholder='Search For Recipee.' class="<?=$class?>" autocomplete='off' onkeyup="auto_search_fun_skill(this);" onkeypress="cleartimeout();" value='<?=$search?>'/>
<input type="submit" value="Search" class='button large gray float_right mo_2styule_23' style='height:30px;'/>
</form>
<?php
            break;case 2:
            ?>
<form action='recipe.php' method="get"><input type="text" name='search' placeholder='Search For Recipee.' class="<?=$class?>" autocomplete='off' onkeyup="auto_search_fun_skill2(this);" onkeypress="cleartimeout();" value='<?=$search?>'/>
    <input type="submit" class="button theme xlarge float_right mo_bigr_btn mo_2styule_23" value='Find Recipe'/>
</form>
<?php
            break;
        default:
            
            break;
    }
}

function time_dif($minutes){
    if($minutes < 59){
    echo $minutes.' Mins';    
    }else{
     echo floor($minutes / 60).':'.($minutes -   floor($minutes / 60) * 60) .' Hrs';
    }
}
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe src=\"//www.youtube.com/embed/$2\" width='100%' height='400px' allowfullscreen></iframe>",
        $string
    );
}
function check_youtube($url) {
    if (strpos($url, 'youtube') > 0) {
        return '1';
    } elseif (strpos($url, 'vimeo') > 0) {
        return '2';
    } else {
        return '0';
    }
}

function select_country($style,$selected){ ?>
    <select name="country" class="text_box">
<option value="">Country.</option>
        <?php if($selected !=''){ ?>
<option value="<?=$selected?>" selected><?=country($selected)?></option>
        <?php } ?>
<option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AG">Angola</option><option value="AI">Anguilla</option><option value="AG">Antigua &amp; Barbuda</option><option value="AR">Argentina</option><option value="AA">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BL">Bonaire</option><option value="BA">Bosnia &amp; Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brazil</option><option value="BC">British Indian Ocean Ter</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="IC">Canary Islands</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CD">Channel Islands</option><option value="CL">Chile</option><option value="CN">China</option><option value="CI">Christmas Island</option><option value="CS">Cocos Island</option><option value="CO">Colombia</option><option value="CC">Comoros</option><option value="CG">Congo</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CT">Cote D'Ivoire</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CB">Curacao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TM">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FA">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="FS">French Southern Ter</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GB">Great Britain</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinea</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HW">Hawaii</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IA">Iran</option><option value="IQ">Iraq</option><option value="IR">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="NK">Korea North</option><option value="KS">Korea South</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MY">Malaysia</option><option value="MW">Malawi</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="ME">Mayotte</option><option value="MX">Mexico</option><option value="MI">Midway Islands</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Nambia</option><option value="NU">Nauru</option><option value="NP">Nepal</option><option value="AN">Netherland Antilles</option><option value="NL">Netherlands (Holland, Europe)</option><option value="NV">Nevis</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NW">Niue</option><option value="NF">Norfolk Island</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau Island</option><option value="PS">Palestine</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PO">Pitcairn Island</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="ME">Republic of Montenegro</option><option value="RS">Republic of Serbia</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="NT">St Barthelemy</option><option value="EU">St Eustatius</option><option value="HE">St Helena</option><option value="KN">St Kitts-Nevis</option><option value="LC">St Lucia</option><option value="MB">St Maarten</option><option value="PM">St Pierre &amp; Miquelon</option><option value="VC">St Vincent &amp; Grenadines</option><option value="SP">Saipan</option><option value="SO">Samoa</option><option value="AS">Samoa American</option><option value="SM">San Marino</option><option value="ST">Sao Tome &amp; Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="OI">Somalia</option><option value="ZA">South Africa</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TA">Tahiti</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad &amp; Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TU">Turkmenistan</option><option value="TC">Turks &amp; Caicos Is</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States of America</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VS">Vatican City State</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VB">Virgin Islands (Brit)</option><option value="VA">Virgin Islands (USA)</option><option value="WK">Wake Island</option><option value="WF">Wallis &amp; Futana Is</option><option value="YE">Yemen</option><option value="ZR">Zaire</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option>
</select>
<?php }

function country_code($code){
    $countries = array(
    'AF'=>'AFGHANISTAN', 'AL'=>'ALBANIA', 'DZ'=>'ALGERIA', 'AS'=>'AMERICAN SAMOA', 'AD'=>'ANDORRA', 'AO'=>'ANGOLA', 'AI'=>'ANGUILLA', 'AQ'=>'ANTARCTICA', 'AG'=>'ANTIGUA AND BARBUDA', 'AR'=>'ARGENTINA', 'AM'=>'ARMENIA', 'AW'=>'ARUBA', 'AU'=>'AUSTRALIA', 'AT'=>'AUSTRIA', 'AZ'=>'AZERBAIJAN', 'BS'=>'BAHAMAS', 'BH'=>'BAHRAIN', 'BD'=>'BANGLADESH', 'BB'=>'BARBADOS', 'BY'=>'BELARUS', 'BE'=>'BELGIUM', 'BZ'=>'BELIZE', 'BJ'=>'BENIN', 'BM'=>'BERMUDA', 'BT'=>'BHUTAN', 'BO'=>'BOLIVIA', 'BA'=>'BOSNIA AND HERZEGOVINA', 'BW'=>'BOTSWANA', 'BV'=>'BOUVET ISLAND', 'BR'=>'BRAZIL', 'IO'=>'BRITISH INDIAN OCEAN TERRITORY', 'BN'=>'BRUNEI DARUSSALAM', 'BG'=>'BULGARIA', 'BF'=>'BURKINA FASO', 'BI'=>'BURUNDI', 'KH'=>'CAMBODIA', 'CM'=>'CAMEROON', 'CA'=>'CANADA', 'CV'=>'CAPE VERDE', 'KY'=>'CAYMAN ISLANDS', 'CF'=>'CENTRAL AFRICAN REPUBLIC', 'TD'=>'CHAD', 'CL'=>'CHILE', 'CN'=>'CHINA', 'CX'=>'CHRISTMAS ISLAND', 'CC'=>'COCOS (KEELING) ISLANDS', 'CO'=>'COLOMBIA', 'KM'=>'COMOROS', 'CG'=>'CONGO', 'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'CK'=>'COOK ISLANDS', 'CR'=>'COSTA RICA', 'CI'=>'COTE D IVOIRE', 'HR'=>'CROATIA', 'CU'=>'CUBA', 'CY'=>'CYPRUS', 'CZ'=>'CZECH REPUBLIC', 'DK'=>'DENMARK', 'DJ'=>'DJIBOUTI', 'DM'=>'DOMINICA', 'DO'=>'DOMINICAN REPUBLIC', 'TP'=>'EAST TIMOR', 'EC'=>'ECUADOR', 'EG'=>'EGYPT', 'SV'=>'EL SALVADOR', 'GQ'=>'EQUATORIAL GUINEA', 'ER'=>'ERITREA', 'EE'=>'ESTONIA', 'ET'=>'ETHIOPIA', 'FK'=>'FALKLAND ISLANDS (MALVINAS)', 'FO'=>'FAROE ISLANDS', 'FJ'=>'FIJI', 'FI'=>'FINLAND', 'FR'=>'FRANCE', 'GF'=>'FRENCH GUIANA', 'PF'=>'FRENCH POLYNESIA', 'TF'=>'FRENCH SOUTHERN TERRITORIES', 'GA'=>'GABON', 'GM'=>'GAMBIA', 'GE'=>'GEORGIA', 'DE'=>'GERMANY', 'GH'=>'GHANA', 'GI'=>'GIBRALTAR', 'GR'=>'GREECE', 'GL'=>'GREENLAND', 'GD'=>'GRENADA', 'GP'=>'GUADELOUPE', 'GU'=>'GUAM', 'GT'=>'GUATEMALA', 'GN'=>'GUINEA', 'GW'=>'GUINEA-BISSAU', 'GY'=>'GUYANA', 'HT'=>'HAITI', 'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS', 'VA'=>'HOLY SEE (VATICAN CITY STATE)', 'HN'=>'HONDURAS', 'HK'=>'HONG KONG', 'HU'=>'HUNGARY', 'IS'=>'ICELAND', 'IN'=>'INDIA', 'ID'=>'INDONESIA', 'IR'=>'IRAN, ISLAMIC REPUBLIC OF', 'IQ'=>'IRAQ', 'IE'=>'IRELAND', 'IL'=>'ISRAEL', 'IT'=>'ITALY', 'JM'=>'JAMAICA', 'JP'=>'JAPAN', 'JO'=>'JORDAN', 'KZ'=>'KAZAKSTAN', 'KE'=>'KENYA', 'KI'=>'KIRIBATI', 'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF', 'KR'=>'KOREA REPUBLIC OF', 'KW'=>'KUWAIT', 'KG'=>'KYRGYZSTAN', 'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC', 'LV'=>'LATVIA', 'LB'=>'LEBANON', 'LS'=>'LESOTHO', 'LR'=>'LIBERIA', 'LY'=>'LIBYAN ARAB JAMAHIRIYA', 'LI'=>'LIECHTENSTEIN', 'LT'=>'LITHUANIA', 'LU'=>'LUXEMBOURG', 'MO'=>'MACAU', 'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'MG'=>'MADAGASCAR', 'MW'=>'MALAWI', 'MY'=>'MALAYSIA', 'MV'=>'MALDIVES', 'ML'=>'MALI', 'MT'=>'MALTA', 'MH'=>'MARSHALL ISLANDS', 'MQ'=>'MARTINIQUE', 'MR'=>'MAURITANIA', 'MU'=>'MAURITIUS', 'YT'=>'MAYOTTE', 'MX'=>'MEXICO', 'FM'=>'MICRONESIA, FEDERATED STATES OF', 'MD'=>'MOLDOVA, REPUBLIC OF', 'MC'=>'MONACO', 'MN'=>'MONGOLIA', 'MS'=>'MONTSERRAT', 'MA'=>'MOROCCO', 'MZ'=>'MOZAMBIQUE', 'MM'=>'MYANMAR', 'NA'=>'NAMIBIA', 'NR'=>'NAURU', 'NP'=>'NEPAL', 'NL'=>'NETHERLANDS', 'AN'=>'NETHERLANDS ANTILLES', 'NC'=>'NEW CALEDONIA', 'NZ'=>'NEW ZEALAND', 'NI'=>'NICARAGUA', 'NE'=>'NIGER', 'NG'=>'NIGERIA', 'NU'=>'NIUE', 'NF'=>'NORFOLK ISLAND', 'MP'=>'NORTHERN MARIANA ISLANDS', 'NO'=>'NORWAY', 'OM'=>'OMAN', 'PK'=>'PAKISTAN', 'PW'=>'PALAU', 'PS'=>'PALESTINIAN TERRITORY, OCCUPIED', 'PA'=>'PANAMA', 'PG'=>'PAPUA NEW GUINEA', 'PY'=>'PARAGUAY', 'PE'=>'PERU', 'PH'=>'PHILIPPINES', 'PN'=>'PITCAIRN', 'PL'=>'POLAND', 'PT'=>'PORTUGAL', 'PR'=>'PUERTO RICO', 'QA'=>'QATAR', 'RE'=>'REUNION', 'RO'=>'ROMANIA', 'RU'=>'RUSSIAN FEDERATION', 'RW'=>'RWANDA', 'SH'=>'SAINT HELENA', 'KN'=>'SAINT KITTS AND NEVIS', 'LC'=>'SAINT LUCIA', 'PM'=>'SAINT PIERRE AND MIQUELON', 'VC'=>'SAINT VINCENT AND THE GRENADINES', 'WS'=>'SAMOA', 'SM'=>'SAN MARINO', 'ST'=>'SAO TOME AND PRINCIPE', 'SA'=>'SAUDI ARABIA', 'SN'=>'SENEGAL', 'SC'=>'SEYCHELLES', 'SL'=>'SIERRA LEONE', 'SG'=>'SINGAPORE', 'SK'=>'SLOVAKIA', 'SI'=>'SLOVENIA', 'SB'=>'SOLOMON ISLANDS', 'SO'=>'SOMALIA', 'ZA'=>'SOUTH AFRICA', 'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'ES'=>'SPAIN', 'LK'=>'SRI LANKA', 'SD'=>'SUDAN', 'SR'=>'SURINAME', 'SJ'=>'SVALBARD AND JAN MAYEN', 'SZ'=>'SWAZILAND', 'SE'=>'SWEDEN', 'CH'=>'SWITZERLAND', 'SY'=>'SYRIAN ARAB REPUBLIC', 'TW'=>'TAIWAN, PROVINCE OF CHINA', 'TJ'=>'TAJIKISTAN', 'TZ'=>'TANZANIA, UNITED REPUBLIC OF', 'TH'=>'THAILAND', 'TG'=>'TOGO', 'TK'=>'TOKELAU', 'TO'=>'TONGA', 'TT'=>'TRINIDAD AND TOBAGO', 'TN'=>'TUNISIA', 'TR'=>'TURKEY', 'TM'=>'TURKMENISTAN', 'TC'=>'TURKS AND CAICOS ISLANDS', 'TV'=>'TUVALU', 'UG'=>'UGANDA', 'UA'=>'UKRAINE', 'AE'=>'UNITED ARAB EMIRATES', 'GB'=>'UNITED KINGDOM', 'US'=>'UNITED STATES', 'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS', 'UY'=>'URUGUAY', 'UZ'=>'UZBEKISTAN', 'VU'=>'VANUATU', 'VE'=>'VENEZUELA', 'VN'=>'VIET NAM', 'VG'=>'VIRGIN ISLANDS, BRITISH', 'VI'=>'VIRGIN ISLANDS, U.S.', 'WF'=>'WALLIS AND FUTUNA', 'EH'=>'WESTERN SAHARA', 'YE'=>'YEMEN', 'YU'=>'YUGOSLAVIA', 'ZM'=>'ZAMBIA', 'ZW'=>'ZIMBABWE',
  );
    $nameis=isset($countries[$code]) ? $countries[$code] : null;
    if($code !=''){
        $code=strtolower($code);
     echo "<img src='icons/flag/16/$code.png'-flag.png' class='flagname_s'>".$nameis;   
    }else{
        echo "Country Not Selected";
    }
}

function social_media_share($urltoshare,$nameofp,$hashis){ 
global $flink;            
?>
<script src="<?=$link?>js/social.js"></script>            
    <div class='side_content allposts'>
                        <div class="ingrs_box_0">
                            <b>Share On Social Media</b>
                        </div>
                        <div class="cont_small_ares123">
                            <div class='tabes_olp_about smalles_hjus'>
                              <div class="fb-share-button" data-href="<?=$urltoshare?>" data-layout="button"></div>
                            </div><div class='tabes_olp_about smalles_hjus'>
                             <a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=#<?=$hashis?> <?=$nameofp?>"
  data-size="default">
Tweet</a>
                            </div><div class='tabes_olp_about smalles_hjus'>
                           <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
<script type="IN/Share"></script>
                            </div>
                        </div><div class="cont_small_ares123">
                         <div class='tabes_olp_about smalles_hjus'>
                            <a href="//www.reddit.com/submit" target="_blank" onclick="window.open('//www.reddit.com/submit?url=' + encodeURIComponent(window.location)', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"> <img src="//www.redditstatic.com/spreddit7.gif" alt="submit to reddit" border="0" /> </a>
                            </div><div class='tabes_olp_about smalles_hjus'>
                               <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="none"></div>
                            </div>
                        </div>
                    </div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
};return t;}
                
(document, "script", "twitter-wjs"));
window.fbAsyncInit = function() {
FB.init({
appId : '1705796716365496',
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
};
</script>
<?php }

function likemypage($whichisthis){
    switch($whichisthis){
        case 'fb':?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=565187130324114";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="https://www.facebook.com/enterployee" data-width="70px" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <?php break;case 'tw':?>
<a href="https://twitter.com/enterployee" class="twitter-follow-button" data-show-count="false">Follow @enterployee</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <?php break;case 'go':?>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the widget to render. -->
<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/117022456034958723441" data-rel="publisher"></div>
            <?php break;
    }
    
}
function smiles($text) {
        $icons = array(
                ':)'    =>  '<img src="icons/smiles/smilee.png" class="icon_smile" title="smiling :)"/>',
                ':d'    =>  '<img src="icons/smiles/lol.gif" class="icon_smile" title="Laughing :d"/>',
                ';)'    =>  '<img src="icons/smiles/wink.png" class="icon_smile" title="Wink ;)"/>',
                ':p'    =>  '<img src="icons/smiles/tongue.png" class="icon_smile" title="Tounge :p"/>',
                ':('    =>  '<img src="icons/smiles/sad.png"  class="icon_smile" title="Sad face :("/>',
                ':o'    =>  '<img src="icons/smiles/shock.png" class="icon_smile" title="Shocking :o"/>',
                ':|'    =>  '<img src="icons/smiles/straight.png" class="icon_smile" title="straight :|"/>',
                '<3'   =>  '<img src="icons/smiles/heart.png" class="heart" title="Heart <3"/>',
                '::s'   =>  '<img src="icons/smiles/sexy.png" class="icon_smile" title="Sexy <s"/>',
                ':D'   =>  '<img src="icons/smiles/lols.gif" class="icon_smile" title="lol :D"/>',

                ':(('   =>  '<img src="icons/smiles/cry.gif" class="icon_smile" title="crying :(("/>',
                ':X'   =>  '<img src="icons/smiles/silent.gif" class="icon_smile" title="sealed lips :X"/>',
                ':B'   =>  '<img src="icons/smiles/bla.gif" style="width:29px;vertical-align:middle;" title="bla bla :B"/>',
                ':C'   =>  '<img src="icons/smiles/coll.gif" style="width:24px;vertical-align:middle;" title="coll me :C"/>',
                ':V'   =>  '<img src="icons/smiles/conf.gif" class="icon_smile" title="confused :V"/>',

                '::l'   =>  '<img src="icons/smiles/love.png" class="icon_smile" title="Love this ::l"/>',
                '::>'   =>  '<img src="icons/smiles/sho.png" class="icon_smile" title="Shue ::]"/>',
                '::<'   =>  '<img src="icons/smiles/foot.png" class="icon_smile" title="foot ::!"/>',
                '::b'   =>  '<img src="icons/smiles/filter.png" style="height:17px;max-width:24px;" title="Blured ::b"/>',
                '::d'   =>  '<img src="icons/smiles/dinner.png" class="icon_smile" title="Dinner ::d"/>',
                '::m'   =>  '<img src="icons/smiles/mail.png" style="width:16px;vertical-align:middle;" title="mail ::m"/>',
                '::c'   =>  '<img src="icons/smiles/coffee.png" class="icon_smile" title="coffee ::c"/>',
                '::a'   =>  '<img src="icons/smiles/angry.png" class="icon_smile" title="angry ::a"/>',
                '::o'   =>  '<img src="icons/smiles/oops.png" class="icon_smile" title="Oopss ::o"/>',
                '::t'   =>  '<img src="icons/smiles/tired.png" class="icon_smile" title="Tired ::t"/>',
                '::?'   =>  '<img src="icons/smiles/quest.png" class="icon_smile" title="What ::?"/>',
                '::r'   =>  '<img src="icons/smiles/run.png" class="icon_smile" title="Run ::r"/>',
                '::k'   =>  '<img src="icons/smiles/standing.png" class="icon_smile" title="Standing ::k"/>',
                '::p'   =>  '<img src="icons/smiles/phone.png" class="icon_smile" title="phone ::p"/>',

                '::f'   =>  '<img src="icons/smiles/fuck.png" class="fuckyou" title="fuck you ::F"/>'
        );
	$text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target=\"_blank\" class='THE_LINK_TEXT_009'>$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target=\"_blank\" class='THE_LINK_TEXT_009'>$3</a>", $text);  
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\" target=\"_blank\" class='THE_LINK_TEXT_009'>$2@$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\#])([a-z0-9|\_\.]*)/i", "$1<span class='THASTAG_TEXT_009' id='has$3' onclick='hastagthis(this)'>$2$3</span>", $text);
	$text=nl2br($text);
        return strtr($text, $icons);
    }

function get_captcha($addclass){ ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>      
    <div class="g-recaptcha <?=$addclass?>" data-sitekey="6LfgnxAUAAAAAJ-0K2BFUPh0UMjmMo3UhCAXtBLv"></div>
<?php }
function signup_check($flink){
if(isset($_SESSION['yid']) || @$_SESSION['yid'] !=''){
    header("location:$flink"); die;
}else{
    @clearsession();
}
if(isset($_COOKIE['login']) && $_COOKIE['login'] !='' && !isset($_GET['new'])){
    header("location:login.php?redirect"); die;
}}
function check_mobile($mobile)
{
    if(preg_match('/^[0-9]{10}+$/', $mobile) !='1'){
        echo 'Please check your mobile number, please do not add any extensions.'; die;
    } ;
}
function yesto1($item){
    if($item =='1'){
        echo 'Yes';
    }else{
        echo 'No';
    }
}
?>