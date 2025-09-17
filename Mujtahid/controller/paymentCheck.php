<?php

require_once('../model/paymentModel.php');

if (isset($_POST['payment'])) {
    $payment = $_POST['payment'];
    $decodedData = json_decode($payment, true);

    if ($decodedData === null) {
        echo "Invalid JSON received";
        exit;
    }

    $method = $decodedData['method'];
    $tip = $decodedData['tip'];

    echo "Method: $method, Tip: $tip";
    exit;
}

if ($Method === "") {
    header('Location: ../view/payment.php?error=invalid_method');
}

elseif ($tip === "") {
    header('Location: ../view/payment.php?error=invalid_tip');
}

else{
    header("Location: ../view/payment.php?success=true");
}



