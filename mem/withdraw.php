<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid']))
{
redirect('../index');
}
$userid=getMember($conn,$_SESSION['mid'],'userid');
$left=2;
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title><?=$title?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="assets/css/core/libs.min.css" />
    <link rel="stylesheet" href="assets/css/coinex.min.css?v=1.0.0" />
    <link rel="stylesheet" href="assets/css/custom.min.css?v=1.0.0" /><link href="https://fonts.googleapis.com/css2?family=Outfit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  </head>
  <body class=" ">

<style>
    body {
    font-family: 'Outfit', sans-serif;
}

</style>



<?php include('sidebar.php') ?>
   
    <main class="main-content">
      <div class="position-relative">
        <!--Nav Start-->
        <nav
          class="nav navbar navbar-expand-lg navbar-light iq-navbar border-bottom pb-lg-3 pt-lg-3"
        >
          <div class="container-fluid navbar-inner">
            <a href="dashboard" class="navbar-brand"> </a>
            <div
              class="sidebar-toggle"
              data-toggle="sidebar"
              data-active="true"
            >
              <i class="icon">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                  <path
                    fill="currentColor"
                    d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"
                  />
                </svg>
              </i>
            </div>
            <h4 class="title">Withdrawal</h4>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon">
                <span class="navbar-toggler-bar bar1 mt-2"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul
                class="navbar-nav ms-auto navbar-list mb-2 mb-lg-0 align-items-center"
              >
                
               
                <li class="nav-item dropdown">
                  <a
                    class="nav-link py-0 d-flex align-items-center"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img
                      src="assets/images/avatars/01.png"
                      alt="User-Profile"
                      class="img-fluid avatar avatar-50 avatar-rounded"
                    />
                  </a>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdown"
                  >
                    <li class="border-0">
                      <a
                        class="dropdown-item"
                        href="edit?case=profile"
                        >Edit Profile</a
                      >
                    </li>
                    <li class="border-0">
                      <a
                        class="dropdown-item"
                        href="edit?case=password"
                        >Change password</a
                      >
                    </li>
                    <li class="border-0">
                      <hr class="m-0 dropdown-divider" />
                    </li>
                    <li class="border-0">
                      <a
                        class="dropdown-item"
                        href="logout"
                        >Logout</a
                      >
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!--Nav End-->
      </div>
      <div class="container-fluid content-inner pb-0">
       
        <div class="row pt-2">
          
        <?php if(($_REQUEST['case'] ?? '')==='new'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="card">
<div class="card-header"  >
<div class="card-title">Withdrawal</div>
</div>

<div class="card-body">
<?php if(($_REQUEST['p'] ?? null)==1){?>
    <div class="alert alert-success text-center p-3 rounded ">
        <i class="fe fe-check-circle"></i> <strong>Payment Successfully Transferred, Kindly check your wallet!</strong>
    </div>
<?php }?>
<?php if(($_REQUEST['p'] ?? null)==2){?>
    <div class="alert alert-danger text-center p-3 rounded ">
        <i class="fe fe-check-circle"></i> <strong>Transaction Failed!</strong>
    </div>
<?php }?>
<?php if(($_REQUEST['e'] ?? null)==6){?>
    <div class="alert alert-danger text-center p-3 rounded ">
        <strong>Invalid Transaction Password!</strong>
    </div>
<?php }?>
<?php if(($_REQUEST['e'] ?? null)==8 || ($_REQUEST['e'] ?? null)==1){?>
    <div class="alert alert-danger text-center p-3 rounded ">
        <strong>Minimum withdrawal INR 100 and must be in multiples of INR 100!</strong>
    </div>
<?php }?>
<?php if(($_REQUEST['e'] ?? null)==9){?>
    <div class="alert alert-danger text-center p-3 rounded ">
        <strong>Withdrawal time is 8 AM to 10 PM only!</strong>
    </div>
<?php }?>
<?php if(($_REQUEST['e'] ?? null)==3){?><p align="center" style="color:#FF0000; padding-bottom:8px;">Amount must be greater than 0!</p><?php }?>
<?php if(($_REQUEST['e'] ?? null)==2){?>

    <div class="alert alert-danger text-center p-3 rounded ">
        <i class="fe fe-check-circle"></i> <strong>Insufficient wallet balance!</strong>
    </div>
<?php }?>


<h4 class="form-section text-center">Wallet Balance: INR <?=getAvailableFundWallet($conn,getMember($conn,$_SESSION['mid'],'userid'))?></h4>
<p>&nbsp;</p>

<?php 
$userid=getMember($conn,$_SESSION['mid'],'userid');
$avabal=getAvailableFundWallet($conn,getMember($conn,$_SESSION['mid'],'userid'));
$min=getSettingsWithdrawal($conn,'minimum');

if($avabal >= $min){
    if(getMember($conn,$_SESSION['mid'],'bitcoin')!=''){

        // Withdrawal allowed: Everyday 8AM to 10PM (IST)
        $hour = date('G'); // 0-23

        if ($hour >= 8 && $hour < 22) {

?>
<h4 class="text-center mb-3">Enter Withdrawal Amount</h4>

<form method="post" action="withdrawal-process1" id="withdrawForm">
    <label>Amount<span style="color:#CC0000;">*</span></label>
    <input type="number" step="0.01" name="amount" id="amount" class="form-control mb-3" placeholder="Enter Amount" required>
    
    <input type="hidden" name="userid" value="<?=$userid?>">
    <input type="hidden" name="type" value="Withdrawal">
    <input type="hidden" name="charges" id="charges">
    <input type="hidden" name="final" id="final">
    <input type="hidden" name="api" value="XXX">
    <input type="hidden" name="hash" value="1">

    <div class="mb-3">
        <label for="wallet_address" class="form-label fw-bold text-danger">
            Wallet Address (TRC20)
        </label>
        <input type="text" id="wallet_address" name="wallet_address" class="form-control border border-danger bg-danger" 
               value="<?=getMember($conn, $_SESSION['mid'], 'bitcoin')?>" required readonly>
        <small class="text-muted d-block mt-1">
            ⚠️ This wallet address is <strong>non-editable</strong>. Please ensure it is correct. Network must be TRC20.
        </small>
    </div>

    <div class="form-group form-group-default">
        <label>Transaction Password<span style="color:#CC0000;">*</span></label>
        <input type="password" class="form-control" name="tpassword" placeholder="Transaction Password" id="tpassword" required />
    </div>
    <br>
    <div class="alert alert-info p-2 mt-2" style="font-size:13px;">
        💡 Min: <strong>INR 100</strong> | Multiples of INR 100 only | <strong>10% admin charge</strong> deducted
    </div>
    <button type="submit" class="btn btn-success w-100">Send Now</button>
</form>

<script>
document.getElementById('withdrawForm').addEventListener('submit', function(e) {
    let amount = parseFloat(document.getElementById('amount').value);
    if (isNaN(amount) || amount <= 0) {
        alert("Please enter a valid amount");
        e.preventDefault();
        return;
    }
    if (amount < 100 || amount % 100 !== 0) {
        alert("Amount must be minimum INR 100 and in multiples of INR 100");
        e.preventDefault();
        return;
    }
    let charges = (amount * 10 / 100).toFixed(2);
    let finalAmount = (amount - charges).toFixed(2);
    document.getElementById('charges').value = charges;
    document.getElementById('final').value = finalAmount;
});
</script>

<?php
        } else {
            echo "<p style='color:red; font-weight:bold; text-align:center;'>
        Withdrawals are open <strong>Everyday 8 AM to 10 PM (IST)</strong>
      </p>";

        }
    } else {
        echo '<div align="center">
                <a href="edit?case=profile" style="text-decoration:none; color:#FF3300;" title="Go to Bank Details">
                    <span style="height:30px; border:1px solid #FF6600; padding:10px;font-size:16px;">
                        <strong>Please fill Wallet address !</strong>
                    </span>
                </a>
              </div>';
    }
} else {
    echo "<h5 align='center' style='color:#FF0000;'><strong>You don't have minimum balance for withdrawal</strong></h5>";
}
?>
</div>


<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<?php }else if(($_REQUEST['case'] ?? '')==='history'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header"  >
<div class="card-title">Withdrawal History</div>
</div>
<div class="card-body" style="overflow:auto;">
<?php


// Define pagination settings
$limit = 100;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get current user's ID
$user_id = getMember($conn, $_SESSION['mid'], 'userid');

// Query to fetch withdrawal records
$query = "SELECT request, charge, payout, type, status, date FROM imaksoft_withdrawal WHERE userid = ? ORDER BY id DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $user_id, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>
<table class="table table-head-bg-primary mt-1">
<thead>
<tr>
<th>Sl_No.</th>
<th>Request</th>
<th>Charge</th>
<th>Payout</th>
<th>Type</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php
$i = $offset + 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Status Formatting based on your codes
        $status = '';
        switch ($row['status']) {
            case 'C':
                $status = "<span style='color:#00CC00;font-weight:bold;'>Approved</span>";
                break;
            case 'P':
                $status = "<span style='color:#FF9900;font-weight:bold;'>Pending</span>"; // Changed to orange for pending
                break;
            case 'F':
                $status = "<span style='color:#FF0000;font-weight:bold;'>Failed</span>";
                break;
            default:
                $status = "<span style='color:#999999;font-weight:bold;'>Unknown</span>";
                break;
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block;vertical-align:middle;"><polygon points="12 2 2 19 22 19"/><line x1="12" y1="2" x2="12" y2="19"/><line x1="2" y1="19" x2="12" y2="10"/><line x1="22" y1="19" x2="12" y2="10"/></svg>';
        echo "<tr>
                <td>{$i}</td>
                <td>INR {$row['request']}</td>
                <td>INR {$row['charge']}</td>
                <td>INR {$row['payout']}</td>
                <td>{$row['type']}</td>
                <td>{$status}</td>
                <td>{$row['date']}</td>
              </tr>";
        $i++;
    }
} else {
    echo '<tr><td colspan="7" class="text-danger">No Record Found!</td></tr>';
}
?>
</tbody>
</table>
</div>
<div align="center"><?=$pagination ?? ''?></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php }?>
                 
    </main>

    <!-- Wrapper End-->
    <!-- offcanvas start -->

    <!-- Backend Bundle JavaScript -->
    <script src="assets/js/core/libs.min.js"></script>
    <script src="assets/js/core/external.min.js"></script>

    <!-- widgetchart JavaScript -->
    <script src="assets/js/charts/widgetcharts.js"></script>

    <!-- GSAP Animation JS-->
    <script src="assets/vendor/gsap/gsap.min.js"></script>
    <script src="assets/vendor/gsap/ScrollTrigger.min.js"></script>

    <!-- fslightbox JavaScript -->
    <script src="assets/js/fslightbox.js"></script>

    <!-- Mapchart JavaScript -->
    <script src="assets/js/charts/vector-chart.js"></script>
    <script src="assets/js/charts/dashboard.js"></script>

    <!-- app JavaScript -->
    <script src="assets/js/coinex.js"></script>

    <!-- apexchart JavaScript -->
    <script src="assets/js/charts/apexcharts.js"></script>

    <!-- Gsap Animation Init -->
    <script src="assets/js/gsap.js"></script>
  </body>
</html>
