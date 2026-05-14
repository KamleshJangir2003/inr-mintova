<?php
session_start();
include('../admin/inc/function.php');

if(!isset($_SESSION['mid'])) {
    redirect('index');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_SESSION['mid']) {

        // Check current password (plain text)
        $sql = "SELECT * FROM `imaksoft_member` 
                WHERE `id` = '".trim($_SESSION['mid'])."' 
                AND `tpassword` = '".$_POST['current']."'";

        $res = query($conn, $sql);
        $num = numrows($res);

        if($num > 0) {

            // Check new == confirm
            if($_POST['newpass'] == $_POST['conpass']) {

                // Update plain password
                $sql = "UPDATE `imaksoft_member` 
                        SET `tpassword` = '".$_POST['newpass']."' 
                        WHERE `id` = '".$_SESSION['mid']."'";

                $res = query($conn, $sql);

                redirect('edit?case=tpassword&updated=2');

            } else {
                redirect('edit?case=tpassword&invalid=3');
            }

        } else {
            redirect('edit?case=tpassword&invalid=1');
        }
    }
}
?>
