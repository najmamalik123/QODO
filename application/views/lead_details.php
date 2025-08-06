<div class="py-4">
    <div class="container">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="mb-4 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="material-icons text-dark text-decoration-none m-none me-3">
                                arrow_back
                            </a>
                            <p class="ms-2 mb-0 fw-bold text-body fs-6"><?= $profile_data['name'] ?></p>
                        </div>
                        <!-- <a href="#" class="text-decoration-none material-icons md-20 ms-auto text-muted">share</a> -->
                    </div>
                    <div class="bg-white rounded-4 shadow-sm profile">
                        <div class="d-flex align-items-center px-3 pt-3">
                            <img src="<?= base_url('assets/mem/' . $profile_data['mid'] . '/img/' . $profile_data['photo']) ?>" class="img-fluid rounded-circle" alt="profile-img">
                            <div class="ms-3">
                                <h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $profile_data['name'] ?>
                                    <?php if ($profile_data['user_status'] == '9') { ?>
                                        <span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
                                    <?php } ?>
                                </h6>
                                <p class="text-muted mb-0">@<?= $profile_data['username'] ?></p>
                            </div>

                        </div>
                        <div class="p-3">
                            <p class="mb-2 fs-6"><?= $profile_data['about'] ?></p>
                            <p class="d-flex align-items-center mb-3"><span class="material-icons me-2 rotate-320 text-muted md-16">link</span><a href="<?= base_url('userprofile/' . $profile_data['username']) ?>" class="text-decoration-none">profile/<?= $profile_data['username'] ?></a>
                                <span class="material-icons me-2 text-muted md-16 ms-4">calendar_today</span><span>Joined on <?= date_format_1($profile_data['date'], 'alpha_month_year') ?></span>
                            </p>
                            <div class="d-flex followers">
                                <div>
                                    <p class="mb-0"><?= get_followers_count($profile_data['mid']) ?> <span class="text-muted">Followers</span></p>

                                </div>
                                <div class="ms-5 ps-5">
                                    <p class="mb-0"><?= get_following_count($profile_data['mid']) ?> <span class="text-muted">Following</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('inc/_profile_top_menu.php') ?>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <!-- Follow People -->
                            <div class="ms-1">
                                <!-- Feeds -->
                                <div class="feeds" id="feed">

                                    <div class="card mb-3 p-3 rounded-4 border shadow-sm">


                                        <?php
                                        if (!empty($details)): ?>

                                            <div class="rounded-4 p-2 mb-2">
                                                <p><strong>Name:</strong> <?= htmlspecialchars($details['name']) ?></p>
                                                <p><strong>Email:</strong> <?= htmlspecialchars($details['email']) ?></p>
                                                <p><strong>Phone Number:</strong><?= $details['phone']?></p>
                                                <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($details['msg'])) ?></p>
                                                <p><strong>Uploaded Documents:</strong></p>
                                                <?php
                                                $docs = explode(',', $details['user_doc']);
                                                if (!empty($docs[0])) {
                                                    foreach ($docs as $doc) {
                                                        $doc = trim($doc);
                                                        if ($doc !== '') {
                                                            $url = base_url('assets/avator/upload/' . $doc);
                                                            echo "<a href='{$url}' target='_blank' style='display:block; color:blue; text-decoration:underline;'>{$doc}</a>";
                                                        }
                                                    }
                                                } else {
                                                    echo "<p>No documents uploaded.</p>";
                                                }
                                                ?>
                                                <?= read_me_user('property_lead_status', $details['vendor_status']) ?>
                                            </div>
                                            <div>
                                                <form class="form-floating-space" action="<?= base_url('index.php/action/propstatus') ?>" method="post" id="contactForm" novalidate="novalidate" onsubmit="return ajaxsubmitform('<?= base_url('index.php/action/propstatus') ?>',this,'error_div','loder_div','#','1','propstatus');">
                                                    <div class="col-4 mb-2">
                                                        <label for="status">Status:</label>
                                                        <select class="form-control rounded-5 col-md-4" name="status" id="status">
                                                            <option value="0">Pending</option>
                                                            <option value="1">Meeting</option>
                                                            <option value="2">Closed</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="msid" value="<?= $_GET['msid'] ?>">
                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-login mx-2 rounded-pill">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>

                                        <?php else: ?>
                                            <p class="text-muted">Seems Like you are lost!.</p>
                                        <?php endif; ?>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'inc/_lsidebar.php' ?>
            <?php include 'inc/_rsidebar.php' ?>
        </div>
    </div>
</div>