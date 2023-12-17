<?php
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;

    $userProposals = getUserProposals($userID);




    include_once('templates/header.php');
    include_once('templates/feed_tpl.php');
?>