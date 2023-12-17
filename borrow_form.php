<?php
// borrow_form.php
require_once('database/init.php');
require_once('database/books.php');

$userID = 202005393;

$userProposals = getUserProposals($userID);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the form
    $bookID = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    // Retrieve other values if needed

    // You can process the form data here or redirect to another page
} else {
    // Redirect to another page or display an error message if accessed directly
}

include_once('templates/header.php');
include_once('templates/borrow_form_tpl.php');
?>
