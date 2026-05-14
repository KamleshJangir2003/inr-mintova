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
            <a href="../dashboard/index.html" class="navbar-brand"> </a>
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
            <h4 class="title">Edit Profile</h4>
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
          
             <?php if(($_REQUEST['case'] ?? '')==='direct'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header"  >
<div class="card-title">My Direct</div>
</div>
<div class="card-body" style="overflow:auto;">
<?php


// Define pagination settings
$limit = 100;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get current user's ID
$sponsor_id = getMember($conn, $_SESSION['mid'], 'userid');

// Query to fetch direct downline members
$query = "SELECT userid, name, phone, status, paystatus, date FROM imaksoft_member WHERE sponsor = ? ORDER BY id DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $sponsor_id, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>
<table class="table table-head-bg-primary mt-1">
<thead>
<tr>
<th>Sl_No</th>
<th>User_ID</th>
<th>Name</th>
<th>Phone</th>
<th>Status</th>
<th>Pay_Status</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php
                    $i = $offset + 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Status Formatting
                            $status = ($row['status'] == 'A') ? "<span style='color:#00FF00;font-weight:bold;'>Active</span>" : "<span style='color:#FF0000;font-weight:bold;'>Inactive</span>";

                            // Pay Status Formatting
                            $pay_status = ($row['paystatus'] == 'I') ? "<span style='color:#FF0000;font-weight:bold;'>Pending</span>" : "<span style='color:#00FF00;font-weight:bold;'>Paid</span>";

                            echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$row['userid']}</td>
                                    <td>" . ucfirst($row['name']) . "</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$status}</td>
                                    <td>{$pay_status}</td>
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
<div><?=$pagination ?? ''?></div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<?php }else if(($_REQUEST['case'] ?? '')==='team'){?>
<?php

$placement = $_REQUEST['placement'] ?? getMember($conn, $_SESSION['mid'], 'userid');

// Show selected user details
?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
<div class="row">
<div class="col-md-12">

<div class="card">
<div class="card-header">
    <div class="card-title">Team View</div>
</div>
<div class="card-body" style="overflow:auto;">

<?php if($placement){ ?>
<!--<h3 style="color:#24847A;font-size:20px;">-->
<!--    User_ID: <?=$placement?> &nbsp;&nbsp;&nbsp;-->
<!--    Name: <?=ucwords(strtolower(getMemberUserid($conn, $placement,'name')))?>-->
<!--</h3>-->
<?php } ?>

<?php
$current_level_users = [$placement];  // starting point

for($level = 1; $level <= 9; $level++) {

    $next_level_users = [];

    // Fetch downlines of all users in this level
    $uids = "'" . implode("','", $current_level_users) . "'";
    $sql = "SELECT * FROM imaksoft_member WHERE sponsor IN ($uids) AND status='A'";
    $res = query($conn, $sql);

    if(numrows($res) == 0) break; // stop if no more users

    echo "<h2 style='color:#000;font-size:20px;'>&nbsp;Genealogy - Level $level</h2>";
    echo '
    <table class="table table-head-bg-primary mt-1">
    <thead>
        <tr>
            <th>User_ID</th>
            <th>Name</th>
            <th>Sponsor</th>
            <th>Status</th>
            <th>Paystatus</th>
            <th>Join</th>
        </tr>
    </thead>
    <tbody>
    ';

    while($row = fetcharray($res)) {
        $next_level_users[] = $row['userid'];
        ?>
        <tr>
            <td><a href="downline?case=team&placement=<?=$row['userid']?>"><?=$row['userid']?></a></td>
            <td><?=ucwords(strtolower($row['name']))?></td>
            <td><?=$row['sponsor'] ?: "----"?></td>
            <td><?=($row['status']=='A' ? "<span style='color:#00CC00;'>Active</span>" : "<span style='color:#FF0000;'>Inactive</span>")?></td>
            <td><?=($row['paystatus']=='A' ? "<span style='color:#00CC00;'>Paid</span>" : "<span style='color:#FF0000;'>Pending</span>")?></td>
            <td><?=$row['date']?></td>
        </tr>
        <?php
    }

    echo "</tbody></table>";

    $current_level_users = $next_level_users; // move to next
}
?>

</div>
</div>

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
