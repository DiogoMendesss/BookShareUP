<?php

  function loginSuccess($up_number, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM User WHERE up_number = ? AND password = ?');
    $stmt->execute(array($up_number, hash('sha256', $password)));
    return $stmt->fetch();
  }

  function mock_loginSuccess($up_number) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM User WHERE up_number = ?');
    $stmt->execute(array($up_number));
    return $stmt->fetch();
  }

  function getUserFullName($up_number) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT name FROM User WHERE up_number = ?');
    $stmt->execute(array($up_number));
    return $stmt->fetchColumn();
}

function getUserFacultyCampus($up_number) {
  global $dbh;
  $stmt = $dbh->prepare('SELECT campus FROM UserCampus WHERE user = ?');
  $stmt->execute(array($up_number));
  return $stmt->fetchColumn();
}


  function insertUser($up_number, $password, $full_name, $faculty_campus) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO User (up_number, password, name) VALUES (?, ?, ?)');
    $stmt->execute(array($up_number, hash('sha256', $password), $full_name));

    $stmt = $dbh->prepare('INSERT INTO UserCampus (user, campus) VALUES (?, ?)');
    $stmt->execute(array($up_number, $faculty_campus));
  }

  function getOwnedBooks($up_number) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT BookCopy.id, Book.name, Book.author, BookCopy.condition, BookCopy.availability, BookCopy.copy_type, Book.id
                          FROM BookCopy
                          JOIN Book ON BookCopy.book = Book.id
                          WHERE BookCopy.owner = ?');
    $stmt->execute(array($up_number));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNumOwnedBooks($up_number) {
  global $dbh;
  $stmt = $dbh->prepare('SELECT COUNT(*) FROM BookCopy WHERE owner = ?');
  $stmt->execute(array($up_number));
  return $stmt->fetchColumn();
}

function getOngoingUserBorrows($up_number) {
  global $dbh;
  $stmt = $dbh->prepare('SELECT Borrowing.status, Borrowing.expiration_date, User.name AS borrower_name
                         FROM Borrowing
                         JOIN Proposal ON Borrowing.proposal = Proposal.id
                         JOIN BookCopy ON Proposal.bookcopy = BookCopy.id
                         JOIN User ON Borrowing.user = User.up_number
                         WHERE BookCopy.owner = ? AND Borrowing.status IN ("pending", "delivered", "picked-up")');
  $stmt->execute(array($up_number));
  return $stmt->fetchAll();
}
?>