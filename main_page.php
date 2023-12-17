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
    <link rel="stylesheet" href="css/main_page.css">
    <title>Booksharing UP | Homepage</title>
</head>
<body class=mainPage-body>
    <?php include_once('templates/main_page_tpl.php'); ?>
    <section class="fixed-content">
        <!-- <?php
            if ($register_request=='register') {
                // include_once('templates/register_form.php');
            }
            else {
                 // include_once('templates/login_form.php');
            }
        ?>  -->
    </section>
</body>
</html>
