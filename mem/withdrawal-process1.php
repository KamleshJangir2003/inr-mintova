<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../admin/inc/function.php');

if (!isset($_SESSION['mid'])) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Step 1: Check Transaction Password
    if (!isset($_POST['tpassword']) || trim($_POST['tpassword']) == '') {
        redirect('withdraw?case=new&e=7');
    }

    $sql = "SELECT * FROM `imaksoft_member` WHERE `id`='" . trim($_SESSION['mid']) . "' AND `tpassword`='" . trim($_POST['tpassword']) . "'";
    $res = query($conn, $sql);
    if (numrows($res) <= 0) {
        redirect('withdraw?case=new&e=6'); // Invalid transaction password
    }

    // Step 2: Time check — Everyday 8AM to 10PM IST
    $hour = (int)date('G');
    if ($hour < 8 || $hour >= 22) {
        redirect('withdraw?case=new&e=9'); // Outside withdrawal hours
    }

    if (isset($_POST['amount']) && $_POST['amount'] > 0) {

        $userid  = getMember($conn, $_SESSION['mid'], 'userid');
        $avabal  = getAvailableFundWallet($conn, $userid);
        $amount  = (float)trim($_POST['amount']);
        $type    = isset($_POST['type']) ? trim($_POST['type']) : 'Withdrawal';
        $api     = isset($_POST['api'])  ? trim($_POST['api'])  : 'XXX';
        $date    = date('Y-m-d H:i:s');
        $status  = 'Pending';

        // Minimum ₹100 and must be multiple of ₹100
        if ($amount < 100 || ($amount % 100) != 0) {
            redirect('withdraw?case=new&e=1'); // Below minimum or not multiple of 100
        }

        // 10% admin charge
        $charge  = round($amount * 10 / 100, 2);
        $payout  = round($amount - $charge, 2);

        if ($avabal >= $amount) {

            function generateRandomHash($length = 5) {
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $hash = '';
                for ($i = 0; $i < $length; $i++) {
                    $hash .= $chars[random_int(0, strlen($chars) - 1)];
                }
                return $hash;
            }

            $hash      = generateRandomHash(5);
            $bitcoin   = getMember($conn, $_SESSION['mid'], 'bitcoin');
            $dateOnly  = date('Y-m-d');
            $wallet_address = trim($_POST['wallet_address'] ?? $bitcoin);

            $sql1 = "INSERT INTO `imaksoft_withdrawal` 
                (`userid`, `request`, `charge`, `payout`, `bname`, `branch`, `accname`, `accno`, `ifscode`, `type`, `bitcoin`, `upi`, `status`, `approved`, `date`, `datetime`, `hash`) 
                VALUES (?, ?, ?, ?, '', '', '', '', '', ?, ?, '', 'P', '', ?, NOW(), ?)";

            $stmt = $conn->prepare($sql1);
            if (!$stmt) die("Prepare failed: " . $conn->error);

            $stmt->bind_param("sdddssss", $userid, $amount, $charge, $payout, $type, $bitcoin, $dateOnly, $hash);
            $stmt->execute();

            // Log in transaction table
            $sql2 = "INSERT INTO transaction (userid, type, amount, charge, output, api, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt2 = $conn->prepare($sql2);
            if (!$stmt2) die("Prepare failed: " . $conn->error);

            $payoutStr = (string)$payout;
            $stmt2->bind_param("ssddssss", $userid, $type, $amount, $charge, $payoutStr, $api, $date, $status);
            $stmt2->execute();

            if ($stmt->affected_rows > 0) {
                redirect('withdraw?case=new&p=1');
            } else {
                redirect('withdraw?case=new&e=5');
            }

        } else {
            redirect('withdraw?case=new&e=2'); // Insufficient balance
        }

    } else {
        redirect('withdraw?case=new&e=3'); // Invalid amount
    }

} else {
    redirect('withdraw?case=new&e=4'); // Invalid request
}
?>
