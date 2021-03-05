<?php 
    session_start();
    session_destroy();
    header('location:../Bank_v2/login.php');
?>