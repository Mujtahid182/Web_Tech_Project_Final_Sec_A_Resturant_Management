<?php
session_start();


$msg = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$error = "";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }

  h1 {text-align: center;}
  table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
  th, td { border: 1px solid #e66f0eff; padding: 8px; text-align: center; }
  th { background: #f4f4f4; }
  input[type=number] { width: 60px; }
  .Form { text-align: center; border: 1px solid #df7701ff; padding: 10px;}
  .alert { color: red; font-weight: bold; }
  .btn { padding: 5px 10px; margin: 2px; cursor: pointer; }
  .error { color: red; font-size: 12px; margin-top: 3px; display:block; }
  .msg { color: green; font-weight: bold; }
</style>
</head>
<body>


<h1>Inventory</h1>

<?php if($error) echo "<p class='error'>$error</p>"; ?>
<?php if($msg) echo "<p class='msg'>$msg</p>"; ?>


<h2>Update Log</h2>

<form id="updateForm" class="Form" action="../controller/inventoryValidation.php" method="post">
  <input type="hidden" name="action" value="logUpdate">
  <label>Ingredient:
    <select name="uingredient" id="updateIngredient"></select>
  </label><br><br>
  <label>Quantity:
    <input type="number" name="uquantity" id="updateQty">
    <span id="updateError" class="error"></span>
  </label>
  <button type="submit" class="btn">Update</button>
</form>




<h2>Waste Log</h2>

<form id="wasteForm" class="Form" action="../controller/inventoryValidation.php" method="post">
  <input type="hidden" name="action" value="logWaste">
  <label>Ingredient:
    <select name="ingredient" id="wasteIngredient"></select>
  </label><br><br>
  <label>Quantity wasted:
    <input type="number" name="quantity" id="wasteQty">
    <span id="wasteError" class="error"></span>
  </label>
  <button type="submit" class="btn">Log Waste</button>
</form>






<h2>Stock Count</h2>
<form id="updateStock" action="../controller/inventoryValidation.php" method="post">
  <input type="hidden" name="action" value="logUpdate">
<table id="stockTable">
  
</table>
</form>






<script>


  let stockData = [
    { ingredient: "Chicken", quantity: 10, par: 30 },
    { ingredient: "Rice", quantity: 100, par: 50 },
    { ingredient: "Tomato", quantity: 40, par: 20 }
  ];
 



  function renderTable() {
    const table = document.getElementById("stockTable");
    table.innerHTML = `
      <tr>
        <th>Ingredient</th>
        <th>Quantity</th>
        <th>Par Level</th>
        <th>Alert</th>
      </tr>
    `;
    stockData.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.ingredient}</td>
        <td class="qty">${item.quantity}</td>
        <td>${item.par}</td>
       
        <td class="alert">${item.quantity < item.par ? "Below Par Level!" : ""}</td>
      `;
      table.appendChild(row);
    });

 
  }

  function populateWasteDropdown() {
    let dropdown = document.getElementById("wasteIngredient");
    stockData.forEach(item => {
      const opt = document.createElement("option");
      opt.value = item.ingredient;
      opt.textContent = item.ingredient;
      dropdown.appendChild(opt);
    });
  }

   function populateUpdateDropdown() {
    let dropdown = document.getElementById("updateIngredient");
    stockData.forEach(item => {
      const opt = document.createElement("option");
      opt.value = item.ingredient;
      opt.textContent = item.ingredient;
      dropdown.appendChild(opt);
    });
  }




 document.getElementById("updateForm").addEventListener("submit", function(e){
    const updateQty = document.getElementById("updateQty").value;
    if(updateQty.trim() === "" || updateQty < 1){
      document.getElementById("updateError").textContent = "Enter valid quantity";
      e.preventDefault();
    }
  });
  
 
  document.getElementById("wasteForm").addEventListener("submit", function(e){
    const wasteQty = document.getElementById("wasteQty").value;
    if(wasteQty.trim() === "" || wasteQty < 1){
      document.getElementById("wasteError").textContent = "Enter valid quantity";
      e.preventDefault();
    }
  });





document.addEventListener("input", function(e){
    if(e.target.id === "updateQty"){
      const error = document.getElementById("updateError");

      if(e.target.value < 1){
        error.textContent = "Enter valid quantity";
      } else {
        error.textContent = "";
      }
    }
    if(e.target.id === "wasteQty"){
      const wasteError = document.getElementById("wasteError");
      if(e.target.value < 1){
        wasteError.textContent = "Enter valid quantity";
      } else {
        wasteError.textContent = "";
      }
    }
    
  });


  renderTable();
  populateWasteDropdown();
  populateUpdateDropdown();
  
</script>
</body>
</html>
