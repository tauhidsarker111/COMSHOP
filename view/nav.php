<?php
// nav.php — shared navigation partial
// Expects: $role, $_SESSION["cart"]
$cartCount = isset($_SESSION["cart"]) ? array_sum(array_column($_SESSION["cart"], "quantity")) : 0;
?>
<div class="nav">
    <span class="brand">💻 PC Shop</span>
    <?php if($role == "admin"): ?>
        <a href="../view/admin.php">Admin Panel</a>
        <a href="../view/profile.php">My Profile</a>
        <a href="../control/logout_process.php">Logout</a>
    <?php else: ?>
        <a href="../view/profile.php">My Profile</a>
        <a href="../view/products.php">Products</a>
        <a href="../view/cart.php">Cart <span class="cart-badge cart-count-badge"><?php echo $cartCount; ?></span></a>
        <a href="../view/my_orders.php">My Orders</a>
        <a href="../control/logout_process.php">Logout</a>
    <?php endif; ?>
</div>
<div id="cart_msg"></div>
