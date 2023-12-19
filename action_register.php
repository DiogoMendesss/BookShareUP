<?php 
session_start();

require_once('database/init.php');
require_once('database/db_users.php');

$up_number = $_POST['up_number'];
$password = $_POST['password'];
$full_name = $_POST['first_name'] . " " . $_POST['last_name'];
$faculty_campus = $_POST['campus'];
$profile_pic = $_FILES['profile_picture']; // Use $_FILES to get the file information

if (strlen($up_number) != 9) {
    $_SESSION['msg'] = 'Invalid up number!';
    header('Location: home_page.php?action=register');
    die();
  }

  if (strlen($password) < 8) {
    $_SESSION['msg'] = 'Password must have at least 8 characters.';
    header('Location: home_page.php?action=register');
    die();
  }

try {
    $_SESSION['up_number'] = $up_number;

    if (isset($profile_pic) && $profile_pic['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where you want to save the uploaded profile pictures
        $uploadDir = 'image/avatar/';

        // Generate the filename based on the username and file extension
        $uploadFile = $up_number . '.jpg'; // Use $up_number instead of $username

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($profile_pic['tmp_name'], $uploadDir . $uploadFile)) {
            $_SESSION['msg'] = 'nice';
            // File upload successful
        } else {
            // No file uploaded or an error occurred
            $_SESSION['msg'] = 'Error uploading profile picture';
            header('Location: home_page.php?action=register');
        }
    }

    insertUser($up_number, $password, $full_name, $faculty_campus);
    header('Location: user_profile.php');
}
catch (PDOException $e) {
    $error_msg = $e->getMessage();
    if (strpos($error_msg, 'UNIQUE')) {
        $_SESSION['msg'] = 'UP number already registed!';
      } else {
        $_SESSION['msg'] = "Registration failed! ($error_msg)";
      }
    header('Location: home_page.php?action=register');
}
?>