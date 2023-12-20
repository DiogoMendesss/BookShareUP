<?php include_once('database/init.php'); ?>
<section class="register-book-page">
<form class="register-form" action="action_register.php" method="post" enctype="multipart/form-data">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required autofocus> <!-- Change name and placeholder to 'up_number' -->
    <input type="password" name="password" id="password" placeholder="Password" required> <!-- Change name and placeholder to 'password' -->
    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>

    <br>

    <p> Select your main campus: </p>
    <?php
    $campuses = getCampusesInfo();
    ?>
    <select class="selection-dropdown" name="selectedCampuses[]" >
        <?php foreach ($campuses as $campus) { ?>
            <option value="<?php echo $campus['name']; ?>"><?php echo $campus['name']; ?></option>
        <?php } ?>
    </select>
    <br>

    <p>Upload your profile image:</p>
    <input type="file" name="profile_pic" id="input-profile_pic">
    <input type="submit" value = Register>
</form>
<div class="change-register-page">
    <p class="centered-paragraph"> Already have an account? </p>
    <form id="login-request" action="home_page.php" method="get">
            <input type="hidden" name="action" value="login">
            <input type="submit" value="Login">
    </form>
    <p id=register_error class="centered paragraph"> 
        <?php if (isset($_SESSION['msg'])){
            echo ($_SESSION['msg']);
            //echo ("That user already exists. Try again.");
            $_SESSION['msg']=null;}
        ?>
    </p>
</div>
</section>

