<?php
session_start();
if(!isset($_SESSION['currentUser'])){ header("Location: index.php?msg=Please login"); exit; }

$old_email = $_POST['old_email'];
$username = trim($_POST['username']);
$email = trim($_POST['email']);

if(!$username || !$email){
    header("Location: dashboard.php?msg=All fields required");
    exit;
}

// Update user
foreach($_SESSION['users'] as &$u){
    if($u['email']===$old_email){
        $u['username']=$username;
        $u['email']=$email;
        $_SESSION['currentUser']=$u;
        break;
    }
}
header("Location: dashboard.php?msg=Profile updated successfully");
exit;
?>
