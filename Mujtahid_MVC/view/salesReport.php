<?php


session_start();
$_SESSION["status"] = true;
// session_destroy();
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=invalid_user");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Reports | Restaurant Management System</title>
    <link rel="stylesheet" href="../assets/css/salesReport.css">
</head>
<body>
    <div class="container">
        <h1>Sales Reports</h1>

       
        <div class="filter-section">
            <select id="reportType">
                <option>Daily Report</option>
                <option>Weekly Report</option>
                <option>Monthly Report</option>
            </select>
            <select id="dateRange">
                <option>This Week</option>
                <option>Last Week</option>
                <option>This Month</option>
                <option>Last Month</option>
            </select>
            <button onclick="applyFilter()">Apply Filter</button>
        </div>

    
        <div class="report-card">
            <h2>Performance Dashboard</h2>
            <div class="chart-placeholder">
            Year-over-Year Sales Trend Graph Not Available.......
            </div>
            <table>
                <tr>
                    <th>Period</th>
                    <th>Total Sales</th>
                    <th>Orders</th>
                    <th>Avg. Order Value</th>
                </tr>
                <tr>
                    <td>This Week</td>
                    <td>Taka 8,750</td>
                    <td>312</td>
                    <td>Taka 28.05</td>
                </tr>
                <tr>
                    <td>Last Week</td>
                    <td>Taka 7,920</td>
                    <td>285</td>
                    <td>Taka 27.79</td>
                </tr>
            </table>
        </div>

     
        <div class="report-card">
            <h2>Top Selling Items</h2>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Units Sold</th>
                    <th>Revenue</th>
                </tr>
                <tr>
                    <td>Burger</td>
                    <td>Main Course</td>
                    <td>89</td>
                    <td>Taka 1,156.11</td>
                </tr>
                <tr>
                    <td>Pizza</td>
                    <td>Main Course</td>
                    <td>76</td>
                    <td>Taka 1,214.44</td>
                </tr>
                <tr>
                    <td>Salad</td>
                    <td>Appetizer</td>
                    <td>68</td>
                    <td>Taka 679.32</td>
                </tr>
                <tr>
                    <td>Coke</td>
                    <td>Beverage</td>
                    <td>124</td>
                    <td>Taka 372.00</td>
                </tr>
            </table>
        </div>

      
        <div class="report-card">
            <h2>Labor Cost vs. Sales</h2>
            <div class="chart-placeholder">
            Labor Cost vs. Sales Graph Not Available.......
            </div>
            <table>
                <tr>
                    <th>Staff</th>
                    <th>Hours Worked</th>
                    <th>Labor Cost</th>
                    <th>Sales Generated</th>
                </tr>
                <tr>
                    <td>Rohim (Chef)</td>
                    <td>45</td>
                    <td>Taka 1,125</td>
                    <td>Taka 3,200</td>
                </tr>
                <tr>
                    <td>Korim(Server)</td>
                    <td>38</td>
                    <td>Taka 760</td>
                    <td>Taka 2,100</td>
                </tr>
            </table>
        </div>

   
        <div class="export-section">
            <button onclick="exportCSV()">Export CSV</button>
            <button onclick="exportPDF()">Export PDF</button>
        </div>
    </div>

    <script>
      
        function applyFilter() {
            alert("Filter applied. Report updated.");
        }

       
        function exportCSV() {
            alert("Report exported as CSV.");
        }

     
        function exportPDF() {
            alert("Report exported as PDF.");
        }
    </script>
</body>
</html>