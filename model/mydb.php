<?php
class MyDB {

    function createConn(){
$DBHOST = "localhost";
$DBUSER = "root";
$DBPASS = "";
$DBNAME = "wti";
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
return $conn;
<<<<<<< HEAD
    }

    // ── USERS ────────────────────────────────────────────────────
=======
    } 
    
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
    function createUser($username, $email, $password, $file, $conn){
$sql="INSERT INTO users (username, email, password, file) VALUES ('$username', '$email', '$password', '$file')";
return $conn->query($sql);
}

function getUser($username, $conn){
<<<<<<< HEAD
$sql="SELECT * FROM users WHERE username='$username'";
=======
$sql="SELECT * FROM users WHERE username='$username' ";
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
return $conn->query($sql);
}

function updateUser($username, $email, $password, $file, $conn){
$sql="UPDATE users SET email='$email', password='$password', file='$file' WHERE username='$username'";
return $conn->query($sql);
}

function searchUser($username, $conn){
<<<<<<< HEAD
$sql="SELECT * FROM users WHERE username='$username'";
return $conn->query($sql);
}

function getAllCustomers($conn){
$sql="SELECT id, username, email, file FROM users WHERE role='customer' ORDER BY id DESC";
return $conn->query($sql);
}

function deleteUserCascade($username, $conn){
    $conn->query("DELETE FROM reviews WHERE username='$username'");
    $conn->query("DELETE oi FROM order_items oi JOIN orders o ON oi.order_id=o.id WHERE o.username='$username'");
    $conn->query("DELETE FROM orders WHERE username='$username'");
    $sql="DELETE FROM users WHERE username='$username' AND role='customer'";
    return $conn->query($sql);
}

// ── REVIEWS ──────────────────────────────────────────────────────
=======
$sql="SELECT * FROM users WHERE username='$username' ";
return $conn->query($sql);
}

// ── TASK 4: REVIEWS ──────────────────────────────────────────────

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function createReview($product_id, $username, $comment, $conn){
$sql="INSERT INTO reviews (product_id, username, comment) VALUES ('$product_id', '$username', '$comment')";
return $conn->query($sql);
}

function getReviewsByProduct($product_id, $conn){
$sql="SELECT * FROM reviews WHERE product_id='$product_id' ORDER BY created_at DESC";
return $conn->query($sql);
}

function deleteReview($review_id, $username, $conn){
$sql="DELETE FROM reviews WHERE id='$review_id' AND username='$username'";
return $conn->query($sql);
}

<<<<<<< HEAD
function getAllReviews($conn){
$sql="SELECT r.*, p.name AS product_name FROM reviews r JOIN products p ON r.product_id=p.id ORDER BY r.created_at DESC";
return $conn->query($sql);
}

function getRecentReviews($limit, $conn){
$sql="SELECT r.*, p.name AS product_name FROM reviews r JOIN products p ON r.product_id=p.id ORDER BY r.created_at DESC LIMIT $limit";
return $conn->query($sql);
}

function deleteReviewAdmin($review_id, $conn){
$sql="DELETE FROM reviews WHERE id='$review_id'";
return $conn->query($sql);
}

// ── ORDERS ───────────────────────────────────────────────────────
=======
// ── TASK 4: ORDERS ───────────────────────────────────────────────

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function createOrder($username, $payment_method, $total_amount, $conn){
$sql="INSERT INTO orders (username, payment_method, total_amount, status) VALUES ('$username', '$payment_method', '$total_amount', 'pending')";
return $conn->query($sql);
}

function getLastOrderId($conn){
return $conn->insert_id;
}

function createOrderItem($order_id, $product_id, $quantity, $price, $conn){
$sql="INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
return $conn->query($sql);
}

function getOrdersByUser($username, $conn){
$sql="SELECT * FROM orders WHERE username='$username' ORDER BY created_at DESC";
return $conn->query($sql);
}

function getOrderItems($order_id, $conn){
<<<<<<< HEAD
$sql="SELECT oi.*, p.name, p.brand, p.category FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id='$order_id'";
return $conn->query($sql);
}

function getAllOrders($conn){
$sql="SELECT * FROM orders ORDER BY created_at DESC";
return $conn->query($sql);
}

function getRecentOrders($limit, $conn){
$sql="SELECT * FROM orders ORDER BY created_at DESC LIMIT $limit";
return $conn->query($sql);
}

// ── PRODUCTS ─────────────────────────────────────────────────────
function getAllProducts($conn){
$sql="SELECT * FROM products ORDER BY category, name";
=======
$sql="SELECT oi.*, p.name, p.price FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id='$order_id'";
return $conn->query($sql);
}

// ── TASK 4: ADMIN ────────────────────────────────────────────────

function getAllUsers($conn){
$sql="SELECT id, username, email, file FROM users ORDER BY id DESC";
return $conn->query($sql);
}

function deleteUser($username, $conn){
$sql="DELETE FROM users WHERE username='$username'";
return $conn->query($sql);
}

function getAllReviews($conn){
$sql="SELECT r.*, p.name AS product_name FROM reviews r JOIN products p ON r.product_id=p.id ORDER BY r.created_at DESC";
return $conn->query($sql);
}

function deleteReviewAdmin($review_id, $conn){
$sql="DELETE FROM reviews WHERE id='$review_id'";
return $conn->query($sql);
}

// ── TASK 4: PRODUCTS (needed for order/review pages) ─────────────

function getAllProducts($conn){
$sql="SELECT * FROM products ORDER BY id DESC";
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
return $conn->query($sql);
}

function getProductById($product_id, $conn){
$sql="SELECT * FROM products WHERE id='$product_id'";
return $conn->query($sql);
}

<<<<<<< HEAD
function createProduct($name, $brand, $category, $price, $stock, $description, $conn){
$sql="INSERT INTO products (name, brand, category, price, stock, description) VALUES ('$name', '$brand', '$category', '$price', '$stock', '$description')";
return $conn->query($sql);
}

=======
function createProduct($name, $price, $stock, $conn){
$sql="INSERT INTO products (name, price, stock) VALUES ('$name', '$price', '$stock')";
return $conn->query($sql);
}

// ── CART (session-based, no DB needed) ───────────────────────────

>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
function closeConn($conn){
$conn->close();
}

}
?>
