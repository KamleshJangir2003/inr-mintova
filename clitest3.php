<?php
$conn = mysqli_connect('localhost', 'u937873453_new', 'u937873453_New', 'u937873453_new');

// Insert test deposit for MS1001
$conn->query("INSERT INTO imaksoft_deposit (userid, amount, remarks, date) VALUES ('MS1001', '50.00', 'USDT Deposit - Auto Verified TRC20', '".date('Y-m-d')."')");
echo "Inserted: " . $conn->affected_rows . " row\n";

// Verify
$res = $conn->query("SELECT * FROM imaksoft_deposit WHERE userid='MS1001' ORDER BY id DESC LIMIT 5");
echo "MS1001 deposit records: " . $res->num_rows . "\n";
while($r = $res->fetch_assoc()) {
    echo "  Amt:{$r['amount']} | {$r['remarks']} | {$r['date']}\n";
}
