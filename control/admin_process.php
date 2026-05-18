<?php
include '../model/mydb.php';
session_start();
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
    header("Location: ../view/admin.php");
    exit;
}

// ── Delete review ────────────────────────────────────────────────
if($action == "delete_review"){
    $review_id = intval($_GET["review_id"]);
    $mydb->deleteReviewAdmin($review_id, $conn);
    header("Location: ../view/admin.php");
    exit;
}

$mydb->closeConn($conn);
?>
