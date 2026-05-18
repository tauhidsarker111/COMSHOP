<?php
include '../control/registration_process.php';
?>

<!DOCTYPE html> 
<html>

<body>
    <h1>Registration</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="uname"><br><br>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="myemail"><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="pass"><br><br>
        <label for="file">Upload File:</label>
        <input type="file" id="file" name="myfile"><br><br>
        
        <input type="submit" name="register" value="Register">
</form>
</body>
</html>