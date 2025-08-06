<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                            
                            <!-- Profile Sidebar -->
                            <div class="profile-sidebar">
                                <div class="widget-profile pro-widget-content">
                                    <div class="profile-info-widget">
                                        <a href="#" class="booking-doc-img">
                                        <img alt="" src="<?=base_url('assets')?>/mem/<?=$profile_data['mid']?>/img/<?=$profile_data['photo']?>" onclick="$('#cover_image_90_2').click();" style="cursor: pointer;">
                                    <form action="<?=base_url('index.php/action/photo')?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?=base_url('index.php/action/photo')?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
                                      <input type="file" name="file_name"  id='cover_image_90_2' style="display: none;" onchange="chnageBGDynamic(this,'prifile_pic_09o2','0','1');"/>
                                      <input type="hidden" name="cvr_prf" value="photo"/>
                                    </form>
                                        </a>
                                        <div class="profile-det-info">
                                            <h3><?=$_SESSION['name']?></h3>
                                            <small><?=get_age($profile_data['user_dob'])?> years - <?=read_me_user('gender',$profile_data['gender'])?></small>
                                            <div class="patient-details">
                                                <h5 class="mb-0"><?=$profile_data['user_profile']?></h5>
                                                <hr/>
                                                <small><?=trim_text($profile_data['about'],'120','...');?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-widget">
                                    <nav class="dashboard-menu">
                                        <ul>
                                            <li class="active">
                                                <a href="<?=base_url('profile')?>">
                                                    <i class="fas fa-columns"></i>
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?=base_url('family')?>">
                                                    <i class="fas fa-heart" style="color: red !important;"></i>
                                                    <span>Family Account.</span>
                                                    <!-- <small class="unread-msg">23</small> -->
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('edit')?>">
                                                    <i class="fas fa-user-cog"></i>
                                                    <span>Profile Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('edit/sm')?>">
                                                    <i class="fa fa-facebook-square"></i>
                                                    <span>Social Media</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('edit/pass')?>">
                                                    <i class="fas fa-lock"></i>
                                                    <span>Change Password</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('logout')?>">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- /Profile Sidebar -->
                            
                        </div>