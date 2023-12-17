<!DOCTYPE html>

<?php
// Connect to SQLite database
$db = new SQLite3('sql/bsup.db');

// Check if connection is successful
if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}

// Assuming you have a user ID, replace 1 with the actual user ID
$userID = 202005393;

// Query to retrieve book proposals for the given user
$query = $db->query("SELECT b.id, b.name AS book_name, b.author, u.name AS owner_name
                     FROM InterestedIn i
                     JOIN BookCopy bc ON i.book = bc.book
                     JOIN Book b ON bc.book = b.id
                     JOIN User u ON bc.owner = u.up_number
                     WHERE i.user = $userID
                     AND bc.availability = 'available'");

// HTML content generation
?>

<html lang=en>
    <head>
        <title>Feed</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php include('templates/header.php') ?>
        <section>
    <?php
    // Loop through results and generate HTML for each book proposal
    while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
        echo '<article style="display: flex; align-items: center;">'; // Apply flex styles

        // Construct the image filename based on the book ID
        $imageFilename = 'images/bookcovers/' . $row['id'] . '.jpg';

        // Check if the image file exists

        if (file_exists($imageFilename)) {
            // Display the book cover image
            echo '<img src="' . $imageFilename . '" alt="Book Cover" style="max-width: 100px; margin-right: 15px;">';
        } else {
            // Display a default image if the file doesn't exist
            echo '<img src="images/default.jpg" alt="Default Cover" style="max-width: 100px; margin-right: 15px;">';
        }

        echo '<div>';
        echo '<h2>' . htmlspecialchars($row['book_name']) . '</h2>';
        echo '<p>Author: ' . htmlspecialchars($row['author']) . '</p>';
        echo '<p>Owner: ' . htmlspecialchars($row['owner_name']) . '</p>';
        echo '<div>';

        echo '</article>';
    }
    ?>
        </section>
        <footer>
            <p class=basic-text>BookShare UP</p>
        </footer>
    </body>
</html>

<?php
// Close the database connection
$db->close();
?>
