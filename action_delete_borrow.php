<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php');
require_once('database/db_users.php');

$borrowerID = $_POST['borrowerID'];
$copyID = $_POST['copyID'];

deleteBorrow($copyID, $borrowerID);
updateUserStatus($borrowerID, 'active');
header('Location: feed.php');
exit();
?>