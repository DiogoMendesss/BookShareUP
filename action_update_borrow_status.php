<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php');
require_once('database/db_users.php');


$borrowerID = $_POST['borrowerID'];
$newStatus = $_POST['borrowStatus'];
$copyID = $_POST['bookID'];

// Update the status
updateBorrowStatus($copyID, $borrowerID, $newStatus);

// Redirect or do something after successful update
if ($newStatus === 'returned') {
    updateUserStatus($borrowerID, 'active');
}
elseif ($newStatus === 'accepted') {
    updateBookCopyAvailability($copyID, 'borrowed');
}
elseif ($newStatus === 'archived') {
    updateBookCopyAvailability($copyID, 'available');
}

header('Location: feed.php');
exit();
?>
