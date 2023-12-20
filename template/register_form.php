<?php include_once('database/init.php'); ?>
<form class="register-form" action="action_register.php" method="post" enctype="multipart/form-data">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required autofocus>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>


    <label> Select your main campus: </label>
    <?php
    $campuses = getCampusesInfo();
    ?>
    <select class="selection-dropdown" name="selectedCampuses[]" >
        <?php foreach ($campuses as $campus) { ?>
            <option value="<?php echo $campus['name']; ?>"><?php echo $campus['name']; ?></option>
        <?php } ?>
    </select>

    <label>Upload your profile image:</label>
    <input type="file" name="profile_pic">
    <input type="submit" value = Register>
</form>
<div id="change-register-to-login">
    <label> Already have an account? </label>
    <form action="home_page.php" method="get">
            <input type="hidden" name="action" value="login">
            <input type="submit" value="Login">
    </form>
    <p class=user-input-error> 
        <?php if (isset($_SESSION['msg'])){
            echo ($_SESSION['msg']);
            //echo ("That user already exists. Try again.");
            $_SESSION['msg']=null;}
        ?>
    </p>
</div>

