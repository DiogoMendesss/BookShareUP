<?php 
session_start();
require_once('database/init.php');
require_once('database/db_users.php');

$up_number = $_POST['up_number'];
$password = $_POST['password'];
$full_name = $_POST['first_name'] . " " . $_POST['last_name'];
$faculty_campus = $_POST['faculty_campus'];
$profile_pic = $_FILES['profile_picture']; // Use $_FILES to get the file information

try {
    $_SESSION['up_number'] = $up_number;

    if (isset($profile_pic) && $profile_pic['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where you want to save the uploaded profile pictures
        $uploadDir = 'images/profilePics/';

        // Generate the filename based on the username and file extension
        $uploadFile = $up_number . '.jpg'; // Use $up_number instead of $username

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($profile_pic['tmp_name'], $uploadDir . $uploadFile)) {
            $_SESSION['msg'] = 'nice';
            // File upload successful
        } else {
            // No file uploaded or an error occurred
            $_SESSION['msg'] = 'Error uploading profile picture';
            header('Location: main_page.php?action=register');
        }
    }

    insertUser($up_number, $password, $full_name, $faculty_campus);
    header('Location: profile_page.php');
}
catch (PDOException $e) {
    $_SESSION['msg'] = 'Error: ' . $e->getMessage();
    header('Location: main_page.php?action=register');
}
?>
