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

    .card-date {
        font-size: 13px;
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
        font-size: 15px;
        font-weight: 600;
        margin: 12px 0 8px;
        color: #222;
        height: 30px;
    }

    .card-description {
        font-size: 12px;
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
        <?php
        // Fetch the latest news data from the database using CodeIgniter query builder
        $this->db->select('*');
        $this->db->from('news_data');
        $getNewsData = $this->db->get();

        // Check if the query returned any results
        if ($getNewsData->num_rows() > 0) {
            // Fetch the results as an array
            $news_results = $getNewsData->result_array();
        } else {
            // Handle no results
            $news_results = [];
        }
        ?>

        <!-- Google News Section -->
        <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4">
            <h6 class="fw-bold text-body p-3 mb-0 border-bottom">What's happening</h6>
            <div class="row">
                <?php if (!empty($news_results)) { ?>
                    <?php foreach (array_slice($news_results, 0, 3) as $news) { // Show only 4 trending news 
                    ?>
                        <!-- Trending News Item -->
                        <a href="<?= htmlspecialchars($news['link']) ?>" target="_blank" class="col-md-4 p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                            <div>
                                <div class="text-muted fw-light d-flex align-items-center">
                                    <small>Trending News</small><span class="mx-1 material-icons md-3">circle</span><small>Live</small>
                                </div>
                                <p class="fw-bold mb-0 pe-3"><?= htmlspecialchars($news['title']) ?></p>
                                <small class="text-muted"><?= htmlspecialchars($news['snippet']) ?></small><br>
                            </div>
                            <img src="<?= $news['photo_url'] ?>" class="img-fluid rounded-4 ms-auto" alt="news-img" style="width: 60px; height: 60px; object-fit: cover;">
                        </a>
                    <?php } ?>
                <?php } else { ?>
                    <p class="p-3 text-muted">No trending news available.</p>
                <?php } ?>
            </div>
            <a href="https://news.google.com/home?hl=en-US&gl=US&ceid=US:en" target="_blank" class="d-flex justify-content-end col-md-12 text-decoration-none">
                <div class="p-3">Show More</div>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <h2 class="fw-bold text-body p-3 mb-0 border-bottom">Articles</h2>
                <div class="main-content row">
                    <?php foreach ($blogs as $blog) { ?>
                        <div class="col-md-4">

                            <a href="#" onclick="window.location.href='<?= base_url('blog') ?>/<?= $blog['slug'] ?>'" style="text-decoration:none;">

                                <div class="card mb-3">
                                    <img src="<?= base_url('assets/avator/upload') ?>/<?= $blog['blog_img'] ?>" alt="House" class="card-img">
                                    <div class="card-content">
                                        <div class="card-date"><?= date_format_1($blog['blog_time'], 'alpha_date') ?></div>
                                        <div class="card-premium">
                                            <span class="premium-badge">Premium</span>
                                        </div>
                                        <h2 class="card-title"><?= trim_text($blog['title'], '70', '...') ?></h2>
                                        <p class="card-description">
                                            <?= strip_tags(trim_text($blog['comment'], '150', '...')) ?>
                                        </p>
                                        <div class="card-footer">
                                            <div class="author">
                                                <span class="author-name"><?= $blog['blog_username'] ?></span>
                                            </div>
                                            <div class="stats">
                                                <span class="views">👁️ <?= $blog['blog_views'] ?></span>
                                                <!-- <span class="comments">💬 24</span> -->
                                            </div>
                                        </div>

                                        <button class="signup-btn" onclick="window.location.href='<?= base_url('blog') ?>/<?= $blog['slug'] ?>'">View Details</button>


                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </main>
        </div>
    </div>
</div>