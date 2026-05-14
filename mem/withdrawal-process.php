<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid']))
{
redirect('index');
}

if($_SESSION['mid'])
{
if($_REQUEST['case']=='add')
{

//------------------------------------//
if($_POST['amount']>0)
{
$userid=getMember($conn,$_SESSION['mid'],'userid');
$avabal=getAvailableWallet($conn,$userid);
$chargeper=getSettingsWithdrawal($conn,'charge');

$charge=(trim($_POST['amount'])*$chargeper)/100;

$payout=(trim($_POST['amount'])-($charge));

if($avabal>=trim($_POST['amount']))
{
$min=getSettingsWithdrawal($conn,'minimum');
$amt=trim($_POST['amount']);

if($amt>=$min)
{
if($_POST['type']=='Bank')
{
$sql1="INSERT INTO `imaksoft_withdrawal` (`userid`,`request`,`charge`,`payout`,`bname`,`branch`,`accname`,`accno`,`ifscode`,`date`,`status`,`type`,`bitcoin`,`upi`,`approved`) VALUES('".getMember($conn,$_SESSION['mid'],'userid')."','".mysqli_real_escape_string($conn,$_POST['amount'])."','".$charge."','".$payout."','".getMember($conn,$_SESSION['mid'],'bname')."','".getMember($conn,$_SESSION['mid'],'branch')."','".getMember($conn,$_SESSION['mid'],'accname')."','".getMember($conn,$_SESSION['mid'],'accno')."','".getMember($conn,$_SESSION['mid'],'ifscode')."','".date('Y-m-d')."','P','".trim($_POST['type'])."','','','')";
$res1=query($conn,$sql1);
}
if($_POST['type']=='Bitcoin')
{
$sql1="INSERT INTO `imaksoft_withdrawal` (`userid`,`request`,`charge`,`payout`,`bname`,`branch`,`accname`,`accno`,`ifscode`,`date`,`status`,`type`,`bitcoin`,`upi`,`approved`) VALUES('".getMember($conn,$_SESSION['mid'],'userid')."','".mysqli_real_escape_string($conn,$_POST['amount'])."','".$charge."','".$payout."','','','','','','".date('Y-m-d')."','P','".trim($_POST['type'])."','".getMember($conn,$_SESSION['mid'],'bitcoin')."','','')";
$res1=query($conn,$sql1);
}
if($_POST['type']=='UPI')
{
$sql1="INSERT INTO `imaksoft_withdrawal` (`userid`,`request`,`charge`,`payout`,`bname`,`branch`,`accname`,`accno`,`ifscode`,`date`,`status`,`type`,`bitcoin`,`upi`,`approved`) VALUES('".getMember($conn,$_SESSION['mid'],'userid')."','".mysqli_real_escape_string($conn,$_POST['amount'])."','".$charge."','".$payout."','','','','','','".date('Y-m-d')."','P','".trim($_POST['type'])."','','".getMember($conn,$_SESSION['mid'],'upi')."','')";
$res1=query($conn,$sql1);
}

redirect('withdraw?case=new&p=1');
}else{
redirect('withdraw?case=new&e=1');
}

}else{
redirect('withdraw?case=new&e=2');
}
}else{
redirect('withdraw?case=new&e=3');
}
//--------------------------------------//

}
}
?> 