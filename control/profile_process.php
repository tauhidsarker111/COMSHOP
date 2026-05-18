<?php 
include '../model/mydb.php';

session_start();
if(!isset($_SESSION["username"])){
  header("Location: ../view/login.php");
} 

$mydb = new MyDB();
$conn = $mydb->createConn();
$result=$mydb->getUser($_SESSION["username"], $conn);
if($result->num_rows > 0){
    foreach($result as $row){
           $email=$row["email"];
           $file=$row["file"];
          }
}


if(isset($_GET["username"])) {
    $username = $_GET['username'];

    $mydb2 = new MyDB();
    $conn2 = $mydb2->createConn();
    $result2 = $mydb2->searchUser($username, $conn2);
    if($result2->num_rows > 0){
        foreach($result2 as $row){
         echo json_encode($row);

        }
    } else {
        echo "No user found with the username: " . $username;
    }
$mydb2->closeConn($conn);
}
?>