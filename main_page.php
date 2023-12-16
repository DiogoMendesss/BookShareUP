<?php
    session_start();
    include_once('database/db_users.php');
    $register_request = $_GET['action'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Booksharing UP | Homepage</title>
</head>
<body class=mainPage-body>
    <div class="mainPage-container">
        <?php include_once('scrollableSection.php'); ?>
        <section class="fixed-content">
            <!-- Content for the right side (fixed) goes here -->
             <?php
                if ($register_request=='register') {
                    include_once('register_form.php');
                }
                else {
                    include_once('login_form.php');
                }
            ?>
        </section>
    </div>
</body>
</html>
