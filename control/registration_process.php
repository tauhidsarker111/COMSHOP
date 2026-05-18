<?php
include '../model/mydb.php';

$hasError = false;
<<<<<<< HEAD
if(isset($_POST["register"])){
    if(empty($_REQUEST["uname"])){
        $hasError = true;
        echo "<div class='alert alert-error'>Username is required.</div>";
    }
    if(empty($_REQUEST["myemail"])){
        $hasError = true;
        echo "<div class='alert alert-error'>Email is required.</div>";
    }
    if(empty($_FILES["myfile"]["name"])){
        $hasError = true;
        echo "<div class='alert alert-error'>Profile image is required.</div>";
    } else {
        $uploadDir  = "../uploads/";
        $uploadFile = $uploadDir . basename($_FILES["myfile"]["name"]);
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $uploadFile);
    }

    if(!$hasError){
        $mydb = new MyDB();
        $conn = $mydb->createConn();
        $result = $mydb->createUser(
            $_REQUEST["uname"],
            $_REQUEST["myemail"],
            password_hash($_REQUEST["pass"], PASSWORD_DEFAULT),
            basename($_FILES["myfile"]["name"]),
            $conn
        );
        if($result === true){
            header("Location: ../view/submit_registration.php");
            exit;
        } else {
            echo "<div class='alert alert-error'>Error: Username may already exist.</div>";
        }
        $mydb->closeConn($conn);
    }
}
?>
=======
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
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
