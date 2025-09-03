<?php
session_start();

$_SESSION["status"] = true;
// session_destroy();
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=invalid_user");
}


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
                    <strong>Free Appetizer</strong>
                    <p>Perfect start to your meal</p>
                </div>
                <div class="reward-actions">
                    <span class="reward-points">500 pts</span>
                    <button class="btn" onclick="redeemReward('Free Appetizer', 500)">Redeem</button>
                </div>
            </div>

            <div class="reward-item">
                <div class="reward-info">
                    <strong>$10 Off Main Course</strong>
                    <p>Save on your favorite dish</p>
                </div>
                <div class="reward-actions">
                    <span class="reward-points">1,000 pts</span>
                    <button class="btn" onclick="redeemReward('$10 Off Main Course', 1000)">Redeem</button>
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
        let message = "";
        let messageClass = "";


        function updatePointsDisplay() {
            document.getElementById("pointsDisplay").innerHTML = currentPoints.toLocaleString();
        }


        function showMessage(msg, type) {
            const box = document.getElementById("messageBox");
            box.innerHTML = msg;
            box.className = "message " + type;
        }

        function redeemReward(reward, cost) {
            if (currentPoints >= cost) {
                currentPoints -= cost;
                updatePointsDisplay();
                showMessage("You successfully redeemed: " + reward, "success");
            } else {
                showMessage("Not enough points to redeem " + reward, "error");
            }
        }
        updatePointsDisplay();
    </script>
</body>

</html>