<main>
    <h1>Explorer</h1>

    <form id="search" action="bookexplorer.php">
        <input type="text" name="search_name" placeholder="Book Title" value="<?php echo $search_title ?>">
        <input type="number" name="search_min" placeholder="min price" value="<?php echo $search_min ?>">
        <input type="number" name="search_max" placeholder="max price" value="<?php echo $search_max ?>">
        <button>Search</button>
        <a href="list_products.php?cat=<?php echo $cat_id ?>">Clear</a>
    </form>

    <section class="shelf">
        <?php foreach ($books as $row) { 
            $isBookAdded = isBookAdded($userID, intval($row['id']));
            $book_action = $isBookAdded ? 'remove_from_library' : 'add_to_library';
            $addBook = isset($_GET['addBook']) && $_GET['addBook'] == $row['id'];
            $isCopyAdded = isCopyAdded($userID, intval($row['id']));
            $copy_action = $isCopyAdded ? 'remove_from_mylibrary' : 'add_to_mylibrary';
            $addCopy = isset($_GET['addCopy']) && $_GET['addCopy'] == $row['id'];
        ?>

        <article class="book-item">
            <img src="images/bookcovers/<?php echo $row['id'] ?>.jpg" alt="">
            <div class="book-details">
                <h2><?php echo $row['name'] ?></h2>
                <h3 class="author"><?php echo $row['author'] ?></h3>

                <form action="bookexplorer.php" method="post">
                    <input type="hidden" name="action" value="<?php echo $book_action; ?>">
                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="page_num" value="<?php echo $page_num ?>">

                    <?php if ($addBook) { ?>
                        <form action="bookexplorer.php" method="post">
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
                        <button type="submit"><?php echo ($isBookAdded ? 'Remove From Want To Read' : 'Want To Read'); ?></button>
                    <?php } ?>
                </form>

                <form action="bookexplorer.php" method="post">
                    <input type="hidden" name="action" value="<?php echo $copy_action; ?>">
                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="page_num" value="<?php echo $page_num ?>">

                    <?php if ($addCopy) { ?>
                        <form action="bookexplorer.php" method="post">
                        <input type="hidden" name="action" value="confirm_add_copy">
                        <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="page_num" value="<?php echo $page_num ?>">

                        <label>Condition: </label>
                        <select name="condition">
                            <option value="" selected disabled></option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="worn">Worn</option>
                        </select> <br>

                        <label>Availability: </label>
                        <select name="availability">
                            <option value="" selected disabled></option>
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                        </select> <br>

                        <label>Type: </label>
                        <select name="copy_type">
                            <option value="" selected disabled></option>
                            <option value="hardcover">Hardcover</option>
                            <option value="softcover">Softcover</option>
                            <option value="handbook">Handbook</option>
                        </select> <br>

                        <button type="submit">Confirm</button>
                        </form>
                    <?php } else { ?>
                        <button type="submit"><?php echo ($isCopyAdded ? 'Remove My Copy' : 'Add Copy'); ?></button>
                    <?php } ?>
                </form>
            </div>
        </article>

        <?php } ?>
    </section>

    <?php //if (!isset($search_name) && !isset($search_min) && !isset($search_max)) { ?>
    <div id="pagination">
        <a href="bookexplorer.php?page_num=<?php echo $page_num-1 ?>">&lt;</a>
        <?php echo $page_num ?>
        <a href="bookexplorer.php?page_num=<?php echo $page_num+1 ?>">&gt;</a>
    </div>
    <?php //} ?>
</main>