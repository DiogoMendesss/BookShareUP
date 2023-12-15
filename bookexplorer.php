<?php
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;

    $books = getBooks();

    $isBookAdded = isBookAdded($userID, $row['id']);
    $action = $isBookAdded ? 'remove_from_library' : 'add_to_library';
    
    echo ("This is the book explorer");

    include_once('templates/header.php');
    include_once('templates/book_explorer_tpl.php');
?>