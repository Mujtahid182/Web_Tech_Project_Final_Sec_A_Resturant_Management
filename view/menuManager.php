<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manager Menu Editor</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
    h1 { color: darkblue; text-align: center; }
    .form-container {
      border: 1px solid #ccc;
      background: white;
      padding: 5px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      justify-items: center;
    }
    .pagination {text-align: center;}
    .form-container input, .form-container textarea { padding: 6px; margin: 6px 0; }
    .form-container label { font-weight: bold; margin-top:5px; }
    .form-container button { padding: 8px 15px; margin-top: 10px; cursor: pointer; }
    .error { color: red; font-size: 12px; }
    .menu-item {
      border: 1px solid #ccc;
      background: white;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .menu-item img {
      width: 100px;
      height: 80px;
      border-radius: 5px;
      object-fit: cover;
    }
    .menu-details { flex: 1; }
    .menu-details h3 { margin: 0 0 5px; }
    .menu-details p { margin: 0 0 5px; color: #555; }
    .tags span {
      background: lightgreen;
      color: darkgreen;
      padding: 2px 6px;
      margin-right: 5px;
      border-radius: 5px;
      font-size: 12px;
    }
    .tags .gluten { background: #ffc107; color: #333; }
    .actions button { margin-left: 5px; padding: 4px 8px; cursor: pointer; }
    .pagination { margin-top: 15px; }
    .pagination button { margin: 3px; padding: 5px 10px; cursor: pointer; }
  </style>
</head>
<body>
  <h1>Menu Editor</h1>

  <div class="form-container">
  
    <form id="menuForm" action="../controller/menuManagerValidation.php" method="post" enctype="multipart/form-data">
      <table>
        <tr><th colspan="2"><h3 id="formTitle">Add Menu Item</h3></th></tr>
        <tr>
          <td><label for="itemName">Name:</label></td>
          <td>
            <input type="text" id="itemName" name="itemName">
            <div class="error" id="nameError"></div>
          </td>
        </tr>
        <tr>
          <td><label for="itemDesc">Description:</label></td>
          <td>
            <textarea id="itemDesc" name="itemDesc"></textarea>
            <div class="error" id="descError"></div>
          </td>
        </tr>
        <tr>
          <td><label for="itemPrice">Price:</label></td>
          <td>
            <input type="number" id="itemPrice" name="itemPrice">
            <div class="error" id="priceError"></div>
          </td>
        </tr>
        <tr>
          <td><label for="itemImg">Image:</label></td>
          <td>
            <input type="file" id="itemImg" name="itemImg">
            <div class="error" id="imgError"></div>
          </td>
        </tr>
      </table>
      <label><input type="checkbox" id="itemVegan" name="itemVegan"> Vegan</label>
      <label><input type="checkbox" id="itemGluten" name="itemGluten"> Gluten-Free</label><br>
      <button type="submit">Save</button>
      <button type="reset" onclick="resetForm()">Clear</button>
    </form>
  </div>

  <div id="menuList"></div>

 
  <div class="pagination">
    <label>Items per page:
      <select id="itemsPerPage">
        <option>5</option>
        <option>10</option>
        <option>25</option>
      </select>
    </label>
    <div id="pageButtons"></div>
  </div>

  <script>
  
  let menuItems = [
    {name: "Grilled Chicken", desc:"Juicy chicken breast served with veggies.",price:"100", vegan:false, glutenFree:true, img:"https://www.lecremedelacrumb.com/wp-content/uploads/2024/05/grilledbbqchicken-8b-3-scaled.jpg"},
    {name: "Vegan Burger", desc:"Plant-based burger with lettuce and tomato.",price:"100", vegan:true, glutenFree:false, img:"https://www.wellplated.com/wp-content/uploads/2016/03/Black-Bean-Vegan-Burger-Recipe.jpg"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
    {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"}
  ];
  let currentPage = 1;
  let itemsPerPage = 5;

  function renderMenu() {
    const start = (currentPage-1) * itemsPerPage;
    const end = start + itemsPerPage;
    const itemsToShow = menuItems.slice(start, end);
    const menuList = document.getElementById("menuList");
    menuList.innerHTML = "";
    itemsToShow.forEach((item) => {
      const div = document.createElement("div");
      div.className = "menu-item";
      div.innerHTML = `
        <img src="${item.img}" alt="${item.name}">
        <div class="menu-details">
          <h3>${item.name}</h3>
          <p>${item.desc}</p>
          <p>Price: ${item.price} TK</p>
          <div class="tags">
            ${item.vegan ? "<span>Vegan</span>" : ""}
            ${item.glutenFree ? "<span class='gluten'>Gluten-Free</span>" : ""}
          </div>
        </div>
        <div class="actions">
          <button>Edit</button>
          <button>Delete</button>
        </div>
      `;
      menuList.appendChild(div);
    });
    const pageCount = Math.ceil(menuItems.length / itemsPerPage);
    const pageButtons = document.getElementById("pageButtons");
    pageButtons.innerHTML = "";
    for(let i=1; i<=pageCount; i++){
      const btn = document.createElement("button");
      btn.textContent = i;
      if(i === currentPage) btn.style.backgroundColor = "lightblue";
      btn.addEventListener("click", ()=>{ currentPage = i; renderMenu(); });
      pageButtons.appendChild(btn);
    }
  }

  function validateForm(name, desc, img, price){
    let valid = true;
    document.getElementById("nameError").textContent = "";
    document.getElementById("descError").textContent = "";
    document.getElementById("imgError").textContent = "";
    document.getElementById("priceError").textContent = "";
    if(name.trim()===""){ document.getElementById("nameError").textContent="Name is required"; valid=false; }
    if(desc.trim()===""){ document.getElementById("descError").textContent="Description is required"; valid=false; }
    if(img === ""){ document.getElementById("imgError").textContent="Please select an image file"; valid = false; }
    else { const allowed = ["jpg","jpeg","png"]; const ext = img.split('.').pop().toLowerCase(); if(!allowed.includes(ext)){ document.getElementById("imgError").textContent="Only JPG, JPEG, or PNG allowed"; valid = false; } }
    if(price.trim()==="" || price<1){ document.getElementById("priceError").textContent="Enter Valid Price"; valid=false; }
    return valid;
  }

  
  document.getElementById("menuForm").addEventListener("submit", function(e){
    const name = document.getElementById("itemName").value;
    const desc = document.getElementById("itemDesc").value;
    const img = document.getElementById("itemImg").value;
    const price = document.getElementById("itemPrice").value;
    if(!validateForm(name, desc, img, price)){
      e.preventDefault(); 
    }
  });


 

document.getElementById("itemName").addEventListener("input", function(){
 if(this.value !=""){
      document.getElementById("nameError").textContent = "";
 }
});

  document.getElementById("itemPrice").addEventListener("input", function(){
    if(this.value < 1){
      document.getElementById("priceError").textContent = "Enter Valid Price";
    } else {
      document.getElementById("priceError").textContent = "";
    }
  });

  document.getElementById("itemDesc").addEventListener("input", function(){
    if(this.value !=""){
      document.getElementById("descError").textContent = "";
    }
  });

  document.getElementById("itemImg").addEventListener("input", function(){
    if(this.value !=""){
      document.getElementById("imgError").textContent = "";
    }
  });



  document.getElementById("itemImg").addEventListener("change", function(){
  const imgError = document.getElementById("imgError");
  const filePath = this.value; 
  imgError.textContent = ""; 


  const allowed = ["jpg","jpeg","png"];
  const ext = filePath.split('.').pop().toLowerCase();

  if(!allowed.includes(ext)){
    imgError.textContent = "Only JPG, JPEG, or PNG allowed";
    return;
  }

  if(filePath != ""){
    imgError.textContent = "";
  }

});




  renderMenu();
  </script>
</body>
</html>
