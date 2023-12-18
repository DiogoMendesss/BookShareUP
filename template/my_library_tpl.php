
<main>
    <h1>My Library</h1>
    <section class="shelf">
        <?php foreach ($userCopies as $row) { 
            
        ?>
            <article class="book-item">
                <img src="image/bookcover/<?php echo $row['book'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $row['name'] ?></h2>
                    <h3 class="author"><?php echo $row['author'] ?></h3>
                    <p class="condition"><?php echo "Condition: " . $row['condition'] ?></p>
                    <p class="availability"><?php echo "Availability: " . $row['availability'] ?></p>
                    <form action="my_library.php" method="post">
                        <input type="hidden" name="action" value="delete_copy">
                        <input type="hidden" name="book_id" value=<?php echo $row['book'] ?>>
                        <button type="submit">Delete copy</button>
                    </form>

                </div>
                
            </article>

        <?php } ?>

        <a href="book_explorer.php">Add copy</a>
    </section>
</main>

