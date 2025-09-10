<?php
session_start();

$_SESSION["status"] = true;
// session_destroy();
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=invalid_user");
}


// Cookie
//  setcookie('status', true, time()+900, '/');
//     //  setcookie('status', true, time()-10, '/');
//  if(!isset($_COOKIE['status'])){
//         header('location: login.html?error=invalid_user');
//     }


if (!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}

$currentPoints = $_SESSION['points'];

$message = '';
$messageClass = '';
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $messageClass = "message";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Loyalty Program | Restaurant Management System</title>
    <link rel="stylesheet" href="../assets/css/loyality.css">
</head>

<body>
    <div class="container">
        <h1>Loyalty Program</h1>

        <div id="messageBox" class=<?= $messageClass ?>><?= $message  ?></div>

        <div class="loyalty-card">
            <h2>Welcome, Mujtahid!</h2>
            <p>Your Loyalty Points</p>
            <div id="pointsDisplay" class="points-display"></div>
            <p>You can redeem rewards below using your points.</p>
        </div>

        <div class="rewards-catalog">
            <h2>Rewards Catalog</h2>

            <div class="reward-item">
                <div class="reward-info">
                    <strong>Free Cake</strong>
                     <p>Save on your favorite Cake</p>

                </div>
                <div class="reward-actions">
                    <span class="reward-points">500 pts</span>
                    <button class="btn" onclick="redeemReward('Free Cake', 500)">Redeem</button>
                </div>
            </div>

            <div class="reward-item">
                <div class="reward-info">
                    <strong>Free Ice_cream</strong>
                    <p>Save on your favorite Ice-Cream</p>
                </div>
                <div class="reward-actions">
                    <span class="reward-points">1,000 pts</span>
                    <button class="btn" onclick="redeemReward('Free Ice-cream', 1000)">Redeem</button>
                </div>
            </div>

            <div class="reward-item">
                <div class="reward-info">
                    <strong>Free Dessert</strong>
                    <p>End your meal on a sweet note</p>
                </div>
                <div class="reward-actions">
                    <span class="reward-points">750 pts</span>
                    <button class="btn" onclick="redeemReward('Free Dessert', 750)">Redeem</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        let currentPoints = 2450;
        document.getElementById("pointsDisplay").innerHTML = currentPoints.toLocaleString();

        function redeemReward(reward, cost) {
            if (currentPoints >= cost) {
                currentPoints -= cost;
                document.getElementById("pointsDisplay").innerHTML = currentPoints.toLocaleString();;
                showMessage("You successfully redeemed: " + reward);
            } else {
                showMessage("Not enough points to redeem " + reward);
            }
        }

        function showMessage(msg) {
            const box = document.getElementById("messageBox");
            box.innerHTML = msg;
            box.className = "message";
        }
    </script>
</body>

</html>