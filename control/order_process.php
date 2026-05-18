<?php
include '../model/mydb.php';
session_start();

// Must be logged in
if(!isset($_SESSION["username"])){
    header("Location: ../view/login.php");
    exit;
}

$mydb = new MyDB();
$conn = $mydb->createConn();

if(isset($_POST["place_order"])){
    $username       = $_SESSION["username"];
    $payment_method = $_POST["payment_method"];

    // Validate cart not empty
    if(empty($_SESSION["cart"])){
        $_SESSION["order_error"] = "Your cart is empty.";
        header("Location: ../view/cart.php");
        exit;
    }

    // Validate payment method
    if(empty($payment_method)){
        $_SESSION["order_error"] = "Please select a payment method.";
        header("Location: ../view/checkout.php");
        exit;
    }

    // Calculate total
    $total = 0;
    foreach($_SESSION["cart"] as $item){
        $total += $item["price"] * $item["quantity"];
    }

    // Insert order header
    $result = $mydb->createOrder($username, $payment_method, $total, $conn);
    if($result === true){
        $order_id = $mydb->getLastOrderId($conn);

        // Insert each cart item into order_items
        foreach($_SESSION["cart"] as $item){
            $mydb->createOrderItem(
                $order_id,
                $item["product_id"],
                $item["quantity"],
                $item["price"],
                $conn
            );
        }

        // Clear the cart
        $_SESSION["cart"] = array();
        $_SESSION["order_success"] = $order_id;

        header("Location: ../view/order_confirmation.php");
    } else {
        echo "Error placing order: " . $conn->error;
    }
}

$mydb->closeConn($conn);
?>
