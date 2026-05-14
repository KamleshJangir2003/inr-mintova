<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SESSION['sid'])
{


if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_REQUEST['case']=='edit')
{
$sql2="UPDATE `imaksoft_settings_social` SET `tele`='".mysqli_real_escape_string($conn,$_POST['tele'])."',`utube`='".mysqli_real_escape_string($conn,$_POST['utube'])."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res2=query($conn,$sql2);

redirect('settings?inc=teleutube');
}
}


}

?>