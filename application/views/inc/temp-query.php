<div id='contact_form_data'>
<form action="<?=$flink?>/act/action_sim.php" method="post" onsubmit="return ajaxsubmitform('<?=$flink?>/act/action_sim.php',this,'error_div','loder_div','#','1','contacted');">
    <div class="thetabsl_names_90o">
        <input type="text" name="name" placeholder="Your Name*" required class='text_box' />
    </div><div class="thetabsl_names_90o">
        <input type="text" name="email" placeholder="Your Email*" required class='text_box' />
    </div><div class="thetabsl_names_90o">
        <input type="text" name="phone" placeholder="Phone Number*" required class='text_box' />
    </div><textarea name="mess" placeholder="your Message for us please be specific*" class='text_area' required></textarea><div class="thetabsl_names_90o">
        <select name="p"  class="text_box">
                        <option value="">Select Product</option>
                        <option value="Laptop">Laptop</option>
                        <option value="MacBook">MacBook</option>
                        <option value="Smart Phone">Smart Phone</option>
                        <option value="Network">Network</option>
                        <option value="Others">Others</option>
                    </select>
    </div><div class="thetabsl_names_90o">
        <select name="l" class="text_box">
                        <option value="">Select Location</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Gurgaon">Gurgaon</option>
                        <option value="Delhi NCR">Delhi NCR</option>
                    </select>
    </div>
    
    <input type='hidden' name="step" value="4" />
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>      
    <div class="g-recaptcha captaG" data-sitekey="6LfgnxAUAAAAAJ-0K2BFUPh0UMjmMo3UhCAXtBLv"></div>
    
    <input type="submit" name="send" value="Send Your Query" class="button floatrightside xlarge green" style='margin-right:10%;'/>
</form>
        <div class="theclonus_op">
            <div class="tabs_icon_link" style="border:0px;float:right;">
                <div class="icon_mains_headr">
                <img src="<?=$flink?>/icons/b/skype.png"/>
                </div>
                <div class="text_icons_ead masterTooltip" title="Search for ynaps web on skype and you found us">
                    <?=$site_skype?>
                </div>
            </div><div class="tabs_icon_link masterTooltip" title="Phone whatsApp, Instant messages we are availabe" style="border:0px;float:right;">
                <div class="icon_mains_headr">
                    <img src="<?=$flink?>/icons/b/phone.png"/>
                </div>
                <div class="text_icons_ead">
                <?=$site_phone?>
                </div>
            </div><div class="tabs_icon_link masterTooltip" title="hello@ynaps.com, status@ynaps.com, rj@ynaps.com" style="border:0px;float:right;">
                <div class="icon_mains_headr">
                <img src="<?=$flink?>/icons/b/mail4.png"/>
                </div>
                <div class="text_icons_ead">
                   <?=$site_email?>
                </div>
            </div>
        </div>
    
    
</div>