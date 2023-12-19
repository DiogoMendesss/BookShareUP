<?php
session_start();
require_once('database/init.php');
require_once('database/db_users.php');

$up_number = $_SESSION['up_number'];
$newStatus = getOtherUserStatus($up_number);

updateUserStatus($up_number, $newStatus);
header('Location: user_profile.php');
exit();

?>