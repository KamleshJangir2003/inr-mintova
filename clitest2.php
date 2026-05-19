<?php
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://apilist.tronscanapi.com/api/transaction-info?hash=0000000000000000000000000000000000000000000000000000000000000001",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0',
    CURLOPT_SSL_VERIFYPEER => false,
]);
$res = curl_exec($ch);
$err = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP: $code\n";
echo "Error: $err\n";
echo "Response: " . $res . "\n\n";

$data = json_decode($res, true);
echo "Keys: " . implode(', ', array_keys($data ?? [])) . "\n";
echo "confirmed type: " . gettype($data['confirmed'] ?? null) . " = " . var_export($data['confirmed'] ?? null, true) . "\n";
echo "contractType: " . var_export($data['contractType'] ?? null, true) . "\n";
echo "contractRet: " . var_export($data['contractRet'] ?? null, true) . "\n";
echo "trc20TransferInfo: " . var_export($data['trc20TransferInfo'] ?? null, true) . "\n";
