<div class="py-4">
	<div class="container-fluid">
		<div class="row position-relative">
			<!-- Main Content -->
			<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
				<div class="main-content">
					<div class="mb-5">
						<div class="feature bg-primary bg-gradient text-white rounded-4 mb-3"><i class="mdi mdi-help"></i>
						</div>
						<h2 class="fw-bold text-black mb-1">Frequently Asked Questions</h2>
						<p class="lead fw-normal text-muted mb-0">How can we help you?</p>
					</div>
					<!-- Feeds -->
					<div class="feeds">
						<!-- Feed Item -->
						<div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page">
							<!-- Contact form-->
							<div class="rounded-3">
								<div class="row justify-content-center">
									<div class="col-lg-12">
										<!-- FAQ Accordion 1-->
										<div class="accordion overflow-hidden bg-white" id="accordionExample">
											<?php
											$getfaq = $this->db->query("select * from yn_site_faq where faq_status='1' ");
											$thefaqdata = $getfaq->result_array();
											$first = true;
											foreach ($thefaqdata as $faq) { ?>

												<div class="accordion-item">
													<h3 class="accordion-header" id="heading<?= $faq['faq_id'] ?>"><button
															class="accordion-button <?= $first ? '' : 'collapsed' ?> fw-bold m-0" type="button"
															data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq['faq_id'] ?>"
															aria-expanded="<?= $first ? 'true' : 'false' ?>" aria-controls="collapse<?= $faq['faq_id'] ?>"><?= $faq['faq_que'] ?></button></h3>
													<div class="accordion-collapse collapse <?= $first ? 'show' : '' ?>" id="collapse<?= $faq['faq_id'] ?>"
														aria-labelledby="heading<?= $faq['faq_id'] ?>" data-bs-parent="#accordionExample">
														<div class="accordion-body">
															<p class="m-0"><?= $faq['faq_ans'] ?></p>
														</div>
													</div>
												</div>

											<?php $first = false;
											} ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include '_lsidebar.php' ?>
			<?php include '_rsidebar.php' ?>
		</div>
	</div>
</div>