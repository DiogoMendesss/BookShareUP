<?php
    session_start();

    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];
    $genres = getGenres();

    $search_title = $_GET['search_title'];
    $search_author = $_GET['search_author'];
    $search_genre = $_GET['search_genre'];
    

    $n_books = getNumberOfBooks();
    $n_pages = ceil($n_books / 6);
  
    if (isset($_GET['page_num']) && $_GET['page_num'] > 0) {
        $page_num = $_GET['page_num'];
        if ($page_num > $n_pages) {
            $page_num = $n_pages;
        }
    } else {
        $page_num = 1;
    }

    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $page_num = $_POST['page_num'];
        //var_dump($page_num);
        $search_title = $_POST['search_title'];
        $search_author = $_POST['search_author'];
        $search_genre = $_POST['search_genre'];
        

        if ($action === 'add_to_wanttoread') {

            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            if (isset($search_title) || isset($search_author) || isset($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addBook=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num&addBook=$bookID");
            }
            exit();

        } elseif ($action === 'remove_from_wanttoread') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
            if (isset($search_title) || isset($search_author) || isset($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addBook=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num&addBook=$bookID");
            }
            exit();
        } elseif ($action === 'confirm_add_book') {
            $interest_level = $_POST['interest_level'];
            $bookID = $_POST['book_id'];
            addToWantToRead($userID, $bookID, $interest_level);
            header("Location: want_to_read.php");
            exit();
        } elseif ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            if (isset($search_title) || isset($search_author) || isset($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addCopy=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num&addCopy=$bookID");
            }
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            if (isset($search_title) || isset($search_author) || isset($search_genre)) {
                header("Location: book_explorer.php?search_title=$search_title&search_author=$search_author&search_genre=$search_genre&addCopy=$bookID");
            } else {
                header("Location: book_explorer.php?page_num=$page_num&addCopy=$bookID");
            }
            exit();
        } elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: my_library.php");
            exit();
        }
    }

    try {
        if (isset($search_title) || isset($search_author) || isset($search_genre)) {
            $books = getBooksBySearch($search_title, $search_author, $search_genre);
        } else {
            $books = getBooksByPage($page_num);
        }
      } catch (PDOException $e) {
        $error_msg = $e->getMessage();
      }

      include_once('template/header.php');
      include_once('template/book_explorer_tpl.php');
      include_once('template/footer.php');
?>