<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php'); 
require_once('database/db_users.php'); 
require_once('database/db_borrowings.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Get the form data
    $bookCopyID = $_POST['bookCopyID'];
    $borrowerID = $_SESSION['up_number'];
    $action = $_POST['action'];


    if ($action === 'confirm_borrow') {
        try {
            $status = 'pending';
            $ownerCampus = $_POST['campus'];
            insertBorrowing($status, $bookCopyID, $borrowerID, $ownerCampus);
            // Redirect or do something after successful borrowing
            updateUserStatus($borrowerID, 'reading');
            header('Location: feed.php'); // Change to the appropriate page
            exit();
        } catch (PDOException $e) {
            // Handle errors if needed
            echo 'Error: ' . $e->getMessage();
        }
    } elseif ($action === 'borrow') {
        $owner = $_POST['owner'];
        header("Location: feed.php?owner=$owner&copy=$bookCopyID");
    }


} else {
    // Redirect or handle invalid requests
    header('Location: feed.php'); // Change to the appropriate page
    exit();
}
?>
