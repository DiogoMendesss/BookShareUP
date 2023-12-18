<?php
    require_once('database/init.php');
    require_once('database/db_books.php');
    
    session_start();
    $userID = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];

    $userCopies = getUserCopies($userID);
    //var_dump($wantToReadBooks);


    //echo ("This is the My Library");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        

        if ($action === 'delete_copy') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeCopy($userID, $bookID);
            header("Location: my_library.php");
            exit();
        }
    } 
    
    include_once('template/header.php');
    include_once('template/my_library_tpl.php');
    include_once('template/footer.php');
?>