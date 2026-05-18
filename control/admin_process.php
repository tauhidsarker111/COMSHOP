<?php
include '../model/mydb.php';
session_start();

// Must be logged in as admin
if(!isset($_SESSION["username"])){
    header("Location: ../view/login.php");
    exit;
}

$mydb = new MyDB();
$conn = $mydb->createConn();

// Check role
$result = $mydb->getUser($_SESSION["username"], $conn);
$role = "customer";
if($result->num_rows > 0){
    foreach($result as $row){
        $role = $row["role"];
    }
}
if($role != "admin"){
    echo "Access denied. Admins only.";
    exit;
}

$action = isset($_GET["action"]) ? $_GET["action"] : "";

// ── DELETE customer ──────────────────────────────────────────────
if($action == "delete_user"){
    $username = $_GET["username"];
    $mydb->deleteUser($username, $conn);
    header("Location: ../view/admin.php");
    exit;
}

// ── DELETE review ────────────────────────────────────────────────
if($action == "delete_review"){
    $review_id = $_GET["review_id"];
    $mydb->deleteReviewAdmin($review_id, $conn);
    header("Location: ../view/admin.php");
    exit;
}

$mydb->closeConn($conn);
?>
