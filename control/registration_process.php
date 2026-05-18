<?php
include '../model/mydb.php';

$hasError = false;
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
