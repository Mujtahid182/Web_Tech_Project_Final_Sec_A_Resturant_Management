<?php
session_start();

$action = $_POST['action'] ?? "";

if($action === "updateStock"){
    
    $quantity = trim($_POST['quantity'] ?? "");
    if($quantity === "" || !is_numeric($quantity) || $quantity < 1){
        $_SESSION['error'] = "Invalid input for stock update.";
        header("Location: ../view/inventory.php");
        exit;
    }
    $_SESSION['msg'] = "Stock updated to $quantity.";
    header("Location: ../view/inventory.php");
    exit;
}



elseif($action === "logWaste"){
    $ingredient = trim($_POST['ingredient'] ?? "");
    $quantity = trim($_POST['quantity'] ?? "");
    if($quantity === "" || !is_numeric($quantity) || $quantity < 1){
        $_SESSION['error'] = "Invalid input for waste log.";
        header("Location: ../view/inventory.php");
        exit;
    }
    $_SESSION['msg'] = "Waste of $quantity recorded.";
    header("Location: ../view/inventory.php");
    exit;
}



elseif($action === "useRecipe"){
    
    $chicken = (int) ($_POST['chicken'] ?? 0);
    $rice = (int) ($_POST['rice'] ?? 0);
    $tomato = (int) ($_POST['tomato'] ?? 0);
    if($chicken < 1 && $rice < 1 && $tomato < 1){
        $_SESSION['error'] = "Invalid input for recipe usage.";
        header("Location: ../view/inventory.php");
        exit;
    }
    $_SESSION['msg'] = "Ingredients used- Chicken: $chicken, Rice: $rice, Tomato: $tomato.";
    header("Location: ../view/inventory.php");
    exit;

}
?>
