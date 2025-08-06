<?php
$date = $_GET['date'] ?? 'Unknown';
$net_income = $_GET['net_income'] ?? 'N/A';
$cash_ops = $_GET['cash_ops'] ?? 'N/A';
$cash_invest = $_GET['cash_invest'] ?? 'N/A';
$cash_finance = $_GET['cash_finance'] ?? 'N/A';
?>

<div class="py-4">
    <div class="container">
        <div class="row position-relative">
            <!-- Main Content -->
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12 mb-5">
                <div class="main-content">
                    <div class="container mt-5">
                        <h3 class="mb-0 fw-bold text-body mb-3">📊 Apple Stock Details (<?= htmlspecialchars($date) ?>)</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Net Income</th>
                                <td>$<?= number_format($net_income / 1e9, 2) ?>B</td>
                            </tr>
                            <tr>
                                <th>Cash from Operations</th>
                                <td>$<?= number_format($cash_ops / 1e9, 2) ?>B</td>
                            </tr>
                            <tr>
                                <th>Cash from Investing</th>
                                <td>$<?= number_format($cash_invest / 1e9, 2) ?>B</td>
                            </tr>
                            <tr>
                                <th>Cash from Financing</th>
                                <td>$<?= number_format($cash_finance / 1e9, 2) ?>B</td>
                            </tr>
                        </table>
                        <a href="index.php" class="btn btn-primary btn-sm"> Back to Home</a>
                    </div>

                </div>
            </main>

            <?php include 'inc/_lsidebar.php' ?>
            <?php include 'inc/_rsidebar.php' ?>
        </div>
    </div>
</div>