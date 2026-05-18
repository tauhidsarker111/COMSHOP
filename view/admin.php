<?php
include '../model/mydb.php';
session_start();

// Must be logged in
if(!isset($_SESSION["username"])){
    header("Location: ../view/login.php");
    exit;
}

// Check admin role
$mydb = new MyDB();
$conn = $mydb->createConn();
$result = $mydb->getUser($_SESSION["username"], $conn);
$role = "customer";
if($result->num_rows > 0){
    foreach($result as $row){
        $role = $row["role"];
    }
}
if($role != "admin"){
    echo "Access denied. Admins only. <a href='../view/profile.php'>Go back</a>";
    exit;
}
?>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>

<div class="nav">
    <a href="../view/admin.php">Admin Panel</a>
    <a href="../view/profile.php">My Profile</a>
    <a href="../control/logout_process.php">Logout</a>
</div>

<h1>Admin Panel</h1>
<p>Welcome, Admin <strong><?php echo $_SESSION["username"]; ?></strong>!</p>

<hr>

<!-- ── CUSTOMERS TABLE ─────────────────────────────────────────── -->
<h2>All Customers</h2>
<?php
$users = $mydb->getAllUsers($conn);
if($users->num_rows > 0){
?>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Profile Image</th>
        <th>Action</th>
    </tr>
    <?php foreach($users as $user){ ?>
    <tr>
        <td><?php echo $user["id"]; ?></td>
        <td><?php echo $user["username"]; ?></td>
        <td><?php echo $user["email"]; ?></td>
        <td><img src="../uploads/<?php echo $user["file"]; ?>" width="50" height="50" alt="img"></td>
        <td>
            <?php if($user["username"] != $_SESSION["username"]){ ?>
            <a href="../control/admin_process.php?action=delete_user&username=<?php echo $user["username"]; ?>"
               class="btn btn-red"
               onclick="return confirm('Delete user <?php echo $user["username"]; ?>?')">
               Delete
            </a>
            <?php } else { echo "<em>You</em>"; } ?>
        </td>
    </tr>
    <?php } ?>
</table>
<?php } else { echo "<p>No customers found.</p>"; } ?>

<hr>

<!-- ── REVIEWS TABLE ──────────────────────────────────────────── -->
<h2>All Reviews</h2>
<?php
$reviews = $mydb->getAllReviews($conn);
if($reviews->num_rows > 0){
?>
<table>
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Username</th>
        <th>Comment</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php foreach($reviews as $rev){ ?>
    <tr>
        <td><?php echo $rev["id"]; ?></td>
        <td><?php echo $rev["product_name"]; ?></td>
        <td><?php echo $rev["username"]; ?></td>
        <td><?php echo $rev["comment"]; ?></td>
        <td><?php echo $rev["created_at"]; ?></td>
        <td>
            <a href="../control/admin_process.php?action=delete_review&review_id=<?php echo $rev["id"]; ?>"
               class="btn btn-red"
               onclick="return confirm('Delete this review?')">
               Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php } else { echo "<p>No reviews found.</p>"; } ?>

<?php $mydb->closeConn($conn); ?>
</body>
</html>
