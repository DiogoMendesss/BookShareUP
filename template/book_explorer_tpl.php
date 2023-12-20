    <h1>Explorer</h1>

    <!-- SEARCH BAR -->
    <form id="search" action="book_explorer.php">
        <input type="text" name="search_title" placeholder="Book Title" value="<?php echo $search_title ?>">
        <input type="text" name="search_author" placeholder="Book Author" value="<?php echo $search_author ?>">
        <select name="search_genre">
            <?php if (isset($search_genre)) { ?>
                <option value="<?php echo $search_genre ?>" selected><?php echo $search_genre ?></option>
            <?php } else { ?>
                <option value="" selected disabled>Genre</option>
            <?php } ?>
            <?php foreach ($genres as $genre) { //var_dump($genre); ?> 
                      
                <option value="<?php echo $genre['genre'] ?>"><?php echo $genre['genre'] ?></option>
            <?php } ?>

        </select>
        <button>Search</button>
        <a class="floatingButton" href="book_explorer.php">Clear</a>
    </form>

</header>

<main>
    <!-- BOOKS DISPLAY -->
    <section class="shelf">
        
        <?php foreach ($books as $book) {
            $isBookAdded = isBookAdded($userID, $book['id']);
            $book_action = $isBookAdded ? 'remove_from_wanttoread' : 'add_to_wanttoread';
            $isCopyAdded = isCopyAdded($userID, $book['id']);
            $copy_action = $isCopyAdded ? 'remove_from_mylibrary' : 'add_to_mylibrary';
            $bookGenres = getBookGenres($book['id']);
            ?>

            <article class="book-item"> 
        
                <img class="shelfImage" src="image/shelf2.png" alt="shelf-image">
                <img class="bookCover" src="image/bookcover/<?php echo $book['id'] ?>.jpg" alt="">
                <?php if (isset($_GET['addBook']) && $_GET['addBook'] == $book['id']  || isset($_GET['addCopy']) && $_GET['addCopy'] == $book['id']) { ?>
                    <div class="book-details-form">
                    <?php } else { ?> 
                    <div class="book-details"> <?php } ?>

                <h2><?php echo $book['title'] ?></h2>
                <h3 class="author"><?php echo $book['author'] ?></h3>

                <?php foreach ($bookGenres as $genre) { ?>
                <?php } ?>
                    <!-- ADD BOOK TO WANT TO READ FORMS: If the book is already added it is shown a button to remove
                    otherwise it is shown a button to add the book. If the last is clicked the variable $_GET['addBook'] is set and 
                    another form (the first in the code) to choose the interest level and confirm the add is shown-->
                    <?php if (isset($_GET['addBook']) && $_GET['addBook'] == $book['id']) { ?>
                        <form class="miniForm" action="action_book_wanttoread.php" method="post">
                            <input type="hidden" name="action" value="confirm_add_book">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                            <label>Interest Level:</label>
                            <div class="miniFormLine">
                                <input type="radio" name="interest_level" value="1" required>1
                                <input type="radio" name="interest_level" value="2">2
                                <input type="radio" name="interest_level" value="3">3
                            </div>
                            <button type="submit">Confirm</button>
                        </form>
                    <?php } else { ?>
                        <form class="miniForm" action="action_book_wanttoread.php" method="post">
                            <input type="hidden" name="action" value="<?php echo $book_action; ?>">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">
                            <input type="hidden" name="search_title" value="<?php echo $search_title ?>">
                            <input type="hidden" name="search_author" value="<?php echo $search_author ?>">
                            <input type="hidden" name="search_genre" value="<?php echo $search_genre ?>">
                            <button type="submit"><?php echo ($isBookAdded ? 'Remove From Want To Read' : 'Want To Read'); ?></button>
                        </form>
                    <?php } ?>
                        
                    <!-- ADD BOOK TO MY LIBRARY: If the user already has a copy of the book it is shown a button to remove
                    otherwise it is shown a button to add a copy to My Library. If the last is clicked, the variable $_GET['addCopy'] is set and 
                    another form (the first in the code) to fill the copy info and confirm the add is shown-->
                    
                    <?php if (isset($_GET['addCopy']) && $_GET['addCopy'] == $book['id']) { ?>
                        <form class="miniForm" action="action_copy.php" method="post">
                            <input type="hidden" name="action" value="confirm_add_copy">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <input type="hidden" name="page_num" value="<?php echo $page_num ?>">

                            <label>Condition: </label>
                            <div class="miniFormLine">
                                <input type="radio" name="condition" value="excellent">
                                <label for="excellent">Excellent</label>
                                <input type="radio" name="condition" value="good">
                                <label for="excellent">Good</label>
                                <input type="radio" name="condition" value="worn">
                                <label for="excellent">Worn</label>
                            </div>
                            <label>Type: </label>
                            <div class="miniFormLine">
                                <input type="radio" name="copy_type" value="hardcover">
                                <label for="hardcover">Hardcover</label>
                                <input type="radio" name="copy_type" value="softcover">
                                <label for="softcover">Softcover</label>
                                <input type="radio" name="copy_type" value="handbook">
                                <label for="handbook">Handbook</label>
                            </div>
                            <button type="submit">Confirm</button>
                        </form>
                    <?php } else { ?>
                        <form class="miniForm" action="action_copy.php" method="post">
                            <input type="hidden" name="action" value="<?php echo $copy_action; ?>">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
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
