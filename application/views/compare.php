<style type="text/css">
    #compare{display: none !important;}
</style>
<section class="page-header bg_img" data-background="<?=base_url('assets/theme/images/')?>page-header.png">
        <div class="bottom-shape d-none d-md-block">
            <img src="<?=base_url('assets/theme/')?>css/img/page-header.png" alt="css">
        </div>
        <div class="container">
            <div class="page-header-content cl-white">
                <h2 class="title">compare</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?=base_url()?>">Home</a>
                    </li>
                    <li>
                        compare
                    </li>
                </ul>
            </div>
        </div>
    </section>
        <!--============= About Section Starts Here =============-->
    <section class="about-section padding-top padding-bottom oh">
        <div class="container">
            <div class="row align-items-center">
                <h3>Compare Courses</h3>
                <table class="table">
                <thead>
                  <tr>
                    <th class="col-sm-3">#</th>
                    <th class="col-sm-3">Course1</th>
                    <th class="col-sm-3">Course2</th>        
                    <th class="col-sm-3">Course3</th>        
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table class="table">
                                <tr><td style="height:100px;"><b>Course Name</b></td></tr>
                                <tr><td style="height:130px;"><b>Image</b></td></tr>
                                <tr><td ><b>Price</b></td></tr>
                                <tr><td><b>Provider</b></td></tr>
                                <tr><td><b>Level</b></td></tr>
                                <tr><td><b>Pace</b></td></tr>
                                <tr><td><b>Language</b></td></tr>
                                <tr><td><b>Duration</b></td></tr>
                                <tr><td><b>Instructor</b></td></tr>
                                <tr><td><b>Rating Stars</b></td></tr>

                            </table>
                        </td>
                    <?php 
                    foreach($theCourses as $thecourse_data){ ?>
                    <td>
                        <table class="table">
                            <tr><td style="height:100px;"><a class="no_link" href="<?=base_url('course/')?><?=$thecourse_data['cou_id']?>/<?=clean_url(url_smart($thecourse_data['cou_name']))?>"><?=$thecourse_data['cou_name']?></a></td></tr>
                            <tr><td><?php $cou_img=get_cou_image($thecourse_data['cou_img'], $thecourse_data['pr_image']);?><img src="<?=$cou_img?>" style="height: 100px;" alt="<?=$thecourse_data['cou_name']?>" class='img-fluid my-auto'></td></tr>
                            <tr><td><?=convertCurrency($thecourse_data['cou_price'],$thecourse_data['cou_currency'],$_SESSION['currency'])?></td></tr>
                            <tr><td><?=$thecourse_data['pr_name']?></td></tr>
                            <tr><td><?php if($thecourse_data['cou_level']=='') echo 'NA';else echo $thecourse_data['cou_level'];?></td></tr>
                            <tr><td><?php if($thecourse_data['cou_pace']=='') echo 'NA'; else echo str_replace('_', ' ', $thecourse_data['cou_pace']);?></td></tr>
                            <tr><td><?=strtoupper($thecourse_data['cou_lang'])?><?php  if($thecourse_data['cou_lang'] ==''){echo 'English';} ?></td></tr>
                            <tr><td><?php if($thecourse_data['cou_duration']=='') echo '--';else echo '<i class="fa fa-stopwatch-20 mr-1"></i>'.strtoupper($thecourse_data['cou_duration']);?></td></tr>
                            
                            <tr>
                                <td>
                                    <?php if($thecourse_data['cou_inst'] !=''){ ?> <i class="fa fa-chalkboard-teacher" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Instructor" ></i> <?=str_replace('_', ' ', $thecourse_data['cou_inst'])?> <?php } ?>
                                </td>
                            </tr>

                            <tr><td><?php if($thecourse_data['cou_rat']=='') echo '--';else echo ratings_star($thecourse_data['cou_rat'],'star');?></td></tr>

                            <tr>
                                <td class="text-center">
                                    <!-- <a href="<?=base_url('apply/')?><?=$thecourse_data['cou_id']?>/<?=url_smart($thecourse_data['cou_name'])?>" target='_blank' class='mt-3 btn btn--primary type--uppercase the_imp_btn theme_bg shadow_1' > Go To Course <span class="ml-1 fa fa-external-link-alt"></span> </a> -->

                                    <a href="<?=$thecourse_data['cou_link']?>" target='_blank' class='mt-3 mt-3 special_go_to btn btn--primary type--uppercase the_imp_btn theme_bg shadow_1' > Go To Course <span class="ml-1 fa fa-external-link-alt"></span> </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <?php } ?>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--============= About Section Ends Here =============-->


<div id="comparsse"><a href="<?=base_url('reset')?>"><button class="compare_box theme_bg2 the_ani_btn theme_bg2">Reset</button></a></div>