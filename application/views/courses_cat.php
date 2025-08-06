<section class="teacher__area pt-115 pb-110">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3">
                     <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">Our Courses <!-- <br>
                           Popular <span class="yellow-bg"> Teachers <img src="assets/img/shape/yellow-bg-2.png" alt="">  </span> <br> -->
                        </h2>
                        <!-- <p>You don't have to struggle alone, you've got our assistance and help.</p> -->
                     </div>
                  </div>
               </div>
               <div class="row justify-content-center">
               	<?php foreach($show_courses as $course){?>
                  <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                     <div class="teacher__item text-center grey-bg-5 transition-3 mb-30">
                        <div class="teacher__thumb w-img fix">
                           <a href="<?=base_url('courses?cat=')?><?=$course['ctid']?>">
                              <img src="<?=base_url('assets/avator/upload/')?><?=$course['img']?>" alt="">
                           </a>
                        </div>
                        <div class="teacher__content">
                           <h3 class="teacher__title"><a href="<?=base_url('courses?cat=')?><?=$course['ctid']?>"><?=$course['name']?></a></h3> 
                        </div>
                     </div>
                  </div>
                  <?php }?>
                  
               </div>
            </div>
         </section>