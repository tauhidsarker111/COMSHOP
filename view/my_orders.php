<?php
include '../control/profile_process.php';
$role = "customer";
?>
<html>
<head>
    <title>My Orders – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">
    <div class="section-title">📦 My Orders</div>

    <?php
    $mydb6 = new MyDB(); $conn6 = $mydb6->createConn();
    $orders = $mydb6->getOrdersByUser($_SESSION["username"], $conn6);
    if($orders->num_rows > 0):
        foreach($orders as $ord):
    ?>
    <div class="order-card">
        <div class="order-header">
            <div>
                <strong>Order #<?php echo $ord["id"]; ?></strong>
                <span style="color:#888;font-size:12px;margin-left:10px;"><?php echo date("M d, Y H:i", strtotime($ord["created_at"])); ?></span>
            </div>
            <div style="display:flex;align-items:center;gap:12px;">
                <span><?php echo $ord["payment_method"]; ?></span>
                <span class="badge badge-<?php echo $ord["status"]; ?>"><?php echo ucfirst($ord["status"]); ?></span>
                <strong style="color:#e94560;">$<?php echo number_format($ord["total_amount"],2); ?></strong>
            </div>
        </div>
        <div class="order-body">
            <?php
            $mydb7 = new MyDB(); $conn7 = $mydb7->createConn();
            $items = $mydb7->getOrderItems($ord["id"], $conn7);
            if($items->num_rows > 0): ?>
            <ul>
            <?php foreach($items as $item): ?>
                <li>
                    <strong><?php echo htmlspecialchars($item["name"]); ?></strong>
                    &nbsp;×<?php echo $item["quantity"]; ?>
                    &nbsp;— $<?php echo number_format($item["price"] * $item["quantity"], 2); ?>
                    <span style="color:#888;font-size:11px;">(<?php echo htmlspecialchars($item["brand"]); ?> / <?php echo htmlspecialchars($item["category"]); ?>)</span>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php endif;
            $mydb7->closeConn($conn7); ?>
        </div>
    </div>
    <?php
        endforeach;
    else:
        echo "<div class='card' style='text-align:center;padding:40px;'>
                <p style='font-size:48px;'>📭</p>
                <p style='color:#888;font-size:16px;'>No orders yet.</p>
                <a href='../view/products.php' class='btn btn-primary' style='margin-top:14px;'>Start Shopping</a>
              </div>";
    endif;
    $mydb6->closeConn($conn6);
    ?>
</div>
</body>
</html>
