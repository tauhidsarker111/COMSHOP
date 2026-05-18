<?php
include '../control/editprofile_process.php';
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
</html>
