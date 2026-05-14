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
$sql1="INSERT INTO `imaksoft_deduct` (`userid`,`amount`,`remarks`,`date`) VALUES('".trim($_POST['userid'])."','".trim($_POST['amount'])."','".trim($_POST['remarks'])."','".date('Y-m-d')."')";
$res1=query($conn,$sql1);    
  
redirect('deduct?m=1');
}else{
redirect('deduct?e=1');
}
}else{
redirect('deduct?f=2');
}

}
}


if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_deduct` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql);

redirect('deduct');
}
?>