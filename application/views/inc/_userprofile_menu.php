<?php
$this->load->helper('url');
$total_segments = $this->uri->total_segments();
$second_to_last_segment = $this->uri->segment($total_segments - 1);
$last_segment = $this->uri->segment($total_segments);
?>

<ul class="top-osahan-nav-tab nav nav-pills justify-content-center nav-justified mb-4 shadow-sm rounded-4 overflow-hidden bg-white mt-4" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('userprofile/' . $profile_data['username']) ?>" class="p-3 nav-link text-muted <?= $second_to_last_segment == 'userprofile' ? 'active' : '' ?>">Feed</a>
	</li>
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('userliked/' . $profile_data['username']) ?>" class="p-3 nav-link text-muted <?= $second_to_last_segment == 'userliked' ? 'active' : '' ?>">Liked</a>
	</li>
	<?php if ($profile_data['is_vendor'] == '1') {  ?>
		<li class="nav-item" role="presentation">
			<a href="<?= base_url('userproperties/' . $profile_data['username']) ?>" class="p-3 nav-link text-muted <?= $second_to_last_segment == 'userproperties' ? 'active' : '' ?>">Properties</a>
		</li>
	<?php } ?>
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('usermentions/' . $profile_data['username']) ?>" class="p-3 nav-link text-muted <?= $second_to_last_segment == 'usermentions' ? 'active' : '' ?>">mentions</a>
	</li>
</ul>