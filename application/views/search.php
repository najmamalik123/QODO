<style>
	.card-img-top {
		width: 60%;
		border-radius: 50%;
		margin: 0 auto;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	}

	.card {
		padding: 1.5em 0.5em 0.5em;
		text-align: center;
		border-radius: 2em;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	}

	.card-title {
		font-weight: bold;
		font-size: 1.5em;
	}

	.btn-primary {
		border-radius: 2em;
		padding: 0.5em 1.5em;
	}
</style>

<div class="py-4">
	<div class="container">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
							<!-- Search Input Start -->
							<input type="text" id="search" class="form-control" placeholder="Search users..." autocomplete="off">
							<!-- Search Input Ends -->
							<div>
								<div class="rounded-4 overflow-hidden mb-4" id="userList">
									<!-- Users will be loaded here dynamically -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>

<script script>
	$(document).ready(function() {
		$("#search").on("input", function() {
			var query = $(this).val().trim();
			if (query.length > 0) {
				$.ajax({
					url: "<?= base_url('main/searchUsers') ?>",
					type: "POST",
					data: {
						search: query
					},
					success: function(response) {
						$("#userList").html(response);
					}
				});
			} else {
				$("#userList").html("");
			}
		});
	});
</script>
