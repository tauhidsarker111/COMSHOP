<?php
include '../control/profile_process.php';
?>
<html>
<head>
    <title>Cart</title>
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

<h1>Your Cart</h1>
<p id="cart_msg" style="color:green; font-weight:bold;"></p>

<?php
// Show order error if any
if(isset($_SESSION["order_error"])){
    echo "<p class='error'>" . $_SESSION["order_error"] . "</p>";
    unset($_SESSION["order_error"]);
}

if(empty($_SESSION["cart"])){
    echo "<p>Your cart is empty. <a href='../view/products.php'>Shop now</a></p>";
} else {
    $total = 0;
?>

<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php foreach($_SESSION["cart"] as $item){ 
        $subtotal = $item["price"] * $item["quantity"];
        $total += $subtotal;
    ?>
    <tr id="cart_row_<?php echo $item["product_id"]; ?>">
        <td><?php echo $item["name"]; ?></td>
        <td>$<?php echo $item["price"]; ?></td>
        <td><?php echo $item["quantity"]; ?></td>
        <td>$<?php echo number_format($subtotal, 2); ?></td>
        <td>
            <button class="btn btn-red" onclick="removeFromCart(<?php echo $item["product_id"]; ?>)">
                Remove
            </button>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="3"><strong>Total:</strong></td>
        <td colspan="2"><strong id="cart_total">$<?php echo number_format($total, 2); ?></strong></td>
    </tr>
</table>

<br>
<a href="../view/checkout.php" class="btn btn-green">Proceed to Checkout</a>
<a href="../view/products.php" class="btn btn-yellow">Continue Shopping</a>

<?php } ?>

<script src="../js/myscript.js"></script>
</body>
</html>
