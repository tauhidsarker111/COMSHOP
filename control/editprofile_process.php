<?php
include '../model/mydb.php';
session_start();

$mydb = new MyDB();
$conn = $mydb->createConn();
$result=$mydb->getUser($_SESSION["username"], $conn);
if($result->num_rows > 0){
    foreach($result as $row){

           $email=$row["email"];
           $password=$row["password"];
           $file=$row["file"];
          }
}
if(isset($_POST["update"])) {
    $newEmail = $_REQUEST["myemail"];
    $newPassword = password_hash($_REQUEST["pass"], PASSWORD_DEFAULT);
    $newFile = $_FILES["myfile"]["name"];
    if(empty($newFile)){
        $newFile = $file; // Keep the old file if no new file is uploaded
    }
    if(move_uploaded_file($_FILES["myfile"]["tmp_name"], "../uploads/" . $_FILES["myfile"]["name"])){
        echo "File uploaded successfully.<br>";
    } else {
        echo "Error uploading file.<br>";
    }
    
    $updateResult = $mydb->updateUser($_SESSION["username"], $newEmail, $newPassword, $newFile, $conn);
    
    if($updateResult === true){
        header("Location: ../view/profile.php");
    } else {
        echo "Error: " . $conn->error;
    }
}





?>