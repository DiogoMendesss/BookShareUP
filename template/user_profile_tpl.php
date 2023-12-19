<?php
    require_once('database/init.php');
    require_once('database/db_users.php');
    require_once('database/db_campus.php');
    require_once('next_borrow_state.php');

    if (isset($_POST['ChangeProfilePic'])) {
        $changePicRequest = $_POST['ChangeProfilePic'];
    }
?>

<main class = "profile-main">
    <section class = "profile-pic">
        <img src = "image/users/<?php echo $up_number ?>.jpg" alt = "Profile Picture">

        <!-- Change Profile Picture Form -->
        <?php if ($changePicRequest==='Upload New Pic') {
            unset($changePicRequest);
            saveProfilePic($up_number); 
        ?>
        <?php }?>
        <?php if (!isset($changePicRequest)) { ?>
        <form action = "user_profile.php" method = "post">
            <input type = "submit" name='ChangeProfilePic' value = "Change Profile Picture">
        </form>
        <?php } 
        elseif ($changePicRequest==='Change Profile Picture') { ?>
            <form action = "user_profile.php" method = "post" enctype="multipart/form-data">
                <input type = "file" name = "profile_pic">
                <input type = "submit" name='ChangeProfilePic' value = "Upload New Pic">
            </form>
        <?php } ?>
        <!-- Change Profile Picture Form -->
    </section>

    <h1 id=profile_name> <?php echo getUserFullName($up_number) ?> </h1>
    <section class = "profile-info">
        <h2 id=profile_upNumber> UP Number: <?php echo $up_number ?> </h2>
        <h2 id=profile_campus> Attending Campus: <?php $user_campuses = getUserFacultyCampus($up_number);
        foreach ($user_campuses as $campus) echo $campus['campus'] . '  ';?> </h2>

        <!-- Edit Campus Form -->
        <?php if (!isset($_GET['EditCampus'])) { ?>
        <form action="user_profile.php" method="get">
            <input type='submit' name = 'EditCampus' value='Edit Campus'>
        </form>
        <?php } elseif ($_GET['EditCampus'] === 'Edit Campus') { ?>
            
        <form class="edit-campus-form" action="action_edit_campus.php" method="post">
        <?php
        $allCampuses = getCampusesInfo();
        foreach ($allCampuses as $campus) {
            $campusName = $campus['name']; ?>
            <input type="checkbox" name="selectedCampuses[]" value="<?php echo $campusName; ?>" <?php /* Add logic here to check if the campus is selected */ ?>>
            <?php echo $campusName; ?> |
        <?php } ?>
        <input type="submit" value="Update Campuses">
         </form>
        <?php } ?>
        <!-- Edit Campus Form -->

        <h2 id=profile_numOwnedBooks> Number of Owned Books: <?php echo getNumOwnedBooks($up_number) ?> </h2>
    </section>
    <section class="ongoing-userBorrows">
        <h2>Borrowed Books</h2>
        <?php
        $borrowedBooks = getOngoingUserBorrows($up_number);
        if (!empty($borrowedBooks)) { ?>
            <ul id="borrowed-books">
            <?php foreach ($borrowedBooks as $borrow) { ?>
                <li>
                Status: <? echo $borrow['status']; ?>
                <br>Borrower: <?php echo $borrow['borrower_name']; ?>
                <br>Expiration Date: <?php echo $borrow['expiration_date']; ?>
                </li>
                
        
            <?php if ($borrow['status'] === 'pending' ||  $borrow['status'] === 'returned') {?>
                <form action="action_update_borrow_status.php" method="post">
                    <input type="hidden" name="bookID" value="<?php echo $borrow['copyID']; ?>">
                    <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower_up']; ?>">
                    <input type="hidden" name="newStatus" value="<?php echo getNextBorrowState($borrow['status']); ?>">
                    <input type="submit" value="Update to <?php echo getNextBorrowState($borrow['status']); ?>">
                </form>
            <?php
            } if ($borrow['status'] === 'pending'){ ?>
                <form action="action_update_borrow_status.php" method="post">
                    <input type="hidden" name="bookID" value="<?php echo $borrow['copyID']; ?>">
                    <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower_up']; ?>">
                    <input type="hidden" name="newStatus" value="rejected">
                    <input type="submit" value="Reject Request">
                </form>
                <? } ?>
            <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No ongoing borrowed books.</p>
        <?php } ?>
 
    </section>

</main>

