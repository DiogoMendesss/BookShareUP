<?php
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;

    $books = getBooks();
    
    echo ("This is the book explorer");

    include_once('templates/header.php');
    include_once('templates/my_profile_tpl.php');
?>