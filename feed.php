<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_books.php');
    require_once('database/db_users.php');
    require_once('next_borrow_state.php');
    require_once('database/db_borrowings.php');
    
    $userID = $_SESSION['up_number'];

    $userProposals = getUserProposals($userID);


    include_once('template/header.php');
    if (getUserStatus($userID) === 'reading'){
        include_once('template/feed_currently_reading_tpl.php');
    }
    else {
        include_once('template/feed_tpl.php');
    }
    include_once('template/footer.php');
?>