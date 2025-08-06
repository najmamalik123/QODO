
    <!--============= Header Section Ends Here =============-->
    <section class="page-header bg_img" data-background="<?=base_url('assets/theme/images/')?>page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="<?=base_url('assets/theme/')?>css/img/page-header.png" alt="css">
        </div>
        <div class="container">
            <div class="page-header-content cl-white">
                <h2 class="title">Offers</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        Offers
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--============= Header Section Ends Here =============-->

    <!--============= About Section Starts Here =============-->
    <section class="about-section padding-top padding-bottom oh">
        <div class="container">
            <div class="row align-items-center">
                <h3>Our Offers</h3>
                    <?php 
                    $geththeblogs=$this->db->query("select * from yn_site_blogs where blog_type='2' order by blog_id desc  limit 10");
					$all_blogs=$geththeblogs->result_array();
					// $data['blogs_2']=$all_blogs;
                    foreach($all_blogs as $blog){ 
                        $blog_url=base_url('blog/').$blog['blog_id'].'/'.url_smart($blog['title']);
                        ?>
                    <div class="col-sm-4 p-1">
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
                                	<a href="<?=$blog_url?>">
                                	<?=$blog['title']?>
                                </a>
                            </b>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                
            </div>
        </div>
    </section>
    <!--============= About Section Ends Here =============-->