<style>
    p {
    margin-top: 0;
    margin-bottom: 0.5rem;
}

</style>

<div class="py-4">
    <div class="container-fluid">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                   
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                            <!-- Follow People -->
                            <div class="ms-1">
                                <!-- Feeds -->
                                <div class="feeds" id="feed">
                                    <!-- Feed Item -->
                                    <?php
                                    $yid = $_SESSION['yid']; // define your vendor ID here
                                    $properties = $this->db->query("SELECT * FROM x_home_property WHERE prop_vendor = ?", [$yid])->result_array();

                                    $propertyLeads = [];

                                    foreach ($properties as $property) {
                                        $property_id = $property['prop_id']; // adjust if your field is different
                                        $leads = $this->db->query("SELECT * FROM yn_site_contact WHERE property = ? ORDER BY msid DESC", [$property_id])->result_array();


                                        $propertyLeads[] = [
                                            'property' => $property,
                                            'leads' => $leads
                                        ];
                                    }
                                    // print_r($propertyLeads);

                                    ?>
                                    <?php foreach ($propertyLeads as $item): ?>
                                        <div class="card mb-3 p-3 shadow-sm">
                                            <h5 class="mb-2">Property: <?= htmlspecialchars($item['property']['prop_name']) ?></h5>

                                         <?php if (!empty($item['leads'])): ?>
    <?php foreach ($item['leads'] as $lead): ?>
        <div class="border rounded p-3 mb-4">
            <div class="row">
                <!-- Left Side -->
                <div class="col-md-8">
                    <p><strong>Name:</strong> <?= htmlspecialchars($lead['name']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($lead['email']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($lead['phone']) ?></p>
                    <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($lead['msg'])) ?></p>
                </div>

                <!-- Right Side -->
                <div class="col-md-4 text-md-end">
                    <p><strong>Date:</strong> <?= date_format_1($lead['date'], 'alpha_datetime') ?></p>
                    <p> <?= read_me_user('property_lead_status', $lead['vendor_status']) ?></p>
                </div>
            </div>

            <!-- Horizontal Line -->
            <hr class="my-1">

            <!-- Action Links -->
            <div class="col-md-4 d-flex flex-wrap justify-content-between">
                
                    <a href="<?= base_url('action/propstatus')?>?msid=<?= $lead['msid']?>&status=0" class="text-muted text-decoration-none" >Pending</a>
                    <a href="<?= base_url('action/propstatus')?>?msid=<?= $lead['msid']?>&status=1" class="text-muted text-decoration-none" >Meeting</a>
                    <a href="<?= base_url('action/propstatus')?>?msid=<?= $lead['msid']?>&status=2" class="text-muted text-decoration-none" >Closed</a>
               
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-muted">No leads found for this property.</p>
<?php endif; ?>

                                        </div>
                                    <?php endforeach; ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'inc/_lsidebar.php' ?>
        </div>
    </div>
</div>