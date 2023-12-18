<form class="login-form" action="action_login.php" method="post">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required autofocus> <!-- Change name and placeholder to 'up_number' -->
    <input type="password" name="password" id="password" placeholder="Password"> <!-- Change name and placeholder to 'password' -->
    <input type="submit" value=Login accesskey="enter" >
</form>
<p id=login_error>
    <?php if ($_SESSION['msg'] === 'Invalid up_number or password!'){
        echo "Invalid credentials! Please try again.";
        $_SESSION['msg']=null;}?>
</p>
<div id=register_request>
    <p>Don't have an account yet?</p>
    <form class="register-request" action="home_page.php" method="get">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
</div>