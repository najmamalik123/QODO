<form class="banner-form" id="contact-form" method="post" action="<?=base_url('index.php/action/subscribe')?>" novalidate="novalidate" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/subscribe')?>',this,'error_div','loder_div','#','1','contacted');">
<input type="email" class="form-control" name="email" placeholder="Enter your Email" />
<button type="submit">Subscribe</button>
</form>