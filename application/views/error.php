<div class="container p-5 bg-white vh-100 d-flex align-items-center justify-content-center">
	<div class="text-center">
		<h3>Hey, There is an Alert !</h3>
		<h4 class="p-3 text-danger"><?php echo ucfirst($_GET['e']); ?></h4>
		<img src="<?=base_url('assets/avator/webimg/error_404.png')?>" class='img-fluid' >

		<br/>
		<a href="<?=base_url()?>" class='mt-3'>
			<button class="btn btn_2 px-4">Go Back Home</button>
		</a>

	</div>
</div>
