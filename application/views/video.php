<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                                <form method="get" class="d-flex w-100 position-relative" action="<?= base_url('videos') ?>">
                                    <input 
                                        type="text" 
                                        name="q" 
                                        id="searchInput" 
                                        class="form-control me-2" 
                                        placeholder="Search videos..." 
                                        value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
                                    >
                                    <?php if (!empty($_GET['q'])): ?>
                                        <a href="<?= base_url('videos') ?>" 
                                           class="btn position-absolute" 
                                           style="right: 90px; top: 0; bottom: 0; margin: auto 0; height: 38px;"
                                           title="Clear search">
                                            ✖
                                        </a>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                            </div>
            <!-- Main Content -->
            <main class="col col-xl-8 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <?php if ($video_link != '') { ?>
                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">

                            <div class="col-md-12">
                                <?= convertYoutube($video_link['ygl_img']) ?>
                            </div>
                            <div class="col-md-12">

                                <h4 class="fw-bold text-dark"><?= $video_link['ygl_name'] ?></h4>
                                <p class="text-muted d-flex gap-2"><strong><?php
                                                                            $tags = explode(',', $video_link['ygl_tags']);
                                                                            foreach ($tags as $tag) {
                                                                                echo '<span class="badge bg-primary">#' . $tag . '</span> ';
                                                                            }
                                                                            ?></strong></p>
                            </div>

                        </div>
                    <?php } ?>


                </div>
            </main>
              <aside class="col col-xl-4 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
                <div class="fix-sidebar">
                    <div class="side-trend lg-none">
                        <div class="sticky-sidebar2 mb-3">
                            <?php if (!isset($_SESSION['yid']) || $_SESSION['plan'] == '') {  ?>
                                <div class="card p-4 text-light mb-4" style=" border-radius: 16px; background: linear-gradient(to bottom, #5A1D32, #5A1D32);">
                                    <h5 class="fw-bold text-white">Why Richo Club?</h5>
                                    <p class="text-white"> We don’t promise you just properties</p>

                                    <ul class=" text-white">
                                        <li class="mb-2">India’s First Elite <strong>Real Estate Club!</strong> </li>
                                        <li class="mb-2">Exclusive Community of <strong>Top 1% Investors</strong></li>
                                        <li class="mb-2"><strong>ZERO Brokerage</strong> - Buy Directly From Developer!</li>
                                        <li class="mb-2"><strong>1% Loyalty Benefits</strong> on Every Investment</li>
                                        <li class="mb-2">Online + Offline <strong>Legal Support</strong></li>
                                    </ul>

                                    <a href="<?= base_url('membership') ?>" class="btn  mt-3 py-2" style="background-color: white; color: #5A1D32; border-radius: 30px; font-weight: bold; font-size:12px;">
                                        Become a member
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                                <?php foreach ($all_videos as $video) {
                                ?>
                                    <?php
                                    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]+)/', $video['ygl_img'], $match);
                                    $youtube_id = $match[1] ?? '';
                                    $thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg";
                                    ?>
                                    <!-- Trending News Item -->
                                    <a href="<?= base_url('video') ?>/<?= $video['ygl_id'] ?>" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                                        <img src="<?= $thumbnail_url ?>" class="img-fluid rounded-1 ms-auto" alt="news-img" style="width: 70px; height: 60px; object-fit: cover; margin-right:5px;">
                                        <div>

                                            <p class="fw-bold mb-0 pe-3"><?= htmlspecialchars($video['ygl_name']) ?></p>

                                        </div>

                                    </a>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </aside>
         
            <?php // include 'inc/_lsidebar.php' ?>
        </div>
    </div>
</div>