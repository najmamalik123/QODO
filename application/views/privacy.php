<style>
	@media (max-width: 1200px) {
		.web-none.d-flex.align-items-center.px-3.pt-3 {
			position: fixed;
			width: 100%;
		}
	}
</style>
<!--============= Privacy Section Starts Here =============-->
<div class="py-4">
	<div class="container">
		<div class="row">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5 mt-5">
				<div class="col-12 text-left shadow_2 bg-white p-2 content">
					<?php $page_data = get_page_data('privacy', 'na');
					echo str_replace("{{sitename}}", $site_name, $page_data['content']); ?>
				</div>
			</main>
			<?php include 'inc/_lsidebar.php' ?>
			<?php include 'inc/_rsidebar.php' ?>
		</div>
	</div>
</div>
<!--============= Privacy Section Ends Here =============-->