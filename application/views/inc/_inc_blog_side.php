<div class="edu-blog-sidebar">
                            <!-- Start Single Widget  -->
                            <div class="edu-blog-widget widget-search">
                                <div class="inner">
                                    <h4 class="widget-title">Search</h4>
                                    <div class="content">
                                        <form class="blog-search" action="<?=base_url('blog')?>">
                                            <button class="search-button"><i class="icon-2"></i></button>
                                            <input type="text" placeholder="Search" name="q">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Widget  -->
                            <!-- Start Single Widget  -->
                            <div class="edu-blog-widget widget-latest-post">
                                <div class="inner">
                                    <h4 class="widget-title">Latest Post</h4>
                                    <div class="content latest-post-list">
                                        <?php foreach($show_blogs as $blog){
                                        	$blog_url=base_url('blog/').$blog['blog_id'].'/'.url_smart($blog['title']);
                                        ?>
                                        <div class="latest-post">
                                            <div class="thumbnail">
                                                <a href="<?=$blog_url?>">
                                                    <?php if($blog['blog_img']!=''){ ?>
                                                     <img src="<?=base_url('assets/avator/upload/')?><?=$blog['blog_img']?>" alt="" class="img-responsive width_100">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h6 class="title"><a href="<?=$blog_url?>">Instructional Design &amp; Adult Learners</a></h6>
                                                <ul class="blog-meta">
                                                    <li>
                                                    	<?=date_format_1($blog['blog_time'], '1')?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Widget  -->
                            <!-- Start Single Widget  -->
                            
                            <!-- End Single Widget  -->
                            <!-- Start Single Widget  -->
                            <div class="edu-blog-widget widget-action">
                                <div class="inner">
                                    
                                </div>
                            </div>
                        </div>