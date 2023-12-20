    <h1>Currently Reading Book</h1>
</header>
<main>
    
    <section class="shelf">
        <?php 
        
        $currentlyReadingBook = getCurrentlyReadingBook($userID);
        
        
            
        ?>
            <article class="book-item">
                <img src="image/bookcover/<?php echo $currentlyReadingBook['book'] ?>.jpg" alt="">

                <div class="book-details-form">
                    <h2><?php echo $currentlyReadingBook['title'] ?></h2>
                    <h3 class="author"><?php echo $currentlyReadingBook['author'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $currentlyReadingBook['condition'] ?></p>
                    <p class="copy_type"><?php echo "Type: " . $currentlyReadingBook['copy_type'] ?></p>
                    <p class="owner"><?php echo "Owner: " . $currentlyReadingBook['owner_name'] ?></p>
                    <p class="campus"> <?php echo "Campus: " . $currentlyReadingBook['campus'] ?></p>
                   
                </div>
            </article>
    </section>
    <section class="borrow-info">
        <div class="borrow-details">
            <p class="borrow-status">Borrow Status: <?php echo $currentlyReadingBook['status'] ?></p>
            <p class="borrow-start-date">Start Date: <?php echo $currentlyReadingBook['start_date'] ?></p>
            <p class="borrow-expiration-date">Expiration Date: <?php echo $currentlyReadingBook['expiration_date'] ?></p>
        </div>
    </section>

        <?php
        if ($currentlyReadingBook['status']==='rejected'){ ?>
            <div class="reject-notification">
                <p class = 'reject-notification-message'>Your request has been rejected.</p>
                <form class = "form-delete-borrow" action = "action_delete_borrow.php" method = "post">
                    <input type = "hidden" name = "copyID" value = "<?php echo $currentlyReadingBook['copy']; ?>">
                    <input type = "hidden" name = "borrowerID" value = "<?php echo $userID; ?>">
                    <input type = "submit" value = "Go Back to Feed">
                </form>
            </div>
        <?php
        }
        ?>
</main>