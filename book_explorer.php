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
    $n_pages = ceil($n_books / 40);
  
    if (isset($_GET['page_num']) && $_GET['page_num'] > 0) {
        $page_num = $_GET['page_num'];
        if ($page_num > $n_pages) {
            $page_num = $n_pages;
        }
    } else {
        $page_num = 1;
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