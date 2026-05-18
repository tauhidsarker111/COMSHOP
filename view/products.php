<?php
include '../control/profile_process.php';
?>
<html>
<head>
    <title>Products</title>
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

<h1>Products</h1>
<p id="cart_msg" style="color:green; font-weight:bold;"></p>

<?php
$mydb3 = new MyDB();
$conn3 = $mydb3->createConn();
$products = $mydb3->getAllProducts($conn3);

// ── Show single product with reviews ────────────────────────────
if(isset($_GET["id"])){
    $product_id = $_GET["id"];
    $prod = $mydb3->getProductById($product_id, $conn3);
    if($prod->num_rows > 0){
        foreach($prod as $p){
?>
    <div class="card">
        <h2><?php echo $p["name"]; ?></h2>
        <p>Price: $<?php echo $p["price"]; ?></p>
        <p>Stock: <?php echo $p["stock"]; ?></p>
        <button class="btn btn-blue" onclick="addToCart(<?php echo $p["id"]; ?>, '<?php echo $p["name"]; ?>', <?php echo $p["price"]; ?>)">
            Add to Cart
        </button>
        <a href="../view/cart.php" class="btn btn-green">Go to Cart</a>
    </div>

    <hr>
    <h2>Reviews</h2>

    <?php
    // Show review error if any
    if(isset($_SESSION["review_error"])){
        echo "<p class='error'>" . $_SESSION["review_error"] . "</p>";
        unset($_SESSION["review_error"]);
    }

    // Show existing reviews
    $mydb4 = new MyDB();
    $conn4 = $mydb4->createConn();
    $reviews = $mydb4->getReviewsByProduct($product_id, $conn4);
    if($reviews->num_rows > 0){
        foreach($reviews as $rev){
    ?>
        <div class="review-box" id="review_<?php echo $rev["id"]; ?>">
            <strong><?php echo $rev["username"]; ?></strong>
            <small> — <?php echo $rev["created_at"]; ?></small>
            <p><?php echo $rev["comment"]; ?></p>
            <?php
            // Show delete button only if this is your review or you are admin
            if($_SESSION["username"] == $rev["username"]){
            ?>
            <button class="btn btn-red" onclick="deleteReview(<?php echo $rev["id"]; ?>)">Delete</button>
            <?php } ?>
        </div>
    <?php
        }
    } else {
        echo "<p>No reviews yet. Be the first!</p>";
    }
    ?>

    <!-- Add review form -->
    <div class="card">
        <h3>Write a Review</h3>
        <form action="../control/review_process.php?action=add" method="post">
            <input type="hidden" name="product_id" value="<?php echo $p["id"]; ?>">
            <textarea name="comment" placeholder="Write your comment here..."></textarea><br>
            <input type="submit" class="btn btn-blue" value="Submit Review">
        </form>
    </div>

<?php
        }
    }

// ── Show all products list ────────────────────────────────────────
} else {
    if($products->num_rows > 0){
        foreach($products as $p){
?>
    <div class="product-card">
        <h3><?php echo $p["name"]; ?></h3>
        <p>Price: $<?php echo $p["price"]; ?></p>
        <p>Stock: <?php echo $p["stock"]; ?></p>
        <a href="../view/products.php?id=<?php echo $p["id"]; ?>" class="btn btn-yellow">View & Review</a><br><br>
        <button class="btn btn-blue" onclick="addToCart(<?php echo $p["id"]; ?>, '<?php echo $p["name"]; ?>', <?php echo $p["price"]; ?>)">
            Add to Cart
        </button>
    </div>
<?php
        }
    } else {
        echo "<p>No products available.</p>";
    }
}

$mydb3->closeConn($conn3);
?>

<script src="../js/myscript.js"></script>
</body>
</html>
