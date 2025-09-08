<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['role']!="user"){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Welcome User, <?php echo $_SESSION['username']; ?>!</h2>

    <?php if(isset($_GET['success']) && $_GET['success']=="profile"){ ?>
        <p class="success">Profile updated successfully!</p>
    <?php } ?>

    <p><a href="profile.php">My Profile</a> | <a href="contact.php">Contact Support</a> | <a href="../controller/logout.php">Logout</a>
   
</div>
</body>
</html>

