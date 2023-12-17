<?php
    session_start();
    $up_number = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];
    
    include_once('templates/header.php');
    include_once('templates/my_library_tpl.php');
?>