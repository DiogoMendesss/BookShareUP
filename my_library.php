<!DOCTYPE html>

<?php
    require_once('database/init.php');
    require_once('database/db_books.php');
    
    session_start();
    $userID = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];

    $userCopies = getUserCopies($userID);
    //var_dump($wantToReadBooks);


    //echo ("This is the My Library");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        

        if ($action === 'delete_copy') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeCopy($userID, $bookID);
            header("Location: my_library.php");
            exit();
        }
    }    
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <title>My Library</title>
    </head>
    <body>
        <?php include_once('templates/header.php'); ?>
        <?php include_once('templates/my_library_tpl.php'); ?>
    </body>
</html>