<style>
    p {
        font-size: 14px;
        /*color: #555;*/
        margin-bottom: 16px;
    }

    strong {
        font-size: 20px;
        color: #1f1e1e;
        margin-bottom: 16px;
    }
    
   .blog img{
        width:100% !important;
        height :auto !important;
    }
    
    .blog h1, .blog h2, .blog h3 {
        font-size: 23px !important;
        color:black;
        font-weight:600;
    }
    .blog strong {
    font-size: 14px;
    color: #1f1e1e;
    margin-bottom: 16px;
}
</style>
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
        height: 120px;
        object-fit: cover;
    }

    .card-content {
        padding: 16px;
        position: relative;
    }

    .card-date {
        font-size: 11px;
        color: #666;
    }

    .card-premium {
        position: absolute;
        top: 16px;
        right: 16px;
    }

    .premium-badge {
        background-color: #5A1D32;
        color: white;
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 12px;
    }

    .card-title {
        font-size: 12px;
        font-weight: 600;
        margin: 12px 0 8px;
        color: #222;
        height: 30px;
    }

    .card-description {
        font-size: 11px;
        color: #555;
        margin-bottom: 16px;
        height: 45px;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #777;
        margin-bottom: 12px;
    }

    .signup-btn {
        width: 100%;
        padding: 10px;
        background-color: #f5f5f5;
        border: none;
        font-weight: 500;
        cursor: pointer;
        border-radius: 6px;
        transition: background-color 0.3s;
    }

    .signup-btn:hover {
        background-color: #e0e0e0;
    }
</style>
<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <!-- Profile Image (Left Side) -->
                            <div class="me-3">
                                <img src="<?= base_url('assets/avator/site_img.png') ?>" class="img-fluid rounded-circle user-img" alt="profile-img" style="width: 40px; height: 40px;">
                            </div>
                            <!-- Right Side Content -->
                            <div class="w-100">
                                <!-- User Info -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-0">
                                        <a class="text-decoration-none">
                                            <h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $site_name ?>
                                                <span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
                                            </h6>
                                            <!-- <p class="text-muted mb-0">@<?= $property['username'] ?></p> -->
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center small">
                                        <p class="text-muted mb-0"><?= date_format_1($blog_rea['blog_time'], 'alpha_date'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="w-100">
                                <!-- Post Content (Starts Below Profile Image) -->
                                <div class="mt-2">
                                    <?php if (!empty($blog_rea['blog_img'])) { ?>
                                        <!-- <a href="javascript:void(0)" class="noload"> -->
                                        <img src="<?= base_url('assets/avator/upload/' . $blog_rea['blog_img']) ?>" class="img-fluid rounded mb-3 w-100" alt="post-img" style="max-height:auto">
                                        <!-- </a> -->
                                    <?php } ?>
                                </div>
                                <div class="mt-2">
                                    <h1 class="mb-1 text-dark"><?= $blog_rea['title'] ?></h1>
                                    <div class="blog">
                                    <?= $blog_rea['comment'] ?>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-body py-4 mb-0 border-bottom">Related Articles</h5>
                                    <div class="main-content row">
                                        <?php foreach ($show_blogs as $blog) { ?>
                                            <div class="col-md-6">
                                                <div class="card mb-3">
                                                    <a href="<?= base_url('blog') ?>/<?= $blog['slug'] ?>" class="text-decoration-none">
                                                        <img src="<?= base_url('assets/avator/upload') ?>/<?= $blog['blog_img'] ?>" alt="House" class="card-img">
                                                        <div class="card-content">
                                                            <div class="card-date"><?= date_format_1($blog['blog_time'], 'alpha_date') ?></div>

                                                            <h2 class="card-title"><?= trim_text($blog['title'], '70', '...') ?></h2>
                                                            <p class="card-description">
                                                                <?= strip_tags(trim_text($blog['comment'], '150', '...')) ?>
                                                            </p>


                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>


            <?php include 'inc/_rsidebar.php' ?>
        </div>
    </div>
</div>