<?php
session_start();
require_once("../model/userModel.php");

// ✅ Session check
if(!isset($_SESSION['username']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}

$users = loadUsers();
$currentUser = null;
foreach($users as $u){
    if($u['email'] === $_SESSION['email']){
        $currentUser = $u;
        break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>My Profile</h2>
    <form method="post" action="../controller/updateProfile.php">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $currentUser['name']; ?>"><br>

        <label>Email:</label><br>
        <input type="text" value="<?php echo $currentUser['email']; ?>" disabled><br>

        <label>New Password:</label><br>
        <input type="password" name="password" placeholder="Enter new password"><br>

        <button type="submit">Update Profile</button>
    </form>

   
    <?php if($_SESSION['role']=="admin"){ ?>
        <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    <?php } else { ?>
        <a href="user_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    <?php } ?>
</div>
</body>
</html>
