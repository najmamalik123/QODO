<style type="text/css">
  .container {
    width: 99% !important;
  }

  .container {
    max-width: 1900px !important;
  }
</style>

<section id="contact" class="contact-area pt-145 pb-245" style="background-image:url(<?= base_url('assets/theme/img/') ?>shape/12.png)">
  <div class="container pt-sm-4 ">
    <div class="row">
      <div class="col-12 col-sm-9">
        <?php
        $yid = $_SESSION['yid'];

        $today = date('Y-m-d');
        $theEnrolls = $this->db->query("select * from x_edu_enrollments,x_edu_courses where co_course_id=course_id and co_user_id='$yid' and co_id='$enrol' and ('$today' BETWEEN co_start_date AND co_end_date) GROUP by co_id");
        $enrollment = $theEnrolls->row_array();

        if (!empty($enrollment)) {
          $course_id = $enrollment['co_course_id'];
          $course_name = $enrollment['course_name'];
        ?>
          <div class="container p-0">
            <div class="row p-0">
              <div class="col-12">
                <div class="table-responsive">
                  <?php if ($enrollment['co_status'] == '1') { ?>
                    <div class="table-responsive">
                      <table class="table table-borderless">
                        <tbody>
                          <?php
                          $Order_listPro = $this->db->query("SELECT * from  x_edu_study_material where sm_course_id='$course_id' and sm_id='$smid'");
                          if ($Order_listPro->num_rows() > 0) {
                            $productList = $Order_listPro->row_array();
                          ?>

                            <?php if ($productList['sm_link'] != '') { ?>
                              <h4><?= $productList['sm_name'] ?></h4>
                              <div style="padding:55.4% 0 0 0;position:relative;border: 7px solid #104a8e;"><iframe src="https://player.vimeo.com/video/<?= $productList['sm_link'] ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;autoplay=0&amp;loop=1&amp;muted=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="<?= $productList['sm_name'] ?>"></iframe></div>
                            <?php } ?>
                            <div class="col-12 p-3">
                              <a class="e-btn mb-2 text-capitalize text-white" data-toggle="collapse" href="#pdfPoints" role="button" aria-expanded="false" aria-controls="pdfPoints"> <i class="fas fa-book"></i> Quick Revision Points</a>
                              <?php if ($productList['sm_qbank_id'] > '0') { ?>
                                <a class="e-btn mb-2 bg-danger text-capitalize" href="<?= base_url('qbank/') ?><?= $productList['sm_qbank_id'] ?>/solve_test" target="_blank"> <i class="fa fa-pen"></i> Solve Test</a>
                              <?php } ?>
                              <a class="edu-btn btn-medium btn-gradient" href="<?= base_url('action/add_bookmark?smid=') ?><?= @$smid ?>&enrol=<?= @$enrol ?>"> <i class="fa fa-bookmark"></i> Add Bookmark</a>
                              <a onclick="$('body').scrollTo('#doubts');" class="edu-btn btn-medium btn-gradient2" style="float: right;" href="#doubts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="doubts"> <i class="fa fa-pen"></i> Ask Doubts</a>
                            </div>
                            <?php if ($productList['sm_desc'] != '') { ?>
                              <div class="col-12 p-3">
                                <?= $productList['sm_desc'] ?>
                              </div>
                            <?php } ?>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>

          <div id="doubts" class="collapse p-3">
            <?php include('material_review.php'); ?>
          </div>
          <?php if ($productList['sm_file'] != '') { ?>
            <div id="pdfPoints" class="collapse p-3">
              <hr />
              <iframe style="width:100%;height:700px;" class="mt-3" src="<?= base_url('assets/avator/upload/smaterial/') ?><?= $productList['sm_file'] ?>" width="100%" height="100%"></iframe>
            </div>
          <?php }  ?>
        <?php
        } else {
          echo "<div class='alert alert-info'>Your Enrollment might have been Expired / Empty data!</div>";
        }
        ?>
      </div>

      <?php
      $Order_listPro = $this->db->query("SELECT * from  x_edu_study_material LEFT JOIN x_edu_material_bookmark ON sm_id=emb_mat_id where sm_course_id='$course_id' and sm_id!='$smid' and sm_status='1'");
      if ($Order_listPro->num_rows() > 0) {
        $productList = $Order_listPro->result_array();
      ?>
        <div class="col-12 col-sm-3">
          <div class="row">
            <div class="col-xxl-12">
              <div class="price__tab-btn text-center mb-20">
                <nav>
                  <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-materials-tab" data-bs-toggle="tab" data-bs-target="#nav-materials" type="button" role="tab" aria-controls="nav-materials" aria-selected="true">All Materials</button>
                    <button class="nav-link " id="nav-bookmarks-tab" data-bs-toggle="tab" data-bs-target="#nav-bookmarks" type="button" role="tab" aria-controls="nav-bookmarks" aria-selected="false">My BookMarks</button>
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-materials" role="tabpanel" aria-labelledby="nav-materials-tab">
              <div class="row">
                <div class="p-2 the_materials_scroll">
                  <?php foreach ($productList as $material) { ?>
                    <a href="<?= base_url('viewMaterial?enrol=') ?><?= $enrol ?>&smid=<?= $material['sm_id'] ?>">
                      <div class="col-12 mb-2 p-2 bg-white">
                        <!-- <img src="https://cdn-wordpress-info.futurelearn.com/wp-content/uploads/FL365_Free_Certs_Blog_Header.png" class="img-fluid" > -->
                        <h6><?= $material['sm_name'] ?></h6>
                        <p><?php if (isset($material['emb_mat_id']) && $material['emb_mat_id'] > '0') {
                              echo '<i class="fas fa-bookmark text-warning"></i> ';
                            } ?><?= trim_text(strip_tags($material['sm_desc']), '40') ?></p>
                      </div>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-bookmarks" role="tabpanel" aria-labelledby="nav-bookmarks-tab">
              <div class="row">
                <div class="p-2 the_materials_scroll">
                  <?php foreach ($productList as $material) {
                    if (isset($material['emb_mat_id']) && $material['emb_mat_id'] > '0') { ?>
                      <a href="<?= base_url('viewMaterial?enrol=') ?><?= $enrol ?>&smid=<?= $material['sm_id'] ?>">
                        <div class="col-12 mb-2 p-2 bg-white">
                          <h6><?= $material['sm_name'] ?></h6>
                          <p><?= trim_text(strip_tags($material['sm_desc']), '40') ?></p>
                        </div>
                      </a>
                  <?php }
                  } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
    </div>
</section>