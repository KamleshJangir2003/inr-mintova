<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SESSION['sid'])
{
if($_REQUEST['case']=='edit')
{
$sql1="UPDATE `imaksoft_settings_withdrawal` SET `minimum`='".trim(mysqli_real_escape_string($conn,$_POST['minimum']))."',`charge`='".trim(mysqli_real_escape_string($conn,$_POST['charge']))."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res1=query($conn,$sql1);

redirect('settings?inc=with');
}
}
?>
