<?php

  function loginSuccess($up_number, $password) {
    global $bsup;
    $stmt = $bsup->prepare('SELECT * FROM Users WHERE up_number = ? AND password = ?');
    $stmt->execute(array($up_number, hash('sha256', $password)));
    return $stmt->fetch();
  }

  function mock_loginSuccess($up_number) {
    global $bsup;
    $stmt = $bsup->prepare('SELECT * FROM Users WHERE up_number = ?');
    $stmt->execute(array($up_number));
    return $stmt->fetch();
  }

  function getUserFullName($up_number) {
    global $bsup;
    $stmt = $bsup->prepare('SELECT name FROM Users WHERE up_number = ?');
    $stmt->execute(array($up_number));
    return $stmt->fetchColumn();
}


  function insertUser($up_number, $password, $full_name, $faculty_campus) {
    global $bsup;
    $stmt = $bsup->prepare('INSERT INTO Users (up_number, password, name) VALUES (?, ?, ?)');
    $stmt->execute(array($up_number, password_hash($password, PASSWORD_DEFAULT), $full_name));

    $stmt = $bsup->prepare('INSERT INTO UserCampus (user, campus) VALUES (?, ?)');
    $stmt->execute(array($up_number, $faculty_campus));
  }
?>