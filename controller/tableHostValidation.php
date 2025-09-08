<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['custName'] ?? '');
    $people = trim($_POST['custPeople'] ?? '');
    $table = trim($_POST['tableSelect'] ?? '');

    if ($name === "") {
        $_SESSION['error'] = "noname";
        header("Location: ../view/tableReservationHostes.php");
        exit;
    }

    if ($people === "" || !is_numeric($people) || $people < 1) {
        $_SESSION['error'] = "nopeople";
        header("Location: ../view/tableReservationHostes.php");
        exit;
    }

    if ($table === "") {
        $_SESSION['error'] = "notable";
        header("Location: ../view/tableReservationHostes.php");
        exit;
    }

    echo "<h2 style='color:green;'>Table $table assigned to $name for $people people!</h2>";
}


