<style type="text/css">
  .container{width: 99% !important;}
  .container{max-width: 1900px !important;}
</style>

<section id="contact" class="contact-area pt-145 pb-245" style="background-image:url(<?=base_url('assets/theme/img/')?>shape/12.png)">
    <div class="container pt-sm-4 ">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="container p-0">
                 <div class="row p-0">
                  <div class="col-12" >
                    <div class="table-responsive">
                      <div class="table-responsive">
                          <table class="table table-borderless">
                            <tbody>
                              <?php 
                              foreach($slides as $slide){
                                $url=base_url('assets/avator/upload/content/').$slide['content_file'];
                              ?>
                              <h4><?=$slide['name']?></h4>
                              <div style="position:relative;border: 10px solid blue;">
                                <!-- <iframe style="width:100%;height:700px;" class="mt-3" src="<?=base_url('assets/avator/upload/content/')?><?=$slide['content_file']?>" width="100%" height="100%"></iframe> -->
                                <!-- <iframe style="width:100%;height:700px;" class="mt-3" src="<?=$url?>&embedded=true" style="width:550px; height:450px;" frameborder="0"></iframe> -->
                                <iframe style="width:100%;height:700px;" class="mt-3" src="https://view.officeapps.live.com/op/embed.aspx?src=<?=$url?>" width="100%" height="100%"> </iframe>
                              </div>
                              <?php } ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
