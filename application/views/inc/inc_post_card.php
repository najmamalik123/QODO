<?php if (isset($_SESSION['yid'])) { ?>
	<div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white" data-bs-toggle="modal" data-bs-target="#postModal">
		<!--<span class="input-group-text material-icons border-0 bg-white text-primary">account_circle</span>-->
		<img src="<?= base_url('assets/mem/' . $_SESSION['yid'] . '/img/' . $_SESSION['photo']) ?>" style="    width: 55px; border-radius: 50%; padding: 4px;">
		<input type="text" class="form-control border-0 fw-light ps-1" placeholder="What's on your mind." readonly>
		<a href="#" class="text-decoration-none input-group-text bg-white border-0 material-icons text-primary d-flex">add_circle</a>
	</div>
<?php } else { ?>
	<div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white" onclick="window.location.href='<?= base_url('login') ?>'">
		<span class="input-group-text material-icons border-0 bg-white text-primary">account_circle</span>
		<input type="text" class="form-control border-0 fw-light ps-1" placeholder="What's on your mind." readonly>
		<a href="#" class="text-decoration-none input-group-text bg-white border-0 material-icons text-primary">add_circle</a>
	</div>
<?php } ?>