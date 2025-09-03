<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Schedule</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  h2 { margin-top: 30px; }
  table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
  th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
  th { background: #f4f4f4; }
  input[type=number] { width: 50px; }
  input[type=text], select { width: 120px; }
  .btn { padding: 5px 10px; margin: 2px; cursor: pointer; }
  .clocked-in { background: green; color: white; }
  .clocked-out { background: red; color: white; }
  .error { color: red; font-size: 0.9em; margin-top: 2px; }
</style>
</head>
<body>

<h1>Employee Schedule</h1>


<h2>Set Availability</h2>
<table>
  <tr>
    <th>Day</th>
    <th>Available Hours</th>
  </tr>
  <tr>
    <td>Mon</td>
    <td>
      <input type="number" id="avail-mon" min="0" max="24">
      <div class="error" id="error-mon"></div>
    </td>
  </tr>
  <tr>
    <td>Tue</td>
    <td>
      <input type="number" id="avail-tue" min="0" max="24">
      <div class="error" id="error-tue"></div>
    </td>
  </tr>
  <tr>
    <td>Wed</td>
    <td>
      <input type="number" id="avail-wed" min="0" max="24">
      <div class="error" id="error-wed"></div>
    </td>
  </tr>
  <tr>
    <td>Thu</td>
    <td>
      <input type="number" id="avail-thu" min="0" max="24">
      <div class="error" id="error-thu"></div>
    </td>
  </tr>
  <tr>
    <td>Fri</td>
    <td>
      <input type="number" id="avail-fri" min="0" max="24">
      <div class="error" id="error-fri"></div>
    </td>
  </tr>
  <tr>
    <td>Sat</td>
    <td>
      <input type="number" id="avail-sat" min="0" max="24">
      <div class="error" id="error-sat"></div>
    </td>
  </tr>
  <tr>
    <td>Sun</td>
    <td>
      <input type="number" id="avail-sun" min="0" max="24">
      <div class="error" id="error-sun"></div>
    </td>
  </tr>
</table>
<button class="btn" onclick="saveAvailability()">Save Availability</button>

<p id="availability-msg" style="color:green;"></p>


<h2>Requests</h2>
<form id="requestForm">
  <label>Request Type:
    <select id="requestType">
      <option value="timeoff">Time-Off</option>
      <option value="swap">Shift Swap</option>
    </select>
  </label>
  <label>Day:
    <select id="requestDay">
      <option value="Mon">Mon</option>
      <option value="Tue">Tue</option>
      <option value="Wed">Wed</option>
      <option value="Thu">Thu</option>
      <option value="Fri">Fri</option>
      <option value="Sat">Sat</option>
      <option value="Sun">Sun</option>
    </select>
  </label>
  <label>Details: <input type="text" id="requestDetails" placeholder="Reason or swap info"></label>
  <button type="submit" class="btn">Submit Request</button>
</form>
<p id="request-msg" style="color:green;"></p>



<h2>Clock In/Out</h2>
<button class="btn clock-btn" id="clockBtn" onclick="toggleClock()">Clock In</button>
<p id="clockStatus">Currently clocked out.</p>

<script>
  
  function saveAvailability() {
    let valid = true;
    const days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
    const avail = {};
    days.forEach(day => {
      const value = document.getElementById("avail-" + day.toLowerCase()).value;
      if(value === "" || value < 0 || value > 24){
        document.getElementById("error-" + day.toLowerCase()).textContent = "Enter 0-24 hours.";
        valid = false;
      } else {
        document.getElementById("error-" + day.toLowerCase()).textContent = "";
        avail[day] = value;
      }
    });

    if(!valid) return;

    localStorage.setItem("employeeAvailability", JSON.stringify(avail));
    document.getElementById("availability-msg").textContent = "Availability saved!";
  }


  const availabilityInputs = document.querySelectorAll('input[type=number]');
  availabilityInputs.forEach(input => {
    input.addEventListener('input', () => {
      const value = input.value;
      const errorDiv = document.getElementById("error-" + input.id.split('-')[1]);
      if(value === "" || value < 0 || value > 24){
        errorDiv.textContent = "Enter 0-24 hours.";
      } else {
        errorDiv.textContent = "";
      }
    });
  });

 


  let clockedIn = false;
  function toggleClock() {
    clockedIn = !clockedIn;
    const btn = document.getElementById("clockBtn");
    const status = document.getElementById("clockStatus");
    if(clockedIn){
      btn.textContent = "Clock Out";
      btn.classList.add("clocked-in");
      btn.classList.remove("clocked-out");
      status.textContent = "Currently clocked in.";
    } else {
      btn.textContent = "Clock In";
      btn.classList.add("clocked-out");
      btn.classList.remove("clocked-in");
      status.textContent = "Currently clocked out.";
    }
  }
</script>

</body>
</html>

