<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../admin/inc/function.php');

$userid = isset($_GET['userid']) ? trim($_GET['userid']) : '';

if ($userid === '') {
    if (function_exists('redirect')) redirect('index.php?error=no_userid');
    header('Location: index.php?error=no_userid');
    exit;
}

$sql = "SELECT `id`, `userid`, `name`, `email` FROM `imaksoft_member` WHERE `userid` = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Update the most recent withdrawal record - add 20% to amount and set status to Approved
    $update_sql = "UPDATE `transaction` 
                   SET `status` = 'Approved',
                       `amount` = `amount` * 1.10
                   WHERE `userid` = ? 
                   ORDER BY `id` DESC 
                   LIMIT 1";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('s', $userid);
    $update_stmt->execute();

    session_regenerate_id(true);

    $_SESSION['mid']    = $user['id'];
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['mname']  = $user['name'] ?? '';
    $_SESSION['memail'] = $user['email'] ?? '';

    if (function_exists('redirect')) {
        redirect('deposit?p=1');
    } else {
        header('Location: dashboard');
    }
    exit;
}

if (function_exists('redirect')) redirect('index.php?error=user_not_found');
header('Location: index?error=user_not_found');
exit;
?>