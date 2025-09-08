<?php
  session_start();
  if (isset($_REQUEST['error'])) {
      if ($_REQUEST['error'] == "name") {
          echo "<p style='color:red'>Name is required</p>";
      } elseif ($_REQUEST['error'] == "phone") {
          echo "<p style='color:red'>Valid 11-digit phone required</p>";
      } elseif ($_REQUEST['error'] == "date") {
          echo "<p style='color:red'>Date is required</p>";
      } elseif ($_REQUEST['error'] == "time") {
          echo "<p style='color:red'>Time is required</p>";
      } elseif ($_REQUEST['error'] == "people") {
          echo "<p style='color:red'>Number of people is required</p>";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Table Reservation</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background:#f8f9fa; justify-items: center;}
    h1 { color: darkgreen; text-align: center; }
    .form-container {
      border: 1px solid #ccc;
      background: white;
      padding: 15px;
      border-radius: 8px;
      width: 350px;
    }
    label { margin-top: 8px; font-weight:bold; }
    input, select, textarea { width:95%; padding:6px; margin-top:4px; }
    button { margin-top:10px; padding:8px 15px; cursor:pointer; }
    .error { color:red; font-size:12px; }
    .success { color:green; margin-top:10px; }
  </style>


</head>



<body>
  <h1>Reserve Your Table</h1>
  <div class="form-container">
    <form id="treserve" action="../controller/tableCusValidation.php" method="post">
      <label>Name:</label>
    <input type="text" id="custName" name="custName">
    <div class="error" id="nameError"></div>

    <label>Phone:</label>
    <input type="text" id="custPhone" name="custPhone" maxlength="11">
    <div class="error" id="phoneError"></div>

    <label>Date:</label>
    <input type="date" id="custDate" name="custDate">
    <div class="error" id="dateError"></div>

    <label>Time:</label>
    <input type="time" id="custTime" name="custTime">
    <div class="error" id="timeError"></div>

    <label>Number of People:</label>
    <select id="custPeople" name="custPeople">
      <option value="">Select</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6+</option>
    </select>
    <div class="error" id="peopleError"></div>

    <label>Special Request:</label>
    <textarea id="custRequest"></textarea>

    <div style="text-align: center;"><button type="submit">Reserve</button></div>
    <div id="successMsg" class="success"></div>
    </form>


     <script>
    function validateForm(name,phone,date,time,people){
      let valid=true;
      document.getElementById("nameError").textContent="";
      document.getElementById("phoneError").textContent="";
      document.getElementById("dateError").textContent="";
      document.getElementById("timeError").textContent="";
      document.getElementById("peopleError").textContent="";

      if(name.trim()==="")
      { document.getElementById("nameError").textContent="Name required"; valid=false; }
     if (phone.length !== 11 || isNaN(phone)) {
  document.getElementById("phoneError").textContent = "Valid 11-digit phone required";
  valid = false;
}
      if(date===""){ document.getElementById("dateError").textContent="Select date"; valid=false; }
      if(time===""){ document.getElementById("timeError").textContent="Select time"; valid=false; }
      if(people===""){ document.getElementById("peopleError").textContent="Select number of people"; valid=false; }
      return valid;
    }

    document.getElementById("treserve").addEventListener("submit", function(e){
      const name=document.getElementById("custName").value;
      const phone=document.getElementById("custPhone").value;
      const date=document.getElementById("custDate").value;
      const time=document.getElementById("custTime").value;
      const people=document.getElementById("custPeople").value;
      const req=document.getElementById("custRequest").value;

      if(!validateForm(name,phone,date,time,people)) 
         e.preventDefault();
    
  });


    
    document.getElementById("custName").addEventListener("input", function() {
      if(this.value.trim() === "") document.getElementById("nameError").textContent="Name required";
      else document.getElementById("nameError").textContent="";
    });

    document.getElementById("custPhone").addEventListener("input", function() {
      if (this.value.length !== 11 || isNaN(phone)) {
  document.getElementById("phoneError").textContent = "Valid 11-digit phone required";
  
}

      if(this.value.length === 11)
      {document.getElementById("phoneError").textContent="";}
    });

    document.getElementById("custDate").addEventListener("change", function() {
      if(this.value !== "") document.getElementById("dateError").textContent="";
    });

    document.getElementById("custTime").addEventListener("change", function() {
      if(this.value !== "") document.getElementById("timeError").textContent="";
    });

    document.getElementById("custPeople").addEventListener("change", function() {
      if(this.value !== "") document.getElementById("peopleError").textContent="";
    });
  </script>
</body>
</html>