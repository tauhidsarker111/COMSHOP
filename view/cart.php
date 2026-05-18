<?php
include '../control/profile_process.php';
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

<script src="../js/myscript.js"></script>
</body>
</html>
