<?php
session_start();
require_once("../model/userModel.php");

$name = trim($_POST['name']);
$password = trim($_POST['password']);

$users = loadUsers();

foreach($users as &$u){
    if($u['email'] === $_SESSION['email']){
        $u['name'] = $name;
        if($password !== ""){
            $u['password'] = $password;
        }
        saveUsers($users);

        // Update session
        $_SESSION['username'] = $name;
        break;
    }
}

// Redirect back with success
if($_SESSION['role']=="admin"){
    header("Location: ../view/dashboard.php?success=profile");
} else {
    header("Location: ../view/user_dashboard.php?success=profile");
}
exit();
?>
