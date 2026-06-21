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
          
            <?php if(($_REQUEST['case'] ?? '')==='profile'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<div class="card">
<div class="card-header" >

<div class="card-title">Profile Update</div>
</div>
<div class="card-body" >


<?php if(isset($_REQUEST['Updated'])=='1'){?>
<div align="center" style="color:#009933;font-size:16px;">Your profile successfully updated!</div>
<?php }?>

<form class="form" action="profile-process" method="post">
<div class="row mt-3">
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Name</label>
<input type="text" class="form-control border-warning" name="name" placeholder="Name" value="<?=getMember($conn,$_SESSION['mid'],'name')?>" <?php if(getMember($conn,$_SESSION['mid'],'name')){?><?php }?> />
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Email</label>
<input type="email" class="form-control border-warning" name="email" placeholder="Name" value="<?=getMember($conn,$_SESSION['mid'],'email')?>" <?php if(getMember($conn,$_SESSION['mid'],'email')){?><?php }?> />
</div>
</div>
</div>

<div class="row mt-3">
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Phone</label>
<input type="text" class="form-control border-warning" id="phone" name="phone" value="<?=getMember($conn,$_SESSION['mid'],'phone')?>" placeholder="Phone Number" maxlength="10" <?php if(getMember($conn,$_SESSION['mid'],'phone')){?><?php }?> />
</div>
</div>

<div class="col-md-6">
<div class="form-group form-group-default">
<label>Country</label>
<input type="text" class="form-control border-warning" value="<?=getMember($conn,$_SESSION['mid'],'address')?>" name="address" id="address" placeholder="Country" <?php if(getMember($conn,$_SESSION['mid'],'address')){?>readonly<?php }?> />
</div>
</div>
</div>
<div class="row mt-3">

<div class="col-md-6">
  <div class="form-group form-group-default">
    <label>INR Wallet Address</label>
    <input type="text" class="form-control border-danger" name="bitcoin" id="bitcoin" 
      placeholder="Enter your INR TRC20 Wallet Address"
      value="<?=getMember($conn,$_SESSION['mid'],'bitcoin')?>"
      <?php if(getMember($conn,$_SESSION['mid'],'bitcoin')){?>readonly<?php }?> />

    <small class="form-text" 
  style="background:#ffe5e5; color:#b30000; font-weight:600; display:block; padding:10px; border-radius:6px; margin-top:6px;">
  ⚠️ Please enter your correct <b>INR TRC20 wallet address</b>.<br>
  Once submitted, it <u>cannot be edited or changed</u>.<br>
  Any incorrect entry may result in permanent loss of funds.<br>
  The company will not be responsible for funds lost due to an invalid or incorrect address.
</small>

  </div>
</div>



</div>

<div class="text-left mt-3 mb-3">
<button class="btn btn-warning">UPDATE</button>
</div>
</form>
</div>
</div>
</div>

</div>
</div>
</div>

</div>
<?php }else if(($_REQUEST['case'] ?? '')==='password'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<div class="card">
<div class="card-header" >
<div class="card-title">Change Password</div>
</div>
<div class="card-body" >
 <!-- Alert Messages -->
              <?php if(($_REQUEST['invalid'] ?? null)==1){?>
                <div class="alert alert-danger text-center" role="alert" style="border-radius: 12px;">Current password does not match!</div>
              <?php }?>
              <?php if(($_REQUEST['updated'] ?? null)==2){?>
                <div class="alert alert-success text-center" role="alert" style="border-radius: 12px;">New password successfully updated!</div>
              <?php }?>
              <?php if(($_REQUEST['invalid'] ?? null)==3){?>
                <div class="alert alert-danger text-center" role="alert" style="border-radius: 12px;">Confirm password does not match!</div>
              <?php }?>
<form class="form" action="password-process" method="post">

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">Current password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="current" name="current" placeholder="" required>
</div>

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">New password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="newpass" name="newpass" placeholder="" required>
</div>

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">Confirm password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="conpass" name="conpass" placeholder="" required>
</div>




<div class="card-action">
<button class="btn btn-warning">UPDATE</button>
<!--<button class="btn btn-danger">Cancel</button>-->
</div>
</form>
</div>
</div>

</div>
</div>
</div>
</div>

</div>


<?php }else if(($_REQUEST['case'] ?? '')==='tpassword'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<div class="card">
<div class="card-header" >
<div class="card-title">Change Transaction Password</div>
</div>
<div class="card-body" >
 <!-- Alert Messages -->
              <?php if(($_REQUEST['invalid'] ?? null)==1){?>
                <div class="alert alert-danger text-center" role="alert" style="border-radius: 12px;">Current password does not match!</div>
              <?php }?>
              <?php if(($_REQUEST['updated'] ?? null)==2){?>
                <div class="alert alert-success text-center" role="alert" style="border-radius: 12px;">New password successfully updated!</div>
              <?php }?>
              <?php if(($_REQUEST['invalid'] ?? null)==3){?>
                <div class="alert alert-danger text-center" role="alert" style="border-radius: 12px;">Confirm password does not match!</div>
              <?php }?>
<form class="form" action="tpassword-process" method="post">

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">Current password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="current" name="current" placeholder="" required>
</div>

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">New password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="newpass" name="newpass" placeholder="" required>
</div>

<div class="form-group">
<label for="pillInput"><span style="font-size:16px;">Confirm password</span><span style="color:#FF0000;">*</span></label>
<input type="password" class="form-control border-warning input-pill" id="conpass" name="conpass" placeholder="" required>
</div>




<div class="card-action">
<button class="btn btn-warning">UPDATE</button>
<!--<button class="btn btn-danger">Cancel</button>-->
</div>
</form>
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
