


<?php
require_once('db.php');

function addfeedback($feedback)
{
    $con = getConnection();
    $sql = "insert into fedback values(null, '{$feedback}', NOW())";
    $result = mysqli_query($con, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function getAllFeedback()
{
    $con = getConnection();
    $sql = "select * from fedback";
    $result = mysqli_query($con, $sql);
    $feedbacks = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($feedbacks, $row);
    }
    return $feedbacks;
}


?>