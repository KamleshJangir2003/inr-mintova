<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect('localhost', 'u937873453_new', 'u937873453_New', 'u937873453_new');
if(!$conn) { die('DB FAIL: ' . mysqli_connect_error() . "\n"); }
echo "DB OK\n\n";

// Check mi_member_payment columns
$cols = $conn->query('SHOW COLUMNS FROM mi_member_payment');
if($cols) {
    echo "=== mi_member_payment columns ===\n";
    while($c = $cols->fetch_assoc()) echo $c['Field'] . ' | ' . $c['Type'] . "\n";
} else {
    echo "TABLE mi_member_payment NOT FOUND\n";
}

echo "\n=== Wallet Addresses ===\n";
$qr_res = $conn->query('SELECT * FROM imaksoft_settings_qr LIMIT 1');
$qr = $qr_res ? $qr_res->fetch_assoc() : null;
echo 'TRC20: ' . ($qr['wallet_address'] ?? 'NOT SET') . "\n";
echo 'BEP20: ' . ($qr['bep20_wallet_address'] ?? 'NOT SET') . "\n";

echo "\n=== Last 5 Deposit Submissions ===\n";
$dep = $conn->query('SELECT userid, tranid, amount, status, verify_note, date FROM mi_member_payment ORDER BY id DESC LIMIT 5');
if($dep && $dep->num_rows > 0) {
    while($r = $dep->fetch_assoc()) {
        echo 'User:'.$r['userid'].' | Amt:'.$r['amount'].' | Status:'.$r['status'].' | Note:'.($r['verify_note']??'').' | '.$r['date']."\n";
    }
} else {
    echo "No records in mi_member_payment\n";
}

echo "\n=== TronScan API Reachability ===\n";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://apilist.tronscanapi.com/api/transaction-info?hash=abc123',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_USERAGENT => 'Mozilla/5.0',
    CURLOPT_SSL_VERIFYPEER => false,
]);
$res = curl_exec($ch);
$err = curl_error($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if($err) echo "cURL Error: $err\n";
else echo "HTTP Code: $http_code | Response size: ".strlen($res)." bytes\n";
echo "Response: " . substr($res, 0, 300) . "\n";
