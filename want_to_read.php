<?php
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;


    
    echo ("This is the Want to read Library");

    include_once('templates/header.php');
    include_once('templates/want_to_read_tpl.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <title>My Library</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/my_library_style.css">
    </head>
    <body>
        <header>
            <?php include "templates/navbar.php";?>
        </header>
        <main>
            <section class=container>
                <img src="book.png" alt="book">
                <h1>ADD BOOK</h1>
                <img src="search.png" alt="book">
                <h1>SEARCH BOOK</h1>
            </section>
            <section class=container>
                <button class=edit img src="pencil.png" alt="edit"></button>
                <section class=shelf>
                    <img src="images/book.jpg" alt="Book 1">
                    <img src="images/book.jpg" alt="Book 2">
                    <img src="images/book.jpg" alt="Book 3">
                <section>
                <section class=shelf>
                    <img src="images/book.jpg" alt="Book 4">
                    <img src="images/book.jpg" alt="Book 5">
                    <img src="images/book.jpg" alt="Book 6">
                <section>
            </section>
        </main>
        <footer>
            <p class=basic-text>BookShare UP</p>
        </footer>
    </body>
</html>