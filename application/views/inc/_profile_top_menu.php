<?php
$this->load->helper('url');
$total_segments = $this->uri->total_segments();
$second_to_last_segment = $this->uri->segment($total_segments - 1);
$last_segment = $this->uri->segment($total_segments);
?>

<ul class="top-osahan-nav-tab nav nav-pills justify-content-center nav-justified mb-4 shadow-sm rounded-4 overflow-hidden bg-white mt-4" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('profile') ?>" class="px-2 py-3 nav-link text-muted <?= $last_segment == 'profile' ? 'active' : '' ?>">Feed</a>
	</li>
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('liked') ?>" class="px-2 py-3 nav-link text-muted <?= $last_segment == 'liked' ? 'active' : '' ?>">Liked</a>
	</li>
	<!--<li class="nav-item" role="presentation">-->
	<!--	<a href="<?= base_url('reels') ?>" class="px-2 py-3 nav-link text-muted <?= $last_segment == 'reels' ? 'active' : '' ?>">Ree-<?= $site_name ?></a>-->
	<!--</li>-->
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('mentions') ?>" class="px-2 py-3 nav-link text-muted <?= $last_segment == 'mentions' ? 'active' : '' ?>">Mentions</a>
	</li>

</ul>