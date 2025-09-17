<?php
require_once '../model/loyalityModel.php';

$data = $_POST['points'];
$loyaltyObj = json_decode($data);

$userid = $loyaltyObj->user_id;
$cost = $loyaltyObj->points;

if ($cost <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid reward amount']);
    exit;
}

if ($cost > 10000) {
    echo json_encode(['success' => false, 'message' => 'Not enough points to redeem this reward']);
    exit;
}

$success = redeemPoints($cost);

if ($success == true) {
    $newpoints = getCurrentPoints();
    echo json_encode(['success' => true, 'message' => 'You successfully redeemed the reward!', 'points' => $newpoints]);
} else {
    echo json_encode(['success' => false, 'message' => 'Not enough points to redeem this reward']);
}