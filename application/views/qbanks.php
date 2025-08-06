<?php //include('inc/banner.php');?>
<section class="teacher__area py-2 ">
   <div class="container">
      <div class="row justify-content-center">
      	<?php $totalQues=0; $q=1;
         foreach($show_courses as $qbank){//$totalQues+=$qbank['qbquestions'];
            //print_r($qbank);
            $qbid=$qbank['qb_id'];
         ?>
            <div class="row justify-content-center">
               -----   <span class="circle-singleline"><?=$q++?></span>   ------
            </div>
            <div class="row m-2">
               <div class="col-sm-9 text-right"></div>
               <div class="col-12 col-sm-3 text-right">
                  <b>Uploaded on: </b><?=date_format_1(@$qbank['qbdate'],'1')?>
               </div>
            </div>
            <div class="row border justify-content-center my-3 shadow_1" style="margin: 0px; padding: 0px;">

               <div class="col-12 m-2">
                  <div class="text-center bg-light p-2">
                     <h6 style="font-size: 24px;"><?=@$qbank['qbtitle']?> </h6>
                  </div>
               </div>
               <div class="col-4 text-center">
                  <h6><i class="fas fa-octagon-check"></i><i class="fas fa-circle"></i> Marks</h6><span style="color: red"><?=@number_format($qbank['qbtotal'],0)?></span>
               </div>
               <div class="col-4 text-center">
                  <h6><i class="fas fa-question-circle"></i> MCQ</h6><span style="color: red"><?php if($qbank['qb_id']>'0'){echo $totalQues=get_totalQues($qbank['qb_id']);}else{echo '0';}//echo @$qbank['qbquestions']?></span>
               </div>
               <div class="col-4 text-center">
                  <h6><i class="fas fa-clock"></i> Time</h6><span style="color: red"><?=@$qbank['qbtime']?> mins</span>
               </div>
               <div class="col-10 text-center mt-2">
                  <?php if($qbank['qbu_exam_id']==''){?>
                     <a class="e-btn mb-2 text-capitalize px-4" style="background-color: #EDEEF3; color: #000;width:200px;" href="<?=base_url('qbank/')?><?=$qbank['qb_id']?>/<?=url_smart($qbank['qbtitle'])?>"><b>Start Test</b></a>
                  <?php }
                  if($qbank['qbu_exam_id']!=''){?>
                     <a href="<?=base_url('qbtest_review?exam_id=')?><?=@$qbank['qbu_exam_id']?>" class="e-btn col-3 text-right mb-2">Review Your Test</a>
                  <?php }?>
               </div>
            </div>
         <?php }?>
      </div>
   </div>
</section>