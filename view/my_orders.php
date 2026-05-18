<?php
include '../control/profile_process.php';
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

</body>
</html>
