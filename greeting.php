<?php
    session_start();
    include_once('sql/db_users.php');
    $up_number = $_SESSION['up_number'];
    $full_name = $_SESSION['full_name'];
    $error_msg = $_SESSION['msg'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greeting Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #greeting {
            font-size: 18px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="greeting">
            <?php
            echo $up_number;
            echo $full_name;
            ?>
        </div>
        <button onclick="window.location.href='main_page.php'"; session_destroy>Back to Login Page</button>
    </div>
</body>
</html>
