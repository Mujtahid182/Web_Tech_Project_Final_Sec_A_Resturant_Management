<?php

require_once 'db.php';

function getCurrentPoints() {
    $userId = 1; 
    $con = getConnection();

    $sql = "SELECT points FROM loyalty_users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return (int)$row['points'];
    } else {
        $insertSql = "INSERT INTO loyalty_users (user_id, points) VALUES (?, 0)";
        $insertStmt = mysqli_prepare($con, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "i", $userId);
        mysqli_stmt_execute($insertStmt);
        return 0;
    }
}


function redeemPoints($cost) {
    $userId = 1;
    $current = getCurrentPoints();

    if ($current < $cost) {
        return false; 
    }

    $newPoints = $current - $cost;

    $con = getConnection();
    $sql = "UPDATE loyalty_users SET points = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $newPoints, $userId);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    return $result;
}

function getRewards() {
    return [
        ['name' => 'Free Appetizer', 'cost' => 500],
        ['name' => '$10 Off Main Course', 'cost' => 1000],
        ['name' => 'Free Dessert', 'cost' => 750]
    ];
}