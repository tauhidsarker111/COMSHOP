<?php
include '../control/profile_process.php';
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

<script src="../js/myscript.js"></script>
</body>
</html>
