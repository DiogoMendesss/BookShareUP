<?php
    session_start();

    $up_number = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];  
    $user_profile = $_GET['user']; 
    
    include_once('template/header.php');
    include_once('template/user_profile_tpl.php');
    include_once('template/footer.php');
?>
