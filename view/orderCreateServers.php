<?php
    session_start();

    if (isset($_REQUEST['error'])) {
        if ($_REQUEST['error'] == "null") {
            echo "<p style='color:red'>Field cannot be empty!</p>";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Panel</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px;}
    h2 { margin-bottom: 15px; }
    label { display: block; margin-bottom: 10px; }
    select, input[type=number] { margin-left: 10px; }
    button { margin: 5px; padding: 5px 10px; cursor: pointer; }
    ul { margin-top: 15px; padding-left: 20px; }
    li { margin: 5px 0; }
    #qError { color: red; font-size: 12px; margin-top: 3px; }
    .error { color: red; font-weight: bold; }
    .msg { color: green; font-weight: bold; }
  </style>
</head>
<body>
  
  <h2>Place New Order</h2>

  

  <form id="orderForm" action="../controller/orderCreateValidation.php" method="post">
    <input type="hidden" name="action" value="sendOrder">
    <input type="hidden" id="orderData" name="orderData">

    <label>Table Number:
      <select id="tableNo" name="tableNo">
        <option value="1">Table 1</option>
        <option value="2">Table 2</option>
        <option value="3">Table 3</option>
        <option value="4">Table 4</option>
        <option value="5">Table 5</option>
        <option value="6">Table 6</option>
      </select>
    </label>

    <label>Menu Item:
      <select id="menuItem"></select>
    </label>

    <label>Quantity:
      <input type="number" id="quantity" min="1" value="1">
      <p id="qError"></p>
    </label>

    <button type="button" id="addBtn">Add</button>
    <button type="button" id="clearBtn">Clear List</button>
    <button type="submit" id="sendBtn">Send to Kitchen</button>
  </form>

  <h3>Order List</h3>
  <ul id="orderList"></ul>

  <script>
    const menuItems = ["Grilled Chicken", "Vegan Burger", "Salad Bowl", "Pasta", "Soup"];
    const menuSelect = document.getElementById("menuItem");
    menuItems.forEach(item => {
      let opt = document.createElement("option");
      opt.value = item;
      opt.textContent = item;
      menuSelect.appendChild(opt);
    });

    let currentOrder = [];
    const orderListEl = document.getElementById("orderList");

    function renderOrderList() {
      orderListEl.innerHTML = "";
      currentOrder.forEach((entry) => {
        const li = document.createElement("li");
        li.textContent = `${entry.item} x ${entry.qty}`;
        orderListEl.appendChild(li);
      });
    }

    document.getElementById("addBtn").addEventListener("click", () => {
      const item = menuSelect.value;
      const qty = parseInt(document.getElementById("quantity").value);
      let qerror = document.getElementById("qError");

      if (isNaN(qty) || qty < 1) {
        qerror.textContent="Please enter a valid quantity";
        return;
      } else {
        qerror.textContent="";
      }

      currentOrder.push({ item, qty });
      renderOrderList();
      document.getElementById("quantity").value = 1;
    });

    document.getElementById("clearBtn").addEventListener("click", () => {
      currentOrder = [];
      renderOrderList();
    });

   
    document.getElementById("orderForm").addEventListener("submit", function(e){
      if(currentOrder.length === 0){
        alert("Please add at least one item before sending!");
        e.preventDefault();
        return;
      }
     
      document.getElementById("orderData").value = JSON.stringify(currentOrder);
    });

    document.getElementById("quantity").addEventListener("input", function(){
      if(this.value < 1){
        document.getElementById("qError").textContent = "Enter Valid Quantity";
      } else {
        document.getElementById("qError").textContent = "";
      }
    });
  </script>
</body>
</html>

