<?php
function getCampusesInfo() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Campus');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateCampusesInfo($up_number, $selectedCampuses) {
    global $dbh;
    $stmt = $dbh->prepare('DELETE FROM UserCampus WHERE user = ?');
    $stmt->execute(array($up_number));
    foreach ($selectedCampuses as $campus) {
        $stmt = $dbh->prepare('INSERT INTO UserCampus VALUES (?, ?)');
        $stmt->execute(array($up_number, $campus));
    }
}

function isSelected($campus, $user_campuses) {
    foreach ($user_campuses as $user_campus) {
        if ($user_campus['campus'] === $campus) {
            return true;
        }
    }
    return false;
}
?>