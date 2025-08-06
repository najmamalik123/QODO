<style type="text/css">
   #footer{ display: none !important; }
   #header{ display: none !important; }
</style>
<main>
<section class="page__title-area pb-90" style="padding: 30px;">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="course__wrapper">
               <div class="page__title-content mb-25 text-center">
                  <h5 class="page__title-3"><?=$thisQbank['qbtitle']?></h5>
               </div>
               
            </div>
            <div class="row border m-3 p-3">
               <h6 class="text-center"> Thank you, You have finished your Test</h6> 
               <div class="col-sm-3 col-6">
                  <h4>Total Marks</h4>
                  <?=$thisQbank['qbtotal']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Total Questions</h4>
                  <?php echo get_totalQues($thisQbank['qb_id']);//echo $thisQbank['qbquestions'];?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Your Score</h4>
                  <?=$score['0']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4>Your Rank</h4>
                  <?php echo calculate_rank($exam_id, $qbid);?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4><a href="<?=base_url('qbtest_end?exam_id=').$exam_id?>&check=aq">Total Questions Answered</a></h4>
                  <?=$score['1']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4><a href="<?=base_url('qbtest_end?exam_id=').$exam_id?>&check=cq">Total Questions Correct</a></h4>
                  <?=$score['4']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4><a href="<?=base_url('qbtest_end?exam_id=').$exam_id?>&check=wq">Total Questions Wrong</a></h4>
                  <?=$score['5']?>
               </div>
               <div class="col-sm-3 col-6">
                  <h4><a href="<?=base_url('qbtest_end?exam_id=').$exam_id?>&check=uq">Total Questions Unattempted</a></h4>
                  <?=$score['6']?>
               </div>
            </div>
            <div class="text-center"><a href="<?=base_url('series_enrollments')?>" class="e-btn e-btn-7">Back to Profile</a></div>
         </div>
      </div>
   </div>

   <?php
   if(isset($_GET['check']) && $_GET['check']!='')
   {
      $chk_condition='';
      $check=$_GET['check'];
      $heading='<h2 class="m-3">';

      switch($_GET['check']){
         case 'wq':
            $chk_condition=" and qanswer!=qbt_answer and qbt_status='1'";
            $heading.='Wrong Questions';
            break;
         case 'cq':
            $chk_condition=" and qanswer=qbt_answer and qbt_status='1'";
            $heading.='Correct Questions';
            break;
         case 'aq':
            $chk_condition=" and qbt_status='1'";
            $heading.='Answered Questions';
            break;
         case 'uq':
            $chk_condition=" and (qbt_status!='0' && qbt_status!='1')";
            $heading.='Unattempted Questions';
            break;
      }
      $heading.='</h2>';

   if($_GET['check']!='uq')
   {
      $qry="SELECT * FROM `x_edu_qbank_question`, `x_edu_questions` LEFT JOIN `x_edu_qbank_test` ON qid=qbt_qid where qbt_exam_id='$exam_id' $chk_condition group by qbt_id order by qbt_id ASC";
   }else{
      $qry="SELECT * FROM `x_edu_questions`, `x_edu_qbank_question` where qbq_ques_id=qid and qbq_qbank_id='$qbid' and qid NOT IN (SELECT qbt_qid FROM x_edu_qbank_test WHERE qbt_exam_id='$exam_id' and qbt_status='1') group by qbq_ques_id order by qbq_ques_id ASC";
   }
   $getheQbankQues=$this->db->query($qry);
   $total_num=$getheQbankQues->num_rows();

   $rec_per_page='10';
   
   $config['base_url'] = base_url('qbtest_end?exam_id=').$exam_id.'&check='.$check;
   $config['total_rows'] = $total_num;
   $config['per_page'] = $rec_per_page;
   $config['num_links'] = 10;
   $config['use_page_numbers'] = TRUE;
   $config['full_tag_open'] = "<span class='page_num p-2'>";
   $config['full_tag_close'] = '</span>';
   $config['reuse_query_string'] = true;
   $config['page_query_string'] = TRUE;
   $config['query_string_segment'] = 'page';
   $this->pagination->initialize($config);

   @$pg=@$page=$_GET['page'];
   if(isset($_GET['page'])){
      $page=$page-1;
   }
   
   $limit1=$page*$rec_per_page;

   $getheQbankQues=$this->db->query($qry." limit $limit1, $rec_per_page");

   $theQbankQuestions=$getheQbankQues->result_array();
   if($getheQbankQues->num_rows()>'0'){
      echo $heading;
      $q=1;
   ?>
   <div class="col-xxl-11 col-xl-11 col-lg-11 m-3">
   <?php
      foreach($theQbankQuestions as $theQbankQues){
         $answer=@$theQbankQues['qbt_answer'];
         $canswer=@$theQbankQues['qanswer'];
   ?>
         
            <div class="row border m-2 p-3" style="font-size: 17px;color: black;">
               <?php 
               echo '<b>'.($q++).'. '.strip_tags($theQbankQues['qtitle']).'</b>';
               ?> 
               <div class="col-sm-9 col-12 mt-3">
               <?php if(!check_bookmark(@$theQbankQues['qid'])){?>
                  <a href="<?=base_url('action/add_qbank_bookmark?qbid=')?><?=@$qbid?>&ques=<?=@$theQbankQues['qid']?>&exam_id=<?=$exam_id?>&check=<?=@$check?>&page=<?=@$pg?>" class="btn btn-warning col-3"><i class="fas fa-bookmark"></i> Add Bookmark</a>
               <?php }else{echo '<span class="btn btn-warning col-3">Bookmarked</span>';}?>
               <?php if(!check_report(@$theQbankQues['qid'])){?>
               <a href="<?=base_url('action/report_qbank?qbid=')?><?=@$qbid?>&ques=<?=@$theQbankQues['qid']?>&exam_id=<?=$exam_id?>&check=<?=@$check?>&page=<?=@$pg?>" class="btn btn-success col-3"><i class="fas fa-check"></i> Report MCQ</a>
               <?php }else{echo '<span class="btn btn-success col-3">Reported</span>';}?>
               </div> 
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
               <div class="col-sm-6 col-12 p-3 the_tag_90ss"> <span class="<?=$opt_class?>"><?=$i?>. <?=$theQbankQues['qoption'.$i];?></span></div>
               <?php }?>
            </div>

            <div class="row border m-2 p-3"><?=$theQbankQues['qdesc']?></div>      
         
   <?php }?>
      <?php echo $this->pagination->create_links(); ?></div>
   <?php }
} ?>
   </section>
</main>