<?php
include '../control/profile_process.php';
<<<<<<< HEAD
$role = "customer";
?>
<html>
<head>
    <title>Cart – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">
    <div class="section-title">🛒 Your Cart</div>

    <?php if(isset($_SESSION["order_error"])): ?>
    <div class="alert alert-error"><?php echo $_SESSION["order_error"]; unset($_SESSION["order_error"]); ?></div>
    <?php endif; ?>

    <?php if(empty($_SESSION["cart"])): ?>
    <div class="card" style="text-align:center;padding:40px;">
        <p style="font-size:48px;margin-bottom:12px;">🛒</p>
        <p style="color:#888;font-size:16px;">Your cart is empty.</p>
        <a href="../view/products.php" class="btn btn-primary" style="margin-top:14px;">Browse Products</a>
    </div>
    <?php else:
        $total = 0;
    ?>
    <div class="card">
        <table class="cart-table">
            <thead>
                <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
            </thead>
            <tbody id="cart_tbody">
            <?php foreach($_SESSION["cart"] as $item):
                $sub = $item["price"] * $item["quantity"];
                $total += $sub;
            ?>
            <tr id="cart_row_<?php echo $item["product_id"]; ?>">
                <td><strong><?php echo htmlspecialchars($item["name"]); ?></strong></td>
                <td>$<?php echo number_format($item["price"],2); ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td>$<?php echo number_format($sub,2); ?></td>
                <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(<?php echo $item["product_id"]; ?>)">Remove</button></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="cart-total">Total: <span id="cart_total">$<?php echo number_format($total,2); ?></span></div>
    </div>

    <div style="display:flex;gap:12px;margin-top:4px;">
        <a href="../view/products.php" class="btn btn-dark">← Continue Shopping</a>
        <a href="../view/checkout.php" class="btn btn-success">Proceed to Checkout →</a>
    </div>
    <?php endif; ?>
</div>

=======
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

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
<script src="../js/myscript.js"></script>
</body>
</html>
