<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">

</head>
<body>
    <header>
    <h1>ADMIN PAGE</h1>
    <form id = "logout-form" action="action_logout.php">
        <button>Logout</button>
    </form>
    <hr>
    <div class="search_bar">
        <form id="search" action="admin.php">
            <input type="text" name="search_owner" placeholder="owner up_number" value="<?php echo $search_owner ?>">
            <input type="text" name="search_borrower" placeholder="borrower up_number" value="<?php echo $search_borrower ?>">
            <select name="search_campus">
                <?php if (isset($search_campus)) { ?>
                    <option value="<?php echo $search_campus ?>" selected><?php echo $search_campus ?></option>
                <?php } else { ?>
                    <option value="" selected disabled>Select campus</option>
                <?php } ?>
                <?php foreach ($campuses as $campus) { //var_dump($genre); ?> 
                        
                    <option value="<?php echo $campus['name'] ?>"><?php echo $campus['name'] ?></option>
                <?php } ?>

            </select>
            <button>Search</button>
            <a href="admin.php">Clear</a>
        </form>
    </div>
    <header>

    <main>
    <hr>

    <div class="borrowing-items">
    <?php
    foreach ($borrowings as $borrowing) { ?>
    <article class="borrowing-details">
        <p>Book: <?php echo $borrowing['title'] ?></p>
        <p>Owner: <?php echo $borrowing['owner'] ?></p>
        <p>Borrower: <?php echo $borrowing['borrower'] ?></p>
        <p>Status: <?php echo $borrowing['status'] ?></p>
        <?php if (isset($_GET['bID']) && $_GET['bID'] == $borrowing['id']) { ?>
            <form action="admin.php" method="post">
                <input type="hidden" name="action" value="confirm_update_status">
                <input type="hidden" name="copy_id" value="<?php echo $borrowing['copy']; ?>">
                <input type="hidden" name="ownerID" value="<?php echo $borrowing['owner'] ?>">
                <input type="hidden" name="borrowerID" value="<?php echo $borrowing['borrower'] ?>">
                <input type="hidden" name="borrow_id" value="<?php echo $borrowing['id']; ?>">
                <label>Status:</label>
                <input type="radio" name="status" value="delivered">Delivered
                <input type="radio" name="status" value="picked-up">Picked-up
                <input type="radio" name="status" value="returned">Returned
                <button type="submit">Confirm</button>
            </form>
        <?php } else { ?>
            <form action = "admin.php" method="post">
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="borrow_id" value="<?php echo $borrowing['id'] ?>">
                <input type="hidden" name="search_user" value="<?php echo $search_user ?>">
                <input type="hidden" name="search_campus" value="<?php echo $search_campus ?>">
                <button type="submit">Update Status</button>
            </form>

        <?php } ?>
        <p>Campus: <?php echo $borrowing['campus'] ?></p>
        <p>Exp date: <?php echo $borrowing['expiration_date']?> </p>

        
    </article>
    <hr>
    <?php } ?>
    </div>
    

    

    </main>
</body>
</html>
