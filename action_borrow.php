<?php
session_start();
require_once('database/init.php');
require_once('database/db_books.php'); 
require_once('database/db_users.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'ask_borrow') {
    // Get the form data
    $bookCopyID = $_POST['bookCopyID'];
    $borrowerID = $_SESSION['up_number'];
    //$startDate = date("Y-m-d");
    //$duration = 31; // 31 days, adjust as needed
    $ownerCampus = $_POST['campus'][0]; // Assuming there's only one campus, adjust accordingly

    // Calculate expiration date
    //$expirationDate = date("Y-m-d", strtotime($startDate . "+ $duration days"));

    // Add the borrowing record to the database
    $status = 'pending'; // You can change this as needed
    $proposal = null; // You may need to set this based on your database structure
    
    try {
        insertBorrowing($status, $bookCopyID, $borrowerID, $ownerCampus);
        // Redirect or do something after successful borrowing
        updateUserStatus($borrowerID, 'reading');
        header('Location: feed.php'); // Change to the appropriate page
        exit();
    } catch (PDOException $e) {
        // Handle errors if needed
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect or handle invalid requests
    header('Location: feed.php'); // Change to the appropriate page
    exit();
}
?>
