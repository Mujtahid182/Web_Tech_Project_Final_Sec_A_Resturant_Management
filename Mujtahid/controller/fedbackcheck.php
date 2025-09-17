<?php

require_once('../model/feedbackModel.php');
$data = isset($_POST['feedback']) ? $_POST['feedback'] : '';


$feedbackObj = json_decode($data);

$feedback = $feedbackObj->feedbackText;

if ($feedback === '') {
    echo "Feedback cannot be empty";
    exit;
} elseif (strlen($feedback) < 5) {
    echo 'Feedback must be at least 5 characters long';
    exit;
} elseif (strlen($feedback) > 1000) {
    echo 'Feedback is too long (maximum 1000 characters';
    exit;
} else {
    $success = addFeedback($feedback);
    if ($success === true) {
        $allFeedbacks = getAllFeedback();//associative array hishebe ashche
        echo json_encode($allFeedbacks);
    }
}
