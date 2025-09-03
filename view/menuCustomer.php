<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Menu</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #ecedee; text-align: center; justify-items: center;}
    h1 { color: darkgreen; }
    .filters { margin-bottom: 15px; }
    .filters label { margin-right: 15px; }

    .menu-item {
      border: 1px solid #ccc;
      background: white;
      width: 70vw;
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

    .pagination { margin-top: 15px; }
    .pagination button { margin: 3px; padding: 5px 10px; cursor: pointer; }
  </style>
</head>
<body>
  <h1>Menu</h1>

  
  <div class="filters">
    <label><input type="checkbox" id="veganFilter"> Vegan</label>
    <label><input type="checkbox" id="glutenFreeFilter"> Gluten-Free</label>
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
    
    const menuItems = [
      {name: "Grilled Chicken", desc:"Juicy chicken breast served with veggies.",price:"100", vegan:false, glutenFree:true, img:"https://www.lecremedelacrumb.com/wp-content/uploads/2024/05/grilledbbqchicken-8b-3-scaled.jpg"},
      {name: "Vegan Burger", desc:"Plant-based burger with lettuce and tomato.",price:"100", vegan:true, glutenFree:false, img:"https://www.wellplated.com/wp-content/uploads/2016/03/Black-Bean-Vegan-Burger-Recipe.jpg"},
      {name: "Gluten-Free Pasta", desc:"Delicious pasta made with rice flour.",price:"100", vegan:false, glutenFree:true, img:"https://wholesomepatisserie.com/wp-content/uploads/2021/12/Gluten-Free-Pasta-Salad-Dressing-Featured-Image-1.jpg"},
      {name: "Salad Bowl", desc:"Fresh seasonal vegetables with dressing.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCfePX6AdI0cEWgyHGMQgzu9m6zUBdx_-Sg&s"},
      {name: "Steak", desc:"Grilled beef steak cooked to perfection.",price:"100", vegan:false, glutenFree:false, img:"https://www.simplyrecipes.com/thmb/P9H1SrWMXvlywbZ9-69aO0mD0JU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/simply-recipes-easy-steak-au-poivre-lead-1-7ea7ee649fb64401be483e698fc8bbd5.jpg"},
      {name: "Fruit Smoothie", desc:"Refreshing smoothie with mixed fruits.",price:"100", vegan:true, glutenFree:true, img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmeeRZTQlkrDCY8puiPWjp2jxkY9SSkVfsVw&s"},
      {name: "Pizza", desc:"Cheesy pizza with toppings of your choice.",price:"100", vegan:false, glutenFree:false, img:"https://www.allrecipes.com/thmb/aefJMDXKqs42oAP71dQuYf_-Qdc=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/6776_Pizza-Dough_ddmfs_4x3_1724-fd91f26e0bd6400a9e89c6866336532b.jpg"}
    ];

    let currentPage = 1;
    let itemsPerPage = 5;

    function renderMenu() {
      const veganFilter = document.getElementById("veganFilter").checked;
      const glutenFilter = document.getElementById("glutenFreeFilter").checked;

      let filtered = menuItems.filter(item => {
        if (veganFilter && !item.vegan) return false;
        if (glutenFilter && !item.glutenFree) return false;
        return true;
      });

      const start = (currentPage-1) * itemsPerPage;
      const end = start + itemsPerPage;
      const itemsToShow = filtered.slice(start, end);

     
      const menuList = document.getElementById("menuList");
      menuList.innerHTML = "";
      itemsToShow.forEach(item => {
        const div = document.createElement("div");
        div.className = "menu-item";
        div.innerHTML = `
          <img src="${item.img}" alt="${item.name}">
          <div class="menu-details">
            <h3>${item.name}</h3>
            <p>${item.desc}</p>
            <p>Price:${item.price} TK</p>
            <div class="tags">
              ${item.vegan ? "<span>Vegan</span>" : ""}
              ${item.glutenFree ? "<span class='gluten'>Gluten-Free</span>" : ""}
            </div>
          </div>
        `;
        menuList.appendChild(div);
      });

      
      const pageCount = Math.ceil(filtered.length / itemsPerPage);
      const pageButtons = document.getElementById("pageButtons");
      pageButtons.innerHTML = "";
      for(let i=1; i<=pageCount; i++){
        const btn = document.createElement("button");
        btn.textContent = i;
        if(i === currentPage) btn.style.backgroundColor = "lightgreen";
        btn.addEventListener("click", ()=>{ currentPage = i; renderMenu(); });
        pageButtons.appendChild(btn);
      }
    }

    

   
    renderMenu();
  </script>
</body>
</html>