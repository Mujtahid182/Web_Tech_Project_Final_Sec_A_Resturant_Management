<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $name = trim($_POST['itemName'] ?? '');
    $desc = trim($_POST['itemDesc'] ?? '');
    $price = trim($_POST['itemPrice'] ?? '');
    $vegan = isset($_POST['itemVegan']);
    $gluten = isset($_POST['itemGluten']);

    if ($name === '') {
        $errors[] = "Name is required.";
    }
    if ($desc === '') {
        $errors[] = "Description is required.";
    }
    if ($price === '' || !is_numeric($price) || $price < 1) {
        $errors[] = "Enter a valid price.";
    }

    if (!isset($_FILES['itemImg']) || $_FILES['itemImg']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Please upload an image.";
    } else {
        $allowed = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($_FILES['itemImg']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $errors[] = "Only JPG, JPEG, or PNG allowed.";
        }
    }

    if (!empty($errors)) {
        echo "<h3>Form Errors:</h3><ul>";
        foreach ($errors as $err) {
            echo "<li style='color:red;'>$err</li>";
        }
        echo "<a href='../view/menuManager.php'>Go Back</a>";
    } else {
        
        echo "Success";
    }
}
?>
