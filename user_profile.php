<!DOCTYPE html>

<?php
    session_start();
    $up_number = $_SESSION['up_number'];
    $msg = $_SESSION['msg'];    
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
           <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <title>User Profile</title>
    </head>
    <body>
        <?php include_once('template/header.php'); ?>
        <?php include_once('template/user_profile_tpl.php'); ?>
    </body>
</html>
