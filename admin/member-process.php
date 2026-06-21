<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid']))
{
redirect('index');
}

if($_SESSION['sid'])
{
if($_REQUEST['case']=='add')
{
$userid=$prefix.rand(1111111,9999999);

$sql="INSERT INTO `imaksoft_member` (`userid`,`password`,`name`,`email`,`phone`,`address`,`bname`,`branch`,`accname`,`accno`,`ifscode`,`bitcoin`,`upi`,`pancard`,`aadharcard`,`status`,`date`) VALUES('".$userid."','".base64_encode(trim($_POST['password']))."','".trim($_POST['name'])."','".trim($_POST['email'])."','".trim($_POST['phone'])."','".trim($_POST['address'])."','".trim($_POST['bname'])."','".trim($_POST['branch'])."','".trim($_POST['accname'])."','".trim($_POST['accno'])."','".trim($_POST['ifscode'])."','".trim($_POST['bitcoin'])."','".trim($_POST['upi'])."','".trim($_POST['pancard'])."','".trim($_POST['aadharcard'])."','A','".date('Y-m-d')."')";
$res=query($conn,$sql);

redirect('member?inc=memdet');
}


if($_REQUEST['case']=='edit')
{
$sql3="UPDATE `imaksoft_member` SET `name`='".trim($_POST['name'])."',`email`='".trim($_POST['email'])."',`phone`='".trim($_POST['phone'])."',`password`='".base64_encode(trim($_POST['password']))."',`tpassword`='".trim($_POST['tpassword'])."',`address`='".trim($_POST['address'])."',`bname`='".trim($_POST['bname'])."',`branch`='".trim($_POST['branch'])."',`accname`='".trim($_POST['accname'])."',`accno`='".trim($_POST['accno'])."',`ifscode`='".trim($_POST['ifscode'])."',`bitcoin`='".trim($_POST['bitcoin'])."',`upi`='".trim($_POST['upi'])."',`pancard`='".trim($_POST['pancard'])."',`aadharcard`='".trim($_POST['aadharcard'])."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res3=query($conn,$sql3);

redirect('member?inc=memdet&m=1&page='.$_REQUEST['page']);
}


if($_REQUEST['case']=='status')
{
if($_REQUEST['st']=='A'){$st='I';}else{$st='A';}

$sql2="UPDATE `imaksoft_member` SET `status`='".$st."' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res2=query($conn,$sql2); 

redirect('member?inc=memdet&page='.$_REQUEST['page']);
}



if($_REQUEST['case']=='activate')
{
$sql="UPDATE `imaksoft_member` SET `paystatus`='A', `status`='A' WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
query($conn,$sql);
$back = isset($_REQUEST['redirect']) ? $_REQUEST['redirect'] : 'act';
redirect('member?inc='.$back);
}

if($_REQUEST['case']=='delete')
{
$sql="DELETE FROM `imaksoft_member` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
$res=query($conn,$sql); 

redirect('member?inc=memdet&'.mysqli_real_escape_string($conn,$_REQUEST['page']));
}
}
?>