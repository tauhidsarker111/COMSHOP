<?php
include '../model/mydb.php';
session_start();
<<<<<<< HEAD
if(!isset($_SESSION["username"])){ header("Location: ../view/login.php"); exit; }
$mydb = new MyDB(); $conn = $mydb->createConn();
$rRes = $mydb->getUser($_SESSION["username"], $conn);
$role = "customer";
if($rRes->num_rows > 0){ foreach($rRes as $rr){ $role=$rr["role"]; } }
if($role != "admin"){ echo "<p class='error'>Access denied. <a href='../view/profile.php'>Go back</a></p>"; exit; }
$cartCount = 0;
?>
<html>
<head>
    <title>Admin Panel – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">

    <!-- Welcome banner -->
    <div class="welcome-banner" style="background:linear-gradient(135deg,#e94560 0%,#1a1a2e 100%);">
        <span class="icon">🛡️</span>
        <div>
            <h2>Admin Dashboard</h2>
            <p>Logged in as <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></p>
        </div>
    </div>

    <?php
    // ── Stats ────────────────────────────────────────────────────
    $custRes  = $mydb->getAllCustomers($conn);      $totalCustomers = $custRes->num_rows;
    $revRes   = $mydb->getAllReviews($conn);         $totalReviews   = $revRes->num_rows;
    $ordRes   = $mydb->getAllOrders($conn);          $totalOrders    = $ordRes->num_rows;
    $prodRes  = $mydb->getAllProducts($conn);        $totalProducts  = $prodRes->num_rows;
    ?>
    <div class="stats-row">
        <div class="stat-card">
            <div class="num"><?php echo $totalCustomers; ?></div>
            <div class="lbl">👤 Customers</div>
        </div>
        <div class="stat-card amber">
            <div class="num"><?php echo $totalOrders; ?></div>
            <div class="lbl">📦 Orders</div>
        </div>
        <div class="stat-card red">
            <div class="num"><?php echo $totalReviews; ?></div>
            <div class="lbl">💬 Reviews</div>
        </div>
        <div class="stat-card green">
            <div class="num"><?php echo $totalProducts; ?></div>
            <div class="lbl">🖥️ Products</div>
        </div>
    </div>

    <!-- ── Search user ──────────────────────────────────────────── -->
    <div class="card">
        <h3>🔍 Search User by Username</h3>
        <div class="search-box">
            <input type="text" id="username" onkeyup="getUserData()" placeholder="Type a username to search…">
        </div>
        <div id="search_result"></div>
    </div>

    <!-- ── Recent Orders (dashboard section) ────────────────────── -->
    <div class="section-title">🕐 Recent Orders</div>
    <?php
    $recentOrd = $mydb->getRecentOrders(5, $conn);
    if($recentOrd->num_rows > 0):
    ?>
    <table class="data-table" style="margin-bottom:28px;">
        <thead>
            <tr><th>#</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th></tr>
        </thead>
        <tbody>
        <?php foreach($recentOrd as $ord): ?>
        <tr>
            <td>#<?php echo $ord["id"]; ?></td>
            <td><?php echo htmlspecialchars($ord["username"]); ?></td>
            <td><strong>$<?php echo number_format($ord["total_amount"],2); ?></strong></td>
            <td><?php echo htmlspecialchars($ord["payment_method"]); ?></td>
            <td><span class="badge badge-<?php echo $ord["status"]; ?>"><?php echo ucfirst($ord["status"]); ?></span></td>
            <td><?php echo date("M d, Y H:i", strtotime($ord["created_at"])); ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: echo "<p style='color:#888;margin-bottom:24px;'>No orders yet.</p>"; endif; ?>

    <!-- ── Recent Reviews (dashboard section) ───────────────────── -->
    <div class="section-title">🕐 Recent Reviews</div>
    <?php
    $recentRev = $mydb->getRecentReviews(5, $conn);
    if($recentRev->num_rows > 0):
    ?>
    <table class="data-table" style="margin-bottom:28px;">
        <thead>
            <tr><th>#</th><th>Product</th><th>Customer</th><th>Comment</th><th>Date</th></tr>
        </thead>
        <tbody>
        <?php foreach($recentRev as $rev): ?>
        <tr>
            <td><?php echo $rev["id"]; ?></td>
            <td><?php echo htmlspecialchars($rev["product_name"]); ?></td>
            <td><?php echo htmlspecialchars($rev["username"]); ?></td>
            <td><?php echo htmlspecialchars(substr($rev["comment"],0,60)) . (strlen($rev["comment"])>60?"…":""); ?></td>
            <td><?php echo date("M d, Y", strtotime($rev["created_at"])); ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: echo "<p style='color:#888;margin-bottom:24px;'>No reviews yet.</p>"; endif; ?>

    <!-- ── All Customers ─────────────────────────────────────────── -->
    <div class="section-title">👤 All Customers</div>
    <?php
    // Re-query to iterate fresh
    $customers = $mydb->getAllCustomers($conn);
    if($customers->num_rows > 0):
    ?>
    <table class="data-table" style="margin-bottom:28px;">
        <thead>
            <tr><th>ID</th><th>Username</th><th>Email</th><th>Profile Image</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach($customers as $user): ?>
        <tr>
            <td><?php echo $user["id"]; ?></td>
            <td><?php echo htmlspecialchars($user["username"]); ?></td>
            <td><?php echo htmlspecialchars($user["email"]); ?></td>
            <td><img src="../uploads/<?php echo htmlspecialchars($user["file"]); ?>"
                     width="44" height="44"
                     style="border-radius:50%;object-fit:cover;border:2px solid #ddd;"
                     onerror="this.src='../uploads/default.png'"></td>
            <td>
                <a href="../control/admin_process.php?action=delete_user&username=<?php echo urlencode($user["username"]); ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete <?php echo htmlspecialchars($user["username"]); ?> and all their data?')">
                   🗑 Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: echo "<p style='color:#888;'>No customers found.</p>"; endif; ?>

    <!-- ── All Reviews ───────────────────────────────────────────── -->
    <div class="section-title">💬 All Reviews</div>
    <?php
    $allReviews = $mydb->getAllReviews($conn);
    if($allReviews->num_rows > 0):
    ?>
    <table class="data-table" style="margin-bottom:28px;">
        <thead>
            <tr><th>ID</th><th>Product</th><th>Customer</th><th>Comment</th><th>Date</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach($allReviews as $rev): ?>
        <tr>
            <td><?php echo $rev["id"]; ?></td>
            <td><?php echo htmlspecialchars($rev["product_name"]); ?></td>
            <td><?php echo htmlspecialchars($rev["username"]); ?></td>
            <td><?php echo htmlspecialchars(substr($rev["comment"],0,80)) . (strlen($rev["comment"])>80?"…":""); ?></td>
            <td><?php echo date("M d, Y", strtotime($rev["created_at"])); ?></td>
            <td>
                <a href="../control/admin_process.php?action=delete_review&review_id=<?php echo $rev["id"]; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this review?')">
                   🗑 Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: echo "<p style='color:#888;'>No reviews found.</p>"; endif; ?>

    <!-- ── All Orders ─────────────────────────────────────────────── -->
    <div class="section-title">📦 All Orders</div>
    <?php
    $allOrders = $mydb->getAllOrders($conn);
    if($allOrders->num_rows > 0):
    ?>
    <table class="data-table" style="margin-bottom:28px;">
        <thead>
            <tr><th>#</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Items</th></tr>
        </thead>
        <tbody>
        <?php foreach($allOrders as $ord):
            $mydbI = new MyDB(); $connI = $mydbI->createConn();
            $its = $mydbI->getOrderItems($ord["id"], $connI);
            $itemNames = [];
            if($its->num_rows > 0){ foreach($its as $it){ $itemNames[] = $it["name"]." ×".$it["quantity"]; } }
            $mydbI->closeConn($connI);
        ?>
        <tr>
            <td>#<?php echo $ord["id"]; ?></td>
            <td><?php echo htmlspecialchars($ord["username"]); ?></td>
            <td><strong>$<?php echo number_format($ord["total_amount"],2); ?></strong></td>
            <td><?php echo htmlspecialchars($ord["payment_method"]); ?></td>
            <td><span class="badge badge-<?php echo $ord["status"]; ?>"><?php echo ucfirst($ord["status"]); ?></span></td>
            <td><?php echo date("M d, Y", strtotime($ord["created_at"])); ?></td>
            <td style="font-size:12px;color:#666;"><?php echo implode(", ", $itemNames); ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: echo "<p style='color:#888;margin-bottom:24px;'>No orders yet.</p>"; endif; ?>

</div>

<?php $mydb->closeConn($conn); ?>
<script src="../js/myscript.js"></script>
=======

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
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
</body>
</html>
