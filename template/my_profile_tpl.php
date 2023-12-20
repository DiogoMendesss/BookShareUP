<h1>My Profile</h1>
</header>
        <main id='main_profile'>
            <section class = "profile-main">
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

                <h1 class=profile_name> <?php echo getUserFullName($up_number) ?> </h1>
                <form action = 'action_change_user_status.php' method = 'post'>
                    <input type = 'submit' name = 'ChangeStatus' value = "Change Status to <?php echo getOtherUserStatus($up_number) ?> ">
                </form>

                <section class = "info-section">
                    <div class = "info-row">
                        <div class="info-label"> UP Number: </div> <div class='info-field'> <?php echo $up_number ?> </div>
                    </div>
                    <div class = "info-row">
                        <div class="info-label"> Number of Owned Books: </div> <div class='info-field'> <?php echo getNumOwnedBooks($up_number) ?> </div>
                    </div>
                    <div class = "info-row">
                        <div class="info-label"> Associated Campus: </div> <div class='info-field'> <?php $user_campuses = getUserFacultyCampus($up_number);
                        foreach ($user_campuses as $campus) echo $campus['campus'] . '  ';?> </div>
                    </div>
                    <h1 class=profile_name> Books Read:<?php echo $readBooksNumber ?> </h1>
                    <h1 class=profile_name> Books Borrowed: <?php echo $borrowedBooksNumber ?> </h1>
                    <?php foreach ($badges as $badge){ ?>
                        <p><?php echo $badge['badge'] ?></p>
                    <?php } ?>
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
                                $campusName = $campus['name']; ?>
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
            </section>

            <section class="ongoing-userBorrows">
                <h2>Borrowed Books</h2>
                <?php
                $borrowedBooks = getOngoingUserBorrows($up_number);
                if (!empty($borrowedBooks)) { ?>
                    <ul id="borrowed-books">
                    <?php foreach ($borrowedBooks as $borrow) { ?>
                        <div class="borrowed-book-container">
                            <li>
                            Book: <? echo $borrow['title']; ?> <br>
                            Status: <? echo $borrow['status']; ?> <br>
                            Borrower: <a class="link-to-profile" href="user_profile.php?user=<?php echo $borrow['borrower']; ?>">
                            <?php echo $borrow['borrower_name'] ?></a> <br>
                            Campus: <?php echo $borrow['campus']; ?> <br>
                            Expiration Date: <?php echo $borrow['expiration_date']; ?>
                            </li>
                            
                    
                        <?php if ($borrow['status'] === 'pending' ||  $borrow['status'] === 'returned') {?>
                            <form action="action_update_borrow_status.php" method="post">
                                <input type="hidden" name="bookID" value="<?php echo $borrow['copy']; ?>">
                                <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower']; ?>">
                                <input type="hidden" name="newStatus" value="<?php echo getNextBorrowState($borrow['status']); ?>">
                                <input type="hidden" name="borrowID" value="<?php echo $borrow['id']; ?>">
                                <input type="submit" value="Update to <?php echo getNextBorrowState($borrow['status']); ?>">
                            </form>
                        <?php
                        } if ($borrow['status'] === 'pending'){ ?>
                            <form action="action_update_borrow_status.php" method="post">
                                <input type="hidden" name="bookID" value="<?php echo $borrow['copy']; ?>">
                                <input type="hidden" name="borrowerID" value="<?php echo $borrow['borrower']; ?>">
                                <input type="hidden" name="borrowID" value="<?php echo $borrow['id']; ?>">
                                <input type="hidden" name="newStatus" value="rejected">
                                <input type="submit" value="Reject Request">
                            </form>
                            <? } ?>
                        </div>
                    <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p>No ongoing borrowed books.</p>
                <?php } ?>
        
            </section>
        </main>
    </body>
</html>
