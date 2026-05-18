<?php include '../control/registration_process.php'; ?>
<html>
<head>
    <title>Register – PC Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <style>
        .reg-wrap { max-width:440px; margin:60px auto; }
        .reg-brand { text-align:center; font-size:30px; font-weight:700; color:#1a1a2e; margin-bottom:4px; }
        .reg-sub   { text-align:center; color:#888; margin-bottom:24px; font-size:14px; }
    </style>
</head>
<body style="background:#f0f2f5;">
<div class="reg-wrap">
    <div class="reg-brand">💻 PC Shop</div>
    <div class="reg-sub">Create your account</div>
    <div class="card">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="uname" placeholder="Choose a username" required style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="myemail" placeholder="Your email address" required style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" placeholder="Choose a password" required style="max-width:100%;">
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="myfile" accept="image/*" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary" style="width:100%;padding:12px;">Create Account</button>
        </form>
        <p style="text-align:center;margin-top:16px;font-size:13px;color:#888;">
            Already have an account? <a href="../view/login.php" style="color:#667eea;">Sign in</a>
        </p>
    </div>
</div>
</body>
</html>
