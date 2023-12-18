<!DOCTYPE html>

<?php
    session_start();
    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];

    $userProposals = getUserProposals($userID);
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <title>Feed</title>
    </head>
    <body>
        <?php include_once('template/header.php'); ?>
        <?php include_once('template/feed_tpl.php');; ?>
    </body>
</html>