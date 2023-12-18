<?php
function getCampusesInfo() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Campus');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>