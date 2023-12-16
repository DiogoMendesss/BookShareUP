<main>
    <h1>Want To Read</h1>
    <section class="shelf">
        <?php foreach ($wantToReadBooks as $row) { 
            
        ?>
            <article class="book-item">
                <img src="images/bookcovers/<?php echo $row['id'] ?>.jpg" alt="">

                <div class="book-details">
                    <h2><?php echo $row['name'] ?></h2>
                    <h3 class="author"><?php echo $row['author'] ?></h3>
                    <p class="interest ´_level"><?php echo "Interest level: " . $row['interest_level'] ?></p>
                </div>
                
            </article>

        <?php } ?>
    </section>
</main>