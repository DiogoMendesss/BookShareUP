<?php
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');
?>

<main class = "profile-main">
    <section class = "profile-pic">
        <img src = "image/avatar/hasbulla.jpg" alt = "Profile Picture">
    </section>
    <h1 id=profile_name> <?php echo getUserFullName($up_number) ?> </h1>
    <section class = "profile-info">
        <h2 id=profile_upNumber> UP Number: <?php echo $up_number ?> </h2>
        <h2 id=profile_campus> Attending Campus: <?php echo getUserFacultyCampus($up_number) ?> </h2>
        <h2 id=profile_numOwnedBooks> Number of Owned Books: <?php echo getNumOwnedBooks($up_number) ?> </h2>
    </section>
    <section class="ongoing-userBorrows">
        <h2>Borrowed Books</h2>
        <?php
        $borrowedBooks = getOngoingUserBorrows($up_number);
        if (!empty($borrowedBooks)) {
            echo '<ul id="borrowed-books">';
            foreach ($borrowedBooks as $borrow) {
                echo '<li>';
                echo 'Status: ' . $borrow['status'];
                echo '<br>Borrower: ' . $borrow['borrower_name'];
                echo '<br>Expiration Date: ' . $borrow['expiration_date'];
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No ongoing borrowed books.</p>';
        }
        ?>
    </section>
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
                echo '<img src="image/bookCover/' . $book['id'] . '.jpg" alt="Book Cover">';
            }
            echo '</ul>';
        } else {
            echo '<p>No books owned yet.</p>';
        }
        ?>

        <?php
        // Assuming $borrow is the array containing the borrow information
        if ($borrow['status'] === 'pending' || $borrow['status'] === 'accepted' || $borrow['status'] === 'returned') {
            ?>
            <form action="action_update_borrow_status.php" method="post">
                <input type="hidden" name="bookID" value="<?php echo $borrow['bookID']; ?>">
                <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower_up']; ?>">
                <input type="hidden" name="borrowStatus" value="<?php echo getNextBorrowState($borrow['status']); ?>">
                <input type="submit" value="Update to <?php echo getNextBorrowState($borrow['status']); ?>">
            </form>
            <?php
        }
        ?>
    </section>

</main>

