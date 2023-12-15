<!DOCTYPE html>
<html>
<head>
    <head>
        <title>My Profile</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/my_profile_style.css">
    </head>
</head>
<body>
    <header>
        <?php include "navbar.php";?>
    </header>

    <main>
        <section class="module">
            <h1>Name</h1>
            <img src="path_to_logo.png" alt="User Logo">
            <h2>BIO</h2>
            <p>Your bio goes here.</p>
        </section>
        <section class="module">
            <h1>Badges</h1>
            <section class="shelf">
                <img src="badge.png" alt="Badge 1">
                <img src="badge.png" alt="Badge 2">
                <img src="badge.png" alt="Badge 3">
            </section>
            <h1>My Library</h1>
            <section class="shelf">
                <img src="book.jpg" alt="Book 1">
                <img src="book.jpg" alt="Book 2">
                <img src="book.jpg" alt="Book 3">
                <img src="book.jpg" alt="Book 4">
                <img src="book.jpg" alt="Book 5">
                <img src="book.jpg" alt="Book 6">
                <img src="book.jpg" alt="Book 7">
                <img src="book.jpg" alt="Book 8">
                <img src="book.jpg" alt="Book 9">
            </section>
        </section>
    </main>

    <footer>
        <p class=basic-text>BookShare UP</p>
    </footer>
</body>
</html>
