<?php
    require_once('database/init.php');
    require_once('database/books.php');

    $userID = 202005393;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        if ($action === 'add_to_library') {
            // Handle adding the book to the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            addToWantToRead($userID, $bookID);
        } elseif ($action === 'remove_from_library') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
        }

        // Redirect back to the book explorer or any other page as needed
        header("Location: bookexplorer.php");
        exit();
    }
?>
