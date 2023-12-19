<?php 
session_start();

require_once('database/init.php');
require_once('database/db_users.php');

$up_number = $_POST['up_number'];
$password = $_POST['password'];
$full_name = $_POST['first_name'] . " " . $_POST['last_name'];
$faculty_campus = $_POST['campus'];
$profile_pic = $_FILES['profile_pic']; // Use $_FILES to get the file information

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

    insertUser($up_number, $password, $full_name, $faculty_campus);
    saveProfilePic($up_number);
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