
<?php
    function getUserProposals($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT BookCopy.id AS bookCopyID, BookCopy.condition, BookCopy.availability, BookCopy.copy_type, BookCopy.owner,
                                BookCopy.book, Book.*, InterestedIn.*, User.name AS owner_name, User.up_number AS owner_id FROM BookCopy 
                                JOIN Book ON BookCopy.book = Book.id 
                                JOIN InterestedIn ON Book.id = InterestedIn.book 
                                JOIN User ON BookCopy.owner=User.up_number
                                WHERE InterestedIn.user=?
                                AND owner != ?
                                AND User.status != 'inactive'
                                AND availability = 'available'
                                ORDER BY Book.name, InterestedIn.interest_level DESC;");
        $stmt->execute(array($userID, $userID));
        return $stmt->fetchAll();
      }

      function insertBorrowing($status, $bookCopyID ,$user, $campus) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO Borrowing (status, copyID ,user, campus) VALUES (?, ?, ?, ?)');
        $stmt->execute([$status, $bookCopyID,$user, $campus]);
    }    
    function initializeDates($copyID, $borrowerID){
        $startDate = date("Y-m-d");
        $duration = 31;
        $expirationDate = date("Y-m-d", strtotime($startDate . "+ $duration days"));
        global $dbh;
        $stmt = $dbh->prepare('UPDATE Borrowing SET start_date = ?, duration = 31, expiration_date = ? WHERE copyID = ? AND user = ?');
        $stmt->execute([$startDate, $expirationDate, $copyID, $borrowerID]);
    }
  
        function updateBorrowStatus($bookID, $borrowerID, $newStatus) {
          global $dbh;
          $stmt = $dbh->prepare('UPDATE Borrowing SET status = ? WHERE copyID = ? AND user = ?');
          $stmt->execute([$newStatus, $bookID, $borrowerID]);
      }  

      function getBorrowings() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Borrowing JOIN BookCopy ON Borrowing.copyID = BookCopy.id WHERE status != "pending" AND status != "rejected" ');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    function getBorrowingsBySearch($ownerID, $borrowerID, $campus) {
      global $dbh;

      $params = array();

      $query = 'SELECT * FROM Borrowing JOIN BookCopy ON Borrowing.copyID = BookCopy.id ';

      if ($ownerID != '') {
        $query .= 'WHERE owner = ?';
        $params[] = $ownerID;
      }
  
      if ($borrowerID != '') {
          if ($ownerID != '') {
              $query .= ' AND user = ?';
          } else {
              $query .= ' WHERE user = ?';
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
        $stmt = $dbh->prepare('DELETE FROM Borrowing WHERE copyID = ? AND user = ?');
        $stmt->execute([$copyID, $borrowerID]);
    }

?>