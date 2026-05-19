<?php
session_start();
include('../admin/inc/function.php');

// Only allow admin or local access
if (!isset($_SESSION['mid']) && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    die('Access denied');
}

echo "<style>body{font-family:monospace;background:#111;color:#0f0;padding:20px;} .ok{color:#0f0;} .err{color:#f44;} .warn{color:#fa0;} pre{background:#222;padding:10px;border-radius:6px;overflow:auto;}</style>";
echo "<h2 style='color:#fa0'>🔍 USDT Deposit Verification Tester</h2>";

// ── 1. Check DB table columns ──────────────────────────────────────────────
echo "<h3>1. mi_member_payment Table Columns</h3>";
$cols = $conn->query("SHOW COLUMNS FROM mi_member_payment");
if ($cols) {
    echo "<pre>";
    while ($c = $cols->fetch_assoc()) {
        echo $c['Field'] . " | " . $c['Type'] . " | " . $c['Null'] . "\n";
    }
    echo "</pre>";
} else {
    echo "<span class='err'>❌ Table mi_member_payment not found! Run setup SQL first.</span><br>";
}

// ── 2. Check imaksoft_settings_qr wallet addresses ─────────────────────────
echo "<h3>2. Wallet Addresses in DB</h3>";
$qr_res = $conn->query("SELECT * FROM imaksoft_settings_qr LIMIT 1");
$qr = $qr_res ? $qr_res->fetch_assoc() : null;
if ($qr) {
    $trc20 = $qr['wallet_address'] ?? '';
    $bep20 = $qr['bep20_wallet_address'] ?? '';
    echo "TRC20 Wallet: <span class='" . ($trc20 ? 'ok' : 'err') . "'>" . ($trc20 ?: '❌ NOT SET') . "</span><br>";
    echo "BEP20 Wallet: <span class='" . ($bep20 ? 'ok' : 'warn') . "'>" . ($bep20 ?: '⚠️ Not set') . "</span><br>";
} else {
    echo "<span class='err'>❌ imaksoft_settings_qr table empty or missing!</span><br>";
    $trc20 = ''; $bep20 = '';
}

// ── 3. Test TRC20 TX Hash ──────────────────────────────────────────────────
$test_txhash = trim($_GET['txhash'] ?? '');
$test_amount = floatval($_GET['amount'] ?? 0);
$test_network = $_GET['network'] ?? 'trc20';

echo "<h3>3. Test a Transaction Hash</h3>";
echo "<form method='get'>
  <input name='txhash' value='" . htmlspecialchars($test_txhash) . "' placeholder='Paste TX Hash here' style='width:500px;padding:6px;background:#222;color:#fff;border:1px solid #555;'>
  <input name='amount' value='" . $test_amount . "' placeholder='Amount (USDT)' style='width:100px;padding:6px;background:#222;color:#fff;border:1px solid #555;'>
  <select name='network' style='padding:6px;background:#222;color:#fff;border:1px solid #555;'>
    <option value='trc20'" . ($test_network==='trc20'?' selected':'') . ">TRC20</option>
    <option value='bep20'" . ($test_network==='bep20'?' selected':'') . ">BEP20</option>
  </select>
  <button type='submit' style='padding:6px 14px;background:#fa0;color:#000;border:none;cursor:pointer;'>Test</button>
</form><br>";

if ($test_txhash) {
    if ($test_network === 'trc20') {
        echo "<h4>TRC20 API Response (TronScan)</h4>";
        $url = "https://apilist.tronscanapi.com/api/transaction-info?hash=" . urlencode($test_txhash);
        echo "URL: <span style='color:#aaa'>$url</span><br><br>";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT      => 'Mozilla/5.0',
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($ch);
        $curl_err  = curl_error($ch);
        curl_close($ch);

        if ($curl_err) {
            echo "<span class='err'>❌ cURL Error: $curl_err</span><br>";
        } elseif (!$response) {
            echo "<span class='err'>❌ Empty response from TronScan API</span><br>";
        } else {
            $data = json_decode($response, true);
            echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>";

            // Run same logic as deposit-submit.php
            $transfer     = $data['trc20TransferInfo'][0] ?? null;
            $contractType = $data['contractType'] ?? 0;
            $confirmed    = $data['confirmed'] ?? false;
            $contractRet  = $data['contractRet'] ?? '';

            echo "<h4>Verification Check</h4>";
            echo "contractType: <b>$contractType</b> (need 31) " . ($contractType==31 ? "<span class='ok'>✅</span>" : "<span class='err'>❌</span>") . "<br>";
            echo "contractRet: <b>$contractRet</b> (need SUCCESS) " . ($contractRet==='SUCCESS' ? "<span class='ok'>✅</span>" : "<span class='err'>❌</span>") . "<br>";
            echo "confirmed: <b>" . ($confirmed ? 'true' : 'false') . "</b> " . ($confirmed ? "<span class='ok'>✅</span>" : "<span class='err'>❌</span>") . "<br>";

            if ($transfer) {
                $to_address   = $transfer['to_address'] ?? '';
                $token_symbol = $transfer['symbol'] ?? '';
                $raw_amount   = floatval($transfer['amount_str'] ?? 0);
                $decimals     = intval($transfer['decimals'] ?? 6);
                $tx_amount    = $raw_amount / pow(10, $decimals);

                echo "to_address: <b>$to_address</b><br>";
                echo "DB TRC20 wallet: <b>$trc20</b><br>";
                echo "Address match: " . (strtolower($to_address)==strtolower($trc20) ? "<span class='ok'>✅ MATCH</span>" : "<span class='err'>❌ NO MATCH</span>") . "<br>";
                echo "token_symbol: <b>$token_symbol</b> " . (strtoupper($token_symbol)==='USDT' ? "<span class='ok'>✅</span>" : "<span class='err'>❌</span>") . "<br>";
                echo "tx_amount: <b>$tx_amount</b> | entered: <b>$test_amount</b> | diff: <b>" . abs($tx_amount - $test_amount) . "</b> " . (abs($tx_amount-$test_amount)<0.01 ? "<span class='ok'>✅</span>" : "<span class='err'>❌ Amount mismatch</span>") . "<br>";

                $all_ok = ($contractType==31 && $contractRet==='SUCCESS' && $confirmed && strtolower($to_address)==strtolower($trc20) && strtoupper($token_symbol)==='USDT' && abs($tx_amount-$test_amount)<0.01);
                echo "<br><b>Final Result: " . ($all_ok ? "<span class='ok'>✅ WOULD AUTO-VERIFY</span>" : "<span class='err'>❌ WOULD GO PENDING</span>") . "</b><br>";
            } else {
                echo "<span class='err'>❌ trc20TransferInfo[0] not found in response — TX may not be a USDT transfer or hash is wrong</span><br>";
            }
        }
    } else {
        // BEP20
        echo "<h4>BEP20 API Response (BSCScan)</h4>";
        $url = "https://api.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=" . urlencode($test_txhash);
        echo "URL: <span style='color:#aaa'>$url</span><br><br>";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT      => 'Mozilla/5.0',
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($ch);
        $curl_err  = curl_error($ch);
        curl_close($ch);

        if ($curl_err) {
            echo "<span class='err'>❌ cURL Error: $curl_err</span><br>";
        } else {
            $data = json_decode($response, true);
            echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>";
            $tx = $data['result'] ?? null;
            if ($tx) {
                $usdt_contract = '0x55d398326f99059ff775485246999027b3197955';
                echo "to (contract): <b>" . ($tx['to'] ?? '') . "</b><br>";
                echo "USDT contract match: " . (strtolower($tx['to'] ?? '')===$usdt_contract ? "<span class='ok'>✅</span>" : "<span class='err'>❌</span>") . "<br>";
            } else {
                echo "<span class='err'>❌ TX not found</span><br>";
            }
        }
    }
}

// ── 4. Recent deposit submissions ─────────────────────────────────────────
echo "<h3>4. Last 5 Deposit Submissions (mi_member_payment)</h3>";
$res = $conn->query("SELECT userid, tranid, amount, status, verify_note, date FROM mi_member_payment ORDER BY id DESC LIMIT 5");
if ($res && $res->num_rows > 0) {
    echo "<table border='1' cellpadding='6' style='border-collapse:collapse;color:#fff;'>";
    echo "<tr style='background:#333'><th>UserID</th><th>TranID</th><th>Amount</th><th>Status</th><th>Verify Note</th><th>Date</th></tr>";
    while ($r = $res->fetch_assoc()) {
        $sc = $r['status']==='C' ? 'ok' : 'warn';
        echo "<tr><td>{$r['userid']}</td><td style='font-size:11px'>" . substr($r['tranid'],0,20) . "...</td><td>\${$r['amount']}</td><td class='$sc'>{$r['status']}</td><td>{$r['verify_note']}</td><td>{$r['date']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<span class='warn'>No records found in mi_member_payment</span><br>";
}

echo "<br><br><span style='color:#555;font-size:12px'>⚠️ Delete this file after testing: mem/test-verify.php</span>";
?>
