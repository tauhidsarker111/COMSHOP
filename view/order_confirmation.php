<?php
include '../control/profile_process.php';
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

</body>
</html>
