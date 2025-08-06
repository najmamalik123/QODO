<style type="text/css">
   #footer{ display: none !important; }
   #header{ display: none; }
</style>

<div class="container-fluid p-sm-5">
   <div class="row justify-content-center">
      <div class="col-12 col-sm-8 shadow_1 bg-light p-3">
            <center>
            <img src="<?=base_url('assets/avator/')?>favicon.png" alt="logo" style='height: 100px;'  >   
            </center>
         <div class="course__wrapper">
            <div class="page__title-content mb-25">
               <!-- <span class="page__title-pre"><?=$thisQbank['course_category']?></span> -->
               <h5 class="page__title-3" style="font-size:30px;"><?=$thisQbank['qbtitle']?></h5>
            </div>
            <div class="page__title-content mb-25">
               <h3>Instructions: </h3>
               <p><?=@$thisQbank['qbdesc']?></p>
            </div>
            <!-- <div class="course__img w-img mb-30">
               <img src="<?=base_url('assets/avator/upload/courses/')?><?=$thisQbank['course_img']?>" alt="">
            </div> -->
         </div>
         <!-- <div class="row border m-3 p-3 bg-white">
            <div class="col-sm-4 col-4">
               <h4>Total Marks</h4>
               <?=$thisQbank['qbtotal']?>
            </div>
            <div class="col-sm-4 col-4">
               <h4>Total Questions</h4>
               <?php echo get_totalQues($thisQbank['qb_id']);//echo $thisQbank['qbquestions']?>
            </div>
            <div class="col-sm-4 col-4">
               <h4>Total Time Duration</h4>
               <?=$thisQbank['qbtime']?> mins
            </div>
         </div> -->
         <div class="course__wrapper">
            <div class="page__title-content mb-25" style="padding-left: 15px;">
               <input type="checkbox" name="terms" id="terms" value="1"> Please go through the <a href="<?=base_url('terms')?>" target="_blank">"Terms & Conditions"</a>
            </div>
         </div>
         <div class="text-center m-3 p-3"><a href="<?=base_url('qbank_cat')?>" style="float: left; background-color: #E9EBEC; color: #000;" class="e-btn e-btn-7">Cancel Test</a>

            <a href="<?=base_url('action/qbtest_user?qbid=')?><?=$thisQbank['qb_id']?>" class="e-btn e-btn-7 pull-right" onclick="return check_terms()">Start Test</a>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function check_terms(){
      if(document.getElementById('terms').checked){
         //return confirm('Are you sure you want to Start the Test?');
      }else{
         swal('Please go through the Terms and conditions');
         return false;
      }
   }
</script>