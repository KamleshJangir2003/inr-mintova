<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid'])) redirect('../index');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = mysqli_real_escape_string($conn, trim($_POST['userid']));
    $amount = floatval($_POST['amount']);
    $tranid = mysqli_real_escape_string($conn, trim($_POST['tranid']));
    $date   = date('Y-m-d');
    $screenshot = '';

    if($amount <= 0) redirect('deposit');

    // Upload screenshot
    if(isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if(in_array($ext, $allowed)) {
            $filename = 'ss_' . time() . '_' . $userid . '.' . $ext;
            move_uploaded_file($_FILES['screenshot']['tmp_name'], __DIR__ . '/uploads/screenshots/' . $filename);
            $screenshot = $filename;
        }
    }

    // Check duplicate tranid
    $chk = $conn->prepare("SELECT id FROM mi_member_payment WHERE tranid=?");
    $chk->bind_param("s", $tranid);
    $chk->execute();
    $chk->store_result();
    if($chk->num_rows > 0) redirect('deposit?dup=1');

    $stmt = $conn->prepare("INSERT INTO mi_member_payment (userid, tranid, slip, amount, status, date) VALUES (?,?,?,?,'P',?)");
    $stmt->bind_param("sssds", $userid, $tranid, $screenshot, $amount, $date);
    $stmt->execute();

    redirect('deposit?s=1');
}
redirect('deposit');
?>
