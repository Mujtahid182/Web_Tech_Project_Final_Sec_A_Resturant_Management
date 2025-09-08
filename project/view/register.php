<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function validateRegister(){
            let name = document.forms["regForm"]["name"].value;
            let email = document.forms["regForm"]["email"].value;
            let pass = document.forms["regForm"]["password"].value;
            if(name===""||email===""||pass===""){
                alert("All fields required!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if(isset($_GET['error']) && $_GET['error']=="exists") echo "<p class='error'>Email already exists!</p>"; ?>
        <form name="regForm" method="post" action="../controller/registerCheck.php" onsubmit="return validateRegister();">
            <input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">Register</button>
        </form>
        <p><a href="login.php">Back to Login</a></p>
    </div>
</body>
</html>
