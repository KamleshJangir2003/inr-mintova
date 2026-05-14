<?php
session_start();
include('inc/function');
unset($_SESSION['sid']);
session_destroy();

redirect('index');
?>