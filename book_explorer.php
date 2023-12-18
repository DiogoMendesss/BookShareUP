<?php
    session_start();

    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];
    $genres = getGenres();

    $search_title = $_GET['search_name'];
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
        

        if ($action === 'add_to_library') {

            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: book_explorer.php?page_num=$page_num&addBook=$bookID");
            exit();
        } elseif ($action === 'remove_from_library') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_book') {
            $interest_level = $_POST['interest_level'];
            $bookID = $_POST['book_id'];
            addToWantToRead($userID, $bookID, $interest_level);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: book_explorer.php?addCopy=$bookID&page_num=$page_num");
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: book_explorer.php");
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
<?php
    session_start();

    require_once('database/init.php');
    require_once('database/db_books.php');
    
    $userID = $_SESSION['up_number'];
    $genres = getGenres();

    $search_title = $_GET['search_name'];
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
        

        if ($action === 'add_to_library') {

            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: book_explorer.php?page_num=$page_num&addBook=$bookID");
            exit();
        } elseif ($action === 'remove_from_library') {
            // Handle removing the book from the library
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            removeFromWantToRead($userID, $bookID);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_book') {
            $interest_level = $_POST['interest_level'];
            $bookID = $_POST['book_id'];
            addToWantToRead($userID, $bookID, $interest_level);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'add_to_mylibrary') {
            $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';
            header("Location: book_explorer.php?addCopy=$bookID&page_num=$page_num");
            exit();
        } elseif ($action === 'remove_from_mylibrary') {
            $bookID = $_POST['book_id'];
            removeCopy($userID, $bookID);
            header("Location: book_explorer.php?page_num=$page_num");
            exit();
        } elseif ($action === 'confirm_add_copy') {
            $condition = $_POST['condition'];
            $availability = $_POST['availability'];
            $copy_type = $_POST['copy_type'];
            $bookID = $_POST['book_id'];
            addCopy($condition, $availability, $copy_type, $userID, $bookID);
            header("Location: book_explorer.php");
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