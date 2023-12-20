    <h1>User Profile</h1>
    </header>
        <main>
        <section class = "profile-main" id='visiting_profile'>
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
        </main>
    </body>
</html>