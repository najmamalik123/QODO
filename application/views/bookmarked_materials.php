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
                        <h3>Bookmarked Materials</h3><br/>
                        <?php     
                        if(count(@$bookmarks)){?>
                        <div class="col-12 m-0 p-0">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Material Name</th>        
                                <th>Enrollment Date </th>    
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach($bookmarks as $bookmark){?>
                              <tr>
                                <td><a href="<?=base_url('viewMaterial?enrol=')?><?=$bookmark['co_id']?>&smid=<?=$bookmark['sm_id']?>"><b><?=$bookmark['co_order_id']?></b></a></td>
                                <td><?=$bookmark['sm_name']?></td>
                                <td><small><?=date_format_1($bookmark['co_start_date'],'1')?></small></td>
                              </tr>            
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        <?php }else{
                          echo "You haven't taken any EXAM.<br><a href='".base_url('qbank_cat')."' style='color: blue;'>Choose and Enroll for Exam</a>";
                        } ?>
                    </div>
                  </div>
                  <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</section>