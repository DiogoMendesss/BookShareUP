<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    
    <h1>This is the admin page</h1>
    <h2>Here you can see all the borrowings</h2>
    <hr>
    <h4>Search bar goes here</h4>
    <form id="search" action="admin.php">
        <input type="text" name="search_owner" placeholder="owner up_number" value="<?php echo $search_owner ?>">
        <input type="text" name="search_borrower" placeholder="borrower up_number" value="<?php echo $search_borrower ?>">
        <select name="search_campus">
            <option value="" selected disabled>Select campus</option>
            <?php foreach ($campuses as $campus) { //var_dump($genre); ?> 
                      
                <option value="<?php echo $campus['name'] ?>"><?php echo $campus['name'] ?></option>
            <?php } ?>

        </select>
        <button>Search</button>
        <a href="admin.php">Clear</a>
    </form>
    <hr>
    <?php
    foreach ($borrowings as $borrowing) { ?>
        <p>Owner: <?php echo $borrowing['owner'] ?></p>
        <p>Borrowing User: <?php echo $borrowing['user'] ?></p>
        <p>Status: <?php echo $borrowing['status'] ?></p>
        <?php if (isset($_GET['bID']) && $_GET['bID'] == $borrowing['id']) { ?>
            <form action="admin.php" method="post">
                <input type="hidden" name="action" value="confirm_update_status">
                <input type="hidden" name="copy_id" value="<?php echo $borrowing['copy']; ?>">
                <input type="hidden" name="ownerID" value="<?php echo $borrowing['owner'] ?>">
                <input type="hidden" name="borrowerID" value="<?php echo $borrowing['borrower'] ?>">
                <label>Status:</label>
                <input type="radio" name="status" value="pending">Pending
                <input type="radio" name="status" value="accepted">Accepted
                <input type="radio" name="status" value="delivered">Delivered
                <input type="radio" name="status" value="picked-up">Picked-up
                <input type="radio" name="status" value="returned">Returned
                <input type="radio" name="status" value="archived">Archived
                <button type="submit">Confirm</button>
            </form>
        <?php } else { ?>
            <form action = "admin.php" method="post">
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="borrowing_id" value="<?php echo $borrowing['id'] ?>">
                <input type="hidden" name="search_user" value="<?php echo $search_user ?>">
                <input type="hidden" name="search_campus" value="<?php echo $search_campus ?>">
                <button type="submit">Update Status</button>
            </form>

        <?php } ?>
        <p>Campus: <?php echo $borrowing['campus'] ?></p>
        <p>Exp date: <?php echo $borrowing['expiration_date']?> </p>

        <hr>
    <?php } ?>
    
    <form id = "logout-form" action="action_logout.php">
        <button>Logout</button>
    </form>
    
</body>
</html>
