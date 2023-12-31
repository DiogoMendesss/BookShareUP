    <h1>Feed</h1>
</header>
<main id='main-feed'>
    
    <section class="shelf">
        <?php foreach ($userProposals as $row) { 
            
            
        ?>
            <article class="book-item">
                <img class="shelf-image" src="image/shelf2.png" alt="shelf-image">
                <img class="book-cover" src="image/bookcover/<?php echo $row['book'] ?>.jpg" alt="">

                <?php // if (isset($_GET['owner']) && $_GET['owner'] == $row['owner']  || isset($_GET['copy']) && $_GET['copy'] == $row['id']) { ?>
                <div class="book-details-form">
                <?php //} else { ?> 
                <!-- <div class="book-details"> --> <?php //} ?>
                    
                    <?php if (isset($_GET['owner']) && $_GET['owner'] == $row['owner'] &&
                    isset($_GET['copy']) && $_GET['copy'] == $row['copy_id']) { ?>

                    <form action="action_borrow.php" method="post">
                        <input type="hidden" name="action" value="confirm_borrow">
                        <input type="hidden" name="bookCopyID" value="<?php echo $row['copy_id']; ?>">
                        <!-- Pass each column value separately -->
                        <input type="hidden" name="name" value="<?php echo $row['title']; ?>">
                        <input type="hidden" name="author" value="<?php echo $row['author']; ?>">
                        <input type="hidden" name="condition" value="<?php echo $row['condition']; ?>">
                        <input type="hidden" name="availability" value="<?php echo $row['availability']; ?>">
                        <input type="hidden" name="copy_type" value="<?php echo $row['copy_type']; ?>">
                        <!-- Add other necessary fields -->
                        Select the campus to pick-up the book:
                        <select name="campus" required>
                            <?php $ownerCampus = getUserFacultyCampus($row['owner']);
                                foreach ($ownerCampus as $campus) { ?>
                                <option value="<?php echo $campus['campus']; ?>"><?php echo $campus['campus']; ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit">Confirm</button>
                    </form>
                    <?php } else { ?>
                    <h2 class="book-title"><?php echo $row['title'] ?></h2>
                    <h3 class="book-author"><?php echo $row['author'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $row['condition'] ?></p>
                    <p class="copy_type"><?php echo "Type: " . $row['copy_type'] ?></p>
                    <a class="link-to-profile" href="user_profile.php?user=<?php echo $row['owner']; ?>"><?php echo $row['owner_name'] ?></a>
                    <form action="action_borrow.php" method="post">
                        <input type="hidden" name="action" value="borrow">
                        <input type="hidden" name="bookCopyID" value="<?php echo $row['copy_id']; ?>">
                        <input type="hidden" name="owner" value="<?php echo $row['owner']; ?>">
                        <button type="submit">Borrow</button>
                    </form>
                    <?php } ?>

                </div>
                
            </article>

        <?php } ?>
    </section>
</main>