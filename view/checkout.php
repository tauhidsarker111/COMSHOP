<?php
include '../control/profile_process.php';
<<<<<<< HEAD
$role = "customer";
?>
<html>
<head>
    <title>Checkout – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">
    <div class="section-title">💳 Checkout</div>

    <?php if(empty($_SESSION["cart"])): ?>
    <div class="alert alert-error">Your cart is empty. <a href="../view/products.php">Shop now</a></div>
    <?php else:
        $total = 0;
    ?>

    <div style="display:grid;grid-template-columns:1fr 380px;gap:24px;">

        <!-- Order summary -->
        <div class="card">
            <h3>📋 Order Summary</h3>
            <table class="cart-table">
                <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
                <tbody>
                <?php foreach($_SESSION["cart"] as $item):
                    $sub = $item["price"] * $item["quantity"];
                    $total += $sub;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item["name"]); ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td>$<?php echo number_format($item["price"],2); ?></td>
                    <td>$<?php echo number_format($sub,2); ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">Total: $<?php echo number_format($total,2); ?></div>
        </div>

        <!-- Payment method -->
        <div class="card">
            <h3>💰 Payment Method</h3>
            <div id="checkout_error" class="alert alert-error" style="display:none;"></div>
            <form action="../control/order_process.php" method="post" onsubmit="return validateCheckout()">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="Cash on Delivery">
                    <span>💵 Cash on Delivery</span>
                </label>
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="Online Wallet">
                    <span>👜 Online Wallet</span>
                </label>
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="Credit Card">
                    <span>💳 Credit Card</span>
                </label>
                <br>
                <button type="submit" name="place_order" class="btn btn-success" style="width:100%;">
                    ✅ Place Order — $<?php echo number_format($total,2); ?>
                </button>
                <a href="../view/cart.php" class="btn btn-dark btn-sm" style="width:100%;text-align:center;margin-top:8px;">← Back to Cart</a>
            </form>
        </div>

    </div>
    <?php endif; ?>
</div>

=======
?>
<html>
<head>
    <title>Checkout</title>
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

<h1>Checkout</h1>

<?php
if(empty($_SESSION["cart"])){
    echo "<p class='error'>Your cart is empty. <a href='../view/products.php'>Shop now</a></p>";
} else {

    // Calculate total
    $total = 0;
    foreach($_SESSION["cart"] as $item){
        $total += $item["price"] * $item["quantity"];
    }
?>

<!-- Order Summary -->
<div class="card">
    <h2>Order Summary</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach($_SESSION["cart"] as $item){ ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["quantity"]; ?></td>
            <td>$<?php echo $item["price"]; ?></td>
            <td>$<?php echo number_format($item["price"] * $item["quantity"], 2); ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </table>
</div>

<!-- Payment Form -->
<div class="card">
    <h2>Select Payment Method</h2>
    <p id="checkout_error" class="error"></p>

    <form action="../control/order_process.php" method="post" onsubmit="return validateCheckout()">

        <label>
            <input type="radio" name="payment_method" value="Cash on Delivery">
            💵 Cash on Delivery
        </label><br><br>

        <label>
            <input type="radio" name="payment_method" value="Online Wallet">
            💳 Online Wallet
        </label><br><br>

        <label>
            <input type="radio" name="payment_method" value="Credit Card">
            💳 Credit Card
        </label><br><br>

        <input type="submit" name="place_order" class="btn btn-green" value="Place Order">
        <a href="../view/cart.php" class="btn btn-yellow">Back to Cart</a>
    </form>
</div>

<?php } ?>

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
<script src="../js/myscript.js"></script>
</body>
</html>
