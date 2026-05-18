<?php
include '../control/login_process.php';
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form action="" method="post">
           
            <label for="uname">Username:</label>
            <input type="text" id="uname" name="uname" ><br><br>

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" ><br><br>

            <input type="submit" name="login" value="Login">
        </form>
         <?php echo $errorMsg; ?>
    </body>
</html>