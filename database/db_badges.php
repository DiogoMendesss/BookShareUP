<?php
    require_once('database/db_borrowings.php');

    function getCategories(){
        global $dbh;
        $stmt = $dbh->prepare('SELECT DISTINCT category FROM Badges');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function checkUserBadgeCategory($up_number, $category){
        global $dbh;
        $stmt = $dbh->prepare('SELECT COUNT(*) FROM UserBadge 
                                JOIN Badges ON UserBadge.badge = Badges.name 
                                WHERE Badges.category = ? 
                                AND UserBadge.user = ?');
        $stmt->execute(array($category, $up_number));
        $count = $stmt->fetchColumn();
        if($count == 0){
            return false;
        }else{
            return true;
        }

    }

    function updateUserBadges($up_number, $borrowedBooksNumber, $readBooksNumber){
        global $dbh;
        var_dump($borrowedBooksNumber);
        var_dump($readBooksNumber);
        var_dump(checkUserBadgeCategory($up_number, "Reader"));
        var_dump(checkUserBadgeCategory($up_number, "Borrower"));
        if($readBooksNumber>=1 && !checkUserBadgeCategory($up_number, "Reader")){
            echo "entrou if 1";
            $stmt = $dbh->prepare("INSERT INTO UserBadge VALUES (?, 'Good Reader')");
            $stmt->execute(array($up_number));
        }
        
        if ($readBooksNumber>=2){
            echo "entrou if 2";
            $stmt = $dbh->prepare("UPDATE UserBadge SET badge = 'Awesome Reader' 
                                    WHERE user = ?
                                    AND badge = 'Good Reader' ");
            $stmt->execute(array($up_number));
        } 
        if ($readBooksNumber>=3){
            echo "entrou if 3\n";
            $stmt = $dbh->prepare("UPDATE UserBadge SET badge = 'Legendary Reader' 
                                    WHERE user = ?
                                    AND badge = 'Awesome Reader'");
            $stmt->execute(array($up_number));
        }
        


        if($borrowedBooksNumber>=1 && !checkUserBadgeCategory($up_number, "Borrower")){
            echo "entrou if 4";
            $stmt = $dbh->prepare("INSERT INTO UserBadge VALUES (?, 'Good Borrower')");
            $stmt->execute(array($up_number));
        }  
        
        if ($borrowedBooksNumber>=2){
            echo "entrou if 5";
            $stmt = $dbh->prepare("UPDATE UserBadge SET badge = 'Awesome Borrower' 
                                    WHERE user = ?
                                    AND badge = 'Good Borrower'");
            $stmt->execute(array($up_number));
        }
        if ($borrowedBooksNumber>=3){
            echo "entrou if 6";
            $stmt = $dbh->prepare("UPDATE UserBadge SET badge = 'Legendary Borrower' 
                                    WHERE user = ?
                                    AND badge = 'Awesome Borrower'");
            $stmt->execute(array($up_number));
        }
    
    }

    function getUserBadges($up_number){
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM UserBadge WHERE user = ?');
        $stmt->execute(array($up_number));
        return $stmt->fetchAll();
    }
?>  
