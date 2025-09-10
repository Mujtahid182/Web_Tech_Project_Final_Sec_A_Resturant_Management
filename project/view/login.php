<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function validateLogin(){
            let email = document.forms["loginForm"]["email"].value;
            let pass = document.forms["loginForm"]["password"].value;
            if(email === "" || pass === ""){
                alert("Email and password required");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($_GET['error']) && $_GET['error']=="invalid") echo "<p class='error'>Invalid credentials!</p>"; ?>
        <?php if(isset($_GET['success']) && $_GET['success']=="registered") echo "<p class='success'>Registration successful! Please login.</p>"; ?>
        <form name="loginForm" method="post" action="../controller/loginCheck.php" onsubmit="return validateLogin();">
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">Login</button>
        </form>
        <p><a href="register.php">Register</a> | <a href="reset_password.php">Reset Password</a></p>
    </div>
    <script src="loginValidation.js"></script>
</body>
</html>
