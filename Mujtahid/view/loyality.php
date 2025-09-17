<?php
// session_start();

// $_SESSION["status"] = true;

// if (!isset($_SESSION["status"])) {
//     header("Location: login.html?error=invalid_user");
//     exit;
// }

require_once '../model/loyalityModel.php';
$currentPoints = getCurrentPoints();
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

        <div id="messageBox" class="<?= isset($_GET['msg']) ? 'message' : '' ?>">
            <?php if (isset($_GET['msg'])) echo htmlspecialchars($_GET['msg']); ?>
        </div>

        <div class="loyalty-card">
            <h2>Welcome, Mujtahid!</h2>
            <p>Your Loyalty Points</p>
            <div id="pointsDisplay" class="points-display"><?= number_format($currentPoints) ?></div>
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
        function showMessage(msg, type) {
            const box = document.getElementById("messageBox");
            box.innerHTML = msg;
            box.className = "message";
          
        }

        function redeemReward(reward, cost) {
            let errorElement = document.getElementById("messageBox");
            let pointsDisplay = document.getElementById("pointsDisplay");

            if (cost <= 0) {
                errorElement.innerHTML = 'Invalid reward amount.';
                return false;
            }

            let loyaltyData = {
                user_id: 1,  
                points: cost 
            };


            let data = JSON.stringify(loyaltyData);
            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/loyalityCheck.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
       
            xhttp.send('points=' + data);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    let response = JSON.parse(this.responseText);

                    if (response.success) {
                        pointsDisplay.innerHTML = response.points.toLocaleString();
                        showMessage("You successfully redeemed: " + reward, 'success');
                    } else {
                        showMessage(" " + response.message, 'error');
                    }
                }
            };
        }
    </script>
</body>
</html>