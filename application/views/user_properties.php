<div class="py-4">
    <div class="container-fluid">
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
                            <!-- <div class="ms-auto btn-group" role="group" aria-label="Basic checkbox toggle button group">
								<input type="checkbox" class="btn-check" id="btncheck1">
								<label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="btncheck1"><span class="follow">+ Follow</span><span class="following d-none">Following</span></label>
							</div> -->
                            <div class="ms-auto btn-group" role="group">
                                <input type="checkbox" class="btn-check follow-toggle" id="followBtn<?= $profile_data['mid'] ?>" data-user-id="<?= $profile_data['mid'] ?>" <?= favourite_me_user($profile_data['mid']) ? 'checked' : '' ?>>
                                <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="followBtn<?= $profile_data['mid'] ?>">
                                    <span class="follow <?= favourite_me_user($profile_data['mid']) ? 'd-none' : '' ?>">+ Follow</span>
                                    <span class="following <?= favourite_me_user($profile_data['mid']) ? '' : 'd-none' ?>">Following</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-3">
                            <p class="mb-2 fs-6"><?= $profile_data['about'] ?></p>
                            <p class="d-flex align-items-center mb-3">
                                <span class="material-icons me-2 rotate-320 text-muted md-16">link</span><a href="<?= base_url('userprofile/' . $profile_data['username']) ?>" class="text-decoration-none">profile/<?= $profile_data['username'] ?></a>
                                <span class="material-icons me-2 text-muted md-16 ms-4">calendar_today</span><span>Joined on <?= date_format_1($profile_data['date'], 'alpha_month_year') ?></span>
                            </p>
                            <div class="d-flex followers" id="followers">
                                <div>
                                    <p class="mb-0"><?= get_followers_count($profile_data['mid']) ?> <span class="text-muted">Followers</span></p>

                                </div>
                                <div class="ms-5 ps-5">
                                    <p class="mb-0"><?= get_following_count($profile_data['mid']) ?> <span class="text-muted">Following</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('inc/_userprofile_menu.php'); ?>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <!-- Follow People -->
                            <div class="ms-1">
                                <!-- Feeds -->
                                <!-- <div class="feeds" id="postContainer">
								</div> -->
                                <div class="feeds">
                                    <!-- Feed Item -->
                                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm " style="min-height: 50px;">
                                        <?php if (!empty($posts)) { ?>
                                            <div>
                                                <div class="pt-1 feeds row" id="property-list">
                                                    <?php
                                                    $total_properties = count($posts);
                                                    $initial_limit = 6;
                                                    $index = 0;

                                                    foreach ($posts as $row) {
                                                        $display = ($index < $initial_limit) ? '' : 'style="display:none"';
                                                        echo '<div class="col-md-6 mb-4 property-item" ' . $display . '>';
                                                    ?>
                                                        <!--<div class="col-md-4 mb-4">-->
                                                        <a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" style="text-decoration: none;">
                                                            <div class="card border-0 shadow-sm position-relative">
                                                                <?php if (!empty($row['prop_img1'])) { ?>
                                                                    <img src="<?= base_url('assets/avator/upload/' . $row['prop_img1']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Property Image">
                                                                    <!--<span class="badge bg-dark position-absolute top-0 start-0 m-2">Ready To Move</span>-->
                                                                <?php } ?>

                                                                <div class="card-body">
                                                                    <h5 class="card-title text-dark mb-2" style="font-size: 16px;"><?= $row['prop_name'] ?></h5>
                                                                    <p class="card-text text-muted mb-1" style="font-size: 13px;">
                                                                        <?= $row['prop_bedroom'] ?> BHK <?= $row['prop_type'] ?> | <?= $row['prop_address'] ?>
                                                                    </p>
                                                                    <p class="text-primary fw-bold mb-2" style="font-size: 14px;">₹<?= number_format($row['prop_price']) ?></p>

                                                                    <div class="d-flex flex-wrap text-muted" style="font-size: 12px;">
                                                                        <div class="me-3 mb-1">
                                                                            <i class="fa fa-bed me-1 fa-sm"></i><?= $row['prop_bedroom'] ?> Beds
                                                                        </div>
                                                                        <div class="me-3 mb-1">
                                                                            <i class="fa fa-home me-1 fa-sm"></i><?= $row['prop_area'] ?> sqft
                                                                        </div>
                                                                        <div class="mb-1">
                                                                            <i class="fa fa-map-marker-alt me-1 fa-sm"></i><?= $row['prop_city'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--</div>-->

                                                    <?php
                                                        echo '</div>';
                                                        $index++;
                                                    }
                                                    ?>
                                                </div>

                                                <?php if ($total_properties > $initial_limit): ?>
                                                    <div class="text-center mt-3">
                                                        <button id="loadMoreBtn" class="btn btn-outline-dark rounded-pill px-4 py-2">See More</button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } else { ?>
                                            <p class="text-dark m-0">No Properties found for this developer</p>
                                        <?php } ?>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            let currentVisible = 6;
                                            const step = 9;
                                            const items = document.querySelectorAll('.property-item');
                                            const loadMoreBtn = document.getElementById('loadMoreBtn');

                                            loadMoreBtn?.addEventListener('click', function() {
                                                let shown = 0;

                                                for (let i = currentVisible; i < items.length && shown < step; i++) {
                                                    items[i].style.display = '';
                                                    shown++;
                                                }

                                                currentVisible += shown;

                                                if (currentVisible >= items.length) {
                                                    loadMoreBtn.style.display = 'none';
                                                }
                                            });
                                        });
                                    </script>
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