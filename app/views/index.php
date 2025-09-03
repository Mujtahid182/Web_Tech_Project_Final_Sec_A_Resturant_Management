<?php
session_start();

// Initialize users array
if(!isset($_SESSION['users'])){
    $_SESSION['users'] = [
        ["username"=>"Admin User","email"=>"admin@example.com","password"=>"admin123","role"=>"admin"]
    ];
}

// Redirect logged-in user to dashboard
if(isset($_SESSION['currentUser'])){
    header("Location: dashboard.php");
    exit;
}

// Get messages
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restaurant Management System</title>
<style>
/* === Your previous CSS === */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 20px;
    color: #333;
}
.container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
h1, h2 {
    color: #2c3e50;
    text-align: center;
}
.page {
    padding: 20px;
}
.hidden {
    display: none;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
input[type="text"], input[type="email"], input[type="password"], textarea, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}
button {
    background-color: blueviolet;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    margin-top: 10px;
}
button:hover {
    background-color: #2980b9;
}
.alert {
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
}
.alert-error {
    background-color: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}
.alert-success {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}
.nav {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    flex-wrap: wrap;
}
.nav a {
    margin: 5px 10px;
    color: #3498db;
    text-decoration: none;}
.nav a:hover {
    text-decoration: underline;
    }
</style>
</head>
<body>
<div class="container">
<h1>Restaurant Management System</h1>

<?php if($msg): ?>
<div class="alert <?php echo strpos($msg,'successfully')!==false?'alert-success':'alert-error'; ?>">
    <?php echo htmlspecialchars($msg); ?>
</div>
<?php endif; ?>

<!-- Signup -->
<div id="signupPage" class="page">
<h2>Create Account</h2>
<form method="POST" action="register.php">
    <div class="form-group">
        <label for="s_username">Full Name</label>
        <input type="text" name="username" id="s_username" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="s_email">Email Address</label>
        <input type="email" name="email" id="s_email" placeholder="Enter your email">
    </div>
    <div class="form-group">
        <label for="s_password">Password</label>
        <input type="password" name="password" id="s_password" placeholder="Create a password (min. 6 characters)">
    </div>
    <div class="form-group">
        <label for="s_role">Account Type</label>
        <select name="role" id="s_role">
            <option value="member">Member</option>
            <option value="admin">Administrator</option>
        </select>
    </div>
    <button type="submit">Create Account</button>
</form>
<div class="nav">
    <a href="#loginPage" onclick="showLogin()">Already have an account? Login</a>
</div>
</div>

<!-- Login -->
<div id="loginPage" class="page hidden">
<h2>Login</h2>
<form method="POST" action="login.php">
    <div class="form-group">
        <label for="l_email">Email Address</label>
        <input type="email" name="email" id="l_email" placeholder="Enter your email">
    </div>
    <div class="form-group">
        <label for="l_password">Password</label>
        <input type="password" name="password" id="l_password" placeholder="Enter your password">
    </div>
    <button type="submit">Login</button>
</form>
<div class="nav">
    <a href="#signupPage" onclick="showSignup()">Create Account</a>
    <a href="#forgotPage" onclick="showForgot()">Forgot Password</a>
</div>
</div>

<!-- Forgot Password -->
<div id="forgotPage" class="page hidden">
<h2>Reset Password</h2>
<form method="POST" action="reset_password.php">
    <div class="form-group">
        <label for="f_email">Email Address</label>
        <input type="email" name="email" id="f_email" placeholder="Enter your email">
    </div>
    <div class="form-group">
        <label for="f_pass">New Password</label>
        <input type="password" name="new_password" id="f_pass" placeholder="Enter new password (min. 6 characters)">
    </div>
    <button type="submit">Reset Password</button>
</form>
<div class="nav">
    <a href="#loginPage" onclick="showLogin()">Back to Login</a>
</div>
</div>

</div>

<script>
function showSignup(){ 
    document.getElementById('signupPage').classList.remove('hidden'); document.getElementById('loginPage').classList.add('hidden');
    document.getElementById('forgotPage').classList.add('hidden'); 
    }
function showLogin(){ 
    document.getElementById('loginPage').classList.remove('hidden');
     document.getElementById('signupPage').classList.add('hidden');
      document.getElementById('forgotPage').classList.add('hidden');
     }
function showForgot(){ 
    document.getElementById('forgotPage').classList.remove('hidden'); 
    document.getElementById('signupPage').classList.add('hidden');
     document.getElementById('loginPage').classList.add('hidden'); 
     }
</script>
</body>
</html>
