    <h1>My Library</h1>
</header>
<main>
   
    <section class="shelf">
        <?php foreach ($userCopies as $row) { 
            
        ?>
            <article class="book-item">
                <img class="shelf-image" src="image/shelf2.png" alt="shelf-image">
                <img class="book-cover" src="image/bookcover/<?php echo $row['book'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2 class="book-title"><?php echo $row['title'] ?></h2>
                    <h3 class="book-author"><?php echo $row['author'] ?></h3>
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
    </section>
<a href="book_explorer.php" class="floating-button">Add copy</a>
</main>

