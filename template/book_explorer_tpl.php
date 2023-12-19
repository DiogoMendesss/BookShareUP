    <h1>Explorer</h1>

    <form id="search" action="book_explorer.php">
        <input type="text" name="search_title" placeholder="Book Title" value="<?php echo $search_title ?>">
        <input type="text" name="search_author" placeholder="Book Author" value="<?php echo $search_author ?>">
        <select name="search_genre">
            <option value="" selected disabled>Genre</option>
            <?php foreach ($genres as $genre) { //var_dump($genre); ?> 
                      
                <option value="<?php echo $genre['genre'] ?>"><?php echo $genre['genre'] ?></option>
            <?php } ?>

        </select>
        <button>Search</button>
        <a class="floatingButton" href="book_explorer.php">Clear</a>
    </form>
</header>
<main>

    <section class="shelf">
        <?php //var_dump($books); ?>
        <?php foreach ($books as $row) {
            $isBookAdded = isBookAdded($userID, intval($row['id']));
            $book_action = $isBookAdded ? 'remove_from_wanttoread' : 'add_to_wanttoread';
            $isCopyAdded = isCopyAdded($userID, intval($row['id']));
            $copy_action = $isCopyAdded ? 'remove_from_mylibrary' : 'add_to_mylibrary';
            $bookGenres = getBookGenres($row['id']);
            
        ?>
        <img src="image/shelf1.png" alt="" class="shelf">
        <article class="book-item">
            <img class="bookCover" src="image/bookcover/<?php echo $row['id'] ?>.jpg" alt="">
            <div class="book-details">
                <h3><?php echo $row['name'] ?></h2>
                <h3 class="author"><?php echo $row['author'] ?></h3>
                <?php foreach ($bookGenres as $genre) { ?>
                    <!-- <p class="bookgenre"><?php echo $genre['genre'] ?></p> -->
                <?php } ?>

                    <?php if (isset($_GET['addBook']) && $_GET['addBook'] == $row['id']) { ?>
                        <form class="miniForm" action="action_book_wanttoread.php" method="post">
                            <input type="hidden" name="action" value="confirm_add_book">
                            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                            <label>Interest Level:</label>
                            <input type="radio" name="interest_level" value="1">1
                            <input type="radio" name="interest_level" value="2">2
                            <input type="radio" name="interest_level" value="3">3
                            <button type="submit">Confirm</button>
                        </form>
                    <?php } else { ?>
                        <form class="miniForm" action="action_book_wanttoread.php" method="post">
                            <input type="hidden" name="action" value="<?php echo $book_action; ?>">
                            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                            <input type="hidden" name="search_title" value="<?php echo $search_title ?>">
                            <input type="hidden" name="search_author" value="<?php echo $search_author ?>">
                            <input type="hidden" name="search_genre" value="<?php echo $search_genre ?>">
                            <button type="submit"><?php echo ($isBookAdded ? 'Remove From Want To Read' : 'Want To Read'); ?></button>
                        </form>
                    <?php } ?>
                       

                    <?php if (isset($_GET['addCopy']) && $_GET['addCopy'] == $row['id']) { ?>
                        <form class="miniForm" action="action_copy.php" method="post">
                            <input type="hidden" name="action" value="confirm_add_copy">
                            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">

                            <label>Condition: </label>
                            <input type="radio" name="condition" value="excellent">
                            <label for="excellent">Excellent</label>
                            <input type="radio" name="condition" value="good">
                            <label for="excellent">Good</label>
                            <input type="radio" name="condition" value="worn">
                            <label for="excellent">Worn</label>
                            
                            <label>Type: </label>
                            <input type="radio" name="copy_type" value="hardcover">
                            <label for="hardcover">Hardcover</label>
                            <input type="radio" name="copy_type" value="softcover">
                            <label for="softcover">Softcover</label>
                            <input type="radio" name="copy_type" value="handbook">
                            <label for="handbook">Handbook</label>
    
                            <button type="submit">Confirm</button>
                        </form>

                    <?php } else { ?>
                        <form class="miniForm" action="action_copy.php" method="post">
                            <input type="hidden" name="action" value="<?php echo $copy_action; ?>">
                            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                            <input type="hidden" name="search_title" value="<?php echo $search_title ?>">
                            <input type="hidden" name="search_author" value="<?php echo $search_author ?>">
                            <input type="hidden" name="search_genre" value="<?php echo $search_genre ?>">
                            <button type="submit"><?php echo ($isCopyAdded ? 'Remove My Copy' : 'Add Copy'); ?></button>
                        </form>
                    <?php } ?>

             
            </div>
        </article>

        <?php } ?>
    </section>

    <?php if (!isset($search_title) && !isset($search_author) && !isset($search_genre)) { ?>
    <div id="pagination">
        <a href="book_explorer.php?page_num=<?php echo $page_num-1 ?>">&lt;</a>
        <?php echo $page_num ?>
        <a href="book_explorer.php?page_num=<?php echo $page_num+1 ?>">&gt;</a>
    </div>
    <?php } ?>
</main>
