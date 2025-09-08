<?php
session_start();
require_once("../model/userModel.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if($email === "" || $password === ""){
    header("Location: ../view/login.php?error=empty");
    exit();
}

$user = login($email, $password);
if($user){
    $_SESSION['username'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    if($user['role'] === "admin"){
        header("Location: ../view/dashboard.php");
    } else {
        header("Location: ../view/user_dashboard.php");
    }
} else {
    header("Location: ../view/login.php?error=invalid");
}
exit();
?>

