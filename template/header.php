<?php
    session_start();

    $up_number = $_SESSION['up_number'];

?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/user_profile.css">
         <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <title>Book Sharing UP</title>
    </head>
    <body>
        <header class="header">
            <nav class="navbar">
                <ul class="navbar-nav">
                    <li class="logo">
                        <a href="book_explorer.php?page_num=1" class="nav-link"> 
                            <img src="image/logo.png" alt="Logo">
                            <span class="link-text">BSUP</span>
                        </a>
                    </li>
                    <il class="nav-item">
                        <a href="book_explorer.php?page_num=1" class="nav-link"> 
                            <img src="image/avatar/avatar_1.jpg" alt="Explorer">
                            <span class="link-text">Explorer</span>
                        </a>
                    </il>
                    <il class="nav-item">
                        <a href="want_to_read.php" class="nav-link">
                            <img src="image/avatar/avatar_2.jpg" alt="Want To Read">
                            <span class="link-text">Want To Read</span>
                        </a>
                    </il>
                    <il class="nav-item">
                        <a href="feed.php" class="nav-link">
                            <img src="image/avatar/avatar_3.jpg" alt="Feed">
                            <span class="link-text">Feed</span>
                        </a>
                    </il>
                    <il class="nav-item">
                        <a href="my_library.php" class="nav-link">
                            <img src="image/avatar/avatar_4.jpg" alt="My Library">
                            <span class="link-text">My Library</span>
                        </a>
                    </il>
                    <il class="nav-item">
                        <a href="my_profile.php" class="nav-link">
                            <img src="image/avatar/hasbulla.jpg" alt="User Profile">
                            <span class="link-text">My Profile</span>
                        </a>
                    </il>
                    <il class="nav-item">
                        <form id = "logout-form" action="action_logout.php">
                            <button>Logout</button>
                        </form>
                    </il>
            </nav>
<!-- header only closes in the templates to include the title and search bar in the header -->