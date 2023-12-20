<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');
    require_once('database/db_books.php');
    require_once('database/db_borrowings.php');
    require_once('database/db_badges.php');

    $user = $_GET['user'];
    $msg = $_SESSION['msg'];  

    $borrowedBooksNumber = countOwnerBorrowings($user);
    $readBooksNumber = countBorrowerBorrowings($user);
    updateUserBadges($user, $borrowedBooksNumber, $readBooksNumber);
    $badges = getUserBadges($user);

    
    include_once('template/header.php');
    include_once('template/user_profile_tpl.php');
    include_once('template/footer.php');
?>
