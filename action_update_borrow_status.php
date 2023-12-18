<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php');
require_once('database/db_users.php');


$borrowerID = $_POST['borrowerID'];
$newStatus = $_POST['borrowStatus'];
$bookID = $_POST['bookID'];

// Update the status
updateBorrowStatus($bookID, $borrowerID, $newStatus);

// Redirect or do something after successful update
if ($newStatus === 'returned') {
    updateUserStatus($borrowerID, 'active');
}
elseif ($newStatus === 'accepted') {
    updateBookCopyAvailability($bookCopyID, 'borrowed');
}
elseif ($newStatus === 'archived') {
    updateBookCopyAvailability($bookCopyID, 'available');
}
header('Location: feed.php');
exit();
?>
