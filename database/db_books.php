<?php
    function isBookAdded($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM InterestedIn WHERE user = ? AND book = ?");
        $stmt->execute(array($userID, $bookID));
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result !== false);
    }

    function getBooks () {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM Book ORDER BY name;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Functions to add and remove books from the library
    function addToWantToRead($userID, $bookID, $interest_level) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO InterestedIn (user, book, interest_level) VALUES (?, ?, ?)");
        $stmt->execute(array($userID, $bookID, $interest_level));
    }

    function removeFromWantToRead($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("DELETE FROM InterestedIn 
                                WHERE user = ? AND book = ?");
        $stmt->execute(array($userID, $bookID));
    }

    function getWantToReadBooks($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT Book.id, Book.name, Book.author, InterestedIn.interest_level 
                                FROM Book 
                                JOIN InterestedIn ON Book.id = InterestedIn.book 
                                WHERE InterestedIn.user = ?
                                ORDER BY interest_level DESC, name;");
        $stmt->execute(array($userID));
        return $stmt->fetchAll();
    }

    function isCopyAdded($userID, $bookID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM BookCopy WHERE owner = ? AND book = ?");
        $stmt->execute(array($userID, $bookID));
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result !== false);
    }

    function addCopy($condition, $copy_type, $userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO BookCopy (condition, availability, copy_type, owner, book) VALUES (?, 'available' , ?, ?, ?)");
        $stmt->execute(array($condition, $copy_type, $userID, $bookID));
    }

    function removeCopy($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("DELETE FROM BookCopy 
                                WHERE owner = ? AND book = ?");
        $stmt->execute(array($userID, $bookID));
    }

    function getBooksByPage($page_num) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Book ORDER BY name LIMIT ? OFFSET ?');
        $stmt->execute(array(40, ($page_num-1)*40));
        return $stmt->fetchAll();
      }
    
      function getNumberOfBooks() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT COUNT(*) AS count FROM Book');
        $stmt->execute();
        return $stmt->fetch()['count'];
      }

      function getUserCopies($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM BookCopy 
                                JOIN Book ON BookCopy.book = Book.id 
                                WHERE owner = ?;");
        $stmt->execute(array($userID));
        return $stmt->fetchAll();
      }

      function getUserProposals($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT BookCopy.id AS bookCopyID, BookCopy.condition, BookCopy.availability, BookCopy.copy_type, BookCopy.owner,
                                BookCopy.book, Book.*, InterestedIn.*, User.name AS owner_name, User.up_number AS owner_id FROM BookCopy 
                                JOIN Book ON BookCopy.book = Book.id 
                                JOIN InterestedIn ON Book.id = InterestedIn.book 
                                JOIN User ON BookCopy.owner=User.up_number
                                WHERE InterestedIn.user=?
                                AND owner != ?
                                AND availability = 'available';");
        $stmt->execute(array($userID, $userID));
        return $stmt->fetchAll();
      }

      function getCurrentlyReadingBook($readerID) {
        global $dbh; // Assuming $dbh is your SQLite database connection
    
        $stmt = $dbh->prepare("SELECT Book.name AS bookName, Book.author AS bookAuthor, User.name AS ownerName, Book.id AS bookID, BookCopy.id AS copyID, 
        BookCopy.condition AS bookCopyCondition, BookCopy.copy_type AS bookCopyType, BookCopy.owner AS ownerID, UserCampus.campus AS ownerCampus,
        Borrowing.status AS borrowStatus, Borrowing.start_date AS borrowStartDate, Borrowing.expiration_date AS borrowExpirationDate, Borrowing.user AS borrowerID
        FROM Borrowing
        JOIN BookCopy ON Borrowing.copyID = BookCopy.id
        JOIN Book ON BookCopy.book = Book.id
        JOIN User ON BookCopy.owner = User.up_number
        LEFT JOIN UserCampus ON BookCopy.owner = UserCampus.user
        WHERE Borrowing.user = ?");
    
        $stmt->execute(array($readerID));
    
        return $stmt->fetch(PDO::FETCH_ASSOC);;
    }

      function getBooksBySearch($search_title, $search_author, $search_genre) {
        global $dbh;

        $params = array();

        if ($search_genre != '') {
          $query = 'SELECT * FROM Book JOIN BookGenre ON Book.id = BookGenre.book WHERE genre=?';
          $params[] = $search_genre;
        }
        else {
          $query = 'SELECT * FROM Book';
        }

        //var_dump($search_genre);
    
        if ($search_title != '') {
            if ($search_genre != '') {
                $query .= ' AND name LIKE ?';
            } else {
                $query .= ' WHERE name LIKE ?';
            }
            $params[] = "%$search_title%";
        }

        if ($search_author != '') {
          if ($search_genre != '' || $search_title != '') {
              $query .= ' AND author LIKE ?';
              
          } else {
              $query .= ' WHERE author LIKE ?';
          }
          $params[] = "%$search_author%";
      }

      //var_dump($params);
    
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    

      function getGenres(){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM Genre;");
        $stmt->execute();
        return $stmt->fetchAll();
      }

      function getBookGenres($book_ID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM BookGenre
                                WHERE book = ?;");
        $stmt->execute(array($book_ID));
        return $stmt->fetchAll();
      }
    

      function insertBorrowing($status, $bookCopyID ,$user, $startDate, $duration, $campus, $expirationDate) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO Borrowing (status, copyID ,user, start_date, duration, campus, expiration_date) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$status, $bookCopyID,$user, $startDate, $duration, $campus, $expirationDate]);
    }    

      function updateBorrowStatus($bookID, $borrowerID, $newStatus) {
        global $dbh;
        $stmt = $dbh->prepare('UPDATE Borrowing SET status = ? WHERE copyID = ? AND user = ?');
        $stmt->execute([$newStatus, $bookID, $borrowerID]);
    }  

    function updateBookCopyAvailability($bookCopyID, $newAvailability) {
        global $dbh;
        $stmt = $dbh->prepare('UPDATE BookCopy SET availability = ? WHERE id = ?');
        $stmt->execute([$newAvailability, $bookCopyID]);
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