<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="post" action="../controller/resetPasswordCheck.php">
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="new_password" placeholder="New Password"><br>
            <button type="submit">Reset</button>
        </form>
        <p><a href="login.php">Back to Login</a></p>
    </div>
    <script src="loginValidation.js"></script>
</body>
</html>
