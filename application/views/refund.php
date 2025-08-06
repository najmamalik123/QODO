
    <!--============= Privacy Section Starts Here =============-->
    <section class="privacy-section padding-top padding-bottom py-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 text-left bg-light shadow_2 p-sm-3">
                    <?php $page_data=get_page_data('refund','na'); 
					echo str_replace("{{sitename}}",$site_name, $page_data['content']); ?>
                </div>
            </div>
        </div>
    </section>
    <!--============= Privacy Section Ends Here =============-->

