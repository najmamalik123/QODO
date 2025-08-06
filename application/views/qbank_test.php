<style type="text/css">
   #footer{ display: none !important; }
   .the_mobile_fooeter{ display: none !important; }
   #header{ display: none; }
</style>

   <div class="container-fluid p-sm-5">
      <div class="row">
         <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="page__title-content px-2 mb-5">
               <h5 style="font-size: 20px;"><?=$thisQbank['qbtitle']?></h5>
            </div>
            <!-- <div class="row my-3 px-2 text-center">
               <div class="col-sm-12 my-3 col-12">
                  <h1>Roll No.: <?=$profile_data['roll_num']?></h1>
               </div>
            </div> -->
            <div class="row border m-2 p-2 bg-light" style="font-size: 15px;">
               <div class="col-sm-3 col-6">
                  <h6>Total Marks</h6>
                  <?=$thisQbank['qbtotal']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h6>Total Questions</h6>
                  <?=$thisQbank['qbquestions']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h6>Total Time</h6>
                  <?=$thisQbank['qbtime']?> mins
               </div>
               <div class="col-sm-3 col-6 bg-white pt-3">
                  <h4 class="text-black">
                  <?php 
                  $duration=$thisQbank['qbtime']*60;
                  $end_timer=$qbankUser['qbu_end_time'];
                  $start_timer=$qbankUser['qbu_start_time'];
                  $exam_id=$qbankUser['qbu_exam_id'];
                  $qbu_id=$qbankUser['qbu_id'];
                  qbank_timer($start_timer, $end_timer, $exam_id);?>
                  <p id="demo" style="font-size: 30px;text-align: left; color: #000 !important;"></p>
                  </h4>
               </div>
            </div>
         </div>
         <?php 
               if(!isset($_GET['q'])){
                  $q=0;
               }else{
                  $q=$_GET['q'];
               }

               if(!isset($_GET['qid'])){
                  $qid=@$theQbankQues[$q]['qbq_ques_id'];
               }else{
                  $qid=$_GET['qid'];
               }

               $getheQbankTestQues=$this->db->query("select * from x_edu_qbank_test, x_edu_qbank_question, x_edu_questions where qid=qbt_qid and qbq_ques_id=qbt_qid and qbt_exam_id='$exam_id' group by qbt_id order by qbq_id desc");
               $theQbankTestQues=$getheQbankTestQues->result_array();
               //echo count($theQbankTestQues);
               //print_r($theQbankTestQues);
               $key=array_search($qid, array_column(@$theQbankTestQues, 'qbt_qid'));
               //echo 'key: '.$key;
               $answer=@$theQbankTestQues[$key]['qbt_answer'];

               if(empty($theQbankQues[$q])){ //IF Question is not UPLOADED
                  echo '<div class="row border m-2 p-2 bg-light"><div class="col-xxl-9 col-xl-9 col-lg-9">You Finished your Test, Do you want to Review
                  </div></div><div class="col-3 mt-4"><a href="'.base_url('qbtest?qbid='.$qbid.'&q=0').'" class="btn btn-danger btn-block col-12 text-right">Review Your Test</a></div><div class="col-3 mt-4">
                        <a href="'.base_url('qbtest_end?exam_id='.$exam_id).'" class="btn btn-danger btn-block col-12">END Exam</a>
                  </div>';
               }else{
            ?>
         <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="row border m-2 p-3" style="font-size: 15px;color: black;" id="b">
               <div class="col-sm-9 col-12">
               <?php
               echo '<b>'.($q+1).'. '.strip_tags(@$theQbankQues[$q]['qtitle']).'</b> &nbsp;&nbsp;';
               $totalQues=get_totalQues($thisQbank['qb_id']);
               if($theQbankQues[$q]['qimg_url']!=''){
               ?> 
               <br><img src="<?=$theQbankQues[$q]['qimg_url']?>" class="img-fluid" align="center">
               <?php }?>
               </div>
               <div class="col-sm-3 col-12">Marks: <?=$theQbankQues[$q]['qbmarks']?> Mrk/s<br>
                  Negative Marks: <?=$theQbankQues[$q]['qbnmarks']?> Mrk/s
               </div>
               <!-- <div class="col-sm-9 col-12">
               <?php if(!check_bookmark(@$theQbankQues[$q]['qid'])){?>
                  <a href="<?=base_url('action/add_qbank_bookmark?qbid=')?><?=@$qbid?>&ques=<?=@$theQbankQues[$q]['qid']?>&q=<?=$q?>" class="btn btn-warning col-3"><i class="fas fa-bookmark"></i> Add Bookmark</a>
               <?php }?>
               <?php if(!check_report(@$theQbankQues[$q]['qid'])){?>
               <a href="<?=base_url('action/report_qbank?qbid=')?><?=@$qbid?>&ques=<?=@$theQbankQues[$q]['qid']?>&q=<?=$q?>" class="btn btn-success col-3"><i class="fas fa-check"></i> Report MCQ</a>
               <?php }?>
               </div> -->
               <div class="col-sm-3 col-12">
               </div>
               <?php 
               $correct_option_str='';
               if($key !== false && $theQbankTestQues[$key]['qbt_status']=='1' && @$_SESSION['series_cat']=='9'){//Category 9 - Samhithawise
               ?>
               <div class="col-sm-12 col-12" style="font-size: 15px;color: black;">
               <?php if($theQbankTestQues[$key]['qbt_answer']==$theQbankTestQues[$key]['qanswer']) {
                $correct_option_str= '<b style="color: #157347;">Your Answer is Correct</b>';
               }else{
                  $correct_option='qoption'.$theQbankTestQues[$key]['qanswer'];
                  $correct_option_str= '<b style="color: #ff0000;">Correct Option: </b>'.$theQbankTestQues[$key]['qanswer'].' - '.$theQbankTestQues[$key][$correct_option];
               }echo $correct_option_str;?>
               </div>
               <?php }?>
            </div>
            
            <form name="qbtest_form" action="<?=base_url('action/qbtest')?>" method="post" onsubmit="return choose_option();">
               <input type="hidden" name="q" value="<?=$q?>">
               <input type="hidden" name="qid" value="<?=$qid?>">
               <input type="hidden" name="qbid" value="<?=$qbid?>">
               <input type="hidden" name="num" value="<?=$totalQues?>">
               <div class="row border m-2 p-3" style="font-size: 12px;" id="op">
                  <?php for($i=1; $i<5; $i++) {?>
                  <div class="col-sm-6 col-12 p-3 opthe_tag_90ss"><input type="radio" name="option" id="option" class="mr-3" value="<?=$i?>" <?php if($answer==$i && $key!==false) { echo 'checked';}?>> <?=$i?>. <?=@$theQbankQues[$q]['qoption'.$i];?></div>
                  <?php }?>
               </div>
               
               <div class="row m-2 p-3">
                  <?php 
                  if($q>'0'){
                     $prev_qid=@$theQbankQues[$q-1]['qbq_ques_id'];
                  ?>
                  <div class="col-6 col-sm-2 mb-2">
                     <a href="<?=base_url('qbtest?qbid=')?><?=$qbid?>&qid=<?=$prev_qid?>&q=<?=($q-1)?>" class="btn btn-secondary btn-block col-12"><i class="fas fa-arrow-left"></i> Previous</a>
                  </div>
                  <?php }
                  $nextq=$q+1;
                  if($nextq > $totalQues){
                     $nextq='last';
                  }
                  ?>
                  <?php 
               if($correct_option_str==''){
               ?>
                  <div class="col-6 col-sm-2">
                        <a href="<?=base_url('action/qbtest_status?qbid=')?><?=$qbid?>&q=<?=($nextq)?>&qid=<?=$qid?>&what=skip" class="btn btn-success btn-block col-12">Next <i class="fas fa-arrow-right"></i></a>
                  </div>
                  <div class="col-6 col-sm-2">
                        <a href="<?=base_url('action/qbtest_status?qbid=')?><?=$qbid?>&q=<?=($nextq)?>&qid=<?=$qid?>&what=review" class="btn btn-warning btn-block col-12"><i class="fas fa-bookmark"></i> Tag</a>
                  </div>
                  <div class="col-6 col-sm-2 mb-2">
                        <!-- <a onclick="clear_option()" class="btn btn-danger btn-block col-12"><i class="fas fa-eraser"></i> Erase</a> -->
                        <a href="<?=base_url('action/qbtest_status?qbid=')?><?=$qbid?>&q=<?=($q)?>&qid=<?=$qid?>&what=erase" class="btn btn-danger btn-block col-12">Erase</a>
                  </div>
                  <div class="col-6 col-sm-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block col-12">Submit</button>
                  </div>
                  <div class="col-6 col-sm-1 mb-2">
                        <button type="button" class="btn btn-secondary btn-block col-6" onclick="increaseFontSizeBy1px()">+</button>
                  </div>
                  <div class="col-6 col-sm-1 mb-2">Font</div>
                  <div class="col-6 col-sm-1 mb-2">
                        <button type="button" class="btn btn-secondary btn-block col-6" onclick="decreaseFontSizeBy1px()">-</button>
                  </div>
                  <?php }?>
               </div>
            </form>            
         </div>

         <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="course__sidebar pl-70 p-relative ">
               <div class="course__sidebar-widget-2 mb-20">
                  <div class="row">
                     <!-- <div class="col-5"><img src="<?=base_url('assets/mem/')?><?=$_SESSION['yid']?>/img/<?=$_SESSION['photo']?>" class="img-fluid"></div>
                     <div class="col-2"></div> -->
                     <div class="col-5">
                        <div class="my-3"><h6>Roll Number: </h6><?=@$_SESSION['roll_num']?></div>
                        <div class="my-3"><h6>Candidate Name: </h6><?=@$_SESSION['name']?></div>
                     </div>
                  </div>
                  <div class="course__video scrollClass row p-sm-3">
                     <h3>All Questions.</h3>
                  <?php 
                  
                  //print_r($theQbankTestQues);
                  //for($i=0; $i<$thisQbank['qbquestions']; $i++){ 
                  for($i=0; $i<$totalQues; $i++){ 
                     $qid=@$theQbankQues[$i]['qbq_ques_id'];
                     if($qid > '0'){
                        $key=array_search($qid, @array_column($theQbankTestQues, 'qbt_qid'));

                        if($key !== false){
                           if($theQbankTestQues[$key]['qbt_status']=='2'){
                              $qclass='q_number_skip';
                           }elseif($theQbankTestQues[$key]['qbt_status']=='3'){
                              $qclass='q_number_review';
                           }else{
                              $qclass='q_number_answer';
                           }
                        }else{
                           $qclass='q_number_34 bg-white';
                        }?>
                        <div class="col p-2">
                           <div class="<?=$qclass?> p-0 text-black" style='border:1px solid #000;'>
                              <a href="<?=base_url('qbtest?qbid=')?><?=$qbid?>&qid=<?=$qid?>&q=<?=$i?>" style='color:#000 !important;' >
                                 <?=$i+1?>
                              </a>   
                           </div>
                        </div>
                     <?php }?>
                   <?php }?>             
                  </div>
                  <div class="col-12 mt-4">
                     <a href="<?=base_url('qbtest_end?exam_id='.$exam_id)?>" class="btn btn-danger btn-block col-12">END Exam</a>
                  </div>
               </div>
            </div>
         </div>
         <?php }?>
      </div>
   </div>
<script type="text/javascript">
   function choose_option(){
      var option=document.getElementsByName('option');
     
      if (!(option[0].checked || option[1].checked || option[2].checked || option[3].checked)) {
         swal('Please choose an Option to proceed further');
         return false;
      }else{
         return true;
      }
   }
              
   function clear_option() {
      var option=document.getElementsByName('option');
      option[0].checked = option[1].checked = option[2].checked = option[3].checked = false;
   }

   function increaseFontSizeBy1px() {
       txt = document.getElementById('b');
       optxt = document.getElementById('op');
       style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
       currentSize = parseFloat(style);
       txt.style.fontSize = (currentSize + 1) + 'px';
       style = window.getComputedStyle(optxt, null).getPropertyValue('font-size');
       currentSize = parseFloat(style);
       optxt.style.fontSize = (currentSize + 1) + 'px';
   }

   function decreaseFontSizeBy1px() {
       txt = document.getElementById('b');
       optxt = document.getElementById('op');
       style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
       currentSize = parseFloat(style);
       txt.style.fontSize = (currentSize - 1) + 'px';
       style = window.getComputedStyle(optxt, null).getPropertyValue('font-size');
       currentSize = parseFloat(style);
       optxt.style.fontSize = (currentSize - 1) + 'px';
   }
</script>