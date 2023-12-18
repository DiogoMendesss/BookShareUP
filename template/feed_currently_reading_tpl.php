<main>
    <h1>Currently Reading Book</h1>
    <section class="shelf">
        <?php 
        
        $currentlyReadingBook = getCurrentlyReadingBook($userID);
            
        ?>
            <article class="book-item">
                <img src="image/bookcover/<?php echo $currentlyReadingBook['bookID'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $currentlyReadingBook['bookName'] ?></h2>
                    <h3 class="author"><?php echo $currentlyReadingBook['bookAuthor'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $currentlyReadingBook['bookCopyCondition'] ?></p>
                    <p class="copy_type"><?php echo "Type: " . $currentlyReadingBook['bookCopyType'] ?></p>
                    <p class="owner"><?php echo "Owner: " . $currentlyReadingBook['ownerName'] ?></p>
                    <?php $ownerCampus = getUserFacultyCampus($currentlyReadingBook['ownerID']);
                        foreach ($ownerCampus as $campus) {     
                    ?>
                    <p class="campus">Owner campus: <?php echo "" . $campus['campus'] ?></p>
                    <?php } ?>  
                </div>
            </article>
    </section>
    <section class="borrow-info">
        <div class="borrow-details">
            <p class="borrow-status">Borrow Status: <?php echo $currentlyReadingBook['borrowStatus'] ?></p>
            <p class="borrow-start-date">Start Date: <?php echo $currentlyReadingBook['borrowStartDate'] ?></p>
            <p class="borrow-expiration-date">Expiration Date: <?php echo $currentlyReadingBook['borrowExpirationDate'] ?></p>
        </div>
        <?php
        // Assuming $borrow is the array containing the borrow information
        if ($currentlyReadingBook['borrowStatus'] === 'delivered' || $currentlyReadingBook['borrowStatus'] === 'picked-up' ) {
            ?>
            <form action="action_update_borrow_status.php" method="post">
                <input type="hidden" name="bookID" value="<?php echo $currentlyReadingBook['bookID']; ?>">
                <input type="hidden" name="borrowerID" value="<?php echo $currentlyReadingBook['borrowerID']; ?>">
                <input type="hidden" name="borrowStatus" value="<?php echo getNextBorrowState($currentlyReadingBook['borrowStatus']); ?>">
                <input type="submit" value="Update to <?php echo getNextBorrowState($currentlyReadingBook['borrowStatus']); ?>">
            </form>
            <?php
        }
        ?>
    </section>
</main>