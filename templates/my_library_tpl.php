<?php
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
?>

<section class="owned-books">
        <h2>Owned Books</h2>
        <?php
        $ownedBooks = getOwnedBooks($up_number);
        if (!empty($ownedBooks)) {
            echo '<ul>';
            foreach ($ownedBooks as $book) {
                echo '<li>';
                echo '<strong>' . $book['name'] . '</strong> by ' . $book['author'];
                echo '<br>Condition: ' . $book['condition'];
                echo '<br>Availability: ' . $book['availability'];
                echo '<br>Copy Type: ' . $book['copy_type'];
                echo '</li>';
                echo '<img src="images/bookCovers/' . $book['id'] . '.jpg" alt="Book Cover">';
            }
            echo '</ul>';
        } else {
            echo '<p>No books owned yet.</p>';
        }
        ?>
</section>
<form id = "addBook-request" action="bookexplorer.php">
    <button>Add Book to My Library</button>
</form>