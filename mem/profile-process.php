<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid']))
{
redirect('index.php');
}

if($_SESSION['mid'])
{

$sql="UPDATE  `imaksoft_member` SET `name`='".trim($_POST['name'])."',`email`='".trim($_POST['email'])."',`phone`='".trim($_POST['phone'])."',`bname`='".trim($_POST['bname'])."',`branch`='".trim($_POST['branch'])."',`address`='".trim($_POST['address'])."',`accname`='".trim($_POST['accname'])."',`accno`='".trim($_POST['accno'])."',`ifscode`='".trim($_POST['ifscode'])."',`bitcoin`='".trim($_POST['bitcoin'])."',`upi`='".trim($_POST['upi'])."' WHERE `id`='".trim($_SESSION['mid'])."'";
$res=query($conn,$sql);

redirect('edit?case=profile&Updated=1');
}
?>