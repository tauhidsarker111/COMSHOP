<?php 
include '../control/profile_process.php';
?>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    </head>
    <body>

<div class="nav">
    <a href="../view/profile.php">My Profile</a>
    <a href="../view/products.php">Products</a>
    <a href="../view/cart.php">Cart (<span id="cart_count"><?php echo isset($_SESSION["cart"]) ? array_sum(array_column($_SESSION["cart"], "quantity")) : 0; ?></span>)</a>
    <a href="../view/my_orders.php">My Orders</a>
    <?php
    // Show Admin link only for admins
    $mydbCheck = new MyDB();
    $connCheck  = $mydbCheck->createConn();
    $roleResult = $mydbCheck->getUser($_SESSION["username"], $connCheck);
    $myRole     = "customer";
    if($roleResult->num_rows > 0){
        foreach($roleResult as $rrow){ $myRole = $rrow["role"]; }
    }
    if($myRole == "admin"){ echo '<a href="../view/admin.php">Admin Panel</a>'; }
    $mydbCheck->closeConn($connCheck);
    ?>
    <a href="../control/logout_process.php">Logout</a>
</div>

        <h2>Profile</h2>
        <p>Welcome to your profile!</p>
        <p>Hello, <?php echo $_SESSION["username"]; ?>!</p>
Email: <?php echo $email; ?>
<br>

<img src="../uploads/<?php echo $file; ?>" alt="Profile Image" width="200" height="200">
<a href="../view/editprofile.php">Edit Profile</a>

<hr/>

<!-- Search users by username (AJAX — from original project) -->
<input type="text" name="username" id="username" onkeyup="getUserData()" placeholder="Search user by username">
<p id="result"> </p>

<hr/>

        <a href="../control/logout_process.php">Logout</a>

<script src="../js/myscript.js"></script>
    </body>
</html>
