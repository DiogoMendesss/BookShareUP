<!DOCTYPE html>
<html>
<head>
    <title>BookShareUP</title>
    <!-- Link to your navbar.css -->
    <link rel="stylesheet" type="text/css" href="bootstrap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="bookexplorer.php"> <img src="icon.png" alt="Explorer"></a>
            <a href="want_to_read.php"> <img src="icon.png" alt="Want To Read"></a>
            <a href="feed.php"> <img src="icon.png" alt="Feed"></a>
            <a href="my_library.php"> <img src="icon.png" alt="My Library"></a>
            <a href="profile_page.php"> <img src="icon.png" alt="My Profile"></a>
        </nav>
        <form id = "logout-form" action="logout_action.php">
            <button>Logout</button>
        </form>
    </header>
