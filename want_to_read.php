<?php
    require_once('database/init.php');
    require_once('database/books.php');
    
    $userID = 202005393;

    $wantToReadBooks = getWantToReadBooks($userID);
    //var_dump($wantToReadBooks);


    echo ("This is the Want to read Library");

    include_once('templates/header.php');
    include_once('templates/want_to_read_tpl.php');
?>