<?php
require_once ('assets/vendor/autoload.php');
use \Statickidz\GoogleTranslate;
$source344 = 'en';
$targe444t = 'hi';
?>
<style type="text/css">
#ftco-navbar{display: none;}
.ftco-footer{display: none;}
</style>



<?php
		@$qid=$_GET['q'];
		@$ty=$_GET['ty'];
		$ppr=$exam_data['ppr_id'];

		if(isset($_GET['q']) && $_GET['q'] !=''){@$qid=$_GET['q'];}else{$qid='1';}
		if(isset($_GET['ty']) && $_GET['ty'] !=''){
			@$ty=$_GET['ty'];
			$questios2=$this->db->query("select * from edu_questions where (qu_ppr='$ppr' and qu_status !='0' and qu_type='$ty' ) order by qui_mqid");

			// echo  "select * from edu_questions where (qu_ppr='$ppr' and qu_status !='0' and qu_type='$ty' ) order by qui_mqid";
		}else{
			$ty='';
			$questios2=$this->db->query("select * from edu_questions where (qu_ppr='$ppr' and qui_mqid='$qid' and qu_status !='0' ) order by qui_mqid");
		}


		$questios=$questios2->row_array();
		$qid=$questios['qui_mqid'];



$QUES_0op9 = $questios['qu_ques'];
if($questios['qu_dir'] ==''){
$tex4444t = 'Question: '.str_replace('"', "'",$QUES_0op9);
}else{$tex4444t = 'Directions: '.$questios['qu_dir'].'<br/> Question: '.str_replace('"', "'",$QUES_0op9);}
$tex4444t=str_replace(array("\r\n", "\r", "\n"), " ", $tex4444t);
$trans232 = new GoogleTranslate();
$results3 = $trans232->translate($source344, $targe444t, $tex4444t);

$results31 = $trans232->translate($source344, $targe444t, $questios['qu_op1']);
$results32 = $trans232->translate($source344, $targe444t, $questios['qu_op2']);
$results33 = $trans232->translate($source344, $targe444t, $questios['qu_op3']);
$results34 = $trans232->translate($source344, $targe444t, $questios['qu_op4']);
$results35 = $trans232->translate($source344, $targe444t, $questios['qu_op5']);
$results3=str_replace("\ ","\\",$results3);

$results3=str_replace("\ ","\\",$results3);
$results31=str_replace("\ ","\\",$results31);
$results32=str_replace("\ ","\\",$results32);
$results33=str_replace("\ ","\\",$results33);
$results34=str_replace("\ ","\\",$results34);
$results35=str_replace("\ ","\\",$results35);


$results31=str_replace("$ $","$$",$results31);
$results32=str_replace("$ $","$$",$results32);
$results33=str_replace("$ $","$$",$results33);
$results34=str_replace("$ $","$$",$results34);
$results35=str_replace("$ $","$$",$results35);


		$exm=$_GET['id'];
		$details_anw=$this->db->query("select * from edu_answers where ans_exam='$exm' and ans_ques='$qid' ");
		$thedatesrs=$details_anw->row_array();
		?>
		<div class="container-fluid themain_mox_90s">
		<div class="col-12 exam_headers_s p-3 no_pads_mo">
			<div class="row">
			<div class="col-sm-4 d-none d-md-block">
			<center><img src="<?=base_url('assets/avator/logo.png')?>"></center>
			</div>
			<div class="col-sm-4 text-center" style="padding-top: 10px;">
				<h5>#<?=$exam_data['ppr_id']?> | <?=$exam_data['ppr_name']?></h5>
			</div>
			<div class="col-sm-4" style="padding-top: 4px;background: #333;color: #fff;">
				REVIEW!
			</div>

			<div class="col-12 theextra_smallss" style="background: #ddd;">
				<?php $getcatsgs=$this->db->query("select DISTINCT qu_type from edu_questions where qu_ppr='$ppr' ");
				$theall_tyes=$getcatsgs->result_array();
				foreach($theall_tyes as $typesare){
					$theclaskks='';
				if($questios['qu_type'] == $typesare['qu_type'] ){ $theclaskks='theactivelink'; }?>
					<a href="<?=base_url('index.php/main/start_review?id=')?><?=$_GET['id']?>&ty=<?=$typesare['qu_type']?>" class="real_link <?=$theclaskks?>"><span class="mr-2"><?=show_options('t',$typesare['qu_type'])?></span></a>
				<?php }
				?>
				<select class="px-2 pull-right" id='language34_0s' onchange="change_lang();">
					<option value="0">English</option>
					<option value="1">Hindi</option>
				</select>
			</div>
			</div>
		</div>

		<div class="row p-1 main_exam_place_mod">
			<div class="col-sm-9 the_main_exam theex_Amshjsqq" style="border-right: 1px solid #ddd;">

				<div style="font-size: 16px;"><?php if($questios2->num_rows() !='0'){ ?>

				<div id="real_q_e" class="all_q_e_e"><b>Q<?=$questios['qui_mqid']?>:
				</b><span id='theappensder_qes'><?php if($questios['qu_dir'] !=''){ ?><span class="theme_text">DIRECTIONS</span> <?=$questios['qu_dir']?><br/><?php } ?>
				<?=$questios['qu_ques']?> </div>
				<div id="real_q_h" class="all_q_e_h"><?=strip_tags($results3)?></div>

				<?php if($questios['qu_img6'] !=''){?>
				<br/><a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img6']?>" class='image_option_90'></a>
				<?php } ?></div>
			<form action="<?=base_url('index.php/main/submit_answer')?>" method="post" id='answer_theform_quest'>
				<input type="hidden" name="qid" value="<?=$questios['qui_mqid']?>">
				<input type="hidden" name="qi_mq" value="<?=$questios['qu_id']?>">
				<div class="row">
					<div class="col-sm-6 p-2 options_examsj">
						(A) <input type="radio" name="ans" class="" value="1">
						<?php if($questios['qu_img1'] !=''){?>
						<a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img1']?>" class='image_option_90'></a>
						<?php } ?>
						<span id="opet_09_1" class="all_q_e_e"><?=nl2br($questios['qu_op1'])?></span>
						<span id="real_q_h" class="all_q_e_h"><?=$results31?></span>
					</div><div class="col-sm-6 p-2 options_examsj">
						(B) <input type="radio" name="ans" class="" value="2">
						<?php if($questios['qu_img2'] !=''){?>
						<a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img2']?>" class='image_option_90'></a>
						<?php } ?>
						<span id="opet_09_2" class="all_q_e_e"><?=nl2br($questios['qu_op2'])?></span>
						<span id="real_q_h" class="all_q_e_h"><?=$results32?></span>
					</div><div class="col-sm-6 p-2 options_examsj">
						(C) <input type="radio" name="ans" class="" value="3">
						<?php if($questios['qu_img3'] !=''){?>
						<a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img3']?>" class='image_option_90'></a>
						<?php } ?>
						<span id="opet_09_1" class="all_q_e_e"><?=nl2br($questios['qu_op3'])?></span>
						<span id="real_q_h" class="all_q_e_h"><?=$results33?></span>
					</div><div class="col-sm-6 p-2 options_examsj">
						(D) <input type="radio" name="ans" class="" value="4">
						<span id="opet_09_1" class="all_q_e_e"><?=nl2br($questios['qu_op4'])?></span>
						<span id="real_q_h" class="all_q_e_h"><?=$results34?></span>
						<?php if($questios['qu_img4'] !=''){?>
						<a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img4']?>" class='image_option_90'></a>
						<?php } ?>
					</div><?php if($questios['qu_op5'] !=''){ ?>
						<div class="col-sm-6 p-2 options_examsj">
						(E) <input type="radio" name="ans" class="" value="5">
						<span id="opet_09_1" class="all_q_e_e"><?=nl2br($questios['qu_op5'])?></span>
						<span id="real_q_h" class="all_q_e_h"><?=$results35?></span>
					</div>
				<?php } ?>

					<div class="col-sm-6 p-2 options_examsj" style="background: yellow">
						CORRECT OPTION:
						<b><?=$questios['qu_ans']?></b>
					</div><div class="col-sm-6 p-2 options_examsj" style="background: #fef">
						YOUR ANSWER:
						<?php if($thedatesrs['ans_ans'] !=''){ ?> <b>OPTION <?=$thedatesrs['ans_ans']?></b> <?php } else{
							echo "<b>Not Attempted!</b>";
						}?>
					</div><div class="col-sm-6 p-2 options_examsj" style="background: #fef">
						Explanation
						<p id="opet_09_6"><?=$questios['qu_desc']?></p>
						<?php if($questios['qu_img5'] !=''){?>
						<br/><a href="#" class="pop_img"><img src="<?=base_url('assets/avator/upload/ppr/')?><?=$questios['qu_img5']?>" class='image_option_90'></a>
						<?php } ?>
					</div>
				</div>
			</form>
			<?php }else{
				echo "This question is not active or not set by the admin please call at $site_phone for more details <br/
				>give them following details when asked.<br/><br/>
				Paper ID: $ppr<br/>
				Question number: $qid
				";
			} ?>
			</div>
			<div class="only_for_mox_09osip" onclick="$('#show_opus78shs4').show();">
				|
			</div>
			<div class="col-sm-3 p-2 the_options_09s" id='show_opus78shs4'>
				<div class="ross_liwjkss theme_bg row p-2 no-gutters">
					<div class="col-sm-4">
						<img src="<?=base_url('assets/mem/')?><?=$_SESSION['yid']?>/img/<?=$_SESSION['photo']?>">
					</div><div class="col-sm-8">
					Name: <?=$_SESSION['name']?><br/>
					Exam ID: <?=$exam_data['ex_id']?><br/>
					Paper ID: <?=$exam_data['ppr_id']?>
				</div>
				</div>

				<div class="row no-gutters p-2 thepas_90sopos">
					<div class="col-12"><b style="color: #333;">Questions</b></div>
					<?php for($i=1;$i<=$exam_data['ppr_tq'];$i++){
						if($qid == $i){$class_q1='active_quesi90s';}else{$class_q1='';}

						@$all_answered=$_SESSION['answers_ques'];
						$all_answered_array=explode(",",$all_answered);
						if (in_array($i, $all_answered_array)){$class_q1=$class_q1.' answered';}
						?>
						<a href="<?=base_url('index.php/main/start_review?id=')?><?=$_GET['id']?>&q=<?=$i?>">
							<div class="ppae_ques_id <?=$class_q1?>">
							<?=$i?>
						</div></a>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="exam_ops90_foetsr row col-12 justify-content-center">
			<div class="col-sm-9">
				<div class="row pt-4 thedispl_09ioss">
					<div class="col-sm-6">
						<a href="<?=base_url('index.php/main/start_review?id=')?><?=$_GET['id']?>&q=<?=$qid-1?>"><button class="btn btn-default btn-block" type="button" name="" style="border:1px solid #333;" ><span class="fa fa-arrow-left"> </span> Previous Question </button></a>
					</div><div class="col-sm-3 the_mo_gsf">
						<a href="<?=base_url('index.php/main/start_review?id=')?><?=$_GET['id']?>&q=<?=$qid+1?>"><button class="btn btn-default btn-block" type="button" name="" style="border:1px solid #333;"> Next Question </button></a>
					</div><div class="col-sm-3">
						<a href="<?=base_url('index.php/main/clear_review')?>"><button class="btn btn-danger btn-block" type="button" name="" style="border:1px solid #333;"> GO HOME </button></a>
					</div>
				</div>
			</div>

			<div class="col-sm-3">

			</div>
		</div>
</div>


<!--
<?php
if($questios['qu_dir'] ==''){
$tex4444t = 'Question: '.$questios['qu_ques'];
}else{$tex4444t = 'Directions: '.$questios['qu_dir'].'<br/> Question: '.$questios['qu_ques'];}
$tex4444t=str_replace(array("\r\n", "\r", "\n"), " ", $tex4444t);
$trans232 = new GoogleTranslate();
$results3 = $trans232->translate($source344, $targe444t, $tex4444t);

$results31 = $trans232->translate($source344, $targe444t, $questios['qu_op1']);
$results32 = $trans232->translate($source344, $targe444t, $questios['qu_op2']);
$results33 = $trans232->translate($source344, $targe444t, $questios['qu_op3']);
$results34 = $trans232->translate($source344, $targe444t, $questios['qu_op4']);
$results35 = $trans232->translate($source344, $targe444t, $questios['qu_op5']);
$results36 = $trans232->translate($source344, $targe444t, $questios['qu_desc']);
$results36=str_replace(array("\r\n", "\r", "\n"), " ", $results36);
$results3623=str_replace(array("\r\n", "\r", "\n"), " ", $questios['qu_desc']);
?>

<script>
	function change_lang(){
		var langs = $('#language34_0s').val();
		if(langs =='1'){
		$('#theappensder_qes').html("<?=$results3?>");
		$('#opet_09_1').html("<?=$results31?>");
		$('#opet_09_2').html("<?=$results32?>");
		$('#opet_09_3').html("<?=$results33?>");
		$('#opet_09_4').html("<?=$results34?>");
		$('#opet_09_5').html("<?=$results35?>");
		// $('#opet_09_6').html("<?=$results36?>");
		}else{
		$('#theappensder_qes').html("<?=$tex4444t?>");
		$('#opet_09_1').html("<?=$questios['qu_op1']?>");
		$('#opet_09_2').html("<?=$questios['qu_op2']?>");
		$('#opet_09_3').html("<?=$questios['qu_op3']?>");
		$('#opet_09_4').html("<?=$questios['qu_op4']?>");
		$('#opet_09_5').html("<?=$questios['qu_op5']?>");
		// $('#opet_09_6').html("<?=$results3623?>");
		}
	}
</script> -->

<script>
	function change_lang(){
		var langs = $('#language34_0s').val();
		if(langs =='1'){
		// $('#theappensder_qes').html("<?=$results3?>");
		$('.all_q_e_e').hide();
		$('.all_q_e_h').show();

		// $('#opet_09_1').html("<?=$results31?>");
		// $('#opet_09_2').html("<?=$results32?>");
		// $('#opet_09_3').html("<?=$results33?>");
		// $('#opet_09_4').html("<?=$results34?>");
		// $('#opet_09_5').html("<?=$results35?>");
		}else{
		// $('#theappensder_qes').html("<?=$tex4444t?>");
		// $('#opet_09_1').html("<?=$questios['qu_op1']?>");
		// $('#opet_09_2').html("<?=$questios['qu_op2']?>");
		// $('#opet_09_3').html("<?=$questios['qu_op3']?>");
		// $('#opet_09_4').html("<?=$questios['qu_op4']?>");
		// $('#opet_09_5').html("<?=$questios['qu_op5']?>");

		$('.all_q_e_h').hide();
		$('.all_q_e_e').show();
		}
	}
</script>