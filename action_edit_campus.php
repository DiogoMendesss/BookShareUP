<?php
    session_start();
    require_once('database/init.php');
    require_once('database/db_campus.php');

    if (isset($_POST['selectedCampuses'])) {
    $selectedCampuses = $_POST['selectedCampuses'];
    $up_number = $_SESSION['up_number'];

    updateCampusesInfo($up_number, $selectedCampuses); }

    header('Location: my_profile.php');
    exit();
?>