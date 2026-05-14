<?php 
session_start();
include('admin/inc/function.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".trim($_POST['userid'])."' AND `password`='".base64_encode(trim($_POST['password']))."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
$_SESSION['mid']=$fetch['id'];

redirect('mem/dashboard');
}else{
redirect('login?e=1');
}
}
?>