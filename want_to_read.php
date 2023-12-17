<?php
    session_start();

    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];

    $wantToReadBooks = getWantToReadBooks($userID);
    //var_dump($wantToReadBooks);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        

        if ($action === 'remove_book') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            //var_dump($bookID);
            removeFromWantToRead($userID, $bookID);
            header("Location: want_to_read.php");
            exit();
        }
    }

    include_once('template/header.php');
    include_once('template/home_page_tpl.php');
    include_once('template/footer.php');
?>
