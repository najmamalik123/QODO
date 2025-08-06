<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <?php include('inc/_home_nav.php') ?>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-people" role="tabpanel" aria-labelledby="pills-people-tab">
                            <h6 class="mb-3 fw-bold text-body">Developers you can follow</h6>
                            <div class="bg-white rounded-4 overflow-hidden mb-4 shadow-sm">
                                <!-- Account Item -->
                                <?php if (count($vendors) > 0) {
                                    foreach ($vendors as $vendor) { ?>
                                        <a href="<?= base_url('developer') ?>/<?= $vendor['mid'] ?>/<?= url_smart($vendor['name']) ?>" class="p-3 border-bottom d-flex text-dark text-decoration-none account-item pf-item">
                                            <img src="<?= base_url('assets/mem/' . $vendor['mid'] . '/img/' . $vendor['photo']) ?>" class="img-fluid rounded-circle me-3" alt="profile-img">
                                            <div>
                                                <p class="fw-bold mb-0 pe-3 d-flex align-items-center"><?= $vendor['name'] ?>
                                                    <?php if ($vendor['user_status'] == '9') { ?>
                                                        <span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
                                                    <?php } ?>
                                                </p>
                                                <div class="text-muted fw-light">
                                                    <p class="mb-1 small">@<?= $vendor['username'] ?></p>
                                                    <span class="text-muted d-flex align-items-center small"><span class="material-icons me-1 small">open_in_new</span>Developer</span>
                                                </div>
                                            </div>
                                            <div class="ms-auto btn-group" role="group">
                                                <input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $vendor['mid'] ?>" data-user-id="<?= $vendor['mid'] ?>" <?= favourite_me_user($vendor['mid']) ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn<?= $vendor['mid'] ?>">
                                                    <span class="follow <?= favourite_me_user($vendor['mid']) ? 'd-none' : '' ?>">+ Follow</span>
                                                    <span class="following <?= favourite_me_user($vendor['mid']) ? '' : 'd-none' ?>">Following</span>
                                                </label>
                                            </div>
                                        </a>
                                    <?php }
                                } else { ?>
                                    <div class="alert alert-warning">No Developers found</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'inc/_lsidebar.php' ?>
        </div>
    </div>
</div>