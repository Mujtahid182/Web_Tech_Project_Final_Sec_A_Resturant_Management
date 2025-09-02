<?php
session_start();

if (isset($_POST['submit'])) {
    $name   = trim($_POST['custName']);
    $phone  = trim($_POST['custPhone']);
    $date   = trim($_POST['custDate']);
    $time   = trim($_POST['custTime']);
    $people = trim($_POST['custPeople']);
    $req    = trim($_POST['custRequest']);

 
    if ($name == "") {
        header("location: ../view/tablereservationCus.php?error=name");
        exit;
    }
    if ($phone == "") {
        header("location: ../view/tablereservationCus.php?error=phone");
        exit;
    }
    if ($date == "") {
        header("location: ../view/tablereservationCus.php?error=date");
        exit;
    }
    if ($time == "") {
        header("location: ../view/tablereservationCus.php?error=time");
        exit;
    }
    if ($people == "") {
        header("location: ../view/tablereservationCus.php?error=people");
        exit;
    }

    
    echo "<h2>Reservation Confirmed</h2>";
   
} else {
    header("location: ../view/tablereservationCus.php");
    exit;
}
?>
