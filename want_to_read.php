<!DOCTYPE html>

<?php
    require_once('database/init.php');
    require_once('database/db_books.php');
    session_start();
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
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <title>Want To Read</title>
    </head>
    <body>
        <?php include_once('template/header.php'); ?>
        <?php include_once('template/want_to_read_tpl.php'); ?>
    </body>
</html>