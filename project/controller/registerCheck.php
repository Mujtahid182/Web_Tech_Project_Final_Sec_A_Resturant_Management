<?php
require_once("../model/userModel.php");

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

if($name === "" || $email === "" || $password === ""){
    header("Location: ../view/register.php?error=empty");
    exit();
}

if(registerUser($name, $email, $password)){
    header("Location: ../view/login.php?success=registered");
} else {
    header("Location: ../view/register.php?error=exists");
}
exit();
?>
