<?php
include '../control/profile_process.php';
$mydbR = new MyDB(); $connR = $mydbR->createConn();
$rRes  = $mydbR->getUser($_SESSION["username"], $connR);
$role  = "customer";
if($rRes->num_rows > 0){ foreach($rRes as $rr){ $role = $rr["role"]; } }
$mydbR->closeConn($connR);
?>
<html>
<head>
    <title>Products – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="page-wrap">

<?php
$mydb3 = new MyDB();
$conn3 = $mydb3->createConn();

// ── Single product detail + reviews ─────────────────────────────
if(isset($_GET["id"])){
    $product_id = intval($_GET["id"]);
    $prod = $mydb3->getProductById($product_id, $conn3);
    if($prod->num_rows > 0):
        foreach($prod as $p):
?>
    <!-- Back link -->
    <a href="../view/products.php" class="btn btn-dark btn-sm" style="margin-bottom:18px;">← Back to Products</a>

    <!-- Product detail card -->
    <div class="product-detail">
        <span class="badge" style="background:#eef0ff;color:#667eea;margin-bottom:10px;display:inline-block;">
            <?php echo htmlspecialchars($p["category"]); ?>
        </span>
        <h2><?php echo htmlspecialchars($p["name"]); ?></h2>
        <p class="meta">Brand: <strong><?php echo htmlspecialchars($p["brand"]); ?></strong></p>
        <p class="description"><?php echo htmlspecialchars($p["description"]); ?></p>

        <table class="spec-table">
            <tr><td>Brand</td>    <td><?php echo htmlspecialchars($p["brand"]); ?></td></tr>
            <tr><td>Category</td> <td><?php echo htmlspecialchars($p["category"]); ?></td></tr>
            <tr><td>Price</td>    <td><strong style="color:#e94560;font-size:18px;">$<?php echo number_format($p["price"],2); ?></strong></td></tr>
            <tr><td>Stock</td>    <td><?php echo $p["stock"]>0 ? "<span style='color:#27ae60;font-weight:600;'>".$p["stock"]." units available</span>" : "<span class='error'>Out of stock</span>"; ?></td></tr>
        </table>

        <?php if($p["stock"] > 0): ?>
        <button class="btn btn-primary" onclick="addToCart(<?php echo $p["id"]; ?>)">🛒 Add to Cart</button>
        <a href="../view/cart.php" class="btn btn-success">View Cart</a>
        <?php else: ?>
        <button class="btn btn-dark" disabled>Out of Stock</button>
        <?php endif; ?>
    </div>

    <!-- Reviews section -->
    <div class="section-title">💬 Customer Reviews</div>

    <?php
    if(isset($_SESSION["review_error"])){
        echo "<div class='alert alert-error'>" . $_SESSION["review_error"] . "</div>";
        unset($_SESSION["review_error"]);
    }
    $mydb4 = new MyDB(); $conn4 = $mydb4->createConn();
    $reviews = $mydb4->getReviewsByProduct($product_id, $conn4);
    if($reviews->num_rows > 0):
        foreach($reviews as $rev):
    ?>
    <div class="review-box" id="review_<?php echo $rev["id"]; ?>">
        <span class="reviewer">👤 <?php echo htmlspecialchars($rev["username"]); ?></span>
        <span class="rev-date"><?php echo date("M d, Y H:i", strtotime($rev["created_at"])); ?></span>
        <p class="rev-text"><?php echo htmlspecialchars($rev["comment"]); ?></p>
        <?php if($_SESSION["username"] == $rev["username"] || $role == "admin"): ?>
        <button class="btn btn-danger btn-sm" onclick="deleteReview(<?php echo $rev["id"]; ?>)">🗑 Delete</button>
        <?php endif; ?>
    </div>
    <?php
        endforeach;
    else:
        echo "<p style='color:#888;'>No reviews yet. Be the first to review!</p>";
    endif;
    ?>

    <?php if($role == "customer"): ?>
    <!-- Write a review -->
    <div class="card" style="margin-top:20px;">
        <h3>✍️ Write a Review</h3>
        <form action="../control/review_process.php?action=add" method="post">
            <input type="hidden" name="product_id" value="<?php echo $p["id"]; ?>">
            <div class="form-group">
                <textarea name="comment" placeholder="Share your experience with this product…" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
    <?php endif; ?>

<?php
        endforeach;
    endif;

// ── All products list ────────────────────────────────────────────
} else {
    echo "<div class='section-title'>🖥️ All Products</div>";

    $products = $mydb3->getAllProducts($conn3);
    $lastCat  = "";

    if($products->num_rows > 0):
        // Group by category
        $all = [];
        foreach($products as $p){ $all[] = $p; }

        // Sort by category
        usort($all, function($a,$b){ return strcmp($a["category"],$b["category"]); });

        $currentCat = "";
        $gridOpen   = false;

        foreach($all as $p):
            if($p["category"] != $currentCat){
                if($gridOpen) echo "</div>"; // close grid
                echo "<h2 style='margin:28px 0 12px;font-size:17px;color:#555;border-bottom:2px solid #eee;padding-bottom:6px;'>📂 " . htmlspecialchars($p["category"]) . "</h2>";
                echo "<div class='products-grid'>";
                $gridOpen   = true;
                $currentCat = $p["category"];
            }
?>
    <div class="product-card">
        <span class="cat-badge"><?php echo htmlspecialchars($p["category"]); ?></span>
        <h3><?php echo htmlspecialchars($p["name"]); ?></h3>
        <p class="brand">by <?php echo htmlspecialchars($p["brand"]); ?></p>
        <p class="desc"><?php echo htmlspecialchars(substr($p["description"],0,120)) . (strlen($p["description"])>120?"…":""); ?></p>
        <div class="specs">
            <span>📦 Stock: <?php echo $p["stock"]; ?></span>
        </div>
        <div class="price">$<?php echo number_format($p["price"],2); ?></div>
        <p class="stock <?php echo $p["stock"]>0?"":"out"; ?>">
            <?php echo $p["stock"]>0 ? "✅ In Stock" : "❌ Out of Stock"; ?>
        </p>
        <div class="actions">
            <a href="../view/products.php?id=<?php echo $p["id"]; ?>" class="btn btn-outline btn-sm">🔍 Details</a>
            <?php if($p["stock"]>0): ?>
            <button class="btn btn-primary btn-sm" onclick="addToCart(<?php echo $p["id"]; ?>)">🛒 Add</button>
            <?php endif; ?>
        </div>
    </div>
<?php
        endforeach;
        if($gridOpen) echo "</div>";
    else
        echo "<p style='color:#888;'>No products available.</p>";
    endif;
}

$mydb3->closeConn($conn3);
?>
</div>
<script src="../js/myscript.js"></script>
</body>
</html>
