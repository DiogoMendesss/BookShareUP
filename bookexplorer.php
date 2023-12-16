<?php
    session_start();

    require_once('database/init.php');
    require_once('database/books.php');
    

    /* $showInterestLevel = isset($_SESSION['showInterestLevel']) ? $_SESSION['showInterestLevel'] : false;
    $showInterestLevel = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        if ($action === 'add_to_library') {
            $_SESSION['showInterestLevel'] = true;
        }
    }
    */
    
    $userID = 202005393;

    $books = getBooks();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';


        if ($action === 'add_to_library') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: bookexplorer.php?addBook=$bookID");
            exit();
        } elseif ($action === 'remove_from_library') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
            header("Location: bookexplorer.php");
            exit();
        } elseif ($action === 'confirm_add_book') {
            // Handle removing the book from the library
            //echo ("ADDED BOOK");
            $interest_level = $_POST['interest_level'];
            $bookID = $_POST['book_id'];
            addToWantToRead($userID, $bookID, $interest_level);
            header("Location: bookexplorer.php");
            exit();

        } elseif ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: bookexplorer.php?addCopy=$bookID");
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            header("Location: bookexplorer.php");
            exit();
        }elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: bookexplorer.php");
            exit();
        }


    }
    
    echo ("This is the book explorer");

    include_once('templates/header.php');
    include_once('templates/book_explorer_tpl.php');
?>