<?php
    function isBookAdded($userID, $bookID) {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM InterestedIn WHERE user = ? AND book = ?");
        $stmt->execute([$userID, $bookID]);
        return $stmt->fetchAll();
    }

    function getBooks () {
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM Book");
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>