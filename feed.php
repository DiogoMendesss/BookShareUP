<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];

    $userProposals = getUserProposals($userID);

    include_once('template/header.php');
    include_once('template/feed_tpl.php');
    include_once('template/footer.php');
?>