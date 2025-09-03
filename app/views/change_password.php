<?php
session_start();
if(!isset($_SESSION['currentUser'])){ header("Location: index.php?msg=Please login"); exit; }

$old_pass = $_POST['old_password'];
$new_pass = $_POST['new_password'];

if($old_pass!==$_SESSION['currentUser']['password']){
    header("Location: dashboard.php?msg=Current password incorrect");
    exit;
}
if(strlen($new_pass)<6){
    header("Location: dashboard.php?msg=New password must be at least 6 characters");
    exit;
}

// Update password
foreach($_SESSION['users'] as &$u){
    if($u['email']===$_SESSION['currentUser']['email']){
        $u['password']=$new_pass;
        $_SESSION['currentUser']=$u;
        break;
    }
}
header("Location: dashboard.php?msg=Password changed successfully");
exit;
?>
