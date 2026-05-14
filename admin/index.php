<?php
session_start();
include('inc/function.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" /><meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>
	Administrator Login
</title>

<link rel="icon" href="favicon.jpg" type="image/x-icon" />

<link id="ctl00_style" href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

<link href="assets/css/icons.css" rel="stylesheet" />

<link href="assets/css/style.css" rel="stylesheet" /><link href="assets/css/plugins.css" rel="stylesheet" />

<link href="assets/css/animate.css" rel="stylesheet" />
<style type="text/css">
        body {
            background-color: #010101;
        }

        .main-signin-header .form-control {
            color: #0e0e0e;
        }

        .main-signup-footer p {
            color: #242424;
        }

        .main-signin-header label {
            color: #000000;
        }

        .main-signin-footer p {
            color: #454545;
        }

        .logo {
            padding-top: 50% !important;
        }

        @media(max-width:767px) {
            .main-card-signin {
                display: block;
            }

            .logo {
                padding-top: 0% !important;
            }

            .logoback {
                padding: 0rem !important;
                margin-bottom: 15px;
            }

            .page-signin-style:before {
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
<form method="post" action="login-process" >

<div class="page">

<div class="my-auto page page-h">
<div class="main-signin-wrapper">
<div class="main-card-signin d-md-flex">

<div class="sign-up-body ">
<div class="main-signin-header">
<div><?php if(isset($_REQUEST['e'])==1){?><p align="center" style="color:#FF0000;background:#FFFFFF;height:30px;line-height:30px;">Invalid Username/Password!</p><?php }?>
<?php if(isset($_REQUEST['m'])==2){?><p align="center" style="color:#FF0000;background:#FFFFFF;height:30px;line-height:30px;">Security code does not match!</p><?php }?>
<div class="form-group mt-5">
<label>Username</label>
<input type="text" maxlength="35" class="form-control" placeholder="UserName" name="username" required="required" />
</div>
<div class="form-group">
<label>Password</label>
<input type="password" class="form-control " id="password" name="password" placeholder="Password" required autocomplete="off">
</div>
<input type="submit" name="ctl00$ContentPlaceHolder1$btn_login" value="LOG IN" id="ctl00_ContentPlaceHolder1_btn_login" class="btn btn-danger  btn-block" />
<input type="hidden" name="captcha" value="1">
<input type="hidden" name="security" value="1">
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</form>
</body>
</html>
