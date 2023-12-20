<h1>My Profile</h1>
</header>
        <main id='main-my-profile'>
            <section class = "profile-main">
                <div class = "empty-space-image">
                    <section class = "profile-pic">
                        <img src = "image/users/<?php echo $user ?>.jpg" alt = "Profile Picture">
                    </section>
                </div>

                <h1 class=profile_name> <?php echo getUserFullName($user) ?> </h1>

                <section class = "info-section">
                    <div class = "info-row">
                        <div class="info-label"> UP Number: </div> <div class='info-field'> <?php echo $user ?> </div>
                    </div>
                    <div class = "info-row">
                        <div class="info-label"> Number of Owned Books: </div> <div class='info-field'> <?php echo getNumOwnedBooks($user) ?> </div>
                    </div>
                    <div class = "info-row">
                        <div class="info-label"> Associated Campus: </div> <div class='info-field'> <?php $user_campuses = getUserFacultyCampus($user);
                        foreach ($user_campuses as $campus) echo $campus['campus'] . '  ';?> </div>
                    </div>
                </section>
            </section>

            <section class="display-badges">
                <h2>BADGES</h2>
                <div class="badges-container">
                    <?php
                    foreach ($badges as $badge) { ?>
                        <div class="badge-item">
                            <img src="image/badges/<?php echo $badge['badge']; ?>.png" alt="<?php echo $badge['badge']; ?>">
                            <h3 id="badge-label"> <?php echo $badge['badge']; ?> </h3>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </main>
    </body>
</html>