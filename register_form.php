<form class="register-form" action="register_action.php" method="post">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required> <!-- Change name and placeholder to 'up_number' -->
    <input type="password" name="password" id="password" placeholder="Password"> <!-- Change name and placeholder to 'password' -->
    <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
    <input type="text" name="faculty_campus" id="faculty_campus" placeholder="Attending Campus" required>
    <input type="submit" value=Register>
</form>
<p> Already have an account? </p>
<form id="login-request" action="main_page.php" method="get">
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Login">
</form>
<p id=register_error> 
    <?php if (isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        $_SESSION['msg']=null;} ?>
</p>
