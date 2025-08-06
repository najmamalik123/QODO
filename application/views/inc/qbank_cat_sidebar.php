<div class="col-xxl-4 col-xl-4 col-lg-4">
 <div class="course__sidebar pl-70">
    <div class="course__sidebar-widget shadow_3" style="background-color: #CEE9DB;">
      <div class="course__sidebar-info">
        <h3 class="qbank__sidebar-title">Categories</h3>
        <ul>
          <li>
             <div class="qbank__sidebar-check mb-10 d-flex align-items-center">
               <label class="m-check-label" for="home"><i class="fas fa-arrow-right"></i> <a href="<?=base_url()?>">Home</a></label>
             </div>
          </li>
          <?php  
          $show_courses=@$_SESSION['categories'];
          foreach($show_courses as $course){
             if($course['display']=='1' && $course['type']=='qbank'){
              $cat_url=base_url('qbank-series?cat=').$course['ctid'];
              if($course['ctid']=='14' || $course['ctid']=='17'){
                $cat_url=base_url('qbank-questions?cat=').$course['ctid'];}
              ?>
          <li>
             <div class="qbank__sidebar-check mb-10 d-flex align-items-center">
               <label class="m-check-label" for="m-eng<?=$course['ctid']?>"><i class="fas fa-arrow-right"></i> <a href="<?=$cat_url?>"><?=$course['name']?></a></label>
             </div>
          </li>
          <?php }}?>
          <?php if(isset($_SESSION['yid']) && $_SESSION['yid']>'0'){?>
          <li>
             <div class="qbank__sidebar-check mb-10 d-flex align-items-center">
               <label class="m-check-label"><i class="fas fa-arrow-right"></i> <a href="<?=base_url('profile')?>">My Profile</a></label>
             </div>
          </li>
          <li>
             <div class="qbank__sidebar-check mb-10 d-flex align-items-center">
               <label class="m-check-label"><i class="fas fa-arrow-right"></i> <a href="<?=base_url('logout')?>">Logout</a></label>
             </div>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
 </div>
</div>