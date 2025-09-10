<?php
$feedback = $_POST['feedback'];

if ($feedback === '') {
    header('Location: ../view/fedback.php?error=empty');
} elseif (strlen($feedback) < 5) {
    header('Location: ../view/fedback.php?error=min_length');
} elseif (strlen($feedback) > 1000) {
    header('Location: ../view/fedback.php?error=max_length');
}
else{
    header("Location: ../view/fedback.php?success=$feedback");
}



?>