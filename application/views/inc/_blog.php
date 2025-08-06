<?php 
$allblogs = $this->db->query("select * from yn_site_blogs order by rand() limit 6 ");
$show_blogs = $allblogs->result_array();

?>
<!--====== APPIE BLOG 3 PART START ======-->
    
    <section class="appie-blog-3-area appie-blog-6-area pt-90 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-section-title text-center">
                        <h3 class="appie-title">Latest updates</h3>
                        <p>Checkout our updates to know about our services.</p>
                    </div>                    
                </div>
            </div>
            <div class="row">
                
                <?php foreach($show_blogs as $blog){ 
                    $url = base_url('blog/' . url_smart($blog['slug']));
                ?>
                <div class="col-lg-6">
                    <div class="appie-blog-item-3 appie-blog-item-6 mt-30">
                        <div class="thumb">
                            <img src="<?= base_url('assets/avator/upload/' . $blog['blog_img']) ?>" alt="">
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="<?=$url?>"><?=trim_text( $blog['title'],'39','...')?></a></h5>
                            <?= strip_tags(trim_text($blog['comment'], '70', '...')) ?>
                            <div class="meta-item">
                                <ul>
                                    <li><i class="fal fa-clock"></i> <?= date_format_1($blog['blog_time'], 'alpha_date'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-lg-12">
                    <div class="blog-btn text-center mt-60">
                        <a class="main-btn" href="<?=base_url('blog')?>">View All Posts <i class="fal fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE BLOG 3 PART ENDS ======-->

