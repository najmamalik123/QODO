<style>
    .card {
        width: 100%;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', sans-serif;
        background-color: white;
    }

    .card-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-content {
        padding: 16px;
        position: relative;
    }


    .card-title {
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        color: #222;
        /* height: 30px; */
    }

    .card-description {
        font-size: 12px;
        color: #555;
        margin-bottom: 16px;
        height: 45px;
    }
</style>
<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
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

                            <div>
                                <!-- Feeds -->
                                <div class="pt-1 feeds row">
                                    <?php if (count($all_videos) > 0) {
                                        foreach ($all_videos as $video) {
                                    ?>
                                            <?php
                                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]+)/', $video['ygl_img'], $match);
                                            $youtube_id = $match[1] ?? '';
                                            $thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg";
                                            ?>

                                            <div class="col-md-4">
                                                <a href="<?= base_url('video') ?>/<?= $video['ygl_id'] ?>" class="text-decoration-none">
                                                    <div class="card mb-3">

                                                        <img src="<?= $thumbnail_url ?>" alt="House" class="card-img">
                                                        <div class="card-content">

                                                            <h5 class="card-title"><?= htmlspecialchars($video['ygl_name']) ?></h5>


                                                        </div>

                                                    </div>
                                                </a>
                                            </div>



                                        <?php
                                        }
                                    } else { ?>
                                        <!-- Feed Item -->
                                        <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm d-flex justify-content-center align-items-center text-center" style="min-height: 50px;">
                                            <p class="text-dark m-0">No Property found</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include 'inc/_lsidebar.php' ?>
        </div>
    </div>
</div>