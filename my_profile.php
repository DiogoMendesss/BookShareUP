<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');
    require_once('database/db_books.php');
    require_once('database/db_borrowings.php');

    $up_number = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];  



    if (isset($_POST['ChangeProfilePic'])) {
        $changePicRequest = $_POST['ChangeProfilePic'];
    }


    $borrowedBooks = getOngoingUserBorrows($up_number);
    
    include_once('template/header.php');
    include_once('template/my_profile_tpl.php');
    include_once('template/footer.php');
?>
