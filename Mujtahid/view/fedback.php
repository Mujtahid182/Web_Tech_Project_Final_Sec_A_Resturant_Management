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
$allFeedbacks = [];

// if (isset($_GET['error'])) {
//     if ($_GET['error'] === 'empty') {
//         $errorMsg = "Feedback cannot be empty";
//     } elseif ($_GET['error'] === 'min_length') {
//         $errorMsg = "Feedback must be at least 5 characters long";
//     } elseif ($_GET['error'] === 'max_length') {
//         $errorMsg = "Feedback is too long (maximum 1000 characters)";
//     }
// }
// if (isset($_GET['success'])) {

// }
// if (isset($_SESSION['all_feedbacks'])) {
//     $allFeedbacks = $_SESSION['all_feedbacks'];
// }


// print_r($allFeedbacks);






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="../assets/css/fedback.css">

</head>

<body class="container">

    <!-- <form action="../controller/fedbackcheck.php" method="post" class="payment-form" onsubmit="return checkValidation()"> -->
    <form>
        <div>
            <h1>Customer Feedback</h1>

            <div class="feedback-form">
                <p>Write your feedback:</p>
                <textarea name="feedback" id="userFeedback" placeholder="Tell us about your experience..."></textarea>

                <p id="feedbackError" class="error"><?= $errorMsg; ?></p>
                <button class="btn" type="button" onclick="checkValidation()">Submit</button>
            </div>
        </div>
    </form>

    <div id="feedback-container" class="feedback-list">
        <p>All feedback:</p>

    </div>

    <footer class="footer">
        &copy; 2025 Restaurant Management System | Support: support@restaurant.com
    </footer>
    <script>
        function checkValidation() {
            let feedbackInput = document.getElementById('userFeedback');
            let errorElement = document.getElementById('feedbackError');
            let feedbackContainer = document.getElementById('feedback-container');
            let feedbackText = feedbackInput.value.trim();

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


            let feedback = {
                feedbackText
            } //shorthand of object


            let data = JSON.stringify(feedback);
            // console.log(data)


            let xhttp = new XMLHttpRequest(); //SERVER CONNECTOR
            xhttp.open('POST', '../controller/fedbackcheck.php', true) //ASYNCHRONOUS
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('feedback=' + data)
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    console.log(this.responseText);
                    feedbackData = JSON.parse(this.responseText);

                    console.log(feedbackData)

                    for (let i = 0; i < feedbackData.length; i++) {
                        let data = feedbackData[i];
                        feedbackContainer.innerHTML +=
                            '<div class="feedback-item">' +
                            '<p class="feedback-text">'+data.fedback_text+'</p>' +
                            '<p class="feedback-time">'+data.created_at+'</p>' +
                            '</div>';
                    }

                }
            }





            // const newItem = document.createElement("div");
            // newItem.className = "feedback-item";

            // const textP = document.createElement("p");
            // textP.className = "feedback-text";
            // textP.innerHTML = feedbackText;

            // const timeP = document.createElement("p");
            // timeP.className = "feedback-time";
            // const now = new Date();
            // timeP.innerHTML = now.toLocaleDateString() + " • " + now.toLocaleTimeString();

            // newItem.appendChild(textP);
            // newItem.appendChild(timeP);
            // const feedbackList = document.querySelector(".feedback-list");
            // feedbackList.prepend(newItem);

        }
    </script>
</body>

</html>