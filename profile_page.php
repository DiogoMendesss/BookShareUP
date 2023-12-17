<?php
    session_start();
    $up_number = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];
    
    include_once('templates/header.php');
    include_once('templates/profile_page_tpl.php');
?>