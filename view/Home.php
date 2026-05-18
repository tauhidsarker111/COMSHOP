<?php

setcookie("user", "1", time() + (10), "/"); // 86400 = 1 day

if(isset($_COOKIE["user"])){
    echo "<h1>Welcome back!<h1>";
} else {
    echo "<h1>Welcome new user!<h1>";
}

$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
echo $car["model"];

foreach ($car as $x => $y) {
 echo "$x: $y <br>";
}

?>



<html>
<head>
    <title>Home</title>
<link rel="stylesheet" type="text/css" href="../css/mystyle.css" />
</head>
<body>
   
    <h1>Home</h1>
   <?php

echo "<h1>Hello World</h1>";
?>
 
    <p>Hello</p>
    <p id="myp">World</p>
    
     <p id="myp2">World</p>
     <button class="signup btnshape" onclick="myfunc()">Sign Up</button>
     <button class="btnshape signin">Sign In</button>
 <script src="../js/myscript.js"></script>
   
</body>
</html>