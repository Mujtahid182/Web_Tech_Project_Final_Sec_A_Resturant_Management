<?php

session_start();
$_SESSION["status"] = true;
// session_destroy();
if (!isset($_SESSION["status"])) {
  header("location: login.html?error=invalid_user");
}


$errorMsg = "";
if (isset($_GET['error'])) {
  if ($_GET['error'] === 'invalid_method') {
    $errorMsg = "Please select a valid payment method.";
  } elseif ($_GET['error'] === 'invalid_tip') {
    $errorMsg = "Please select a tip option.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Payment Processing | Restaurant Management System</title>
  <link rel="stylesheet" href="../assets/css/payment.css" />
</head>

<body>
  <div class="container">
    <h1>Payment Processing</h1>

    <div class="payment-section">
      <div class="bill-summary">
        <h2>Bill Summary - Table 5</h2>
        <div class="bill-item">
          <span>Burger</span>
          <span>Taka 12.99</span>
        </div>
        <div class="bill-item">
          <span>Salad</span>
          <span>Taka 9.99</span>
        </div>
        <div class="bill-item">
          <span>Coke (2x)</span>
          <span>Taka 6.00</span>
        </div>
        <div class="bill-item">
          <span>Subtotal</span>
          <span>Taka 28.98</span>
        </div>
        <div class="bill-item">
          <span>Tax (8%)</span>
          <span>Taka 2.32</span>
        </div>
        <div class="bill-total">
          <span>Total: Taka 31.30</span>
        </div>
      </div>

      <form
        action="../controller/paymentCheck.php"
        method="post"
        class="payment-form"
        onsubmit="return checkValidation()">
        <h2>Payment Method</h2>

        <div class="form-group">
          <label for="paymentMethod">Select Method</label>
          <select id="paymentMethod" name="paymentMethod">
            <option value="">-- Select Payment Method --</option>
            <option value="Cash">Cash</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Digital Payment (NFC)">
              Digital Payment (NFC)
            </option>
          </select>

          <p id="methodError" class="error"></p>
        </div>

        <div class="form-group">
          <label for="tip">Tip Amount</label>
          <select id="tip" name="tip">
            <option value="">-- Select Tip --</option>
            <option value="0">0% (Taka 0.00)</option>
            <option value="4.70">15% (Taka 4.70)</option>
            <option value="5.63">18% (Taka 5.63)</option>
            <option value="6.26">20% (Taka 6.26)</option>
          </select>
          <p id="tipError" class="error"><?= $errorMsg ?></p>
        </div>

        <button type="submit" class="btn">Process Payment</button>
      </form>
    </div>

    <div class="receipt-section">
      <div class="receipt-header">RESTAURANT PRO</div>
      <p>Date: March 14, 2024 • 8:30 PM</p>
      <p>Table: 5 • Order #1234</p>
      <hr />
      <p>Burger ........ Taka 12.99</p>
      <p>Salad .......... Taka 9.99</p>
      <p>Coke (2x) ............. Taka 6.00</p>
      <hr />
      <p>Subtotal: Taka 28.98</p>
      <p>Tax: Taka 2.32</p>
      <p><strong>Total: Taka 31.30</strong></p>
      <p id="tipLine">Tip: Taka 5.63 (18%)</p>
      <p id="finalLine"><strong>Final: Taka 36.93</strong></p>
      <hr />
      <p style="text-align: center">Thank you! Visit again!</p>
    </div>
  </div>

  <script>
    function checkValidation() {
      document.getElementById("methodError").innerHTML = "";
      document.getElementById("tipError").innerHTML = "";

      var method = document.getElementById("paymentMethod").value;
      var tipSelect = document.getElementById("tip").value;


      if (method === "") {
        document.getElementById("methodError").innerHTML =
          "Please select a payment method.";
        return false;
      }

      if (tipSelect === "") {
        document.getElementById("tipError").innerHTML =
          "Please select a tip option.";
        return false;
      }

      var tipAmount = parseFloat(tipSelect);
      var subtotal = 28.98;
      var tax = 2.32;
      var total = subtotal + tax;
      var finalTotal = total + tipAmount;

      var tipLine = document.getElementById("tipLine");
      tipLine.innerHTML =
        "Tip: Taka " +
        tipAmount.toFixed(2) +
        " (" +
        ((tipAmount / total) * 100).toFixed(0) +
        "%)";

      var finalLine = document.getElementById("finalLine");
      finalLine.innerHTML =
        "<strong>Final: Taka " + finalTotal.toFixed(2) + "</strong>";

      return true;
    }
  </script>
</body>

</html>