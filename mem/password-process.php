<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid']))
{
redirect('index');
}


if($_SERVER['REQUEST_METHOD']=='POST')
{
if($_SESSION['mid'])
{
$sql="SELECT * FROM `imaksoft_member` WHERE `id`='".trim($_SESSION['mid'])."' AND `password`='".base64_encode($_POST['current'])."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
if($_POST['newpass']==$_POST['conpass'])
{
$sql="UPDATE `imaksoft_member` SET `password`='".base64_encode($_POST['newpass'])."' WHERE `id`='".$_SESSION['mid']."'";
$res=query($conn,$sql);

redirect('edit?case=password&updated=2');
}else{
redirect('edit?case=password&invalid=3');
}

}else{
redirect('edit?case=password&invalid=1');
}
}
}
?>