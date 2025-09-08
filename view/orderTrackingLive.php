<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Tracking</title>
  <style>
    .New { background: yellow; padding: 8px; margin: 5px; }
    h1 {text-align: center;}
    .InProgress { background: orange; padding: 8px; margin: 5px; color: white; }
    .Ready { background: green; padding: 8px; margin: 5px; color: white; }
    .Completed { background: gray; padding: 8px; margin: 5px; color: white; }
  </style>
</head>
<body>
  <h1>Live Order Tracking</h1>
  <div id="tracking"></div>

  <script>
  
    let orders = [
      { id: 1, table: 2, item: "Grilled Chicken", status: "New" },
      { id: 2, table: 3, item: "Vegan Burger", status: "InProgress" },
      { id: 3, table: 4, item: "Salad Bowl", status: "Ready" }
    ];

    function showOrders() {
      const div = document.getElementById("tracking");
      div.innerHTML = "";

      orders.forEach(order => {
        const box = document.createElement("div");
        box.className = order.status.replace(" ", "");
        box.textContent = `Table ${order.table} → ${order.item} (${order.status})`;
        div.appendChild(box);
      });
    }

    
    showOrders();

   

   
  </script>



</body>
</html>
