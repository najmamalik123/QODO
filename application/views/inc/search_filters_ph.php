<div class="card search-filter">
								<div class="card-header">
									<h4 class="card-title mb-0">Filters</h4>
								</div>
								<?php
                            @$check_cookie_state=$this->input->cookie('user-state', TRUE);
                            @$check_cookie_city=$this->input->cookie('user-city', TRUE);
                            @$user_city_name=$this->input->cookie('user_city_name', TRUE);
                             ?>
							<form action="<?=base_url('action/smart-search2')?>" method="get">
								<div class="card-body">

                                <div class="form-group">
                                    <span class="form-text">What are you looking for?</span>
                                      <select class="form-control" name="service">
                                           <option value='p' >Pharmacy</option>
                                           <option value='b' >Blood Bank</option>
                                          <option value='e' >Emergency Service Providers</option>
                                        </select>
                                </div> <div class="form-group">
                                       <select class="form-control" name="state" onchange="load_new_city(this)" >
                                            <option value="">Select State</option>
                                            <?=getState('101','1',@$check_cookie_state)?>
                                        </select>
                                </div><div class="form-group">
                                       <select class="form-control" name="city" id="get_cities_data" >
                                            <option value="">Select City</option>
                                            <option value="<?=@$check_cookie_city?>" selected><?=@$user_city_name?></option>
                                        </select>
                                </div>
                            


								<div class="filter-widget">
									<!-- <div class="cal-icon"> -->
										<!-- <input type="text" class="form-control datetimepicker" placeholder="Select Date"> -->
										<input type="text" name="q" class="form-control" placeholder="Search By name" value="<?=@$_GET['q']?>">
									<!-- </div>			 -->
								</div>
								
								<div class="filter-widget">
									<h4>More Filters</h4>
									<?php 
									$specility_array=array();
									if(isset($_GET['specility']) && @$_GET['specility'] !=''){
										$specility_data=$_GET['specility'];
										$specility_array=explode(',', $specility_data);
									}
									$atheadmins=getTags('1','f');
                                    foreach($atheadmins as $tags_data){
									?>
									<div>
										<label class="custom_check">
											<input type="checkbox" name="specility[]" value="<?=@$tags_data['stg_name']?>" <?php if( in_array(@$tags_data['stg_name'], @$specility_array) ){echo "checked";}  ?> >
											<span class="checkmark"></span> <?=$tags_data['stg_name']?>
										</label>
									</div>
									<?php } ?>
								</div>
									<div class="btn-search">
										<button type="submit" class="btn btn-block">Search</button>
									</div>	
								</div>
							</form>
							</div>