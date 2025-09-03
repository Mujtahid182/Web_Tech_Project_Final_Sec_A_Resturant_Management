<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    foreach($_SESSION['users'] as $user){
        if($user['email']===$email && $user['password']===$password){
            $_SESSION['currentUser']=$user;
            header("Location: dashboard.php");
            exit;
        }
    }
    header("Location: index.php?msg=Invalid email or password");
    exit;
}
?>
