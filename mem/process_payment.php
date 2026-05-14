<?php
session_start();
include('../admin/inc/function.php');

if(!isset($_SESSION['mid'])){
    redirect('../index');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userid = $_POST['userid'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $charges = $_POST['charges'];
    $final = $_POST['final'];
    $api = $_POST['api'];
    $status = 'Pending';
    $date = date('Y-m-d H:i:s');

    // Save to local database first
    $stmt = $conn->prepare("INSERT INTO transaction (userid, type, amount, charge, output, api, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddssss", $userid, $type, $amount, $charges, $final, $api, $date, $status);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        // Now send all data to external payment processor
        ?>
        <form id="redirectForm" action="https://paycrypto.live/deposit-v1" method="post">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="hidden" name="type" value="<?=$type?>">
            <input type="hidden" name="amount" value="<?=$amount?>">
            <input type="hidden" name="charges" value="<?=$charges?>">
            <input type="hidden" name="final" value="<?=$final?>">
            <input type="hidden" name="api" value="<?=$api?>">
        </form>
        <script>
            document.getElementById('redirectForm').submit();
        </script>
        <?php
    } else {
        header("Location: deposit?r=1");
    }
    exit;
}
?>
