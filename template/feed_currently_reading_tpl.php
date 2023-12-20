    <h1>Currently Reading Book</h1>
</header>
<main>
    
    <section class="shelf" id = "currently_reading_shelf">
        <?php 
        
        $currentlyReadingBook = getCurrentlyReadingBook($userID);
        
        
            
        ?>
            <article class="book-item">
                <img class="shelf-image" src="image/shelf2.png" alt="shelf-image">
                <img class="book-cover" src="image/bookcover/<?php echo $currentlyReadingBook['book'] ?>.jpg" alt="">

                <div class="book-details-form">
                    <h2 class="book-title"><?php echo $currentlyReadingBook['title'] ?></h2>
                    <h3 class="book-author"><?php echo $currentlyReadingBook['author'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $currentlyReadingBook['condition'] ?></p>
                    <p class="copy_type"><?php echo "Type: " . $currentlyReadingBook['copy_type'] ?></p>
                    <p class="owner"><?php echo "Owner: "?><a class=link-to-profile href="user_profile.php?user=<?php echo $currentlyReadingBook['owner']; ?>"> 
                    <?php echo $currentlyReadingBook['owner_name'] ?></a> </p>
                    <p class="campus"> <?php echo "Campus: " . $currentlyReadingBook['campus'] ?></p>
                   
                </div>
            </article>
    </section>
    <section class="borrow-info">
        <div class="info-section" id="currently_reading_section">
            <div class="info-row">
                <div class="info-label">Borrow Status: </div>
                <div class="info-field"> <?php echo $currentlyReadingBook['status'] ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Borrow Status: </div>
                <div class="info-field"> <?php 
                if ($currentlyReadingBook['start_date']!='')
                    echo $currentlyReadingBook['start_date'];
                else echo "Reading period hasn't started..." ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Borrow Status: </div>
                <div class="info-field"> <?php 
                if ($currentlyReadingBook['start_date']!='')
                    echo $currentlyReadingBook['start_date'];
                else echo "Reading period hasn't started..." ?></div>
            </div>
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