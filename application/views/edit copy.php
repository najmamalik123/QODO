<section>
    <div class="bannerimg cover-image bg-background3 sptb-2" style="padding: 0.5rem 0 3rem 0;">        
</section>
<div class="container p-sm-5" style="margin-bottom: 100px;">
 <div class="row justify-content-center">
  <div class="col-md-8 shadow_2 py-3">
    <div class="accordion" id="accordionExample">
  <div>    
      
      <b data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="p-3" style="cursor: pointer;" >
        Profile Details.
      </b>

    <div id="collapseOne" class="collapse show p-3" aria-labelledby="headingOne" data-parent="#accordionExample" style="border-top:1px solid #ddd;">
      <div>
        <div>
      
      <form action="<?=base_url('index.php/action/edit')?>" method="post" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/edit')?>',this,'error_div','loder_div','#','1','editsave_2');">
        <div class="card-body">
            <div class="row">                       
                <div class="col-sm-6 col-md-12">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?=$profile_data['name'];?>" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type='email' readonly class='form-control' value='<?=$profile_data['email'];?>' name="email">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type='number' class='form-control' value='<?=$profile_data['contact']?>' name="phone" readonly>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Father Name</label>
                        <input type='text' class='form-control'  value="<?=$profile_data['father_name']?>" name='father_name'>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">College Name</label>
                        <input type='text' class='form-control' value='<?=$profile_data['college']?>' name="college">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Current Status</label>
                        <select name="current_status" class='form-control'> 
                           <?php 
                           $allstatus=$this->db->query("select * from yn_site_tags where stg_type='status' order by stg_tgid desc");
                           $show_status=$allstatus->result_array();
                           foreach($show_status as $status){
                           ?>
                           <option value="<?=$status['stg_name']?>" <?php if($profile_data['current_status']==$status['stg_name']) { echo 'selected';}?>><?=$status['stg_name']?></option>
                           <?php }?>
                           </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" placeholder="Address" value="<?=$profile_data['address']?>" name='add'>
                    </div>
                </div>
                <!-- <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <select class="form-control" name="country" onchange="load_new_state(this)">
                            <option>--Select--</option>
                            <?php 
                            $gethecnt=$this->db->query("select * from site_countries");
                            $cnt=$gethecnt->result_array();
                            foreach($cnt as $cntry){
                            ?>
                            <option value="<?=$cntry['country_id']?>" <?php if($cntry['country_id']==@$profile_data['user_country']) echo 'selected';?>><?=$cntry['country_name']?></option>
                            <?php }?>                                           
                        </select>
                    </div>
                </div> -->
                <!-- <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <select class="form-control" name="state" onchange="load_new_city(this)" id="get_state_data">
                        <select class="form-control" name="state" onchange="load_new_city(this)" id="state">
                            <option>--Select State--</option>
                            <option value="<?=@$profile_data['user_state']?>" selected><?=@$profile_data['user_state_name']?></option>
                            <?php //echo getState('101','1',@$profile_data['user_state'])?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <select class="form-control" name="city" id="get_cities_data" onchange="load_new_area(this)">
                            <option value="">Select City</option>
                            <option value="<?=@$profile_data['user_city']?>" selected><?=@$profile_data['user_city_name']?></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Area</label>
                        <select class="form-control" name="area" id="get_area_data" >
                            <option value="">Select Area</option>
                            <option value="<?=@$profile_data['user_area']?>" selected><?=@$profile_data['user_area_name']?></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">Don't find your Area ? <a href="<?=base_url('add-area')?>" class="text-secondary ml-1" target="_blank">Add New Area</a></div>                        
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Facebook</label>
                        <input type="text" class="form-control" placeholder="https://www.facebook.com/" value="<?=$profile_data['fb'];?>" name="fb">
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Twitter</label>
                        <input type="text" class="form-control" placeholder="https://twitter.com/" value="<?=$profile_data['tw'];?>" name="tw">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Instagram</label>
                        <input type="text" class="form-control" placeholder="https://instagram.com/" value="<?=$profile_data['insta'];?>" name="ins">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">About Me</label>
                        <textarea rows="5" class="form-control" placeholder="Enter About your description" name="about"><?=$profile_data['about'];?></textarea>
                    </div>
                </div>                           
                 -->
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary tra-black-hover ">Update Profile</button>
        </div>
      </form>

   </div>

      </div>
    </div>
  </div>

  <!-- <div class="card_profiles pt-2" style="border-top:1px solid #ddd;">    
        <b class="p-3" data-toggle="collapse" data-target="#collapseThree2" aria-expanded="true" aria-controls="collapseThree2" id="clcik_23435" >
        Change Password</b>
    <div id="collapseThree2" class="collapse p-3" aria-labelledby="headingThree2" data-parent="#accordionExample">
      <div>
      <div>
      <form action="<?=base_url('index.php/action/password_change')?>" method="post" onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/password_change')?>',this,'error_div','loder_div','#','1','editsave');" class='account-form' >
     <div class="row">
     <div class="panel-body col-12" style="padding-top: 20px;">
    <label>Current Password*</label>
    <input type="password" name="pass" placeholder="Current password" class="form-control">
    <label>New Password : </label>
    <input type="password" name="pass1" placeholder="New password" class="form-control">
    <label>Confirm Password : </label>
      <input type="password" name="pass2" placeholder="Repeat New password" class="form-control">
      <div class="col-12 form-group mt-2">
          <button type="submit" class="btn btn-primary tra-black-hover ">Update</button>
      </div>
    </div>
    </div>
    </form>
   </div>
      </div>
    </div>
  </div> -->
</div>
  </div>
  <div class="col-md-4">
    <?php include_once('inc/profile_card.php'); ?>
  </div>

 </div>
</div>