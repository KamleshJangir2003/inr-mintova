<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_REQUEST['case']=='add')
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".trim(mysqli_real_escape_string($conn,$_POST['userid']))."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
if(trim($_POST['amount'])>0)
{
$sql1="INSERT INTO `imaksoft_deposit` (`userid`,`amount`,`remarks`,`date`) VALUES('".trim($_POST['userid'])."','".trim($_POST['amount'])."','".trim($_POST['remarks'])."','".date('Y-m-d')."')";
$res1=query($conn,$sql1);    
  
redirect('deposit?m=1');
}else{
redirect('deposit?e=1');
}
}else{
redirect('deposit?f=2');
}
}
}

if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_deposit` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql);

redirect('deposit');
}
?>