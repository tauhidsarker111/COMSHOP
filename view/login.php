<?php
include '../control/login_process.php';
?>
<html>
<head>
    <title>Login – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <style>
        .login-wrap { max-width:400px; margin:80px auto; }
        .login-brand { text-align:center; font-size:32px; font-weight:700; color:#1a1a2e; margin-bottom:6px; }
        .login-sub   { text-align:center; color:#888; margin-bottom:28px; font-size:14px; }
    </style>
</head>
<body style="background:#f0f2f5;">
<div class="login-wrap">
    <div class="login-brand">💻 PC Shop</div>
    <div class="login-sub">Sign in to your account</div>
    <div class="card">
        <?php if(isset($errorMsg) && $errorMsg != ""): ?>
        <div class="alert alert-error"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="uname" placeholder="Enter username" required style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" placeholder="Enter password" required style="max-width:100%;">
            </div>
            <button type="submit" name="login" class="btn btn-primary" style="width:100%;padding:12px;">Sign In</button>
        </form>
        <p style="text-align:center;margin-top:16px;font-size:13px;color:#888;">
            Don't have an account? <a href="../view/Registration.php" style="color:#667eea;">Register here</a>
        </p>
    </div>
</div>
</body>
</html>
