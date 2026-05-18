<?php
include '../model/mydb.php';

$hasError = false;
if(isset($_POST["register"])) {
  if((empty($_REQUEST["uname"]))) {
    $hasError=true;
    echo "Username is required<br>";
}
else{
    echo "Username: " . $_POST["uname"] . "<br>";
}
if((empty($_REQUEST["myemail"]))) {
     $hasError=true;
 echo "Email is required";
}
else{
  echo "Email: " . $_POST["myemail"] . "<br>";
}
if(empty($_FILES["myfile"]["name"])){
    $hasError=true;
    echo "File is required";
}
else{
    echo "File: " . $_FILES["myfile"]["name"] . "<br>";
    if(move_uploaded_file($_FILES["myfile"]["tmp_name"], "../uploads/" . $_FILES["myfile"]["name"])){
        echo "File uploaded successfully.<br>";
    } else {
        echo "Error uploading file.<br>";
    }
}


if($hasError==false){

$mydb = new MyDB();
$conn = $mydb->createConn();
$result=$mydb->createUser($_REQUEST["uname"], $_REQUEST["myemail"], password_hash($_REQUEST["pass"], PASSWORD_DEFAULT), $_FILES["myfile"]["name"], $conn);
if($result===true){
     header("Location: ../view/submit_registration.php");
}
else{
    echo "Error: " . $conn->error;
}
$mydb->closeConn($conn);
}
}
?>