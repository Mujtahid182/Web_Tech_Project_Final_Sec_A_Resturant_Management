<?php
$paymentMethod = $_POST['paymentMethod'];
$tip = $_POST['tip'];
if ($paymentMethod === "") {
    header('Location: ../view/payment.php?error=invalid_method');
    exit;
}

elseif ($tip === "") {
    header('Location: ../view/payment.php?error=invalid_tip');
    exit;
}

else{
    header("Location: ../view/payment.php?success=true");
}



