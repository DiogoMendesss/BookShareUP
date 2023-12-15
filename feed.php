<!DOCTYPE html>

<html>
    <head>
        <title>Feed</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="feed_style.css">
    </head>
    <body>
        <header>
            <?php include "navbar.php";?>
        </header>
        <main>
        </main>
        <footer>
            <p class=basic-text>BookShare UP</p>
        </footer>
    </body>
</html>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Proposal Feed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        section {
            display: flex;
            flex-direction: column; /* Display articles in a column */
            align-items: center; /* Center articles horizontally */
            padding: 20px;
        }

        article {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 15px;
            width: 80%; /* Adjust the width as needed */
            max-width: 400px; /* Set a maximum width if desired */
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>

<header>
    <h1>Book Proposal Feed</h1>
</header>

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

</body>
</html>

<?php
// Close the database connection
$db->close();
?>
