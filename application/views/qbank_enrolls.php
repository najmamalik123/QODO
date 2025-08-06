<section id="contact" class="contact-area pt-145 pb-245 pb-4" style="background-image:url(<?=base_url('assets/theme/img/')?>shape/12.png)">
    <div class="container pt-sm-4 ">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <?php include_once('inc/profile_card.php'); ?>
            </div>
            <div class="col-md-8 col-sm-12">
                <?php include_once('inc/profile_enrollments.php'); ?>
                <div class="container p-0">
                 <div class="row p-0">
                    <div class="col-12">
                        <h3>QBank Enrollments</h3><br/>
                        <?php     
                        if(count(@$enrollments)){?>
                        <div class="col-12 m-0 p-0">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>QBank Name</th>        
                                <th>Date & Time</th>    
                                <th>Score</th>        
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach($enrollments as $enrollment){?>
                              <tr>
                                <td><?=$enrollment['qbu_exam_id']?><br><a href="<?=base_url('qbtest_review?exam_id=')?><?=$enrollment['qbu_exam_id']?>" style="color: green;"><b>Review</b></a></td>
                                <td><?=$enrollment['qbtitle']?></td>
                                <td><small><?=date_format_1($enrollment['qbu_start_time'],'t')?></small></td>
                                <td><?=$enrollment['qbu_score']?></td>
                              </tr>            
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        <?php }else{
                          echo "You haven't taken any EXAM.<br><a href='".base_url('qbank_cat')."' style='color: blue;'>Choose and Enroll for TEST</a>";
                        } ?>
                    </div>
                  </div>
                  <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</section>