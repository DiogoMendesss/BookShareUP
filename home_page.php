<?php
    session_start();

    require_once('database/init.php');
    include_once('database/db_users.php');
    include_once('database/db_campus.php');
    
    $register_request = $_GET['action'];

    $campuses = getCampusesInfo();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/home_page.css">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <title>Book Sharing UP</title>
    </head>
    <body>
        <?php include_once('template/home_page_tpl.php'); ?>
    </body>
<html>