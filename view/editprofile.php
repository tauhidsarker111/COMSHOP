<?php
include '../control/editprofile_process.php';
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
</html>
