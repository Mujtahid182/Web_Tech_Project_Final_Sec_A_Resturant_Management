<?php
session_start();

if (isset($_POST['submit'])) {
     $name = trim($_POST['cstName'] ?? '');
    $people = trim($_POST['cstPeople'] ?? '');
    $table = trim($_POST['tableSelect'] ?? '');
    $allowed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ";
   

  if ($name == "") {
        header("location:../view/tableReservationHoste.php?error=name");
        exit;
    }

 for ($i = 0; $i < strlen($name); $i++) {
    if (strpos($allowed, $name[$i]) === false) {
         header("location:../view/tableReservationHostes.php?error=name");
        exit;
       
    }
}
  

     if ($people == "") {
        header("location:../view/tableReservationHostes.php?error=people");
        exit;
    }

    if ($table === "") {
        
         header("location:../view/tableReservationHostes.php?error=table");
        exit;
    }

    
}


