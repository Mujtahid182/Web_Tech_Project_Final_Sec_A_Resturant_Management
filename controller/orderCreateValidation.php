<?php
    session_start();

    if (isset($_POST['submit'])) {
        $quantity = trim($_POST['quantity']);

        
        if ($quantity === "") {
            header("location:../view/orderCreateServers.php?error=null");
            exit;
        }

        
        else if (!is_numeric($quantity) || $quantity < 1) {
            header("location:../view/orderCreateServers.php?error=lessthan1");
            exit;
        }else{

        
        echo "Form submitted successfully! You entered: ";}
    }
?>
