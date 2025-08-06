<!--<div class="col-md-4 mb-4">-->
	<a href="<?= base_url('property') ?>/<?= $row['prop_id'] ?>/<?= url_smart($row['prop_name']) ?>" style="text-decoration: none;">
		<div class="card border-0 shadow-sm position-relative">
			<?php if (!empty($row['prop_img1'])) { ?>
				<img src="<?= base_url('assets/avator/upload/' . $row['prop_img1']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Property Image">
				<!--<span class="badge bg-dark position-absolute top-0 start-0 m-2">Ready To Move</span>-->
			<?php } ?>

			<div class="card-body">
			    <div class="d-flex justify-content-between">
				<h5 class="card-title text-dark mb-2" style="font-size: 16px;"><?= $row['prop_name'] ?></h5>
				
				</div>
				<p class="card-text text-muted mb-1" style="font-size: 13px;">
					<?= $row['prop_bedroom'] ?> BHK <?= $row['prop_type'] ?> | <?= $row['prop_address'] ?>
				</p>
				<p class="text-primary fw-bold mb-2" style="font-size: 14px;">₹<?= number_format($row['prop_price']) ?></p>

				<div class="d-flex flex-wrap text-muted" style="font-size: 12px;">
					<div class="me-3 mb-1">
						<i class="fa fa-bed me-1 fa-sm"></i><?= $row['prop_bedroom'] ?> Beds
					</div>
					<div class="me-3 mb-1">
						<i class="fa fa-home me-1 fa-sm"></i><?= $row['prop_area'] ?> sqft
					</div>
					<div class="mb-1">
						<i class="fa fa-map-marker-alt me-1 fa-sm"></i><?= $row['prop_city'] ?>
					</div>
				</div>
				<a href="javascript:void(0)"
   class="btn btn-membership rounded-pill enquire-btn"
   style="font-size: 11px;padding: 2px 18px; width: 100%; margin-top: 10px;"
   data-bs-toggle="modal"
   data-bs-target="#inquiryModal"
   data-id="<?= $row['prop_id'] ?>"
   data-name="<?= $row['prop_name'] ?>">
   Enquire Now
</a>

			</div>
		</div>
	</a>
<!--</div>-->