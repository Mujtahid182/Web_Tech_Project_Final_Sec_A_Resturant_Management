<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'sendOrder') {
    
    
    $orderData = isset($_POST['orderData']) ? json_decode($_POST['orderData'], true) : [];

   
    if (!is_array($orderData) || count($orderData) === 0) {
        $_SESSION['error'] = "Please add at least one item before sending!";
        header("Location: ../view/orderCreateServers.php");
        exit();
    }


    $_SESSION['msg'] = "Order sent successfully!";
    header("Location: ../view/orderCreateServers.php");
    exit();
}
?>

