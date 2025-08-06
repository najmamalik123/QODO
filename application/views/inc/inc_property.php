<div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
    <!-- <div class="d-flex align-items-center">
		
		<div class="me-3">
			<img src="<?= base_url('assets/avator/site_img.png') ?>" class="img-fluid rounded-circle user-img" alt="profile-img" style="width: 40px; height: 40px;">
		</div>
		
		<div class="w-100">
				<div class="d-flex align-items-center justify-content-between">
				<div class="ms-0">
					<a class="text-decoration-none">
						<h6 class="mb-0 d-flex align-items-start text-body fs-6 fw-bold"><?= $site_name ?>

							<span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
						</h6>
						<p class="text-muted mb-0">Property Investor</p>
					</a>
				</div>
				<div class="d-flex align-items-center small">
					<p class="text-muted mb-0"><?= date("d M", strtotime($row['prop_date'])) ?></p>
				</div>
			</div>
		</div>
	</div> -->
    <!--<a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" class="row" style="text-decoration:none;">-->
                    <div class="">
                        <div class="row pb-3">
                <!-- Image on the left -->
                <div class="col-md-3">
                    <?php if (!empty($row['prop_img1'])): ?>
                        <img src="<?= base_url('assets/avator/upload/' . $row['prop_img1']) ?>" class="img-fluid rounded w-100" alt="Property Image" style="max-height: 250px; object-fit: cover;">
                    <?php endif; ?>
                </div>
            
                <!-- Details on the right -->
                <div class="col-md-9">
                    <a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" class="row" style="text-decoration:none;">
                    <h5 class="mb-2"><?= htmlspecialchars($row['prop_name']) ?></h5>
                    </a>
            
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Price:</strong> ₹<?= number_format($row['prop_price']) ?></p>
                            <p class="mb-1"><strong>Bedrooms:</strong> <?= $row['prop_bedroom'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Area:</strong> <?= $row['prop_area'] ?> sqft</p>
                            <p class="mb-1"><strong>Address:</strong> <?= htmlspecialchars($row['prop_address']) ?></p>
                        </div>
                    </div>
            
                    <p class="text-muted"><?= strip_tags(trim_text($row['prop_desc'], '400', '...')) ?></p>
                     <!-- Horizontal Line -->
           
                </div>
                
            </div>
             <hr class="my-1">
            
                    <!-- Bottom Action Row -->
                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-3">
                        <?php
                            $prop_id = $row['prop_id'];
                            $this->db->where('property', $prop_id);
                            $leadCount = $this->db->count_all_results('yn_site_contact');
                        ?>
                        <a href="<?= base_url('leads') ?>?property=<?= $prop_id ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
                            View Leads (<?= $leadCount ?? 0 ?>)
                        </a>
                        <a href="<?= base_url('add-property') ?>?edit=<?= $prop_id ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1">
                            Edit
                        </a>
                        <a href="<?= base_url('action/delete_property') ?>?delete=<?= $prop_id ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                            Delete
                        </a>
                    </div>

        </div>
    <!--</a>-->
</div>