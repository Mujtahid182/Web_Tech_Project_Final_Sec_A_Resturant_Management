<?php
function loadUsers() {
    $file = __DIR__ . '/../users.json';
    if(!file_exists($file)) {
        return [];
    }
    $data = file_get_contents($file);
    return json_decode($data, true);
}

function saveUsers($users) {
    $file = __DIR__ . '/../users.json';
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

function login($email, $password) {
    $users = loadUsers();
    foreach($users as $user){
        if($user['email'] === $email && $user['password'] === $password){
            return $user;
        }
    }
    return false;
}

function registerUser($name, $email, $password){
    $users = loadUsers();
    foreach($users as $u){
        if($u['email'] === $email){
            return false;
        }
    }
    $users[] = [
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "role" => "user"
    ];
    saveUsers($users);
    return true;
}

function resetPassword($email, $newPass){
    $users = loadUsers();
    foreach($users as &$user){
        if($user['email'] === $email){
            $user['password'] = $newPass;
            saveUsers($users);
            return true;
        }
    }
    return false;
}
?>

