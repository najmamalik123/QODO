<style>
	@media only screen and (max-width: 600px) {
		ul li a {
			font-size: 12px !important
		}
	}
</style>

<ul class="nav nav-pills nav-justified mb-4 bg-white border-bottom">
	<li class="nav-item">
		<a class="nav-link <?= ($this->uri->segment(1) == 'edit') ? 'active' : '' ?>" href="<?= base_url('edit') ?>">Account Settings</a>
	</li>
	<?php if($profile_data['is_vendor'] =='1'){ ?>
	<li class="nav-item">
		<a class="nav-link <?= ($this->uri->segment(1) == 'kyc') ? 'active' : '' ?>" href="<?= base_url('kyc') ?>">KYC Verification</a>
	</li>
	<?php } ?>
	<!-- <li class="nav-item">
		<a class="nav-link <?= ($this->uri->segment(1) == 'become-investor') ? 'active' : '' ?>" href="<?= base_url('become-investor') ?>">Become Investor</a>
	</li> -->
</ul>