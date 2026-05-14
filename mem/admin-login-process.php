<?php
session_start();
include('../admin/inc/function.php');

if($_REQUEST['userid']!='' && $_REQUEST['password']!='')
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".mysqli_real_escape_string($conn,trim($_REQUEST['userid']))."' AND `password`='".base64_encode(mysqli_real_escape_string($conn,trim($_REQUEST['password'])))."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
$_SESSION['mid']=$fetch['id'];

redirect('dashboard');
}else{
redirect('indexe=1');
}
}
?> 