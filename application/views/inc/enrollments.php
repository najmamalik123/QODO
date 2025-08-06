<div class="container p-0">
  <div class="row p-0">
    <div class="col-12">
      <h3 class="m-0">Course Enrollments</h3><br />
      <?php
      if (count(@$enrollments)) { ?>
        <div class="col-12 m-0 p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($enrollments as $enrollment) { ?>
                <tr>
                  <td><a href="<?= base_url('viewEnrollment') ?>?enrol=<?= $enrollment['co_id'] ?>"><?= $enrollment['co_order_id'] ?></a></td>
                  <td><?= $enrollment['course_name'] ?></td>
                  <td><small><?= date_format_1($enrollment['co_start_date'], '1') ?></small></td>
                  <td><small><?= date_format_1($enrollment['co_end_date'], '1') ?><br /></small></td>
                  <td>
                    <span class="pill edu-btn btn-medium btn-gradient badge"><?= strip_tags(read_me_user('cpay', $enrollment['co_payment_status'])) ?><br></span>
                    <span class="pill edu-btn btn-medium btn-gradient2 badge"><?= strip_tags(read_me_user('test_status', $enrollment['co_status'])) ?></span>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else {
        echo "You haven't Enrolled YET in any Course.<br><a href='" . base_url('courses') . "' style='color: blue;'>Choose your course and Enroll</a>";
      } ?>
    </div>
  </div>
</div>