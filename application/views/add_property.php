<style>
    label {
        font-size: 11px;
    }
</style>
<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <!-- Follow People -->
                            <div class="ms-1">
                                <!-- Feeds -->
                                <div class="feeds" id="feed">
                                    <div class="card mb-3 p-3 shadow-sm">
                                        <!-- Add Property Tab -->
                                        <h5>Add Property</h5>

                                        <?php
                                        $what = 'add_property';
                                        $theidval = '';
                                        if (isset($_GET['edit']) && $_GET['edit'] != '') {
                                            $id = $_GET['edit'];
                                            $property_row = $this->db->query("select * from x_home_property where prop_id='$id' ");
                                            $prop = $property_row->row_array();
                                            $what = 'edit_property';
                                            $theidval = $_GET['edit'];
                                        }
                                        ?>
                                        <form method="post" action="<?= base_url('action/add_property'); ?>" onsubmit="return uploadandform('<?= base_url('action/add_property') ?>','post',this,'image_name','progress_value_sc','prog_valie_text','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');" enctype="multipart/form-data">
                                            <input type="hidden" name="what" value="<?= $what ?>">
                                            <input type="hidden" name="prop_id" value="<?= $theidval ?>">
                                            <div class="row my-2">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="prop_name">Property Name</label>
                                                        <input type="text" name="prop_name" class="form-control" id="prop_name" value="<?= @$prop['prop_name'] ?>" placeholder="Property Name">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <!-- Category select-->
                                                    <div class="form-group mb-3">
                                                        <label for="category">Category</label>
                                                        <select class="form-control rounded-5" id="category" name="prop_category" onchange="load_subcat(this);">
                                                            <option value="" disabled selected>Select Category</option>
                                                            <?php $getCategories = $this->db->query("SELECT * FROM yn_site_catagory ORDER BY ctid");
                                                            $categories = $getCategories->result_array();
                                                            foreach ($categories as $category) : ?>
                                                                <option value="<?= $category['ctid'] ?>" <?=
                                                                                                            @$prop['prop_cat'] == $category['ctid'] ? 'selected' : ''
                                                                                                            ?>><?= $category['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <!-- Sub Category select-->
                                                    <div class="form-group mb-3">
                                                        <label for="get_subcat_data">Sub Category</label>
                                                        <select class="form-control rounded-5" id="get_subcat_data" name="prop_sub_category">
                                                            <option value="" disabled selected>Select Sub Category</option>
                                                            <?php
                                                            if (isset($prop['prop_scat']) && $prop['prop_scat'] != '') {
                                                                $getSubCategories = $this->db->query("SELECT * FROM yn_site_sub_cat WHERE sc_ctid = " . $prop['prop_cat'] . " ORDER BY sc_id");
                                                                $sub_categories = $getSubCategories->result_array();

                                                                foreach ($sub_categories as $sub_category) { ?>
                                                                    <option value="<?= $sub_category['sc_id'] ?>" <?= @$prop['prop_scat'] == $sub_category['sc_id'] ? 'selected' : '' ?>><?= $sub_category['sc_name'] ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="prop_rent_sale">Property For</label>
                                                        <select class="form-control rounded-5" id="prop_rent_sale" name="prop_rent_sale" data-sb-validations="required">
                                                            <option value="" disabled selected>Property For</option>
                                                            <option value="Rent" <?= @$prop['prop_rent_sale'] == 'Rent' ? 'selected' : '' ?>>Rent</option>
                                                            <option value="Sale" <?= @$prop['prop_rent_sale'] == 'Sale' ? 'selected' : '' ?>>Sale</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="prop_area">Area</label>
                                                        <input type="text" name="prop_area" id="prop_area" class="form-control rounded-5" placeholder="eg 240 sqft" value="<?= @$prop['prop_area'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <!-- Bedroom select -->
                                                    <div class="form-group mb-3">
                                                        <label for="bedroom">Number of Bedrooms</label>
                                                        <select name="prop_bedroom" id="bedroom" class="form-control">
                                                            <option value="" disabled selected>Select Bedrooms</option>
                                                            <option value="1" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>1</option>
                                                            <option value="2" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>2</option>
                                                            <option value="3" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>3</option>
                                                            <option value="4" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>4</option>
                                                            <option value="5" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>5</option>
                                                            <option value="5+" <?= (@$prop['prop_bedroom']) ? 'selected' : '' ?>>5+</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <!-- Bathroom select -->
                                                    <div class="form-group mb-3">
                                                        <label for="bathroom">Number of Bathrooms</label>
                                                        <select name="prop_bathroom" id="bathroom" class="form-control">
                                                            <option value="" disabled selected>Select Bathrooms</option>
                                                            <option value="1" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>1</option>
                                                            <option value="2" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>2</option>
                                                            <option value="3" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>3</option>
                                                            <option value="4" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>4</option>
                                                            <option value="5" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>5</option>
                                                            <option value="5+" <?= (@$prop['prop_bathroom']) ? 'selected' : '' ?>>5+</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <!-- Facing select -->
                                                    <div class="form-group mb-3">
                                                        <label for="facing">Facings</label>
                                                        <select name="prop_facing" id="facing" class="form-control">
                                                            <option value="" disabled selected>Select Facing</option>
                                                            <option value="North" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North</option>
                                                            <option value="East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>East</option>
                                                            <option value="South" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South</option>
                                                            <option value="West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>West</option>
                                                            <option value="North-East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North-East</option>
                                                            <option value="North-West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>North-West</option>
                                                            <option value="South-East" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South-East</option>
                                                            <option value="South-West" <?= (@$prop['prop_facing']) ? 'selected' : '' ?>>South-West</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <!-- Is Furbished select -->
                                                    <div class="form-group mb-3">
                                                        <label for="is_furbished">Is Furnished</label>
                                                        <select name="prop_furnished" id="is_furbished" class="form-control">
                                                            <option value="" disabled selected>Select option</option>
                                                            <option value="Yes" <?= (@$prop['prop_furnished'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                                                            <option value="No" <?= (@$prop['prop_furnished'] == 'No') ? 'selected' : '' ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="floor">Floor Number</label>
                                                        <input type="number" name="prop_floor" id="floor" min="0" class="form-control" placeholder="Enter floor number" value="<?= @$prop['prop_floor'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="total_floors">Total Floors in Building</label>
                                                        <input type="number" name="prop_total_floors" min="0" id="total_floors" class="form-control" placeholder="Enter total floors" value="<?= @$prop['prop_total_floors'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="balcony">Number of Balconies</label>
                                                        <input type="number" name="prop_balcony" min="0" id="balcony" class="form-control" placeholder="Enter number of balconies" value="<?= @$prop['prop_balcony'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <select name="prop_state" id="state" class="form-control" onchange="load_new_city(this);">
                                                            <option value="">Select State</option>
                                                            <?= getState('101', '1', @$prop['prop_state']) ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="get_cities_data">City</label>
                                                        <select name="prop_city" id="get_cities_data" class="form-control">
                                                            <?php if (isset($prop['prop_city']) && $prop['prop_city']) {
                                                                $seletedCity = $prop['prop_city'];
                                                                getCity($prop['prop_state'], '1', $prop['prop_city']);
                                                            } else {
                                                                getState('101', '1', @$prop['prop_state']);
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="prop_address" class="form-control" id="address" value="<?= @$prop['prop_address'] ?>" placeholder="Address">
                                                    </div>
                                                </div>

                                               <div class="col-md-6 col-12">
                                                    <!-- Price dropdown -->
                                                    <div class="form-group mb-3">
                                                        <label for="prop_price">Price</label>
                                                        <select name="prop_price" id="prop_price" class="form-control rounded-5">
                                                            <option value="">Select Price Range</option>
                                                            <option value="100000-200000" <?= (@$prop['prop_price'] == '100000-200000') ? 'selected' : '' ?>>100,000 - 200,000</option>
                                                            <option value="200001-300000" <?= (@$prop['prop_price'] == '200001-300000') ? 'selected' : '' ?>>200,001 - 300,000</option>
                                                            <option value="300001-400000" <?= (@$prop['prop_price'] == '300001-400000') ? 'selected' : '' ?>>300,001 - 400,000</option>
                                                            <option value="400001-500000" <?= (@$prop['prop_price'] == '400001-500000') ? 'selected' : '' ?>>400,001 - 500,000</option>
                                                            <option value="500001-1000000" <?= (@$prop['prop_price'] == '500001-1000000') ? 'selected' : '' ?>>500,001 - 1,000,000</option>
                                                            <option value="1000001-1500000" <?= (@$prop['prop_price'] == '1000001-1500000') ? 'selected' : '' ?>>1,000,001 - 1,500,000</option>
                                                            <option value="1500001-2000000" <?= (@$prop['prop_price'] == '1500001-2000000') ? 'selected' : '' ?>>1,500,001 - 2,000,000</option>
                                                            <option value="2000001-2500000" <?= (@$prop['prop_price'] == '2000001-2500000') ? 'selected' : '' ?>>2,000,001 - 2,500,000</option>
                                                            <option value="2500001-3000000" <?= (@$prop['prop_price'] == '2500001-3000000') ? 'selected' : '' ?>>2,500,001 - 3,000,000</option>
                                                            <option value="3000001-3500000" <?= (@$prop['prop_price'] == '3000001-3500000') ? 'selected' : '' ?>>3,000,001 - 3,500,000</option>
                                                            <option value="3500001-4000000" <?= (@$prop['prop_price'] == '3500001-4000000') ? 'selected' : '' ?>>3,500,001 - 4,000,000</option>
                                                            <option value="4000001-4500000" <?= (@$prop['prop_price'] == '4000001-4500000') ? 'selected' : '' ?>>4,000,001 - 4,500,000</option>
                                                            <option value="4500001-5000000" <?= (@$prop['prop_price'] == '4500001-5000000') ? 'selected' : '' ?>>4,500,001 - 5,000,000</option>
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-md-6 col-12">
                                                    <!-- Image input-->
                                                    <div class="form-group mb-3">
                                                        <label for="prop_img1">Thumbnail Image
                                                            <!-- (<small class="text-danger">You can add more images later</small>) -->
                                                        </label>
                                                        <input type="file" name="prop_img1" id="prop_img1" class="form-control rounded-5" accept="image/*">
                                                        <input type="hidden" name="old_img" id="image_name" value="<?= @$prop['prop_img1'] ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <!-- Image input-->
                                                    <div class="form-group mb-3">
                                                        <label for="prop_img1">Brochure
                                                            <!-- (<small class="text-danger">You can add more images later</small>) -->
                                                        </label>
                                                        <input type="file" name="prop_brochure" id="prop_img1" class="form-control rounded-5" accept="image/*">
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="prop_amenity_list">Amenitiess</label>
                                                        <select name="prop_amenity_list[]" id="prop_amenity_list" class="form-control" multiple>
                                                            <option value="" disabled>Select Amenities</option>

                                                            <?php
                                                            $selectedAmenities = !empty($prop['prop_amenity_list']) ? explode(',', $prop['prop_amenity_list']) : [];

                                                            $getAmenities = $this->db->query("SELECT * FROM yn_site_tags WHERE stg_type = 'amenity' ORDER BY stg_tgid");

                                                            foreach ($getAmenities->result_array() as $amenity) {
                                                                $amenityId = $amenity['stg_tgid'];
                                                                $amenityName = $amenity['stg_name'];
                                                                $selectedAmenity = in_array($amenityId, $selectedAmenities) ? 'selected' : ''; ?>

                                                                <option value="<?= $amenityId ?>" <?= $selectedAmenity ?>><?= $amenityName ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="prop_furnish_list">Facilities</label>
                                                        <select name="prop_furnish_list[]" id="prop_furnish_list" class="form-control" multiple>
                                                            <option value="" disabled>Select Facilities</option>

                                                            <?php
                                                            $selectedFacilities = !empty($prop['prop_furnish_list']) ? explode(',', $prop['prop_furnish_list']) : [];

                                                            $getFacilities = $this->db->query("SELECT * FROM yn_site_tags WHERE stg_type = 'furnished' ORDER BY stg_tgid");

                                                            foreach ($getFacilities->result_array() as $facily) {
                                                                $facilyId = $facily['stg_tgid'];
                                                                $facilyName = $facily['stg_name'];
                                                                $selectedFacility = in_array($facilyId, $selectedFacilities) ? 'selected' : ''; ?>

                                                                <option value="<?= $facilyId ?>" <?= $selectedFacility ?>><?= $facilyName ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="youtube">Youtube Link</label>
                                                        <input type="text" name="prop_youtube" class="form-control" id="youtube" value="<?= @$prop['prop_youtube'] ?>" placeholder="Video Link">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="prop_vendor" value="<?= $_SESSION['yid'] ?>">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="s_s9iskls90s">Google Map</label>
                                                        <small>(You can get a map for free from here:
                                    						<b> <a href="https://www.embedgooglemap.net/" target="_blank"> Map Link </a></b>)
                                    					</small>
                                                        <textarea class="form-control mb-2 "  placeholder="Google Map Address" name="prop_map"><?= @$prop['prop_map'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="s_s9iskls90s">Description</label>
                                                        <textarea class="form-control mb-2 rich_text" id="s_s9iskls90s" placeholder="Property Details" name="prop_desc"><?= @$prop['prop_desc'] ?></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-login mt-2 mb-2 rounded-pill">Add / Edit Property</button>

                                        </form>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            function load_subcat(categoryElement) {
                var categoryId = categoryElement.value;

                // If category is not selected, do nothing
                if (!categoryId) return;

                // Make an AJAX call to the server to get the subcategories
                $.ajax({
                    url: '<?= base_url("action/get_subcategories"); ?>', // Your PHP handler URL
                    method: 'GET',
                    data: {
                        cat_id: categoryId
                    }, // Send the category ID as a parameter
                    success: function(response) {
                        // Clear the subcategory dropdown
                        $('#get_subcat_data').html('<option value="" disabled selected>Select Sub Category</option>');

                        // Append the new subcategory options
                        if (response) {
                            var subcategories = JSON.parse(response);
                            subcategories.forEach(function(subcategory) {
                                $('#get_subcat_data').append('<option value="' + subcategory.sc_id + '">' + subcategory.sc_name + '</option>');
                            });
                        }
                    },
                    error: function() {
                        alert('Error loading subcategories');
                    }
                });
            }
        </script>
        <?php include 'inc/_lsidebar.php' ?>
    </div>
</div>
</div>