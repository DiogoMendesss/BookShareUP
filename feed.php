<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_books.php');
    require_once('database/db_users.php');
    require_once('next_borrow_state.php');
    
    $userID = $_SESSION['up_number'];

    $userProposals = getUserProposals($userID);


    include_once('templates/header.php');
    if (getUserStatus($userID) === 'reading'){
        include_once('templates/feed_currently_reading_tpl.php');
    }
    else {
        include_once('templates/feed_tpl.php');
    }
    include_once('template/footer.php');
?>