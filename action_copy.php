<?php
    session_start();

    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        $search_title = $_POST['search_title'];
        $search_author = $_POST['search_author'];
        $search_genre = $_POST['search_genre'];
        

        if ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            if (!empty($search_title) || !empty($search_author) || !empty($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addCopy=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num&addCopy=$bookID");
            }
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            if (!empty($search_title) || !empty($search_author) || !empty($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addCopy=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num");
            }
            exit();
        } elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: my_library.php");
            exit();
        }
    }

    ?>