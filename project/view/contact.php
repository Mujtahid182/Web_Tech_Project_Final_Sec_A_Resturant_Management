<?php
session_start();

// ✅ Session check
if(!isset($_SESSION['username']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Support</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function showMessage(event){
            event.preventDefault(); // Stop page reload
            alert("✅ Your message has been sent successfully!");
            return false;
        }
    </script>
</head>
<body>
<div class="container">
    <h2>Contact Support</h2>
    <form onsubmit="return showMessage(event);">
        <label>Subject:</label><br>
        <input type="text" name="subject" required><br>

        <label>Message:</label><br>
        <textarea name="message" required></textarea><br>

        <button type="submit">Send</button>
    </form>

    <!-- ✅ Correct Back to Dashboard -->
    <?php if($_SESSION['role']=="admin"){ ?>
        <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    <?php } else { ?>
        <a href="user_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    <?php } ?>
</div>
</body>
</html>

