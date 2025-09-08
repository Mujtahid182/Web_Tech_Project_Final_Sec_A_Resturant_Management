<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chef Panel</title>



  <style>
    ul { list-style: none; padding: 0; }
    li { margin: 8px 0; }
    button { margin-left: 5px; padding: 3px 8px; cursor: pointer; }
  </style>


</head>


<body>


  <h1 style="text-align: center;">Kitchen Orders</h1>
  <ul id="orderList"></ul>

  <script>
   
    let orders = [
      { id: 1, table: 2, item: "Grilled Chicken", status: "New" },
      { id: 2, table: 3, item: "Vegan Burger", status: "New" },
      { id: 3, table: 4, item: "Salad Bowl", status: "New" }
    ];

    function loadOrders() {
      let list = document.getElementById("orderList");
      list.innerHTML = "";

      orders.forEach(order => {
        let li = document.createElement("li");
        li.textContent = `Table ${order.table}: ${order.item} [${order.status}]`;

        let btn1 = document.createElement("button");
        btn1.textContent = "In Progress";
        btn1.onclick = () => updateStatus(order.id, "In Progress");

        let btn2 = document.createElement("button");
        btn2.textContent = "Ready";
        btn2.onclick = () => updateStatus(order.id, "Ready");

        li.appendChild(btn1);
        li.appendChild(btn2);
        list.appendChild(li);
      });
    }

   
    
    loadOrders();
  </script>

  
</body>
</html>