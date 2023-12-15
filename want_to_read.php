<!DOCTYPE html>

<?php
// Assuming you have a user ID, replace 1 with the actual user ID
$userID = 202005393;

// Global PDO object
try {
    $db = new PDO('sqlite:sql/bsup.db');
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    die("Connection failed: " . $e->getMessage());
}

// Function to retrieve books the user is interested in
function getInterestedBooks($userID, $db) {
    try {
        // Prepared statement to avoid SQL injection
        $stmt = $db->prepare("
            SELECT Book.id, Book.name, Book.author
            FROM InterestedIn
            JOIN Book ON InterestedIn.book = Book.id
            WHERE InterestedIn.user = :userID
        ");
        
        // Binding parameters
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        
        // Executing the query
        $stmt->execute();
        
        // Fetching the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle database connection errors
        die("Error: " . $e->getMessage());
    }
}

// Retrieve the interested books
$interestedBooks = getInterestedBooks($userID, $db);
?>

<html>
    <head>
        <title>Want To Read</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/want_to_read_style.css">
    </head>
    <body>
        <header>
            <?php include "templates/navbar.php";?>
        </header>
        <main>
        <section class="module">
                <h1>Explorer</h1>
                <section class="shelf">
                <?php
                    // Loop through results and generate HTML for each book proposal
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<article class="book-item">'; // Apply flex styles

                        // Construct the image filename based on the book ID
                        $imageFilename = 'images/bookcovers/' . $row['id'] . '.jpg';

                        // Check if the image file exists
                        if (file_exists($imageFilename)) {
                            // Display the book cover image
                            echo '<img src="' . $imageFilename . '" alt="Book Cover" class="book-cover">';
                        } else {
                            // Display a default image if the file doesn't exist
                            echo '<img src="images/default.jpg" alt="Default Cover" class="book-cover">';
                        }

                        echo '<div class="book-details">';
                        echo '<h2 class="book-title">' . htmlspecialchars($row['name']) . '</h2>';
                        echo '<p class="book-author">Author: ' . htmlspecialchars($row['author']) . '</p>';


                        echo '</div>';
                        echo '</article>';
                    }
                ?>
                </section>
            </section>
        </main>
        <footer>
            <p class="basic-text">BookShare UP</p>
        </footer>
    </body>
</html>
