<?php
include '../model/mydb.php';
session_start();
<<<<<<< HEAD
if(!isset($_SESSION["username"])){ header("Location: ../view/login.php"); exit; }

$mydb = new MyDB(); $conn = $mydb->createConn();
$rRes = $mydb->getUser($_SESSION["username"], $conn);
$role = "customer";
if($rRes->num_rows > 0){ foreach($rRes as $rr){ $role=$rr["role"]; } }
if($role != "admin"){ echo "Access denied."; exit; }

$action = isset($_GET["action"]) ? $_GET["action"] : "";

// ── CASCADE delete customer ──────────────────────────────────────
if($action == "delete_user"){
    $username = $_GET["username"];
    $mydb->deleteUserCascade($username, $conn);
=======

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
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
    header("Location: ../view/admin.php");
    exit;
}

<<<<<<< HEAD
// ── Delete review ────────────────────────────────────────────────
if($action == "delete_review"){
    $review_id = intval($_GET["review_id"]);
=======
// ── DELETE review ────────────────────────────────────────────────
if($action == "delete_review"){
    $review_id = $_GET["review_id"];
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
    $mydb->deleteReviewAdmin($review_id, $conn);
    header("Location: ../view/admin.php");
    exit;
}

$mydb->closeConn($conn);
?>
