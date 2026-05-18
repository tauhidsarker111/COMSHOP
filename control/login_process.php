<?php
include '../model/mydb.php';
session_start();
$errorMsg="";
if(isset($_POST["login"])) {
$mydb = new MyDB();
$conn = $mydb->createConn();    
$result=$mydb->getUser($_REQUEST["uname"], $conn);

if($result->num_rows > 0){
    foreach($result as $row){
           $password=$row["password"];
          }
if(password_verify($_REQUEST["pass"], $password)){
$_SESSION["username"]=$_REQUEST["uname"];

    header("Location: ../view/profile.php");  
    }
    else{
    $errorMsg= "Invalid username or password";
    }
}
else{
    $errorMsg= "Invalid username or password";
}

   
}

?>
