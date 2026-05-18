<?php
include '../model/mydb.php';
session_start();

<<<<<<< HEAD
if(!isset($_SESSION["username"])){ header("Location: ../view/login.php"); exit; }

$mydb = new MyDB();
$conn = $mydb->createConn();
$result = $mydb->getUser($_SESSION["username"], $conn);
$email = ""; $password = ""; $file = "";
if($result->num_rows > 0){
    foreach($result as $row){
        $email    = $row["email"];
        $password = $row["password"]; // current hashed password
        $file     = $row["file"];
    }
}

if(isset($_POST["update"])){
    $newEmail = $_REQUEST["myemail"];

    // Only change password if a new one was typed
    if(!empty($_REQUEST["pass"])){
        $newPassword = password_hash($_REQUEST["pass"], PASSWORD_DEFAULT);
    } else {
        $newPassword = $password; // keep existing hash
    }

    // Handle file upload
    $newFile = $file; // default: keep existing
    if(!empty($_FILES["myfile"]["name"])){
        $uploadDir  = "../uploads/";
        $uploadFile = $uploadDir . basename($_FILES["myfile"]["name"]);
        if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $uploadFile)){
            $newFile = basename($_FILES["myfile"]["name"]);
        }
    }

    $updateResult = $mydb->updateUser($_SESSION["username"], $newEmail, $newPassword, $newFile, $conn);
    if($updateResult === true){
        header("Location: ../view/profile.php");
        exit;
    } else {
        echo "<div class='alert alert-error'>Error updating profile: " . $conn->error . "</div>";
    }
}
$mydb->closeConn($conn);
?>
=======
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
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
