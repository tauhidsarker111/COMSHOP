<?php
include '../control/profile_process.php';
<<<<<<< HEAD
$role = "customer";
?>
<html>
<head>
    <title>Order Confirmed – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">
    <?php if(isset($_SESSION["order_success"])):
        $order_id = $_SESSION["order_success"];
        unset($_SESSION["order_success"]);
        $mydb5 = new MyDB(); $conn5 = $mydb5->createConn();
        $items = $mydb5->getOrderItems($order_id, $conn5);
        $total = 0;
    ?>

    <div style="text-align:center;padding:40px 0 20px;">
        <div style="font-size:64px;">✅</div>
        <h2 style="color:#27ae60;margin:12px 0 6px;">Order Placed Successfully!</h2>
        <p style="color:#888;">Order <strong>#<?php echo $order_id; ?></strong> has been confirmed.</p>
    </div>

    <div class="card" style="max-width:600px;margin:0 auto;">
        <h3>📦 Items Ordered</h3>
        <table class="cart-table">
            <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
            <tbody>
            <?php if($items->num_rows > 0): foreach($items as $item):
                $sub = $item["price"] * $item["quantity"];
                $total += $sub;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item["name"]); ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td>$<?php echo number_format($item["price"],2); ?></td>
                <td>$<?php echo number_format($sub,2); ?></td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="cart-total">Total Paid: $<?php echo number_format($total,2); ?></div>
    </div>

    <div style="text-align:center;margin-top:24px;display:flex;gap:12px;justify-content:center;">
        <a href="../view/products.php" class="btn btn-primary">Continue Shopping</a>
        <a href="../view/my_orders.php" class="btn btn-success">View My Orders</a>
    </div>

    <?php $mydb5->closeConn($conn5);
    else: ?>
    <div class="alert alert-error">No order found. <a href="../view/products.php">Shop now</a></div>
    <?php endif; ?>
</div>
=======
?>
<html>
<head>
    <title>Order Confirmed</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>

<div class="nav">
    <a href="../view/profile.php">My Profile</a>
    <a href="../view/products.php">Products</a>
    <a href="../view/cart.php">Cart</a>
    <a href="../view/my_orders.php">My Orders</a>
    <a href="../control/logout_process.php">Logout</a>
</div>

<h1>Order Confirmed! ✅</h1>

<?php
if(isset($_SESSION["order_success"])){
    $order_id = $_SESSION["order_success"];
    unset($_SESSION["order_success"]);

    $mydb5 = new MyDB();
    $conn5 = $mydb5->createConn();
    $items = $mydb5->getOrderItems($order_id, $conn5);

    $total = 0;
?>

<div class="card">
    <h2>Thank you, <?php echo $_SESSION["username"]; ?>!</h2>
    <p>Your Order ID is: <strong>#<?php echo $order_id; ?></strong></p>
    <p>Your order has been placed successfully.</p>

    <h3>Items Ordered:</h3>
    <table>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php
        if($items->num_rows > 0){
            foreach($items as $item){
                $subtotal = $item["price"] * $item["quantity"];
                $total += $subtotal;
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["quantity"]; ?></td>
            <td>$<?php echo $item["price"]; ?></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
        </tr>
        <?php } } ?>
        <tr>
            <td colspan="3"><strong>Total Paid:</strong></td>
            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </table>
</div>

<br>
<a href="../view/products.php" class="btn btn-blue">Continue Shopping</a>
<a href="../view/my_orders.php" class="btn btn-green">View My Orders</a>

<?php
    $mydb5->closeConn($conn5);
} else {
    echo "<p class='error'>No order found. <a href='../view/products.php'>Shop now</a></p>";
}
?>

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
</body>
</html>
