<section class="blog-section py-5 bg-white" style="border-bottom:1px solid #eee;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4> Offers </h4>
                    <small>Know about our latest news and updates. </small>
                </div>
                    <article class="mb-40-none row">
                        <?php foreach($blogs_3 as $blog){
                            $blog_url=base_url('blog/').$blog['blog_id'].'/'.url_smart($blog['title']);
                        ?><div class="col-sm-4 p-1">
                        <div class="post-item style-one bg-white shadow_1">
                            <?php if($blog['blog_img']!=''){?>
                            <div class="post-thumb">
                                <a href="<?=$blog_url?>">
                                	<img src="<?=base_url('assets/avator/upload/')?><?=$blog['blog_img']?>" alt="<?=$blog['title']?>" class='img-fluid' style='border-radius: 10px;' >
                                </a>
                            </div>
                        <?php }?>
                            <div class="post-content">
                                <b>    
                                	<a href="<?=$blog_url?>" class='no_link' >
                                	<?=$blog['title']?>
                                </a>
                            </b>
                            </div>
                        </div>
                        </div>
                        <?php }?>
                    </article>
                
            </div>
        </div>
    </section>