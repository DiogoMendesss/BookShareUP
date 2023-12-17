<main>
    <h1>Feed</h1>
    <section class="shelf">
        <?php foreach ($userProposals as $row) { 
            
        ?>
            <article class="book-item">
                <img src="images/bookcovers/<?php echo $row['book'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $row['name'] ?></h2>
                    <h3 class="author"><?php echo $row['author'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $row['condition'] ?></p>
                    <p class="availability"><?php echo "Availability: " . $row['availability'] ?></p>
                    <p class="copy_type"><?php echo "Type: " . $row['copy_type'] ?></p>
                    <h3 class="owner"><?php echo $row['owner_name'] ?></h3>
                    <h5>Owner campus:</h3>
                    <?php $ownerCampus = getUserCampus($row['owner_id']);
                        foreach ($ownerCampus as $campus) {     
                    ?>
                    <p class="campus"><?php echo "" . $campus['campus'] ?></p>
                    <?php } ?>  
                    <form action="borrow_form.php" method="post">
                        <input type="hidden" name="action" value="ask_borrow">
                        <input type="hidden" name="book_id" value="<?php echo $row['book']; ?>">
                        <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                        <!-- Pass each column value separately -->
                        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="author" value="<?php echo $row['author']; ?>">
                        <input type="hidden" name="condition" value="<?php echo $row['condition']; ?>">
                        <input type="hidden" name="availability" value="<?php echo $row['availability']; ?>">
                        <input type="hidden" name="copy_type" value="<?php echo $row['copy_type']; ?>">
                        <!-- Add other necessary fields -->
                        <?php $ownerCampus = getUserCampus($row['owner_id']);
                            foreach ($ownerCampus as $campus) { ?>
                            <input type="hidden" name="campus[]" value="<?php echo $campus['campus']; ?>">
                        <?php } ?>  
                        <button type="submit">Borrow</button>
                    </form>
                    

                </div>
                
            </article>

        <?php } ?>
    </section>
</main>