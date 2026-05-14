<?php
session_start();
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
$sql1="INSERT INTO `imaksoft_settings_package` (`plan`,`investment`,`dailyper`,`weeklyper`,`profitper`,`nodays`) VALUES('".mysqli_escape_string($conn,$_POST['plan'])."','".mysqli_escape_string($conn,$_POST['investment'])."','".mysqli_escape_string($conn,$_POST['dailyper'])."','".mysqli_escape_string($conn,$_POST['weeklyper'])."','".mysqli_escape_string($conn,$_POST['profitper'])."','".trim($_POST['nodays'])."')";
$res1=query($conn,$sql1);
 
redirect('settings?inc=addpack&case=add&m=1');
}
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_REQUEST['case']=='edit')
{
$sql2="UPDATE `imaksoft_settings_package` SET `plan`='".mysqli_real_escape_string($conn,$_POST['plan'])."',`investment`='".mysqli_real_escape_string($conn,$_POST['investment'])."',`dailyper`='".mysqli_real_escape_string($conn,$_POST['dailyper'])."',`weeklyper`='".mysqli_real_escape_string($conn,$_POST['weeklyper'])."',`profitper`='".mysqli_real_escape_string($conn,$_POST['profitper'])."',`nodays`='".mysqli_real_escape_string($conn,$_POST['nodays'])."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res2=query($conn,$sql2);

redirect('settings?inc=package');
}
}

if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_settings_package` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql);

redirect('settings?inc=package');
}
}

?>