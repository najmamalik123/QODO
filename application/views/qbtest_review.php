<style type="text/css">
   #footer{ display: none !important; }
   .the_mobile_fooeter{ display: none !important; }
   #header{ display: none; }
</style>

   <div class="container-fluid p-sm-5">
      <div class="row">
         <div class="col-xxl-12 col-xl-12 col-lg-12">
            <h1 class="text-center">TEST REVIEW</h1>
            <div class="page__title-content px-2">
               <h5 style="font-size: 20px;"><?=@$theQbankTestQues['0']['qbtitle']?></h5>
            </div>
            <div class="row my-3 px-2 justify-content-center">
               <div class="col-sm-12 my-3 col-12" style="float: right;">
                  <b>Roll No.: </b><?=@$_SESSION['roll_num']?>
               </div>
            </div>
            <div class="row border m-2 p-2 bg-light">
               <div class="col-sm-3 col-6">
                  <h4>Total Marks</h4>
                  <?php if(isset($theQbankTestQues['0']['qbtotal'])){echo $theQbankTestQues['0']['qbtotal'];}else{echo '0';}?> Marks
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Total Questions</h4>
                  <?php echo $totalQues=get_totalQues($qbid);//echo $totalQues=@$theQbankTestQues['0']['qbquestions'];?>
               </div>
               <div class="col-sm-2 col-6">
                  <h4>Total Time</h4>
                  <?php if(isset($theQbankTestQues['0']['qbtime'])){echo $theQbankTestQues['0']['qbtime'];}else{echo '0';} ?> mins
               </div>
               <div class="col-sm-2 col-6">
                  <h4>Your Score</h4>
                  <?=@$qbankUser['qbu_score']?> Marks
               </div>
               <div class="col-sm-2 col-6">
                  <h4>Test Date</h4>
                  <?=date_format_1($qbankUser['qbu_start_time'], '1')?>
               </div>
            
               <div class="col-sm-3 col-6">
                  <h4>Total Questions Answered</h4>
                  <?=@$qbankUser['qbu_ques_answer']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Total Questions Correct</h4>
                  <?=@$qbankUser['qbu_ques_correct']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Total Questions Wrong</h4>
                  <?=@$qbankUser['qbu_ques_wrong']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Total Questions Unattempted</h4>
                  <?=@$qbankUser['qbu_ques_unattempted']?>
               </div>
            </div>
         </div>
         <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="row border m-2 p-3" style="font-size: 30px;color: black;">
               <?php 
               if(!isset($_GET['q'])){
                  $q=0;
               }else{
                  $q=$_GET['q'];
               }

               if(empty($theQbankQues[$q])){ //IF Question is not UPLOADED
                  $q=0;
               }

               if(!isset($_GET['qid'])){
                  $qid=$theQbankQues[$q]['qbq_ques_id'];
               }else{
                  $qid=$_GET['qid'];
               }
               
               $getheQbankTestQues=$this->db->query("select * from x_edu_qbank_test,x_edu_qbank_question where qbq_ques_id=qbt_qid and qbt_exam_id='$exam_id' group by qbt_id order by qbq_id desc");
               $theQbankTestQues=$getheQbankTestQues->result_array();
               $key=array_search($qid, array_column(@$theQbankTestQues, 'qbt_qid'));
               if($key !== false){
                  $answer=@$theQbankTestQues[$key]['qbt_answer'];
               }else{
                  $answer=0;
               }
               $canswer=@$theQbankQues[$key]['qanswer'];

               echo '<b>'.($q+1).'. '.strip_tags($theQbankQues[$q]['qtitle']).'</b>';
               ?>  
            </div>
            
            <div class="row border m-2 p-3">
               <?php 
               for($i=1; $i<5; $i++) {
                     if($i==$canswer){
                        $opt_class='text-success mark';
                     }elseif($answer!=$canswer && $i==$answer){
                        $opt_class='text-danger';
                     }else{
                        $opt_class='';
                     }
                  
               ?>
               <div class="col-sm-6 col-12 p-3 the_tag_90ss"> <span class="<?=$opt_class?>"><?=$i?>. <?=$theQbankQues[$q]['qoption'.$i];?></span></div>
               <?php }?>
               
               <div class="col-sm-6 col-12 p-3"><b>Status: 
                  <?php 
                  if(isset($theQbankTestQues[$key]['qbt_status']) && $key !== false){ 
                     echo read_me_user('qstatus',@$theQbankTestQues[$key]['qbt_status']);
                  }else{
                     echo 'Not Attempted';
                  } ?>
                  </b></div>
            </div>

            <div class="row border m-2 p-3"><?=$theQbankQues[$q]['qdesc']?></div>
            
            <div class="row m-2 p-3">
               <?php 
               if($q>'0'){
                  $prev_qid=$theQbankQues[$q-1]['qbq_ques_id'];
               ?>
               <div class="col-6 col-sm-3 mb-2">
                  <a href="<?=base_url('qbtest_review?exam_id=')?><?=$exam_id?>&q=<?=($q-1)?>" class="btn btn-secondary btn-block col-12">Previous</a>
               </div>
               <?php }?>
               
               <div class="col-6 col-sm-3">
                     <a href="<?=base_url('qbtest_review?exam_id=')?><?=$exam_id?>&q=<?=($q+1)?>" class="btn btn-success btn-block col-12">NEXT</a>
               </div>
               
            </div>
         </div>

         <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="course__sidebar pl-70 p-relative ">
               <div class="course__sidebar-widget-2 mb-20">
                  <div class="course__video scrollClass row p-sm-3">
                     <h3>All Questions.</h3>
                  <?php 
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
                           $qclass='q_number_34';
                        }?>
                        <div class="col p-2">
                           <div class="<?=$qclass?> p-2 theme_bg">
                              <a href="<?=base_url('qbtest_review?exam_id=')?><?=$exam_id?>&q=<?=$i?>">
                                 <?=$i+1?>
                              </a>   
                           </div>
                        </div>
                     <?php }?>
                   <?php }?>             
                  </div>
                  <div class="col-12 mt-4">
                     <a href="<?=base_url('series_enrollments')?>" class="btn btn-danger btn-block col-12">Back to Profile</a>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
