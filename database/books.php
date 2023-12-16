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
    function addToWantToRead($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("INSERT INTO InterestedIn (user, book, interest_level) VALUES (?, ?, ?)");
        $stmt->execute(array($userID, $bookID, 3));
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

?>