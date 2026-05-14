<?php
include "inc/function.php"; // DB connection

$type = $_POST['type'];

if ($type == "imps" || $type == "manual") {

    // Get current value
    $q = $conn->query("SELECT $type FROM imaksoft_settings_onoff LIMIT 1");
    $row = $q->fetch_assoc();
    $current = $row[$type];

    // Toggle value: A ↔ I
    $new_status = ($current == "A") ? "I" : "A";

    // Update in DB
    $conn->query("UPDATE imaksoft_settings_onoff SET $type='$new_status'");

    echo json_encode([
        "status" => "success",
        "new_status" => $new_status
    ]);
    exit;
}

echo json_encode(["status" => "error"]);
?>
