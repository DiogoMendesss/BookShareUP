<form class="login-form" action="action_login.php" method="post">
    <input type="text" name="up_number" id="up_number" placeholder="UP Number" required autofocus>
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" value=Login accesskey="enter" >
</form>
<p class=user-input-error>
    <?php if ($_SESSION['msg'] === 'Invalid up_number or password!'){
        echo "Invalid credentials! Please try again.";
        $_SESSION['msg']=null;}?>
</p>
<div id='change-register-to-login'>
    <p>Don't have an account yet?</p>
    <form action="home_page.php" method="get">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
</div>