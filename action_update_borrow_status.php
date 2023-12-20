<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php');
require_once('database/db_users.php');
require_once('database/db_borrowings.php');

$userID = $_SESSION['up_number'];


$borrowerID = $_POST['borrowerID'];
$newStatus = $_POST['newStatus'];
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
elseif($newStatus === 'delivered'){
    initializeDates($copyID, $borrowerID);
}

header('Location: user_profile.php?user='.$userID);
exit();
?>
