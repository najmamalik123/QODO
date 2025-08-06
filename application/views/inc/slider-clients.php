<?php $getBrandSlider = $this->db->query("SELECT * FROM yn_site_img WHERE img_place = 'slider1' ORDER BY img_sort DESC limit 6");
if ($getBrandSlider->num_rows() > 0) { ?>
    <div class="edu-brand-area brand-area-6">
        <div class="container">
            <div class="section-title section-center sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <h2 class="title">Our Partners</h2>
                <span class="shape-line"><i class="icon-19"></i></span>
            </div>
            <div class="brand-grid-wrap brand-style-2">
                <?php foreach ($getBrandSlider->result_array() as $simg) { ?>
                    <div class="brand-grid">
                        <img src="<?= base_url('assets/avator/upload/' . $simg['img_name']) ?>" alt="<?= $simg['img_text'] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>