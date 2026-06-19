<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['aid'])) redirect('index');
$left = 13;

// Manual distribute button
if (isset($_POST['distribute'])) {
    $today = date('Y-m-d');
    $weekStart = date('Y-m-d', strtotime('monday this week'));

    $memberCount = $conn->query("SELECT COUNT(*) as total FROM imaksoft_member WHERE paystatus='A'");
    $mc = $memberCount->fetch_assoc();
    $totalPool = (int)$mc['total'] * 100;

    if ($totalPool > 0) {
        $achievers = $conn->query("SELECT m.userid, COUNT(d.id) as dc FROM imaksoft_member m LEFT JOIN imaksoft_member d ON d.sponsor=m.userid AND d.paystatus='A' AND d.date >= '$weekStart' WHERE m.paystatus='A' GROUP BY m.userid HAVING dc >= 10");
        $achieverCount = $achievers->num_rows;

        if ($achieverCount > 0) {
            $perAchiever = round($totalPool / $achieverCount, 2);
            $conn->query("INSERT INTO sl_prize_pool (week_end_date, total_amount, achievers_count, per_achiever, distributed, created_date) VALUES ('$today', '$totalPool', '$achieverCount', '$perAchiever', 1, '$today')");
            $poolId = $conn->insert_id;

            $achievers->data_seek(0);
            while ($a = $achievers->fetch_assoc()) {
                $conn->query("INSERT INTO sl_prize_pool_log (userid, pool_id, amount, date) VALUES ('" . mysqli_real_escape_string($conn, $a['userid']) . "', '$poolId', '$perAchiever', '$today')");
                $conn->query("INSERT INTO imaksoft_deposit (userid, amount, date) VALUES ('" . mysqli_real_escape_string($conn, $a['userid']) . "', '$perAchiever', '$today')");
            }
            $msg = "<div class='alert alert-success'>Prize Pool of ₹$totalPool distributed to $achieverCount achievers (₹$perAchiever each).</div>";
        } else {
            $msg = "<div class='alert alert-warning'>No achievers found (10+ directs this week).</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>No active members found.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Prize Pool - Admin</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="app sidebar-mini">
<?php include('header.php'); include('sidebar.php'); ?>
<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header"><h4>Prize Pool Management</h4></div>
            <div class="card-body">

              <?= $msg ?? '' ?>

              <!-- Current Pool Stats -->
              <?php
              $activeMembers = $conn->query("SELECT COUNT(*) as total FROM imaksoft_member WHERE paystatus='A'")->fetch_assoc();
              $poolAmt = (int)$activeMembers['total'] * 100;
              $weekStart = date('Y-m-d', strtotime('monday this week'));
              $achievers = $conn->query("SELECT m.userid, COUNT(d.id) as dc FROM imaksoft_member m LEFT JOIN imaksoft_member d ON d.sponsor=m.userid AND d.paystatus='A' AND d.date >= '$weekStart' WHERE m.paystatus='A' GROUP BY m.userid HAVING dc >= 10");
              ?>
              <div class="row mb-4">
                <div class="col-md-3">
                  <div class="card bg-primary text-white text-center p-3">
                    <h5>₹<?= number_format($poolAmt, 2) ?></h5>
                    <small>This Week's Pool</small>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card bg-success text-white text-center p-3">
                    <h5><?= $activeMembers['total'] ?></h5>
                    <small>Active Members</small>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card bg-warning text-white text-center p-3">
                    <h5><?= $achievers->num_rows ?></h5>
                    <small>Achievers This Week</small>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card bg-info text-white text-center p-3">
                    <h5>₹<?= $achievers->num_rows > 0 ? number_format($poolAmt / $achievers->num_rows, 2) : '0.00' ?></h5>
                    <small>Per Achiever</small>
                  </div>
                </div>
              </div>

              <!-- Manual Distribute -->
              <form method="POST" onsubmit="return confirm('Distribute prize pool now?')">
                <button type="submit" name="distribute" class="btn btn-danger mb-4">
                  Distribute Prize Pool Now
                </button>
              </form>

              <!-- History -->
              <h5>Distribution History</h5>
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr><th>#</th><th>Week Date</th><th>Total Pool</th><th>Achievers</th><th>Per Achiever</th><th>Date</th></tr>
                </thead>
                <tbody>
                <?php
                $history = $conn->query("SELECT * FROM sl_prize_pool ORDER BY id DESC LIMIT 20");
                $i = 1;
                if ($history && $history->num_rows > 0):
                  while ($h = $history->fetch_assoc()):
                ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= date('d M Y', strtotime($h['week_end_date'])) ?></td>
                  <td>₹<?= number_format($h['total_amount'], 2) ?></td>
                  <td><?= $h['achievers_count'] ?></td>
                  <td>₹<?= number_format($h['per_achiever'], 2) ?></td>
                  <td><?= date('d M Y', strtotime($h['created_date'])) ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center text-muted">No history found</td></tr>
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
</body>
</html>
