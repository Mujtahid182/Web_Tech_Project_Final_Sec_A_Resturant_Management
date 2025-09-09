<?php
  session_start();
  if (isset($_REQUEST['error'])) {
      if ($_REQUEST['error'] == "name") {
          echo "<p style='color:red'>Valid Name is required</p>";
      
      } elseif ($_REQUEST['error'] == "people") {
          echo "<p style='color:red'>Number of people is required</p>";
      } elseif ($_REQUEST['error'] == "table") {
          echo "<p style='color:red'>Select Table</p>";
      } elseif ($_REQUEST['error'] == "success") {
          echo "<p style='color:red'>Success</p>";
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hostess Reservation Manager</title>


<style>
  body { font-family: Arial, sans-serif; margin:20px; background:#f8f9fa;}
  h1 { text-align:center; color: darkblue; }


  .form-container { background:white; padding:15px; border-radius:8px; width:400px; 
    margin-bottom:20px; }
  label { display:block; margin-top:10px; font-weight:bold; }


  input, select { width:95%; padding:6px; margin-top:4px; }


  button { margin-top:10px; padding:6px 12px; cursor:pointer; }
  .error { color:red; font-size:12px; }
  .assigned-list, .waitlist { margin-top:20px; }
  table { width:100%; border-collapse:collapse; }
  th, td { border:1px solid #ccc; padding:8px; text-align:center; }
</style>


</head>



<body>
  
<h1>Hostess Reservation Manager</h1>

<form id="tableForm" action="../controller/tableHostValidation.php" method="post">
<div class="form-container">
  <h3>Assign Table</h3>
  
  <label>Name:</label>
  <input type="text" id="custName" name="cstName">
  <div class="error" id="nameError"></div>

  <label>Number of People:</label>
  <input type="number" id="custPeople" name="cstPeople" min="1">
  <div class="error" id="peopleError"></div>

  <label>Table Number:</label>
  <select id="tableSelect" name="tableSelect">
    <option value="">Select Table</option>
    <option>1</option><option>2</option><option>3</option>
    <option>4</option><option>5</option><option>6</option>
  </select>
  <div class="error" id="tableError"></div>

  <button type="submit" id="assignBtn">Assign Table</button>
</div>
</form>

<div class="assigned-list">
  <h3>Assigned Tables</h3>
  <table id="assignedTable">
    <tr>
      <th>Table</th><th>Name</th><th>People</th><th>Action</th>
    </tr>
    <tr><td>1</td><td id="a1"></td><td id="p1"></td><td><button data-table="1" class="freeBtn">Free</button></td></tr>
    <tr><td>2</td><td id="a2"></td><td id="p2"></td><td><button data-table="2" class="freeBtn">Free</button></td></tr>
    <tr><td>3</td><td id="a3"></td><td id="p3"></td><td><button data-table="3" class="freeBtn">Free</button></td></tr>
    <tr><td>4</td><td id="a4"></td><td id="p4"></td><td><button data-table="4" class="freeBtn">Free</button></td></tr>
    <tr><td>5</td><td id="a5"></td><td id="p5"></td><td><button data-table="5" class="freeBtn">Free</button></td></tr>
    <tr><td>6</td><td id="a6"></td><td id="p6"></td><td><button data-table="6" class="freeBtn">Free</button></td></tr>
  </table>
</div>

<div class="waitlist">
  <h3>Waitlist</h3>
  <table id="waitlistTable">
    <tr>
      <th>Table</th><th>Name</th><th>People</th><th>Approve</th><th>Delete</th>
    </tr>
  </table>
</div>









<script>
  const assignedTables = [
  { name: "A", people: 2 },   
  null,                           
  { name: "B", people: 4 },     
  null,                            
  null,                            
  { name: "C", people: 3 }  
];


let waitlist = [
  { table: 2, name: "D", people: 2 },
  { table: 4, name: "E", people: 3 },
  { table: 5, name: "F", people: 2 }
];

  const nameInput = document.getElementById("custName");
  const peopleInput = document.getElementById("custPeople");
  const tableSelect = document.getElementById("tableSelect");


 document.getElementById("custName").addEventListener("input", function() {
  let allowed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
  let value = this.value;
  let errorMsg = "";

  for (let i = 0; i < value.length; i++) {
    if (!allowed.includes(value[i])) {
      errorMsg = "Symbols and numbers are not allowed in name";
      break;
    }
  }

  if (value.trim() === "") {
    errorMsg = "Name required";
  }

  document.getElementById("nameError").textContent = errorMsg;
});

  peopleInput.addEventListener("input", ()=> {
    if(peopleInput.value<1) document.getElementById("peopleError").textContent="Enter valid number of people";
    else document.getElementById("peopleError").textContent="";
  });

  tableSelect.addEventListener("change", ()=> {
    if(tableSelect.value==="") document.getElementById("tableError").textContent="Select table number";
    else document.getElementById("tableError").textContent="";
  });

  
  document.getElementById("assignBtn").addEventListener("click", (e) => {
  

  const name = nameInput.value.trim();
  const people = parseInt(peopleInput.value);
  const tableNo = parseInt(tableSelect.value);

      let allowed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";

  let valid = true;
  if (name.trim() === "") {
    document.getElementById("nameError").textContent = "Name required";
    valid = false;
  } else {
    for (let i = 0; i < name.length; i++) {
      if (!allowed.includes(name[i])) {
        document.getElementById("nameError").textContent = "Symbols and numbers are not allowed in name";
        valid = false;
        break; 
      }
    }
  }
  if (isNaN(people) || people < 1) {
    document.getElementById("peopleError").textContent = "Enter valid number of people";
    valid = false;
  }
  if (isNaN(tableNo)) {
    document.getElementById("tableError").textContent = "Select table number";
    valid = false;
  }
  if (!valid){
    e.preventDefault();
    return;}

  renderAssigned();
  renderWaitlist();
  nameInput.value = "";
  peopleInput.value = "";
  tableSelect.value = "";
});


  function renderAssigned(){
    for(let i=0;i<6;i++){
      const a=document.getElementById("a"+(i+1));
      const p=document.getElementById("p"+(i+1));
      if(assignedTables[i]){
        a.textContent = assignedTables[i].name;
        p.textContent = assignedTables[i].people;
      } else {
        a.textContent=""; p.textContent="";
      }
    }
  }

  function renderWaitlist(){
    const table = document.getElementById("waitlistTable");
    table.innerHTML="<tr><th>Table</th><th>Name</th><th>People</th><th>Approve</th><th>Delete</th></tr>";
    waitlist.forEach((w,index)=>{
      const tr=document.createElement("tr");
      tr.innerHTML=`<td>${w.table}</td><td>${w.name}</td><td>${w.people}</td>
        <td><button data-index="${index}" class="approveBtn">Approve</button></td>
        <td><button data-index="${index}" class="deleteBtn">Delete</button></td>`;
      table.appendChild(tr);
    });

   

  
  }

 

  renderAssigned();
  renderWaitlist();
</script>
</body>
</html>

