<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SESSION['sid'])
{
if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_REQUEST['case']=='add')
{
$sql2="SELECT * FROM `imaksoft_settings_level` WHERE `level`='".mysqli_real_escape_string($conn,$_POST['level'])."' ";
$res2=query($conn,$sql2);
$num2=numrows($res2);
if($num2<1)
{
$sql1="INSERT INTO `imaksoft_settings_level` (`level`,`percentage`) VALUES('".mysqli_real_escape_string($conn,$_POST['level'])."','".mysqli_escape_string($conn,$_POST['percentage'])."')";
$res1=query($conn,$sql1);      

redirect('settings?inc=level&case=add&m=1');
}else{
redirect('settings?inc=level&case=add&e=1');
}
}
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_REQUEST['case']=='edit')
{
$sql2="UPDATE `imaksoft_settings_level` SET `level`='".$_POST['level']."',`percentage`='".mysqli_real_escape_string($conn,$_POST['percentage'])."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res2=query($conn,$sql2);

redirect('settings?inc=level');
}
}

if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_settings_level` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql);

redirect('settings?inc=level');
}
}

?>