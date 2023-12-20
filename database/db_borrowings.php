<?php
    function getUserProposals($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT BookCopy.id AS copy_id, BookCopy.condition, BookCopy.availability, BookCopy.copy_type, BookCopy.owner, BookCopy.book, Book.*, InterestedIn.*, User.name AS owner_name FROM BookCopy 
                                JOIN Book ON BookCopy.book = Book.id 
                                JOIN InterestedIn ON Book.id = InterestedIn.book 
                                JOIN User ON BookCopy.owner=User.up_number
                                WHERE InterestedIn.user=?
                                AND owner != ?
                                AND User.status != 'inactive'
                                AND availability = 'available'
                                ORDER BY Book.title, InterestedIn.interest_level DESC;");
        $stmt->execute(array($userID, $userID));
        return $stmt->fetchAll();
      }

    function insertBorrowing($status, $bookCopyID ,$user, $campus) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO Borrowing (status, copy , borrower, campus) VALUES (?, ?, ?, ?)');
        $stmt->execute([$status, $bookCopyID,$user, $campus]);
    }    
    function initializeDates($copyID, $borrowerID){
        $startDate = date("Y-m-d");
        $duration = 31;
        $expirationDate = date("Y-m-d", strtotime($startDate . "+ $duration days"));
        global $dbh;
        $stmt = $dbh->prepare('UPDATE Borrowing SET start_date = ?, duration = 31, expiration_date = ? WHERE copy = ? AND borrower = ?');
        $stmt->execute([$startDate, $expirationDate, $copyID, $borrowerID]);
    }
  
        function updateBorrowStatus($bookID, $borrowerID, $newStatus) {
          global $dbh;
          $stmt = $dbh->prepare('UPDATE Borrowing SET status = ? WHERE copy = ? AND borrower = ?');
          $stmt->execute([$newStatus, $bookID, $borrowerID]);
      }  

      function getBorrowings() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Borrowing JOIN BookCopy ON Borrowing.copy = BookCopy.id WHERE status != "pending" AND status != "rejected" ');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    function getBorrowingsBySearch($ownerID, $borrowerID, $campus) {
      global $dbh;

      $params = array();

      $query = 'SELECT * FROM Borrowing JOIN BookCopy ON Borrowing.copy = BookCopy.id ';

      if ($ownerID != '') {
        $query .= 'WHERE owner = ?';
        $params[] = $ownerID;
      }
  
      if ($borrowerID != '') {
          if ($ownerID != '') {
              $query .= ' AND borrower = ?';
          } else {
              $query .= ' WHERE borrower = ?';
          }
          $params[] = $borrowerID;
      }

      if ($campus != '') {
        if ($ownerID != '' || $borrowerID != '') {
            $query .= ' AND campus = ?';
            
        } else {
            $query .= ' WHERE campus = ?';
        }
        $params[] = $campus;
    }

      $stmt = $dbh->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll();
  }

    function deleteBorrow($copyID, $borrowerID) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM Borrowing WHERE copy = ? AND borrower = ?');
        $stmt->execute([$copyID, $borrowerID]);
    }

    function getOngoingUserBorrows($up_number) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT Borrowing.*, BookCopy.*, User.name AS borrower_name FROM Borrowing
                               JOIN BookCopy ON Borrowing.copy = BookCopy.id
                               JOIN User ON Borrowing.borrower = User.up_number
                               WHERE BookCopy.owner = ? AND Borrowing.status IN ("pending", "accepted", "delivered", "picked-up", "returned")');
        $stmt->execute(array($up_number));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

?>