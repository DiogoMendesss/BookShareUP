<?php
    session_start();
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = $_SESSION['up_number'];

    $userProposals = getUserProposals($userID);




    include_once('templates/header.php');
    include_once('templates/feed_tpl.php');
?>