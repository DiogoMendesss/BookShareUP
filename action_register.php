<?php 
    session_start();
    require_once('database/init.php');
    require_once('database/db_users.php');

    $up_number = $_POST['up_number'];
    $password = $_POST['password'];
    $full_name = $_POST['first_name'] . " " . $_POST['last_name'];
    $faculty_campus = $_POST['faculty_campus'];

    try {
        insertUser($up_number, $password, $full_name, $faculty_campus);
        $_SESSION['up_number'] = $up_number;
        $_SESSION['full_name'] = $full_name;
        header('Location: user_profile.php');
    }
    catch (PDOException $e) {
        $_SESSION['msg'] = 'Error: ' . $e->getMessage();
        header('Location: home_page.php?action=register');
    }
?>