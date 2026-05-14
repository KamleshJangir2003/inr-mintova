<?php
session_start();
include('../admin/inc/function.php');
unset($_SESSION['sid']);
session_destroy();

redirect('../index');
?>