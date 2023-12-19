<?php

session_start();

require_once('database/init.php');
require_once('database/db_books.php');


$userID = $_SESSION['up_number'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $page_num = $_POST['page_num'];
    $bookID = $_POST['book_id'];
    
    $search_title = $_POST['search_title'];
    $search_author = $_POST['search_author'];
    $search_genre = $_POST['search_genre'];

    if ($action === 'add_to_wanttoread') {

        // variable $_GET['addBook'] is set 
        if (!empty($search_title) || !empty($search_author) || !empty($search_genre)) {
            header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addBook=$bookID");
        } else {
            header("Location: book_explorer.php?page_num=$page_num&addBook=$bookID");
        }
        exit();

    } elseif ($action === 'remove_from_wanttoread') {
    
        removeFromWantToRead($userID, $bookID);

        if (!empty($search_title) || !empty($search_author) || !empty($search_genre)) {
            header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre");
        } else {
            header("Location: book_explorer.php?page_num=$page_num");
        }
        exit();

    } elseif ($action === 'confirm_add_book') {

        $interest_level = $_POST['interest_level'];

        addToWantToRead($userID, $bookID, $interest_level);
        if (!empty($search_title) || !empty($search_author) || !empty($search_genre)) {
            header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre");
        } else {
            header("Location: book_explorer.php?page_num=$page_num");
        }
        exit();
    }
}

?>