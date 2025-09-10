<?php
session_start();

if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 2450;
}

$currentPoints = $_SESSION['points'];


$reward = $_POST['reward'] ;
$cost = (int)($_POST['cost'] );

if ($cost <= 0 || $reward === '') {
    header("Location: ../view/loyality.php?msg=Invalid_reward_request&type=error");
}

if ($currentPoints < $cost) {
    $msg = "Not enough points to redeem $reward.";
    header("Location: ../view/loyality.php?msg=$msg&type=error");
}

$_SESSION['points'] = $_SESSION['points']- $cost;
$msg = "Success! You redeemed: $reward";
header("Location: ../view/loyality.php?msg=$msg&type=success");


?>