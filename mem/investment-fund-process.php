<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid']))
{
redirect('index.php');
}

if($_SESSION['mid'])
{
$userid=getMember($conn,$_SESSION['mid'],'userid');

$avafund=getAvailableFundWallet($conn,$userid);
$amount=$_POST['amount'];

if($avafund>=$amount)
{
$sql="INSERT INTO `imaksoft_member_investment`(`userid`,`package`,`amount`,`date`)VALUES('".$userid."','".trim($_POST['package'])."','".$amount."','".date('Y-m-d')."')";
$res=query($conn,$sql);

$paystatus=getMemberUserID($conn,$userid,'paystatus');
if($paystatus=='I')
{
$sql1="UPDATE `imaksoft_member` SET `paystatus`='A',`approved`='".date('Y-m-d')."' WHERE `userid`='".$userid."'";
$res1=query($conn,$sql1);
}



$dailyper=$_POST['roi'];
$nodays=$_POST['days'];

$bonus=($amount*$dailyper)/100;

//---------------------------ROI-------------------------------//
$last = getLastROIAccount($conn, $userid);
$account = $last + 1;

/* MAIN ROI ENTRY */
query($conn,"
INSERT INTO imaksoft_member_roi
(userid,account,amount,percentage,nodays,bonus,status,date,remarks)
VALUES
('$userid','$account','$amount','$dailyper','$nodays','$bonus','R',CURDATE(),'')
");

/* -------- COMMISSION ROI -------- */

$added = 0;
$i = 0;

while ($added < $nodays) {

    $roiDate = date('Y-m-d', strtotime("+$i day"));
    $day = date('l', strtotime($roiDate));

    /* FORCE TODAY ALWAYS */
    if ($i == 0 || in_array($day, ['Monday','Tuesday','Wednesday','Thursday','Friday'])) {

        /* DUPLICATE SAFETY */
        $chk = query($conn,"
        SELECT id FROM imaksoft_commission_roi
        WHERE userid='$userid'
        AND account='$account'
        AND date='$roiDate'
        ");

        if (numrows($chk) == 0) {

            query($conn,"
            INSERT INTO imaksoft_commission_roi
            (userid,account,amount,percentage,bonus,status,date)
            VALUES
            ('$userid','$account','$amount','$dailyper','$bonus','H','$roiDate')
            ");

            $added++;
        }
    }

    $i++;
}

//------------------------------------------------//
/* ===============================
   DIRECT BONUS (AMOUNT BASED)
================================ */
$sponsor = getMember($conn, $_SESSION['mid'], 'sponsor');

if (!empty($sponsor)) {

    $directPercent = 0;

    if ($amount >= 50 && $amount <= 499) {
        $directPercent = 20;
    } elseif ($amount >= 500 && $amount <= 999) {
        $directPercent = 25;
    } elseif ($amount >= 1000 && $amount <= 5000) {
        $directPercent = 30;
    }

    if ($directPercent > 0) {

        $directBonus = ($amount * $directPercent) / 100;

        query($conn, "
        INSERT INTO imaksoft_commission_direct
        (userid, fromid, bonus, date)
        VALUES
        ('$sponsor', '$userid', '$directBonus', CURDATE())
        ");
    }
}




redirect('invest?case=new&m=2');
}else{
redirect('invest?case=new&e=3');
}

}

?>