<?php
session_start();
include('../admin/inc/function.php');

echo "Session mid: " . ($_SESSION['mid'] ?? 'NOT SET') . "\n";

if(isset($_SESSION['mid'])) {
    $userid = getMember($conn, $_SESSION['mid'], 'userid');
    echo "Userid: $userid\n\n";
    
    $res = $conn->query("SELECT * FROM imaksoft_deposit WHERE userid='$userid' ORDER BY id DESC LIMIT 10");
    echo "Deposit records for $userid: " . $res->num_rows . "\n";
    while($r = $res->fetch_assoc()) {
        echo "  Amt:{$r['amount']} | {$r['remarks']} | {$r['date']}\n";
    }
}
