<?php
require_once("../model/userModel.php");

$email = trim($_POST['email']);
$newPass = trim($_POST['new_password']);

if(resetPassword($email, $newPass)){
    header("Location: ../view/login.php?success=reset");
} else {
    header("Location: ../view/reset_password.php?error=notfound");
}
exit();
?>
