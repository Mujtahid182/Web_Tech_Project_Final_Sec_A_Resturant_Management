<?php


session_start();

$_SESSION["status"] = true;
//session_destroy();

if (!isset($_SESSION["status"])) {
    header("location: login.html?error=invalid_user");
}

// Cookie
//  setcookie('status', true, time()+900, '/');
//     //  setcookie('status', true, time()-10, '/');
//  if(!isset($_COOKIE['status'])){
//         header('location: login.html?error=invalid_user');
//     }


$errorMsg = "";
$feedback = "";

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'empty') {
        $errorMsg = "Feedback cannot be empty";
    } elseif ($_GET['error'] === 'min_length') {
        $errorMsg = "Feedback must be at least 5 characters long";
    } elseif ($_GET['error'] === 'max_length') {
        $errorMsg = "Feedback is too long (maximum 1000 characters)";
    }
}
if (isset($_GET['success'])) {
    $feedback = urldecode($_GET['success']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="../assets/css/fedback.css">

</head>

<body class="container">

    <form action="../controller/fedbackcheck.php" method="post" class="payment-form" onsubmit="return checkValidation()">
        <div>
            <h1>Customer Feedback</h1>

            <div class="feedback-form">
                <p>Write your feedback:</p>
                <textarea name="feedback" id="userFeedback" placeholder="Tell us about your experience..."></textarea>

                <p id="feedbackError" class="error"><?= $errorMsg; ?></p>
                <button class="btn" type="submit">Submit</button>
            </div>
        </div>
    </form>

    <div class="feedback-list">
        <p>All feedback:</p>
        
    <div class="feedback-item">
        <p class="feedback-text"> <?=$feedback;?> </p>
            <p class="feedback-time">Aug 14, 2025 • 8:30 PM</p>
        </div>
        <div class="feedback-item">
            <p class="feedback-text">Excellent service and delicious food! The staff was very attentive and the
                burger was cooked perfectly.</p>
            <p class="feedback-time">Aug 14, 2025 • 8:30 PM</p>
        </div>

        <div class="feedback-item">
            <p class="feedback-text">Great experience overall. Only suggestion would be to have more vegetarian
                options on the menu.</p>
            <p class="feedback-time">Aug 13, 2025 • 7:15 PM</p>
        </div>

        <div class="feedback-item">
            <p class="feedback-text">Food was good but waited 25 minutes for our order. Table was clean and staff
                was friendly though.</p>
            <p class="feedback-time">Aug 12, 2025 • 6:45 PM</p>
        </div>

        <div class="feedback-item">
            <p class="feedback-text">Perfect for family dinner! Kids loved the menu and the staff was so patient.
            </p>
            <p class="feedback-time">Aug 11, 2025 • 7:30 PM</p>
        </div>
    </div>

    <footer class="footer">
        &copy; 2025 Restaurant Management System | Support: support@restaurant.com
    </footer>
    </div>
    <script>
        function checkValidation() {
            const feedbackInput = document.getElementById('userFeedback');
            const errorElement = document.getElementById('feedbackError');
            const feedbackText = feedbackInput.value.trim();

            errorElement.innerHTML = '';

            if (feedbackText === '') {

                errorElement.innerHTML = 'Feedback cannot be empty.';
                return false;
            }

            if (feedbackText.length < 5) {
                errorElement.innerHTML = 'Feedback must be at least 5 characters long.';
                return false;
            }

            if (feedbackText.length > 1000) {
                errorElement.innerHTML = 'Feedback is too long (maximum 1000 characters).';
                return false;
            }


            const newItem = document.createElement("div");
            newItem.className = "feedback-item";

            const textP = document.createElement("p");
            textP.className = "feedback-text";
            textP.innerHTML = feedbackText;

            const timeP = document.createElement("p");
            timeP.className = "feedback-time";
            const now = new Date();
            timeP.innerHTML = now.toLocaleDateString() + " • " + now.toLocaleTimeString();
            
            newItem.appendChild(textP);
            newItem.appendChild(timeP);
            const feedbackList = document.querySelector(".feedback-list");
            feedbackList.prepend(newItem);

            return true;

        }
    </script>
</body>

</html>