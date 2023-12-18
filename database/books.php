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
        $stmt = $dbh->prepare("SELECT * FROM Book");
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
                                WHERE InterestedIn.user = ?;");
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

    function addCopy($condition, $availability, $copy_type, $userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO BookCopy (condition, availability, copy_type, owner, book) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($condition, $availability, $copy_type, $userID, $bookID));
    }

    function removeCopy($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("DELETE FROM BookCopy 
                                WHERE owner = ? AND book = ?");
        $stmt->execute(array($userID, $bookID));
    }

    function getBooksByPage($page_num) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM Book LIMIT ? OFFSET ?');
        $stmt->execute(array(6, ($page_num-1)*6));
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
        $stmt = $dbh->prepare("SELECT BookCopy.*, Book.*, InterestedIn.*, User.name AS owner_name, User.up_number AS owner_id FROM BookCopy 
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
    
        $stmt = $dbh->prepare("SELECT Book.name AS bookName, Book.author AS bookAuthor, User.name AS ownerName, Book.id AS bookID, 
        BookCopy.condition AS bookCopyCondition, BookCopy.copy_type AS bookCopyType, BookCopy.owner AS ownerID, UserCampus.campus AS ownerCampus,
        Borrowing.status AS borrowStatus, Borrowing.start_date AS borrowStartDate, Borrowing.expiration_date AS borrowExpirationDate, Borrowing.user AS borrowerID
        FROM Borrowing
        JOIN Book ON Borrowing.bookID = Book.id
        JOIN BookCopy ON Book.id = BookCopy.book
        JOIN User ON BookCopy.owner = User.up_number
        LEFT JOIN UserCampus ON BookCopy.owner = UserCampus.user
        WHERE Borrowing.user = ?");
    
        $stmt->execute(array($readerID));
    
        return $stmt->fetch(PDO::FETCH_ASSOC);;
    }
    

      function getUserCampus($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM UserCampus 
                                JOIN Campus ON UserCampus.campus = Campus.name
                                WHERE user = ?;");
        $stmt->execute(array($userID));
        return $stmt->fetchAll();
      }

      function getProductsBySearch($cat_id, $search_name, $search_min, $search_max) {
        global $dbh;
    
        $query = 'SELECT * FROM product WHERE cat_id = ?';
        $params = array($cat_id);
    
        if ($search_name != '') {
          $query = $query . ' AND name LIKE ?';
          $params[] = "%$search_name%";
        }
      
        if ($search_min != '') {
          $query = $query . ' AND price >= ?';
          $params[] = $search_min;
        }
      
        if ($search_max != '') {
          $query = $query . ' AND price <= ?';
          $params[] = $search_max;
        }
    
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
    

      function insertBorrowing($status, $bookID ,$user, $startDate, $duration, $campus, $expirationDate) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO Borrowing (status, bookID ,user, start_date, duration, campus, expiration_date) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$status, $bookID,$user, $startDate, $duration, $campus, $expirationDate]);
    }    

      function updateBorrowStatus($bookID, $borrowerID, $newStatus) {
        global $dbh;
        $stmt = $dbh->prepare('UPDATE Borrowing SET status = ? WHERE bookID = ? AND user = ?');
        $stmt->execute([$newStatus, $bookID, $borrowerID]);
    }  
?>