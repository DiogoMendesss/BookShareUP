<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_books.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');
    
    $userID = $_SESSION['up_number'];

    $campuses = getCampusesInfo();

    $search_user = $_GET['search_user'];
    $search_campus = $_GET['search_campus'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $borrowingID = $_POST['borrowing_id'];
        //var_dump($page_num);
        $search_user = $_POST['search_user'];
        $search_campus = $_POST['search_campus'];

        

        if ($action === 'update_status') {
            header("Location: admin.php?bID=$borrowingID");
            exit();
        } elseif ($action === 'confirm_update_status') {
            $status = $_POST['status'];
            $copyID = $_POST['copy_id'];
            $user = $_POST['user'];
            updateBorrowStatus($copyID, $user, $status);

            header("Location: admin.php");
            exit();
        }
    }
  


   
    try {
        if (isset($search_user) || isset($search_campus)) {
            $borrowings = getBorrowingsBySearch($search_user, $search_campus);
        } else {
            $borrowings = getBorrowings();
        }
      } catch (PDOException $e) {
        $error_msg = $e->getMessage();
      }

      if ($userID != 1) {
        echo 'You are not an admin!';
      }else include_once('template/admin_tpl.php');

?>