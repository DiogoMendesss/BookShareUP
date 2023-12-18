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

?>