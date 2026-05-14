<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SESSION['sid'])
{
if($_REQUEST['case']=='status')
{
$sql="UPDATE `imaksoft_withdrawal` SET `status`='C',`approved`='".date('Y-m-d')."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql);

redirect('withdrawal?case=pen&page='.mysqli_real_escape_string($conn,$_REQUEST['page']));
}

if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_withdrawal` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql); 

redirect('withdrawal?case=pen&page='.mysqli_real_escape_string($conn,$_REQUEST['page']));
}

}
?>