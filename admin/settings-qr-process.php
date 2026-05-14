<?php
session_start();
include('inc/function.php');
if(!isset($_SESSION['sid'])) redirect('index');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wallet = mysqli_real_escape_string($conn, trim($_POST['wallet_address']));
    $existing = fetcharray(query($conn, "SELECT * FROM imaksoft_settings_qr LIMIT 1"));
    $qr_image = $existing['qr_image'] ?? '';

    if(isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['qr_image']['name'], PATHINFO_EXTENSION));
        if(in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            $filename = 'qr_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['qr_image']['tmp_name'], __DIR__ . '/uploads/qr/' . $filename);
            $qr_image = $filename;
        }
    }

    if($existing) {
        $conn->query("UPDATE imaksoft_settings_qr SET wallet_address='$wallet', qr_image='$qr_image' WHERE id='{$existing['id']}'");
    } else {
        $conn->query("INSERT INTO imaksoft_settings_qr (wallet_address, qr_image) VALUES ('$wallet', '$qr_image')");
    }
    redirect('settings?inc=qr&m=1');
}
redirect('settings?inc=qr');
?>
