<?php
session_start();

$name = trim($_POST['custName']);
$people = trim($_POST['custPeople']);
$table = trim($_POST['tableSelect']);


if ($name === "") {
    header("Location: index.php?error=noname");
    exit;
}
if ($people === "" || !is_numeric($people) || $people < 1) {
    header("Location: index.php?error=nopeople");
    exit;
}
if ($table === "") {
    header("Location: index.php?error=notable");
    exit;
}


echo "<h2 style='color:green;'>Table $table assigned to $name for $people people!</h2>";
?>
