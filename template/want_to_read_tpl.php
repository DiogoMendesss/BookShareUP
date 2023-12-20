    <h1>Want To Read</h1>
</header>
<main>
    
    <section class="shelf">
        <?php foreach ($wantToReadBooks as $row) { 
            
        ?>
            <article class="book-item">
                <img class="shelfImage" src="image/shelf2.png" alt="shelf-image">
                <img class="bookCover" src="image/bookcover/<?php echo $row['id'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $row['title'] ?></h2>
                    <h3 class="author"><?php echo $row['author'] ?></h3>
                    <p class="interest ´_level"><?php echo "Interest level: " . $row['interest_level'] ?></p>
                    <form action="want_to_read.php" method="post">
                        <input type="hidden" name="action" value="remove_book">
                        <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                        <button type="submit">Remove</button>
                    </form>
                </div>
            </article>
        <?php } ?>
        <a href="book_explorer.php" class="floatingButton">Add Book</a>  
    </section>
</main>