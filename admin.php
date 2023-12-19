<?php
    session_start();
    
    require_once('database/init.php');
    require_once('database/db_books.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');
    require_once('database/db_borrowings.php');
    
    $userID = $_SESSION['up_number'];


    $campuses = getCampusesInfo();

    $search_owner = $_GET['search_owner'];
    $search_borrower = $_GET['search_borrower'];
    $search_campus = $_GET['search_campus'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        $borrowingID = $_POST['borrowing_id'];
        //var_dump($page_num);
        $search_owner = $_GET['search_owner'];
        $search_borrower = $_GET['search_borrower'];
        $search_campus = $_GET['search_campus'];

        

        if ($action === 'update_status') {
            header("Location: admin.php?bID=$borrowingID");
            exit();
        } elseif ($action === 'confirm_update_status') {
            $newStatus = $_POST['status'];
            $copyID = $_POST['copy_id'];
            $ownerID = $_POST['ownerID'];
            $borrowerID = $_POST['borrowerID'];
            
            /*
            var_dump($copyID);
            var_dump($ownerID);
            var_dump($borrowerID);
            */
            
            updateBorrowStatus($copyID, $borrowerID, $newStatus);
            if ($newStatus === 'returned') {
                updateUserStatus($borrowerID, 'active');
            }
            elseif ($newStatus === 'accepted') {
                updateBookCopyAvailability($copyID, 'borrowed');
            }
            elseif ($newStatus === 'archived') {
                updateBookCopyAvailability($copyID, 'available');
            }
            elseif($newStatus === 'delivered'){
                initializeDates($copyID, $borrowerID);
            }

            header("Location: admin.php");
            exit();
        }
    }
  


   
    try {
        if (isset($search_owner) || isset($search_borrower)|| isset($search_campus)) {
            $borrowings = getBorrowingsBySearch($search_owner, $search_borrower, $search_campus);
        } else {
            $borrowings = getBorrowings();
        }
      } catch (PDOException $e) {
        $error_msg = $e->getMessage();
      }

      if ($userID != 1) {
        echo 'You are not an admin!';
        echo '<img src="image/clown.gif" alt="404" style="width:80wh;height:80vh;">';
      }else include_once('template/admin_tpl.php');

?>