<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    if(!$username || !$email || !$password){
        header("Location: index.php?msg=All fields are required");
        exit;
    }

    if(strlen($password)<6){
        header("Location: index.php?msg=Password must be at least 6 characters");
        exit;
    }

    foreach($_SESSION['users'] as $user){
        if($user['email']===$email){
            header("Location: index.php?msg=This email is already registered");
            exit;
        }
    }

    $_SESSION['users'][] = ["username"=>$username,"email"=>$email,"password"=>$password,"role"=>$role];
    header("Location: index.php?msg=Account created successfully! Please login.");
    exit;
}
?>
