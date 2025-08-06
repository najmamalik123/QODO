<?php
$this->load->helper('url');
$total_segments = $this->uri->total_segments();
$second_to_last_segment = $this->uri->segment($total_segments - 1);
$last_segment = $this->uri->segment($total_segments);
?>
<ul class="top-osahan-nav-tab nav nav-pills justify-content-center nav-justified mb-4 shadow-sm rounded-4 overflow-hidden bg-white sticky-sidebar2" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('home') ?>" class="p-3 nav-link text-muted <?= $last_segment == '' ? 'active' : '' ?>">Feed</a>
	</li>
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('investors') ?>" class="p-3 nav-link text-muted <?= $last_segment == 'investors' ? 'active' : '' ?>">investors</a>
	</li>
	<li class="nav-item" role="presentation">
		<a href="<?= base_url('properties') ?>" class="p-3 nav-link text-muted <?= $last_segment == 'properties' ? 'active' : '' ?>">Properties</a>
	</li>
</ul>