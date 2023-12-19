<?php
  session_start();

  require_once('database/init.php');
  require_once('database/db_users.php');

  // get up_number and password from HTTP parameters
  $up_number = $_POST['up_number'];
  $password = $_POST['password'];

  // if login successful:
  // - create a new session attribute for the user
  // - redirect user to main page
  // else:
  // - set error msg "Login failed!"
  // - redirect user to main page

  try {
    if ($up_number == 1) {
      header('Location: admin.php');
    } elseif (loginSuccess($up_number, $password)) {
      $_SESSION['up_number'] = $up_number;
      $_SESSION['full_name'] = getUserFullName($up_number);
      header('Location: user_profile.php');
    } else {
        $_SESSION['up_number'] = null;
        $_SESSION['full_name'] = null;
        $_SESSION['msg'] = 'Invalid up_number or password!';
        header('Location: home_page.php');
    }
  } catch (PDOException $e) {
    $_SESSION['msg'] = 'Error: ' . $e->getMessage();
  }
?>