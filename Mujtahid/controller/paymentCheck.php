<?php
$paymentMethod = $_POST['paymentMethod'];
$tip = $_POST['tip'];
if ($paymentMethod === "") {
    header('Location: ../view/payment.php?error=invalid_method');
}

elseif ($tip === "") {
    header('Location: ../view/payment.php?error=invalid_tip');
}

else{
    header("Location: ../view/payment.php?success=true");
}



