<?php
include '../control/profile_process.php';
// get role
$mydbR = new MyDB(); $connR = $mydbR->createConn();
$rRes  = $mydbR->getUser($_SESSION["username"], $connR);
$role  = "customer";
if($rRes->num_rows > 0){ foreach($rRes as $rr){ $role = $rr["role"]; } }
$mydbR->closeConn($connR);
?>
<html>
<head>
    <title>Profile – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">

    <!-- Welcome banner -->
    <div class="welcome-banner">
        <span class="icon"><?php echo $role=="admin" ? "🛡️" : "👋"; ?></span>
        <div>
            <h2>Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
            <p><?php echo $role=="admin" ? "You are logged in as Administrator." : "Manage your profile and orders below."; ?></p>
        </div>
    </div>

    <!-- Profile card -->
    <div class="profile-card">
        <img src="../uploads/<?php echo htmlspecialchars($file); ?>"
             alt="Profile Image"
             onerror="this.src='../uploads/default.png'">
        <div class="info">
            <h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
            <p>📧 <?php echo htmlspecialchars($email); ?></p>
            <span class="role-badge"><?php echo $role; ?></span><br><br>
            <a href="../view/editprofile.php" class="btn btn-outline">✏️ Edit Profile</a>
        </div>
    </div>

    <?php if($role == "admin"): ?>
        <!-- Admin: user search -->
        <div class="card">
            <h3>🔍 Search User by Username</h3>
            <div class="search-box">
                <input type="text" id="username" onkeyup="getUserData()" placeholder="Type a username to search…">
            </div>
            <div id="search_result"></div>
        </div>
    <?php else: ?>
        <!-- Customer: recent orders summary -->
        <?php
        $mydbO = new MyDB(); $connO = $mydbO->createConn();
        $recentOrds = $mydbO->getOrdersByUser($_SESSION["username"], $connO);
        if($recentOrds->num_rows > 0):
        ?>
        <div class="card">
            <h3>📦 Your Recent Orders <a href="../view/my_orders.php" style="font-size:13px;font-weight:normal;color:#667eea;float:right;">View all →</a></h3>
            <table class="data-table">
                <thead><tr><th>Order #</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th></tr></thead>
                <tbody>
                <?php $c=0; foreach($recentOrds as $ord):
                    if($c++ >= 3) break; ?>
                <tr>
                    <td>#<?php echo $ord["id"]; ?></td>
                    <td><?php echo date("M d, Y", strtotime($ord["created_at"])); ?></td>
                    <td><strong>$<?php echo number_format($ord["total_amount"],2); ?></strong></td>
                    <td><?php echo $ord["payment_method"]; ?></td>
                    <td><span class="badge badge-<?php echo $ord["status"]; ?>"><?php echo ucfirst($ord["status"]); ?></span></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
        endif;
        $mydbO->closeConn($connO);
        ?>
    <?php endif; ?>

</div>
<script src="../js/myscript.js"></script>
</body>
</html>
