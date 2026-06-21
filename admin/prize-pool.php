<?php
include('head.php');
$left = 13;

// Create tables first — before anything else
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `sl_prize_pool` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `week_end_date` date NOT NULL,
    `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
    `achievers_count` int(11) NOT NULL DEFAULT 0,
    `per_achiever` decimal(10,2) NOT NULL DEFAULT 0.00,
    `distributed` tinyint(1) NOT NULL DEFAULT 0,
    `created_date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `sl_prize_pool_log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userid` varchar(50) NOT NULL,
    `pool_id` int(11) NOT NULL,
    `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$msg = '';

// Manual distribute
if (isset($_POST['distribute'])) {
    $today     = date('Y-m-d');
    $weekStart = date('Y-m-d', strtotime('monday this week'));

    // Check already distributed this week
    $chk = mysqli_query($conn, "SELECT id FROM sl_prize_pool WHERE week_end_date >= '$weekStart' AND distributed=1");
    if (mysqli_num_rows($chk) > 0) {
        $msg = "<div class='alert alert-warning'>Prize pool already distributed this week!</div>";
    } else {
        $mc        = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM imaksoft_member WHERE paystatus='A'"));
        $totalPool = (int)$mc['total'] * 100;

        if ($totalPool > 0) {
            $ares = mysqli_query($conn, "SELECT m.userid, COUNT(d.id) as dc
                FROM imaksoft_member m
                LEFT JOIN imaksoft_member d ON d.sponsor=m.userid AND d.paystatus='A' AND d.date >= '$weekStart'
                WHERE m.paystatus='A'
                GROUP BY m.userid HAVING dc >= 10");
            $achieverCount = mysqli_num_rows($ares);

            if ($achieverCount > 0) {
                $perAchiever = round($totalPool / $achieverCount, 2);
                mysqli_query($conn, "INSERT INTO sl_prize_pool (week_end_date, total_amount, achievers_count, per_achiever, distributed, created_date)
                    VALUES ('$today', '$totalPool', '$achieverCount', '$perAchiever', 1, '$today')");
                $poolId = mysqli_insert_id($conn);

                while ($a = mysqli_fetch_assoc($ares)) {
                    $uid = mysqli_real_escape_string($conn, $a['userid']);
                    mysqli_query($conn, "INSERT INTO sl_prize_pool_log (userid, pool_id, amount, date) VALUES ('$uid', '$poolId', '$perAchiever', '$today')");
                    mysqli_query($conn, "INSERT INTO imaksoft_deposit (userid, amount, date) VALUES ('$uid', '$perAchiever', '$today')");
                }
                $msg = "<div class='alert alert-success'>&#10003; Prize Pool of &#8377;$totalPool distributed to $achieverCount achievers (&#8377;$perAchiever each).</div>";
            } else {
                $msg = "<div class='alert alert-warning'>No achievers found this week. Members need 10+ directs this week.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>No active members found.</div>";
        }
    }
}

// Stats
$mc2          = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM imaksoft_member WHERE paystatus='A'"));
$totalActive  = (int)$mc2['total'];
$poolAmt      = $totalActive * 100;
$weekStart    = date('Y-m-d', strtotime('monday this week'));

$ares2        = mysqli_query($conn, "SELECT m.userid, COUNT(d.id) as dc
    FROM imaksoft_member m
    LEFT JOIN imaksoft_member d ON d.sponsor=m.userid AND d.paystatus='A' AND d.date >= '$weekStart'
    WHERE m.paystatus='A'
    GROUP BY m.userid HAVING dc >= 10");
$achieverCount = mysqli_num_rows($ares2);
$perAchiever   = $achieverCount > 0 ? number_format($poolAmt / $achieverCount, 2) : '0.00';
?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<div class="jumps-prevent" style="padding-top: 20px;"></div>

<div class="main-content app-content">
<div class="main-container container-fluid">
<div class="main-content-body">

<?php if ($msg): ?>
    <div class="row row-sm mb-3">
        <div class="col-12"><?= $msg ?></div>
    </div>
<?php endif; ?>

<!-- Stats Cards -->
<div class="row row-sm mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card overflow-hidden project-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-primary-transparent p-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                            <i class="fe fe-award text-primary" style="font-size:20px;"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">&#8377;<?= number_format($poolAmt, 2) ?></h5>
                        <small class="text-muted">This Week's Pool</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card overflow-hidden project-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-success-transparent p-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                            <i class="fe fe-users text-success" style="font-size:20px;"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold"><?= $totalActive ?></h5>
                        <small class="text-muted">Active Members</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card overflow-hidden project-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-warning-transparent p-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                            <i class="fe fe-star text-warning" style="font-size:20px;"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold"><?= $achieverCount ?></h5>
                        <small class="text-muted">Achievers This Week</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card overflow-hidden project-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-info-transparent p-2 rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                            <i class="fe fe-dollar-sign text-info" style="font-size:20px;"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">&#8377;<?= $perAchiever ?></h5>
                        <small class="text-muted">Per Achiever</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Distribute Card -->
<div class="row row-sm mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8 mb-3 mb-md-0">
                        <h5 class="mb-1">Manual Distribution</h5>
                        <p class="text-muted mb-0">Distribute current week's prize pool to all achievers (10+ directs this week).</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <form method="POST" onsubmit="return confirm('Are you sure you want to distribute the prize pool now?')">
                            <button type="submit" name="distribute" class="btn btn-danger w-100">
                                <i class="fe fe-send me-1"></i> Distribute Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- History -->
<div class="row row-sm">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Distribution History</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr align="center">
                                <th>Sl_No</th>
                                <th>Week Date</th>
                                <th>Total Pool</th>
                                <th>Achievers</th>
                                <th>Per Achiever</th>
                                <th>Distributed On</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $history = mysqli_query($conn, "SELECT * FROM sl_prize_pool ORDER BY id DESC LIMIT 20");
                        $i = 1;
                        if ($history && mysqli_num_rows($history) > 0):
                            while ($h = mysqli_fetch_assoc($history)):
                        ?>
                        <tr align="center">
                            <td><?= $i++ ?></td>
                            <td><?= date('d M Y', strtotime($h['week_end_date'])) ?></td>
                            <td><strong style="color:#00CC00;">&#8377;<?= number_format($h['total_amount'], 2) ?></strong></td>
                            <td><?= $h['achievers_count'] ?></td>
                            <td>&#8377;<?= number_format($h['per_achiever'], 2) ?></td>
                            <td><?= date('d M Y', strtotime($h['created_date'])) ?></td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="6" align="center" style="color:#FF0000;">No Distribution History Found!</td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/p-scroll.js"></script>
<script src="assets/plugins/side-menu/sidemenu.js"></script>
<script src="assets/js/sticky.js"></script>
<script src="assets/plugins/sidebar/sidebar.js"></script>
<script src="assets/plugins/sidebar/sidebar-custom.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/switcher/js/switcher.js"></script>
</body>
</html>
