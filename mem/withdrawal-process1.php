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

    // ✅ Step 1: Check Transaction Password
    if (!isset($_POST['tpassword']) || trim($_POST['tpassword']) == '') {
        redirect('withdraw?case=new&e=7'); // Missing transaction password
    }

    $sql = "SELECT * FROM `imaksoft_member` 
            WHERE `id`='" . trim($_SESSION['mid']) . "' 
            AND `tpassword`='" . trim($_POST['tpassword']) . "'";
    $res = query($conn, $sql);
    $num = numrows($res);

    if ($num <= 0) {
        redirect('withdraw?case=new&e=6'); // Invalid transaction password
    }

    // ✅ Step 2: Continue with normal withdrawal flow
    if (isset($_POST['amount']) && $_POST['amount'] > 0) {

        $userid = getMember($conn, $_SESSION['mid'], 'userid');
        $avabal = getAvailableFundWallet($conn, $userid);
        $chargeper = getSettingsWithdrawal($conn, 'charge');
        $charge = (trim($_POST['amount']) * $chargeper) / 100;
        $payout = (trim($_POST['amount']) - $charge);
        $type = isset($_POST['type']) ? trim($_POST['type']) : 'Withdrawal';
        $api = isset($_POST['api']) ? trim($_POST['api']) : 'XXX';
        $amount = trim($_POST['amount']);
        $wallet_address = trim($_POST['wallet_address']);
        $date = date('Y-m-d H:i:s');
        $status = 'Pending';

        if ($avabal >= $amount) {

            $min = getSettingsWithdrawal($conn, 'minimum');
            if ($amount >= $min) {

                // Function to generate random 5-character hash
                function generateRandomHash($length = 5) {
                    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    $hash = '';
                    for ($i = 0; $i < $length; $i++) {
                        $hash .= $characters[random_int(0, strlen($characters) - 1)];
                    }
                    return $hash;
                }

                $hash = generateRandomHash(5);
                $bitcoin = getMember($conn, $_SESSION['mid'], 'bitcoin');
                $dateOnly = date('Y-m-d');

                // FIXED: Correct number of placeholders and parameters
               $sql1 = "INSERT INTO `imaksoft_withdrawal` 
        (`userid`, `request`, `charge`, `payout`, `bname`, `branch`, `accname`, `accno`, `ifscode`, `type`, `bitcoin`, `upi`, `status`, `approved`, `date`, `datetime`, `hash`) 
        VALUES (?, ?, ?, ?, '', '', '', '', '', ?, ?, '', 'P', '', ?, NOW(), ?)";

                $stmt = $conn->prepare($sql1);
                
                // Debug: Check if prepare worked
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }
                
                
                
                // FIXED: Correct number of parameters - 8 placeholders, 8 parameters
                $stmt->bind_param("sdddssss", $userid, $amount, $charge, $payout, $type, $bitcoin, $dateOnly, $hash);
                $stmt->execute();

                // Insert into transaction table
                $sql2 = "INSERT INTO transaction (userid, type, amount, charge, output, api, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt2 = $conn->prepare($sql2);
                
                if (!$stmt2) {
                    die("Prepare failed: " . $conn->error);
                }
                
                $stmt2->bind_param("ssddssss", $userid, $type, $amount, $charge, $payout, $api, $date, $status);
                $stmt2->execute();

                // Redirect after successful insert
                if ($stmt->affected_rows > 0) {
                    redirect('withdraw?case=new&p=1');
                } else {
                    redirect('withdraw?case=new&e=5'); // Insert failed
                }

            } else {
                redirect('withdraw?case=new&e=1'); // Below minimum amount
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