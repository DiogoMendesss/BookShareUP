<form class="register-form" action="register_action.php" method="post">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required autofocus> <!-- Change name and placeholder to 'up_number' -->
    <input type="password" name="password" id="password" placeholder="Password"> <!-- Change name and placeholder to 'password' -->
    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
    <input type="file" name="profile_picture" id="profile_pic" placeholder="Profile Picture">
    <input type="submit" value = Register>
</form>
<p> Already have an account? </p>
<form id="login-request" action="main_page.php" method="get">
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Login">
</form>
<p id=register_error> 
    <?php if (isset($_SESSION['msg'])){
        echo ($_SESSION['msg']);
        //echo ("That user already exists. Try again.");
        $_SESSION['msg']=null;} ?>
</p>

<select name="faculty_campus" id="faculty_campus" required>
        <option value="SelectCampus" disabled selected>Select your campus</option>
        <?php $campuses = getCampusesInfo();
            foreach ($campuses as $campus) { ?>
        <option value="<?php echo $campus['name']; ?>"><?php echo $campus['name']; } ?></option>
    </select>
