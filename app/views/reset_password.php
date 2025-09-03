<?php
session_start();
$email = $_POST['email'];
$new_pass = $_POST['new_password'];

if(strlen($new_pass)<6){
    header("Location: index.php?msg=New password must be at least 6 characters");
    exit;
}

$found=false;
foreach($_SESSION['users'] as &$u){
    if($u['email']===$email){
        $u['password']=$new_pass;
        $found=true;
        break;
    }
}
if($found){
    header("Location: index.php?msg=Password reset successfully");
}else{
    header("Location: index.php?msg=Email not found");
}
exit;
?>
