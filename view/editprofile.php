<?php
include '../control/editprofile_process.php';
<<<<<<< HEAD
$mydbR = new MyDB(); $connR = $mydbR->createConn();
$rRes  = $mydbR->getUser($_SESSION["username"], $connR);
$role  = "customer";
if($rRes->num_rows > 0){ foreach($rRes as $rr){ $role=$rr["role"]; } }
$mydbR->closeConn($connR);
?>
<html>
<head>
    <title>Edit Profile – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="page-wrap" style="max-width:500px;">
    <div class="section-title">✏️ Edit Profile</div>
    <div class="card">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Username</label>
                <input type="text" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" readonly style="max-width:100%;background:#eee;">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="myemail" value="<?php echo htmlspecialchars($email); ?>" required style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="pass" placeholder="Leave blank to keep current" style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <img src="../uploads/<?php echo htmlspecialchars($file); ?>" width="80" height="80"
                     style="border-radius:50%;display:block;margin-bottom:8px;border:3px solid #667eea;"
                     onerror="this.src='../uploads/default.png'">
                <input type="file" name="myfile" accept="image/*">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
            <a href="../view/profile.php" class="btn btn-dark" style="margin-left:8px;">Cancel</a>
        </form>
    </div>
</div>
<script src="../js/myscript.js"></script>
</body>
=======
?>

<html>

    <head>
        <title>Edit Profile</title>
    </head>
    <body>
        <h2>Edit Profile</h2>
        <p>Edit your profile information here.</p>

        <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="uname" value="<?php echo $_SESSION["username"]; ?>" ><br><br>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="myemail" value="<?php echo $email; ?>  "><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="pass" value="<?php echo $password; ?>"><br><br>
        <label for="file">Upload File:</label>
        <img src="../uploads/<?php echo $file; ?>" alt="Profile Image" width="200" height="200">

        <input type="file" id="file" name="myfile"><br><br>
        
        <input type="submit" name="update" value="Update">
</form>
    </body>
>>>>>>> 2f2e17fef05c890d6197996e3e9d7f35784b4a61
</html>
