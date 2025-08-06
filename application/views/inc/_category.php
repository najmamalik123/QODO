
    
        
        
        <div class="container margin_60_35">
            <div class="main_title_3">
                    <h2>Top Categories</h2>
                    <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                    <a href="all-categories.html">View all</a>
                </div>
            <div class="row justify-content-center">
                
            <?php
            $cats = get_web_elements('cat', '1', '9');
            foreach ($cats as $cat) {
            ?>

            <div class="col-lg-4 col-sm-6">
                    <a href="grid-listings-filterstop.html" class="grid_item">
                        <figure>
                              <?= $cat['icon'] ?>
                            <div class="info">
                                <small><?=trim_text($cat['desc'],90)?></small>
                                <em><i class="icon-comment"></i> 323 Reviews</em>
                                <a href="<?= base_url('search?cat=' . $cat['ctid'] . '&catname=' . url_smart($cat['name'])) ?>">
                                <h5 class="title"><?= $cat['name'] ?></h5>
                            </a>
                            </div>
                        </figure>
                    </a>
                </div>
            <?php } ?>


        </div>
    </div>
