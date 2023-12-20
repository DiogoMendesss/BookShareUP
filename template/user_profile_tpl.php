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

                <section class = "profile-info">
                    <div class = "user-info-field">
                        <div class="user-info-label"> UP Number: </div> <div class='user-info'> <?php echo $user ?> </div>
                    </div>
                    <div class = "user-info-field">
                        <div class="user-info-label"> Number of Owned Books: </div> <div class='user-info'> <?php echo getNumOwnedBooks($user) ?> </div>
                    </div>
                    <div class = "user-info-field">
                        <div class="user-info-label"> Attending Campus: </div> <div class='user-info'> <?php $user_campuses = getUserFacultyCampus($user);
                        foreach ($user_campuses as $campus) echo $campus['campus'] . '  ';?> </div>
                    </div>
                </section>
            </section>
        </main>
    </body>
</html>