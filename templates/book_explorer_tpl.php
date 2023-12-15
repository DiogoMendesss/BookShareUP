<main>
    <h1>Explorer</h1>
    <section class="shelf">
        <?php foreach ($books as $row) { ?>
            <article class="book-item">
                <img src="images/bookcovers/<?php echo $row['id'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $row['name'] ?></h2>
                    <h3 class="author"><?php echo $row['author'] ?></h3>

                
                    <form action="book_actions.php" method="post">
                    <input type="hidden" name="action" value="' . $action . '">
                    <input type="hidden" name="book_id" value="' . $row['id'] . '">
                    <button type="submit"> <?php echo ($isBookAdded ? 'Remove' : 'Add') ?></button>
                    </form>

                </div>
                
            </article>

        <?php } ?>
    </section>
</main>