<?php
    session_start();

    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;

    $n_books = getNumberOfBooks();
    $n_pages = ceil($n_books / 6);
  
    if (isset($_GET['page_num']) && $_GET['page_num'] > 0) {
        $page_num = $_GET['page_num'];
        if ($page_num > $n_pages) {
            $page_num = $n_pages;
        }
    } else {
        $page_num = 1;
    }

    $books = getBooksByPage($page_num);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        

        if ($action === 'add_to_library') {

            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: bookexplorer.php?page_num=$page_num&addBook=$bookID");
            exit();
        } elseif ($action === 'remove_from_library') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
            header("Location: bookexplorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_book') {
            $interest_level = $_POST['interest_level'];
            $bookID = $_POST['book_id'];
            addToWantToRead($userID, $bookID, $interest_level);
            header("Location: bookexplorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: bookexplorer.php?addCopy=$bookID&page_num=$page_num");
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            header("Location: bookexplorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: bookexplorer.php?page_num=$page_num");
            exit();
        }
    }
    
    echo ("This is the book explorer");

    include_once('templates/header.php');
    include_once('templates/book_explorer_tpl.php');
?>
