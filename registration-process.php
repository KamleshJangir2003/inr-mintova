<?php 
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('admin/inc/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor = trim(mysqli_real_escape_string($conn, $_POST['sponsor']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $pancard = trim(mysqli_real_escape_string($conn, $_POST['pancard']));
    $aadharcard = trim(mysqli_real_escape_string($conn, $_POST['aadharcard']));

    // Check if sponsor exists
    $sql = "SELECT * FROM `imaksoft_member` WHERE `userid`='$sponsor'";
    $res = query($conn, $sql);
    $num = numrows($res);

    if ($num > 0) {
       

        // Check if phone and email are already used (limit to 2 entries)
        $sqlp = "SELECT * FROM `imaksoft_member` WHERE `phone`='$phone' AND `email`='$email'";
        $resp = query($conn, $sqlp);
        $nump = numrows($resp);

        if ($nump < 2) {
            $fetch = fetcharray($res);
            $userid = $prefix . rand(1111111, 9999999);
            $tpassword = rand(1111, 9999);

            $sql = "INSERT INTO `imaksoft_member` (`userid`, `sponsor`, `password`, `tpassword`, `name`, `email`, `phone`, `address`, `bname`, `branch`, `accname`, `accno`, `ifscode`, `bitcoin`, `upi`, `pancard`, `aadharcard`, `status`, `paystatus`, `date`, `approved`, `datetime`) 
                    VALUES ('$userid', '$sponsor', '" . base64_encode(trim($_POST['password'])) . "', '$tpassword', '" . trim($_POST['name']) . "', '$email', '$phone', '" . trim($_POST['address']) . "', '', '', '', '', '', '', '', '$pancard', '$aadharcard', 'A', 'I', '" . date('Y-m-d') . "', '', '" . date('Y-m-d H:i:s') . "')";
            
            $res = query($conn, $sql);
            $id = mysqli_insert_id($conn);

            if ($_REQUEST['case'] == 'introducer') {
                redirect('welcome?msg=4&id=' . $id . '&intr=' . $sponsor);
            } else {
                redirect('welcome?msg=4&id=' . $id);
            }
        } else {
            if ($_REQUEST['case'] == 'introducer') {
                redirect('introducer?intr=' . $sponsor . '&e=1');
            } else {
                redirect('register?reg=' . $sponsor . '&e=1');
            }
        }
    } else {
        if ($_REQUEST['case'] == 'introducer') {
            redirect('introducer?intr=' . $sponsor . '&q=4');
        } else {
            redirect('register?reg=' . $sponsor . '&q=4');
        }
    }
}
?>
