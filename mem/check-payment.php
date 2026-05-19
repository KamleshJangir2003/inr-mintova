<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid'])) { echo json_encode(['status'=>'error','msg'=>'Not logged in']); exit; }

header('Content-Type: application/json');

$userid  = getMember($conn, $_SESSION['mid'], 'userid');
$amount  = floatval($_POST['amount'] ?? 0);
$network = in_array($_POST['network'] ?? '', ['trc20','bep20']) ? $_POST['network'] : 'trc20';
$date    = date('Y-m-d');

if($amount <= 0) { echo json_encode(['status'=>'error','msg'=>'Invalid amount']); exit; }

$qr_res = $conn->query("SELECT * FROM imaksoft_settings_qr LIMIT 1");
$qr = $qr_res ? $qr_res->fetch_assoc() : null;
$trc20_wallet = $qr['wallet_address'] ?? '';
$bep20_wallet = $qr['bep20_wallet_address'] ?? '';

// ── TRC20 ──────────────────────────────────────────────────────────────────
if($network === 'trc20' && !empty($trc20_wallet)) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => "https://api.trongrid.io/v1/accounts/{$trc20_wallet}/transactions/trc20?limit=20&only_confirmed=true",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT      => 'Mozilla/5.0',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER     => ['Accept: application/json'],
    ]);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);
    $txs  = $data['data'] ?? [];

    foreach($txs as $tx) {
        // Only incoming USDT to our wallet
        if(strtolower($tx['to'] ?? '') !== strtolower($trc20_wallet)) continue;
        if(strtoupper($tx['token_info']['symbol'] ?? '') !== 'USDT') continue;

        $decimals  = intval($tx['token_info']['decimals'] ?? 6);
        $tx_amount = floatval($tx['value'] ?? 0) / pow(10, $decimals);
        $tranid    = $tx['transaction_id'] ?? '';
        $tx_time   = intval(($tx['block_timestamp'] ?? 0) / 1000);

        // Only transactions in last 24 hours
        if((time() - $tx_time) > 86400) continue;
        if(abs($tx_amount - $amount) >= 0.01) continue;

        // Check duplicate
        $chk = $conn->prepare("SELECT id FROM mi_member_payment WHERE tranid=?");
        $chk->bind_param("s", $tranid);
        $chk->execute();
        $chk->store_result();
        if($chk->num_rows > 0) {
            echo json_encode(['status'=>'already','msg'=>'Already processed']);
            exit;
        }

        // Save + credit
        $verify_note = 'Auto Verified - TRC20';
        $status      = 'C';
        $screenshot  = '';
        $stmt = $conn->prepare("INSERT INTO mi_member_payment (userid, tranid, slip, network, amount, status, verify_note, date) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssdsss", $userid, $tranid, $screenshot, $network, $amount, $status, $verify_note, $date);
        $stmt->execute();

        $conn->query("INSERT INTO imaksoft_deposit (userid, amount, remarks, date) VALUES ('$userid', '$amount', 'USDT Deposit - Auto Verified TRC20', '$date')");
        $conn->query("UPDATE imaksoft_member SET paystatus='A', status='A' WHERE userid='$userid' AND paystatus='I'");

        echo json_encode(['status'=>'success','msg'=>'Payment verified!','amount'=>$tx_amount,'hash'=>$tranid]);
        exit;
    }

    echo json_encode(['status'=>'waiting','msg'=>'Waiting for payment...']);
    exit;
}

// ── BEP20 ──────────────────────────────────────────────────────────────────
if($network === 'bep20' && !empty($bep20_wallet)) {
    $usdt_contract = '0x55d398326f99059ff775485246999027b3197955';
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => "https://api.bscscan.com/api?module=account&action=tokentx&contractaddress={$usdt_contract}&address={$bep20_wallet}&sort=desc&offset=20&page=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT      => 'Mozilla/5.0',
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $res = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($res, true);
    $txs  = $data['result'] ?? [];

    foreach($txs as $tx) {
        if(strtolower($tx['to'] ?? '') !== strtolower($bep20_wallet)) continue;
        $decimals  = intval($tx['tokenDecimal'] ?? 18);
        $tx_amount = floatval($tx['value']) / pow(10, $decimals);
        $tranid    = $tx['hash'] ?? '';
        $tx_time   = intval($tx['timeStamp'] ?? 0);

        // Only transactions in last 24 hours
        if((time() - $tx_time) > 86400) continue;
        if(abs($tx_amount - $amount) >= 0.01) continue;

        $chk = $conn->prepare("SELECT id FROM mi_member_payment WHERE tranid=?");
        $chk->bind_param("s", $tranid);
        $chk->execute();
        $chk->store_result();
        if($chk->num_rows > 0) { echo json_encode(['status'=>'already','msg'=>'Already processed']); exit; }

        $verify_note = 'Auto Verified - BEP20';
        $status      = 'C';
        $screenshot  = '';
        $stmt = $conn->prepare("INSERT INTO mi_member_payment (userid, tranid, slip, network, amount, status, verify_note, date) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssdsss", $userid, $tranid, $screenshot, $network, $amount, $status, $verify_note, $date);
        $stmt->execute();

        $conn->query("INSERT INTO imaksoft_deposit (userid, amount, remarks, date) VALUES ('$userid', '$amount', 'USDT Deposit - Auto Verified BEP20', '$date')");
        $conn->query("UPDATE imaksoft_member SET paystatus='A', status='A' WHERE userid='$userid' AND paystatus='I'");

        echo json_encode(['status'=>'success','msg'=>'Payment verified!','amount'=>$tx_amount,'hash'=>$tranid]);
        exit;
    }

    echo json_encode(['status'=>'waiting','msg'=>'Waiting for payment...']);
    exit;
}

echo json_encode(['status'=>'error','msg'=>'Network not configured']);
