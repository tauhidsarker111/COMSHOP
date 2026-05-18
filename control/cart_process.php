<?php
include '../model/mydb.php';
session_start();

// Must be logged in
if(!isset($_SESSION["username"])){
    echo json_encode(array("message"=>"Not logged in", "cart_count"=>0));
    exit;
}

// Start cart as empty array in session if not set
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = array();
}

$mydb = new MyDB();
$conn = $mydb->createConn();
$action = $_GET["action"];

// ── ADD to cart ──────────────────────────────────────────────────
if($action == "add"){
    $product_id = $_GET["product_id"];

    // Get product info
    $result = $mydb->getProductById($product_id, $conn);
    if($result->num_rows > 0){
        foreach($result as $row){
            $name  = $row["name"];
            $price = $row["price"];
        }

        // If already in cart, increase qty; else add new entry
        if(isset($_SESSION["cart"][$product_id])){
            $_SESSION["cart"][$product_id]["quantity"]++;
        } else {
            $_SESSION["cart"][$product_id] = array(
                "product_id" => $product_id,
                "name"       => $name,
                "price"      => $price,
                "quantity"   => 1
            );
        }
        $cart_count = array_sum(array_column($_SESSION["cart"], "quantity"));
        echo json_encode(array(
            "message"    => $name . " added to cart!",
            "cart_count" => $cart_count
        ));
    } else {
        echo json_encode(array("message"=>"Product not found", "cart_count"=>0));
    }
}

// ── REMOVE from cart ─────────────────────────────────────────────
if($action == "remove"){
    $product_id = $_GET["product_id"];
    if(isset($_SESSION["cart"][$product_id])){
        unset($_SESSION["cart"][$product_id]);
    }
    $cart_count = array_sum(array_column($_SESSION["cart"], "quantity"));
    $total = 0;
    foreach($_SESSION["cart"] as $item){
        $total += $item["price"] * $item["quantity"];
    }
    echo json_encode(array(
        "message"    => "Item removed.",
        "cart_count" => $cart_count,
        "total"      => number_format($total, 2)
    ));
}

$mydb->closeConn($conn);
?>
