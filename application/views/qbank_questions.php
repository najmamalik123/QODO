<?php include('inc/banner.php');?>
<section class="teacher__area pt-35 pb-10">
   <div class="container">
      <div class="row">
         <div class="col-xxl-11 offset-xxl-1">
            <div class="section__title-wrapper text-center mb-60">
               <p><img src="<?=base_url('assets/avator/')?>logo.png" alt="logo" style='height: 90px;'  ></p>
               <?php $c=$cat-1;
               $theCat=$_SESSION['categories'][$c];?>
               <h2><?=@$theCat['name']?></h2>
               <p><?=@$theCat['desc']?></p>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="ques__area pb-120">
   <div class="container">
     <div class="row">
      <?php //include_once('inc/qbank_cat_sidebar.php');?>
      <div class="col-xxl-12 col-xl-12 col-lg-12">
         <div class="ques__tab-conent">
            <div class="tab-content" id="quesTabContent">
              <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <div class="row justify-content-center">
                  <?php 
                  if(count($show_ques)>'0'){
                  $q=1;
                  foreach($show_ques as $ques){
                     ?>
                     <div class="row border m-0 p-0 mb-3" >
                        <div class="col-sm-12 col-12">
                           <?php
                           echo '<b>'.($q++).'. '.strip_tags(@$ques['qtitle']).'</b> &nbsp;&nbsp;';
                           ?>  
                        </div>

                        <?php 
                        $canswer=@$ques['qanswer'];
                        for($i=1; $i<5; $i++) {
                              if($i==$canswer){
                                 $opt_class='text-success mark';
                              }else{
                                 $opt_class='';
                              }
                        ?>
                        <div class="col-sm-5 col-12 p-2 mx-3"> <span class="<?=$opt_class?>"><?=$i?>. <?=$ques['qoption'.$i];?></span></div>
                        <?php }?>
                     </div>
                     
                  <?php }}else{echo 'No Questions available';}?>
                </div>
              </div>
            </div>
         </div><?php echo $this->pagination->create_links(); ?>
       </div>
     </div>
   </div>
</section>