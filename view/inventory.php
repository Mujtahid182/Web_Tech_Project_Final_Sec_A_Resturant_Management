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
  h2 { margin-top: 30px; }
  h1 {text-align: center;}
  table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
  th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
  th { background: #f4f4f4; }
  input[type=number] { width: 60px; }
  #recipeForm, #wasteForm{ text-align: center; border: 1px solid #ccc; padding: 10px;}
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

<h2>Stock Count</h2>
<table id="stockTable">
  <tr>
    <th>Ingredient</th>
    <th>Quantity</th>
    <th>Par Level</th>
    <th>Update Stock</th>
    <th>Alert</th>
  </tr>
  
</table>

<h2>Waste Log</h2>
<form id="wasteForm" action="../controller/inventoryValidation.php" method="post">
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

<h2>Recipe Usage Calculation</h2>
<form id="recipeForm" action="../controller/inventoryValidation.php" method="post">
  <input type="hidden" name="action" value="useRecipe">
  <label>Recipe Name: 
    <select name="recipe" id="recipeName"></select>
  </label><br><br>
  <label>Chicken (kg): 
    <input type="number" name="chicken" id="recipeChicken" min="0">
   
  </label>
  <label>Rice (kg): 
    <input type="number" name="rice" id="recipeRice" min="0">
    
  </label>
  <label>Tomato (kg): 
    <input type="number" name="tomato" id="recipeTomato" min="0">
    <span id="recipeError" class="error"></span>
  </label>
  <button type="submit" class="btn">Use Ingredients</button>
</form>







<script>
  let stockData = [
    { ingredient: "Chicken", quantity: 10, par: 30 },
    { ingredient: "Rice", quantity: 100, par: 50 },
    { ingredient: "Tomato", quantity: 40, par: 20 }
  ];
  let recipes = ["Chicken Curry", "Fried Rice", "Tomato Soup"];

  function renderTable() {
    const table = document.getElementById("stockTable");
    table.innerHTML = `
      <tr>
        <th>Ingredient</th>
        <th>Quantity</th>
        <th>Par Level</th>
        <th>Update Stock</th>
        <th>Alert</th>
      </tr>
    `;
    stockData.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.ingredient}</td>
        <td class="qty">${item.quantity}</td>
        <td>${item.par}</td>
        <td>
          <input type="number" class="updateQty" min="1">
          <span class="error updateError"></span>
        </td>
        <td class="alertCell">${item.quantity < item.par ? "Below Par Level!" : ""}</td>
      `;
      table.appendChild(row);
    });
  }

  function populateWasteDropdown() {
    const dropdown = document.getElementById("wasteIngredient");
    stockData.forEach(item => {
      const opt = document.createElement("option");
      opt.value = item.ingredient;
      opt.textContent = item.ingredient;
      dropdown.appendChild(opt);
    });
  }

  function populateRecipeDropdown() {
    const dropdown = document.getElementById("recipeName");
    recipes.forEach(r => {
      const opt = document.createElement("option");
      opt.value = r;
      opt.textContent = r;
      dropdown.appendChild(opt);
    });
  }

 
  document.getElementById("wasteForm").addEventListener("submit", function(e){
    const wasteQty = document.getElementById("wasteQty").value;
    if(wasteQty.trim() === "" || wasteQty < 1){
      document.getElementById("wasteError").textContent = "Enter valid quantity";
      e.preventDefault();
    }
  });

  document.getElementById("recipeForm").addEventListener("submit", function(e){
    const chicken = document.getElementById("recipeChicken").value;
    const rice = document.getElementById("recipeRice").value;
    const tomato = document.getElementById("recipeTomato").value;
    if((chicken < 1) && (rice < 1) && (tomato < 1)){
      
      document.getElementById("recipeError").textContent = "Enter at least 1 ingredient";
      e.preventDefault();
    }
  });

document.getElementById("wasteQty").addEventListener("input", function(){
    if(this.value < 1){
      document.getElementById("wasteError").textContent = "Enter Valid Quantity";
    } else {
      document.getElementById("wasteError").textContent = "";
    }
  });





  renderTable();
  populateWasteDropdown();
  populateRecipeDropdown();
</script>
</body>
</html>
