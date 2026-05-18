<?php
include '../control/profile_process.php';
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
</body>
</html>
