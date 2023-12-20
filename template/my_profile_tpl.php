</header>
<main class = "profile-main">
    <div class = "empty-space-image">
        <section class = "profile-pic">
            <img src = "image/users/<?php echo $up_number ?>.jpg" alt = "Profile Picture">
        </section>

            <div class = "edit-profile-pic">
                <!-- Change Profile Picture Form -->
                <?php if ($changePicRequest==='Upload New Pic') {
                    unset($changePicRequest);
                    saveProfilePic($up_number); 
                ?>
                <?php }?>
                <?php if (!isset($changePicRequest)) { ?>
                <form action = "my_profile.php" method = "post">
                    <input type = "submit" name='ChangeProfilePic' value = "Change Profile Picture">
                </form>
                <?php } 
                elseif ($changePicRequest==='Change Profile Picture') { ?>
                    <form class="upload-pic-form" action = "my_profile.php" method = "post" enctype="multipart/form-data">
                        <input type = "file" name = "profile_pic">
                        <input type = "submit" name='ChangeProfilePic' value = "Upload New Pic">
                    </form>
                <?php } ?>
                <!-- Change Profile Picture Form -->
            </div>
    </div>

    <h1 id=profile_name> <?php echo getUserFullName($up_number) ?> </h1>
    <form action = 'action_change_user_status.php' method = 'post'>
        <input type = 'submit' name = 'ChangeStatus' value = "Change Status to <?php echo getOtherUserStatus($up_number) ?> ">
    </form>

    <section class = "profile-info">
        <div class = "user-info-field">
            <div class="user-info-label"> UP Number: </div> <div class='user-info'> <?php echo $up_number ?> </div>
        </div>
        <div class = "user-info-field">
            <div class="user-info-label"> Number of Owned Books: </div> <div class='user-info'> <?php echo getNumOwnedBooks($up_number) ?> </div>
        </div>
        <div class = "user-info-field">
            <div class="user-info-label"> Attending Campus: </div> <div class='user-info'> <?php $user_campuses = getUserFacultyCampus($up_number);
            foreach ($user_campuses as $campus) echo $campus['campus'] . '  ';?> </div>
        </div>
    </section>

    <div class = "edit-campus-form">
    <!-- Edit Campus Form -->
        <?php if (!isset($_GET['EditCampus'])) { ?>
        <form class = edit-campus-btn action="my_profile.php" method="get">
            <input type='submit' name = 'EditCampus' value='Edit Campus'>
        </form>

        <?php } elseif ($_GET['EditCampus'] === 'Edit Campus') { ?>
            
        <form class="select-campus-form" action="action_edit_campus.php" method="post">
            <div class="edit-campus-list">
                <?php
                $allCampuses = getCampusesInfo();
                foreach ($allCampuses as $campus) {
                    $campusName = $campus['name'];
                    ?>
                    <input type="checkbox" name="selectedCampuses[]" value="<?php echo $campusName; ?>" <?php if (isSelected($campusName, $user_campuses)) echo "checked"; ?>>
                    <?php echo $campusName; ?>
                <?php } ?>
            </div>
            <div class="edit-campus-butn">
                <input type="submit" value="Update Campuses">
            </div>
         </form>
        <?php } ?>
        <!-- Edit Campus Form -->
    </div>

    <section class="ongoing-userBorrows">
        <h2>Borrowed Books</h2>
        <?php
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
                    <input type="hidden" name="bookID" value="<?php echo $borrow['copy']; ?>">
                    <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower_up']; ?>">
                    <input type="hidden" name="newStatus" value="<?php echo getNextBorrowState($borrow['status']); ?>">
                    <input type="submit" value="Update to <?php echo getNextBorrowState($borrow['status']); ?>">
                </form>
            <?php
            } if ($borrow['status'] === 'pending'){ ?>
                <form action="action_update_borrow_status.php" method="post">
                    <input type="hidden" name="bookID" value="<?php echo $borrow['copy']; ?>">
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
