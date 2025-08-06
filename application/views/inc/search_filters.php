			<div class="col-lg-3">
				<div class="edu-course-sidebar">
					<form action="<?= base_url('action/smart_search'); ?>">
						<div class="edu-course-widget widget-category">
							<div class="inner">
								<?php
								$cat = array();
								if (isset($_GET['cat']) && $_GET['cat'] != '')
									$cat = @explode(",", $_GET['cat']);

								$categories = get_web_elements('cat', '1', '10');

								if (is_array($categories) && count($categories) > 0) { ?>
									<h5 class="widget-title">Filter by Categories</h5>
									<div class="content">
										<?php
										$counter = 1;
										$counter2 = 1;
										foreach ($categories as $category) {
											$cat_id = $category['ctid'];
											// $rowcount = $this->db->query("select course_id from x_edu_courses where course_cat='$cat_id'");
											// $countdatass=$rowcount->num_rows();
										?>
											<div class="edu-form-check">
												<input type="checkbox" name="cat[]" value="<?= $cat_id ?>" id="cat-check<?= $counter++ ?>" <?php if (in_array($category['ctid'], $cat)) {
																																				echo 'checked';
																																			} ?>>
												<label for="cat-check<?= $counter2++ ?>"><?= $category['name'] ?>
													<!-- <span>(<?php //echo $countdatass 
																?>)</span> -->
												</label>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
						<!-- <div class="edu-course-widget widget-instructor">
						<div class="inner">
							<h5 class="widget-title">Instructor</h5>
							<div class="content">
								<div class="edu-form-check">
									<input type="checkbox" id="inst-check1">
									<label for="inst-check1">Madge Alvarez <span>(2)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="inst-check2">
									<label for="inst-check2">Tyler Hardy <span>(14)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="inst-check3">
									<label for="inst-check3">Dabiv Matina <span>(10)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="inst-check4">
									<label for="inst-check4">Robbin Lee <span>(5)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="inst-check5">
									<label for="inst-check5">Donald Logan <span>(2)</span></label>
								</div>
							</div>
						</div>
					</div> -->
						<!-- <div class="edu-course-widget widget-level">
						<div class="inner">
							<h5 class="widget-title">Level</h5>
							<div class="content">
								<div class="edu-form-check">
									<input type="checkbox" id="level-check1">
									<label for="level-check1">All Levels <span>(23)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="level-check2">
									<label for="level-check2">Beginner <span>(7)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="level-check3">
									<label for="level-check3">High <span>(10)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="level-check4">
									<label for="level-check4">Intermediate <span>(13)</span></label>
								</div>
							</div>
						</div>
					</div> -->
						<!-- <div class="edu-course-widget widget-language">
						<div class="inner">
							<h5 class="widget-title">Language</h5>
							<div class="content">
								<div class="edu-form-check">
									<input type="checkbox" id="lang-check1">
									<label for="lang-check1">English <span>(12)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="lang-check2">
									<label for="lang-check2">Spanish <span>(7)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="lang-check3">
									<label for="lang-check3">German <span>(5)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="lang-check4">
									<label for="lang-check4">Russian <span>(3)</span></label>
								</div>
								<div class="edu-form-check">
									<input type="checkbox" id="lang-check5">
									<label for="lang-check5">Korean <span>(2)</span></label>
								</div>
							</div>
						</div>
					</div> -->
						<div class="edu-course-widget widget-price">
							<div class="inner">
								<h5 class="widget-title">Price</h5>
								<div class="content">
									<div class="edu-form-check">
										<input type="radio" name="price" id="price-check2" value="" <?php if (@$_GET['price'] == '') echo 'checked'; ?>>
										<label for="price-check2">All</label>
									</div>
									<div class="edu-form-check">
										<input type="radio" name="price" value="0" id="price-check5" <?php if (@$_GET['price'] == '0') echo 'checked'; ?>>
										<label for="price-check5">Free</label>
									</div>
								</div>
							</div>
						</div>
						<div class="edu-course-widget widget-rating">
							<div class="inner">
								<h5 class="widget-title">Rating</h5>
								<div class="content">
									<div class="edu-form-check">
										<input type="radio" name="rating" value="5" id="rating-check55" <?php if (@$_GET['rating'] == '5') echo 'checked'; ?>>
										<label for="rating-check55">
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<span>(5)</span>
										</label>
									</div>
									<div class="edu-form-check">
										<input type="radio" name="rating" value="4" id="rating-check44" <?php if (@$_GET['rating'] == '4') echo 'checked'; ?>>
										<label for="rating-check44">
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="off icon-23"></i>
											<span>(4)</span>
										</label>
									</div>
									<div class="edu-form-check">
										<input type="radio" name="rating" value="3" id="rating-check33" <?php if (@$_GET['rating'] == '3') echo 'checked'; ?>>
										<label for="rating-check33">
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<span>(3)</span>
										</label>
									</div>
									<div class="edu-form-check">
										<input type="radio" name="rating" value="2" id="rating-check22" <?php if (@$_GET['rating'] == '2') echo 'checked'; ?>>
										<label for="rating-check22">
											<i class="icon-23"></i>
											<i class="icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<span>(2)</span>
										</label>
									</div>
									<div class="edu-form-check">
										<input type="radio" name="rating" value="1" id="rating-check11" <?php if (@$_GET['rating'] == '1') echo 'checked'; ?>>
										<label for="rating-check11">
											<i class="icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<i class="off icon-23"></i>
											<span>(1)</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<button class="edu-btn btn-medium btn-gradient" type="submit">Search</button>
					</form>
				</div>
			</div>