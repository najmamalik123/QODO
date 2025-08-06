<?php
$query = $this->db->query("SELECT * FROM site_countries WHERE status = 1 ORDER BY country_name ASC");
$thedatss=$query->result_Array();
$rowCount=$query->num_rows();
?>
<div class="container" style="padding-top: 30px;">
	<div class="row">
		<div class="col-md-3">
			<h5>Filters</h5>
			<div>
                <form action="" method="get">
				<div class="col-sm-12 give_moe_coolr">
				<strong class="theme_text">Travelling from</strong>
				<div class="form-group">
                <select id="country" class="form-control" name="co1">
                    <option value="">Select Country</option>
                    <?php if($rowCount > 0){
                    foreach($thedatss as $row){
                    echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>'; }
                    }else{ echo '<option value="">Country not available</option>'; } ?>
                </select>
                </div><div class="form-group" name='st1'>
                    <select id="state" class="form-control">
                        <option value="">Select country first</option>
                    </select>
                </div><div class="form-group">
                    <select id="city" class="form-control" name="ct1">
                        <option value="">Select state first</option>
                    </select>
                </div></div>

                <div class="col-sm-12 give_moe_coolr">
                <strong class="theme_text">Travelling To</strong>
                <div class="form-group">
                <select id="country2" class="form-control" name="co2">
                    <option value="">Select Country</option>
                    <?php if($rowCount > 0){
                    foreach($thedatss as $row){
                    echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>'; }
                    }else{ echo '<option value="">Country not available</option>'; } ?>
                </select>
                </div><div class="form-group" name='st2' >
                    <select id="state2" class="form-control">
                        <option value="">Select country first</option>
                    </select>
                </div><div class="form-group">
                    <select id="city2" class="form-control" name="ct2">
                        <option value="">Select state first</option>
                    </select>
                </div></div>

                <div class="col-sm-12 give_moe_coolr" style="overflow: hidden;">
             <strong class="theme_text">Travel Date and Mode</strong>
            <div class="form-group">
                <input id="datepicker" name="date" width="276" class="form-control" placeholder="Travel Date*" autocomplete="off"  />
            </div><div class="form-group">
                <select id="city" class="form-control" name="mode">
                        <option value="">Select Mode</option>
                        <?php foreach($mode as $t_mode){ ?>
                            <option value="<?=$t_mode['Em_id']?>"><?=$t_mode['em_mode']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <input type="submit" value="FILTER" class="btn btn-primery btn-block theme_bg text-white">
        </form>
			</div>
		</div>
		<div class="col-md-9">
			<h6>Find the right fit for your package, and send it now. </h6>
			<?php foreach($listings as $list){ ?>
			<div class="col-sm-12 listing_div">
				<div class="pic_div_3">
					<img src="<?=base_url('assets/mem')?>/<?=$list['mid']?>/img/<?=$list['photo']?>">
				</div>
				<div class="list_details">
                 <a href="<?=base_url('index.php/main/package')?>?pid=<?=$list['el_id']?>" class="no_link">
					<b><?=$list['name']?><?=check_verify('1',$list['verify'],'veriffy_ocins')?></b> is Travelling From: <b> <?=$list['li_from_t']?></b> <br/> To: <b> <?=$list['li_to_t']?></b> On date <b> <?=date_format_1($list['el_date'],1)?> </b>
					<br/> Mode of Transport <b><?=$list['em_mode']?></b><br/>
					<small class="light_text">Message: <?=trim_text($list['el_mess'],90)?> </small> <br/>
                    <?=check_verify('2',$list['li_verify'],'veriffy_ocins')?>
                    <input type="button" value="Contact" class="btn btn-primery contact_btn theme_bg contvs4">
                </a>
				</div>
			</div>
		<?php }
        echo $this->pagination->create_links();
         ?>

		</div>
	</div>
</div>