<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ynaps_load extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function load_state(){
		$country=xss_clean($_GET['country']);
		return getState($country,'1');
	}

	function load_city(){
		$state=xss_clean($_GET['state']);
		return getCity($state,'1');
	}

	function load_sub_cats(){
		// echo 'hello'; die;
		$the_data=$_POST['the_data'];
		$thecats2=$this->db->query("select * from yn_site_sub_cat where sc_ctid='$the_data' ");
		$thsersftsy2=$thecats2->result_array();
		foreach($thsersftsy2 as $the_carys_dea){ ?>
		    <div class="col-12 col-sm-6  text-white p-1 text-left text-center justify-content-center">
		    	<div class="btn button-4 my-1 px-2 the_soesss">
		        <a href="<?=base_url('search/')?><?=url_smart($the_carys_dea['sc_name'])?>?do=sct&q=<?=url_smart($the_carys_dea['sc_name'])?>&sct=<?=url_smart($the_carys_dea['sc_id'])?>" class='no_link_3' ><?=trim_text($the_carys_dea['sc_name'],20)?></a>
		    	</div>
		    </div>
		<?php }
	}

	function load_sub_cats2(){
		// echo 'hello'; die;
		$k=$_POST['the_data'];
			
		// $geththecourses=$this->db->query("select * from x_cou_courses where (cou_cat_$k='1') and cou_status='1' limit 9");
		$geththecourses=$this->db->query("select * from x_cou_courses,x_cou_prov,x_cou_datav where (cou_api=pr_id and cou_version=dtv_id and dtv_status='1' and cou_cat_$k='1' ) and cou_status='1' limit 4");
		$all_datas_are=$geththecourses->result_array();
		foreach($all_datas_are as $thecourse_data){ 
			$cou_img=get_cou_image($thecourse_data['cou_img'], $thecourse_data['pr_image']);
			?>
			    <div class="col-12 thecat_caths">
                                    <div class="row shadow_3 bg-white p-2 mb-1">
        <div class="thefav_nowe">
                <?=favourite_me($thecourse_data['cou_id']);?>
        </div>
        <div class="the_imase_f col-sm-3 col-12 pull-left my-auto">
        <a href="<?=$thecourse_data['cou_link']?>" target='_blank' >
            <img src="<?=$cou_img?>" alt="<?=$thecourse_data['cou_name']?>" class='img-fluid'>
        </a>
        </div>
        <div class="col-sm-6 col-12 the_name_scou">
                 <b>
                <a href="<?=$thecourse_data['cou_link']?>" target='_blank' class='no_link' ><?=$thecourse_data['cou_name']?></a>
                
                <!-- <a href="<?=base_url('apply/')?><?=$thecourse_data['cou_id']?>/<?=url_smart($thecourse_data['cou_name'])?>" target='_blank' class='no_link' ><?=clean_url($thecourse_data['cou_name'])?></a> -->
                </b><br/><?php if($thecourse_data['cou_tags']!='') echo $thecourse_data['cou_tags'].'<br/>';?>

                <?php echo ratings_star($thecourse_data['cou_rat'],'star');?>

                By: <a href="<?=base_url('search?pr=')?><?=$thecourse_data['cou_api']?>&provider=<?=url_smart($thecourse_data['pr_name'])?>"><?=$thecourse_data['pr_name']?></a>
                <br/><?php if($thecourse_data['cou_duration'] !=''){ ?> <i class="fa fa-stopwatch-20 mr-1" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Duration" ></i> <?=$thecourse_data['cou_duration']?> <?php } ?> 
                <?php if($thecourse_data['cou_lang'] !=''){ ?> <i class="fa fa-language mx-1" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Language"></i><?=strtoupper($thecourse_data['cou_lang'])?><br/> <?php } ?>
                <?php if($thecourse_data['cou_level'] !=''){ ?>  <i class="fa fa-window-restore" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Level" ></i> <?=$thecourse_data['cou_level']?>
                 <?php } ?><?php if($thecourse_data['cou_pace'] !=''){ ?> | <i class="fa fa-tachometer-alt" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Pace"></i> <?=str_replace('_', ' ', $thecourse_data['cou_pace'])?> <?php } ?> <?php if($thecourse_data['cou_inst'] !=''){ ?> | <i class="fa fa-chalkboard-teacher" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Instructor" ></i> <?=str_replace('_', ' ', $thecourse_data['cou_inst'])?> <?php } ?><br>
                
                <?=compare_me($thecourse_data['cou_id']);?>

        </div>
        <div class="col-sm-3 pull-right the_max_wud col-12 text-sm-right">
        <b><?=convertCurrency($thecourse_data['cou_price'],$thecourse_data['cou_currency'],$_SESSION['currency'])?></b><br/>
        <small><a class="no_link" href="<?=base_url('course/')?><?=$thecourse_data['cou_id']?>/<?=clean_url(url_smart($thecourse_data['cou_name']))?>"> View More <i class="fa fa-angle-double-right"></i> </a></small><br/>
                <?php if($thecourse_data['pr_image']!=''){?>
                    <img src="<?=base_url('assets/avator/upload/')?><?=$thecourse_data['pr_image']?>" style='height: 16px;width: auto;' ><br/>
                <?php }?>
        <a href="<?=$thecourse_data['cou_link']?>" target='_blank' class='mt-3 special_go_to btn btn--primary type--uppercase the_imp_btn theme_bg shadow_1' > Go To Course <span class="ml-1 fa fa-external-link-alt"></span> </a>
        </div>
    </div>
                                </div>
		<?php }
	}

	function load_subcat(){
		$cat=xss_clean($_GET['cat']);
		return getsubCat($cat);
	}

	function load_getsub2Cat(){
		$cat=xss_clean($_GET['cat']);
		$scat=xss_clean($_GET['scat']);
		return getsub2Cat($cat, $scat);
	}


// function load_subsubcat(){
// 	if (isset($_GET['sub_category'])) {
// 		$selectedSubCategory = $_GET['sub_category'];


// 		$subSubCategories = $this->db->query("SELECT * FROM yn_site_sub2_cat WHERE mr_sub2_sid = '$selectedSubCategory'");
// 		$subSubCategories = $subSubCategories->result_array();
	
// 		foreach ($subSubCategories as $subSubCategory) {
// 		    echo '<option value="' . $subSubCategory['mr_sub2_id'] . '">' . $subSubCategory['mr_sub2_name'] . '</option>';
// 		}

// 	}
// }


function load_subsubcat() {
    if (isset($_GET['sub_category'])) {
        $selectedSubCategory = $_GET['sub_category'];

        $subSubCategories = $this->db->query("SELECT * FROM yn_site_sub2_cat WHERE mr_sub2_sid = '$selectedSubCategory'");
        $subSubCategories = $subSubCategories->result_array();

        foreach ($subSubCategories as $subSubCategory) {
            $selected = '';
            if (isset($_GET['sscat']) && $_GET['sscat'] == $subSubCategory['mr_sub2_id']) {
                $selected = 'selected';
            }

            echo '<option value="' . $subSubCategory['mr_sub2_id'] . '" ' . $selected . '>' . $subSubCategory['mr_sub2_name'] . '</option>';
			
        }
    }
}




		/////////////////////

}