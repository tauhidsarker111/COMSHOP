<?php
include '../control/profile_process.php';
<<<<<<< HEAD
$role = "customer";
?>
<html>
<head>
    <title>My Orders – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">
    <div class="section-title">📦 My Orders</div>

    <?php
    $mydb6 = new MyDB(); $conn6 = $mydb6->createConn();
    $orders = $mydb6->getOrdersByUser($_SESSION["username"], $conn6);
    if($orders->num_rows > 0):
        foreach($orders as $ord):
    ?>
    <div class="order-card">
        <div class="order-header">
            <div>
                <strong>Order #<?php echo $ord["id"]; ?></strong>
                <span style="color:#888;font-size:12px;margin-left:10px;"><?php echo date("M d, Y H:i", strtotime($ord["created_at"])); ?></span>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <span><?php echo $ord["payment_method"]; ?></span>
                <span class="badge badge-<?php echo $ord["status"]; ?>"><?php echo ucfirst($ord["status"]); ?></span>
                <strong style="color:#e94560;">$<?php echo number_format($ord["total_amount"],2); ?></strong>
            </div>
        </div>
        <div class="order-body">
            <?php
            $mydb7 = new MyDB(); $conn7 = $mydb7->createConn();
            $items = $mydb7->getOrderItems($ord["id"], $conn7);
            if($items->num_rows > 0): ?>
            <ul>
            <?php foreach($items as $item): ?>
                <li>
                    <strong><?php echo htmlspecialchars($item["name"]); ?></strong>
                    &nbsp;×<?php echo $item["quantity"]; ?>
                    &nbsp;— $<?php echo number_format($item["price"] * $item["quantity"], 2); ?>
                    <span style="color:#888;font-size:11px;">(<?php echo htmlspecialchars($item["brand"]); ?> / <?php echo htmlspecialchars($item["category"]); ?>)</span>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php endif;
            $mydb7->closeConn($conn7); ?>
        </div>
    </div>
    <?php
        endforeach;
    else:
        echo "<div class='card' style='text-align:center;padding:40px;'>
                <p style='font-size:48px;'>📭</p>
                <p style='color:#888;font-size:16px;'>No orders yet.</p>
                <a href='../view/products.php' class='btn btn-primary' style='margin-top:14px;'>Start Shopping</a>
              </div>";
    endif;
    $mydb6->closeConn($conn6);
    ?>
</div>
=======
?>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>

<div class="nav">
    <a href="../view/profile.php">My Profile</a>
    <a href="../view/products.php">Products</a>
    <a href="../view/cart.php">Cart (<span id="cart_count"><?php echo isset($_SESSION["cart"]) ? array_sum(array_column($_SESSION["cart"], "quantity")) : 0; ?></span>)</a>
    <a href="../view/my_orders.php">My Orders</a>
    <a href="../control/logout_process.php">Logout</a>
</div>

<h1>My Orders</h1>

<?php
$mydb6 = new MyDB();
$conn6 = $mydb6->createConn();
$orders = $mydb6->getOrdersByUser($_SESSION["username"], $conn6);

if($orders->num_rows > 0){
    foreach($orders as $order){
        $badge = ($order["status"] == "pending") ? "badge-pending" : "badge-confirmed";
?>
    <div class="card">
        <strong>Order #<?php echo $order["id"]; ?></strong>
        &nbsp;<span class="<?php echo $badge; ?>"><?php echo $order["status"]; ?></span>
        <p>Date: <?php echo $order["created_at"]; ?></p>
        <p>Payment: <?php echo $order["payment_method"]; ?></p>
        <p>Total: <strong>$<?php echo $order["total_amount"]; ?></strong></p>

        <!-- Show order items -->
        <?php
        $mydb7 = new MyDB();
        $conn7 = $mydb7->createConn();
        $items = $mydb7->getOrderItems($order["id"], $conn7);
        if($items->num_rows > 0){
            echo "<ul>";
            foreach($items as $item){
                echo "<li>" . $item["name"] . " × " . $item["quantity"] . " = $" . number_format($item["price"] * $item["quantity"], 2) . "</li>";
            }
            echo "</ul>";
        }
        $mydb7->closeConn($conn7);
        ?>
    </div>
<?php
    }
} else {
    echo "<p>No orders yet. <a href='../view/products.php'>Start shopping!</a></p>";
}

$mydb6->closeConn($conn6);
?>

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
</body>
</html>
