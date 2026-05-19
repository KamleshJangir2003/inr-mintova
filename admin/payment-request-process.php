<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid'])) redirect('index');

if($_REQUEST['case'] == 'delete') {
    $sql = "DELETE FROM `mi_member_payment` WHERE `id`='".mysqli_real_escape_string($conn,$_REQUEST['id'])."'";
    query($conn, $sql);
    redirect('request');
}

if($_REQUEST['case'] == 'status') {
    $id = (int)$_REQUEST['id'];
    $row = fetcharray(query($conn, "SELECT * FROM mi_member_payment WHERE id='$id'"));

    if($row['status'] == 'P') {
        $userid = $row['userid'];
        $amount = floatval($row['amount']);
        $date   = date('Y-m-d');

        // Approve payment
        $conn->query("UPDATE mi_member_payment SET status='C' WHERE id='$id'");

        // Credit wallet
        $conn->query("INSERT INTO imaksoft_deposit (userid, amount, remarks, date) VALUES ('$userid', '$amount', 'USDT Deposit - Admin Approved', '$date')");

        // Activate member if not already active
        $conn->query("UPDATE imaksoft_member SET paystatus='A', status='A' WHERE userid='$userid' AND paystatus='I'");

    } else {
        $conn->query("UPDATE mi_member_payment SET status='P' WHERE id='$id'");
    }
    redirect('request');
}
?>
