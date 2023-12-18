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

      function getUserCampus($userID){
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM UserCampus 
                                JOIN Campus ON UserCampus.campus = Campus.name
                                WHERE user = ?;");
        $stmt->execute(array($userID));
        return $stmt->fetchAll();
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
    

?>