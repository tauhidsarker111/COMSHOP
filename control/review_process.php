<?php
include '../model/mydb.php';
session_start();

// Must be logged in
if(!isset($_SESSION["username"])){
    echo json_encode(array("success"=>false, "message"=>"Not logged in"));
    exit;
}

$mydb = new MyDB();
$conn = $mydb->createConn();
$action = $_GET["action"];

// ── ADD review (POST form submit) ────────────────────────────────
if($action == "add"){
    $product_id = $_POST["product_id"];
    $comment    = $_POST["comment"];
    $username   = $_SESSION["username"];

    if(empty($comment)){
        $_SESSION["review_error"] = "Comment cannot be empty.";
        header("Location: ../view/products.php?id=" . $product_id);
        exit;
    }

    $result = $mydb->createReview($product_id, $username, $comment, $conn);
    if($result === true){
        header("Location: ../view/products.php?id=" . $product_id);
    } else {
        echo "Error: " . $conn->error;
    }
}

// ── DELETE review (AJAX GET) ─────────────────────────────────────
if($action == "delete"){
    $review_id = $_GET["review_id"];
    $username  = $_SESSION["username"];

    // Admin can delete any; customer can delete only their own
    $mydb2 = new MyDB();
    $conn2 = $mydb2->createConn();
    $userResult = $mydb2->getUser($username, $conn2);
    $role = "customer";
    if($userResult->num_rows > 0){
        foreach($userResult as $row){
            $role = $row["role"];
        }
    }

    if($role == "admin"){
        $sql = "DELETE FROM reviews WHERE id='$review_id'";
        $conn->query($sql);
    } else {
        $result = $mydb->deleteReview($review_id, $username, $conn);
    }

    echo json_encode(array("success"=>true, "message"=>"Review deleted"));
}

$mydb->closeConn($conn);
?>
