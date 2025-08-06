<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 card shadow my-5 p-5">
            <h2 class="pt-2">Get Help </h2>
            <span>Please fill this form if you need any help.</span><br>
            <form class="contact__form--inner" action="<?=base_url('index.php/action/help')?>" method="post"
                id="contactForm" novalidate="novalidate"
                onsubmit="return ajaxsubmitform('<?=base_url('index.php/action/help')?>',this,'error_div','loder_div','#','1','contacted');">
                <input type="hidden" name="name" value="<?=$_SESSION['name']?>">
                <input type="hidden" name="email" value="<?=$_SESSION['email']?>">
                <?php
                          $getfeatures = $this->db->query("select * from yn_prod_feature");
                          $althefeatures = $getfeatures->result_array();

                          $uniqueVehicles = array();
                          $uniqueModels = array();

                          foreach ($althefeatures as $feature) {
                              if (!in_array($feature['pf_vehicle'], $uniqueVehicles)) {
                                  $uniqueVehicles[] = $feature['pf_vehicle'];
                              }

                              if (!in_array($feature['pf_model'], $uniqueModels)) {
                                  $uniqueModels[] = $feature['pf_model'];
                              }
                          }
                          ?>

                <div class="col-sm-12">
                    <label for="pf_vehicle">Select Vehicle:</label>
                    <select class="form-control p-3" name="p_vehicle" id="pf_vehicle">
                        <option value="">Select Vehicle Brand</option>
                        <?php foreach ($uniqueVehicles as $vehicle) { ?>
                        <option value="<?=$vehicle?>"
                            <?php if ( @$product_data['p_vehicle'] == $vehicle) echo 'selected'; ?>>
                            <?=$vehicle?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-12">
                    <label for="pf_model">Select Model:</label>
                    <select class="form-control p-3" name="p_model" id="pf_model">
                        <option value="">Select Model</option>
                        <?php foreach ($uniqueModels as $model) { ?>
                        <option value="<?=$model?>">
                            <?=$model?>
                        </option>
                        <?php } ?>
                    </select>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                $(document).ready(function() {
                    $("#pf_vehicle").on("change", function() {
                        var selectedVehicle = $(this).val();
                        var modelSelect = $("#pf_model");

                        modelSelect.empty();

                        $.each(<?php echo json_encode($althefeatures); ?>, function(index,
                            feature) {
                            if (feature.pf_vehicle === selectedVehicle) {
                                modelSelect.append($("<option></option>").attr("value",
                                    feature.pf_model).text(feature.pf_model));
                            }
                        });
                    });
                });
                </script>

                <div class="col-sm-12">
                    <label for="pf_year">Select Year:</label>
                    <select class="form-control p-3" name="p_year" id="pf_year">
                        <option value="">Select Year</option>
                        <?php 
                                  $uniqueYears = array();
                                  foreach($althefeatures as $feature) {
                                      if (!in_array($feature['pf_year'], $uniqueYears)) {
                                          $uniqueYears[] = $feature['pf_year'];
                                ?>
                        <option name="p_year" value="<?=$feature['pf_year']?>"> <?=$feature['pf_year']?></option>
                        <?php
                                      }
                                  }
                                ?>
                    </select>
                </div>

                <div class="col-sm-12">
                    <label for="pf_fuel">Select Fuel:</label>
                    <select class="form-control p-3" name="p_fuel" id="pf_fuel">
                        <option value="">Select Fuel</option>
                        <?php 
                                  $uniqueFuels = array();
                                  foreach($althefeatures as $feature) {
                                      if (!in_array($feature['pf_fuel'], $uniqueFuels)) {
                                          $uniqueFuels[] = $feature['pf_fuel'];
                                ?>
                        <option name="p_fuel" value="<?=$feature['pf_fuel']?>"
                            <?php if ( @$product_data['p_fuel'] == $feature['pf_fuel']) echo 'selected'; ?>>
                            <?=$feature['pf_fuel']?></option>
                        <?php
                                      }
                                  }
                                ?>
                    </select>
                </div>

                <div class="col-sm-12">
                    <label for="pf_fuel">Message:</label>
                    <textarea name="p_mess" class="form-control" cols="10" rows="5"></textarea>
                </div>
                <div class="col-sm-12 mt-3">
                    <button type="submit" class="contact__form--btn rounded-0 primary__btn">Get Help</button>
                </div>
            </form>
        </div>
    </div>
</div>