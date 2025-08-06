<div class="card overflow-hidden shadow">
    <div class="item-user">
        <div class="profile-pic mb-0">
            <img alt="<?= $profile_data['name'] ?>" src="<?= base_url('assets') ?>/mem/<?= @$profile_data['mid'] ?>/img/<?= @$profile_data['photo'] ?>" onclick="$('#cover_image_90_2').click();" style="cursor: pointer;" class="w-100">
            <form action="<?= base_url('index.php/action/photo') ?>" method="post" enctype="multipart/form-data" onsubmit="return uploadandform('<?= base_url('index.php/action/photo') ?>','post',this,'cover_image_90_2','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" id='fomr_id_proile2'>
                <input type="file" name="file_name" id='cover_image_90_2' style="display: none;" onchange="chnageBGDynamic(this,'prifile_pic_09o2','0','1');" />
                <input type="hidden" name="cvr_prf" value="photo" />
            </form>
        </div>
    </div>
    <div class="card-body item-user">
        <div class="ml-1">
            <a href="<?= base_url('profile') ?>" class="text-dark">
                <h4 class="mt-1 mb-3 font-weight-semibold text-dark"><?= $profile_data['name'] ?></h4>
                <p><?= $profile_data['email'] ?></p>
            </a>
            <span class="mb-3"><?= read_me_user('user_type', $profile_data['user_type']) ?></span><br>

            <h6 class="mt-2 mb-0">
                <div class="row">
                    <div class="col-6 text-center">
                        <a href="<?= base_url('edit') ?>" class="edu-btn btn-medium btn-gradient mt-2 col-12"><i class="fa fa-edit"></i> Edit Profile</a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="<?= base_url('logout') ?>" class="edu-btn btn-medium btn-gradient2 btn-block mt-2 col-12"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>

                </div>
            </h6>
        </div>
    </div>
    <!--  <div class="card-body item-user">
        <h4 class="mb-4">Social Share</h4>
        <div class=" item-user-icons mt-4">
            <a href="<?= $profile_data['fb'] ?>" class="mt-0 bg-light border"><i class="fa fa-facebook"></i></a>
            <a href="<?= $profile_data['tw'] ?>" class="mt-0 bg-light border"><i class="fa fa-twitter"></i></a>
            <a href="<?= $profile_data['insta'] ?>" class="mt-0 bg-light border"><i class="fa fa-instagram"></i></a>
        </div>
    </div> -->
</div>