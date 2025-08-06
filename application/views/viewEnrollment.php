<section id="contact" class="contact-area pt-145 pb-245" style="background-image:url(<?= base_url('assets/theme/img/') ?>shape/12.png)">
  <div class="container pt-sm-4 ">
    <div class="row">
      <div class="col-md-4 col-sm-12">
        <?php include_once('inc/profile_card.php'); ?>
      </div>
      <div class="col-md-8 col-sm-12">
        <?php
        $yid = $_SESSION['yid'];
        $enrol = $_GET['enrol'];
        $theEnrolls = $this->db->query("select * from x_edu_enrollments,x_edu_courses where co_course_id=course_id and co_user_id='$yid' and co_id='$enrol' GROUP by co_id");
        $enrollment = $theEnrolls->row_array();

        if (!empty($enrollment)) {
          $course_id = $enrollment['co_course_id'];
        ?>
          <div class="container p-0">
            <div class="row p-0">
              <div class="col-12">
                <h3>View Enrollment</h3><br />
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Enrollment #</td>
                        <td class="font-weight-bold"><?= $enrollment['co_order_id'] ?></td>
                      </tr>
                      <tr>
                        <td>Course Name</td>
                        <td class="font-weight-bold" colspan="3"><?= $enrollment['course_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Course Start Date</td>
                        <td class="font-weight-bold"><?= date_format_1($enrollment['co_start_date'], '1') ?></td>
                        <td>Course End Date</td>
                        <td class="font-weight-bold"><?= date_format_1($enrollment['co_end_date'], '1') ?></td>
                      </tr>
                      <tr>
                        <td>Amount</td>
                        <td class="font-weight-bold"><?= money_show($enrollment['co_amount']) ?></td>
                        <td>Course Status</td>
                        <td class="font-weight-bold"><?= strip_tags(read_me_user('test_status', $enrollment['co_status'])) ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php if ($enrollment['co_status'] == '1') { ?>
                    <div class="table-responsive">
                      <fieldset>
                        <h5>Study Materials List</h5>
                      </fieldset>
                      <table class="table table-borderless">
                        <tbody>
                          <?php
                          $Order_listPro = $this->db->query("SELECT * from  x_edu_study_material where sm_course_id='$course_id' order by sm_sort ASC");
                          if ($Order_listPro->num_rows() > 0) {
                          ?>
                            <tr class="bg-info">
                              <td>#</td>
                              <td>Material Name</td>
                              <td>Type</td>
                            </tr>
                            <?php
                            $index = 0;
                            foreach ($Order_listPro->result_array() as $productList) { //print_r($productList);
                              $index++;
                            ?>
                              <tr class="pb-1" style="border-bottom:1px solid #eee;">
                                <td><?= $index ?></td>
                                <td><?= $productList['sm_name'] ?></td>
                                <td>

                                  <!-- <?php if ($productList['sm_file'] != '') { ?><a href="<?= base_url('viewMaterial?enrol=') ?><?= $enrol ?>&smid=<?= $productList['sm_id'] ?>"><?= $productList['sm_file'] ?></a><br><?php } ?> -->

                                  <?php if ($productList['sm_link'] != '') { ?>
                                    <a href="<?= base_url('viewMaterial?enrol=') ?><?= $enrol ?>&smid=<?= $productList['sm_id'] ?>">
                                      <span class='pill edu-btn btn-medium btn-gradient badge'>
                                        Access Course
                                      </span>
                                    </a>
                                  <?php } ?>
                                </td>
                              </tr>
                          <?php
                            }
                          } else {
                            echo "<div class='alert alert-info'>No Materials uploaded yet!</div>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <!-- <a class="btn btn-secondary" href="<?= base_url('profile') ?>">Back to Profile</a> -->
            </div>
          </div>
        <?php
        } else {
          echo "<div class='alert alert-info'>Empty data!</div>";
        }
        ?>
      </div>
    </div>
  </div>
</section>