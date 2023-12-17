<?php
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
?>

<main class = "profile-main">
    <section class = "profile-pic">
        <img src = "images/profilePics/hasbulla.jpg" alt = "Profile Picture">
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
<!-- <section class="owned-books">
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
</section> -->

<form id = "logout-form" action="logout_action.php">
    <button>Logout</button>
</form>
</main>