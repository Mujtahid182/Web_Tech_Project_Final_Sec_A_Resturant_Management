<?php
session_start();
if(!isset($_SESSION['currentUser'])){
    header("Location: index.php?msg=Please login first");
    exit;
}
$user = $_SESSION['currentUser'];
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
/* === Previous CSS from your original dashboard === */
body {
    font-family: Arial,
     sans-serif;
     background-color: #f0f2f5;
     margin: 0;
     padding: 20px;
     color: #333;
    }
.container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
h1,h2,h3,h4{
    color:#2c3e50;
    text-align:center;
}
.dashboard-cards{display:flex;
    flex-wrap:wrap;
    gap:20px;
    margin-top:20px;
}
.card{
    flex:1;
    min-width:200px;
    background:#f8f9fa;
    padding:15px;
    border-radius:8px;
    border-left:4px solid #3498db;
}
.admin-section{
    background:#fff3e0;
    padding:15px;
    border-radius:8px;
    margin-top:20px;
    border:1px solid #ffcc80;
}
.user-list{
    list-style:none;
    padding:0;
}
.user-list li{
    padding:10px;
    border-bottom:1px solid #eee;
    display:flex;
    justify-content:space-between;
}
.admin-badge{
    background:#e74c3c;
    color:white;
    padding:3px 8px;
    border-radius:10px;
    font-size:12px;
    margin-left:10px;
}
.form-group
{
    margin-bottom:15px;
}
label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}
input[type=text],input[type=email],input[type=password],textarea,select{
    width:100%;
    padding:10px;
    border:1px solid #ddd;
    border-radius:4px;
    font-size:16px;
}
button{
    background-color:blueviolet;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:4px;
    cursor:pointer;
    font-size:16px;
    width:100%;margin-top:10px;
}
button:hover{
    background-color:#2980b9;
}
.nav{
    display:flex;
    justify-content:center;
    margin:20px 0;
    flex-wrap:wrap;
}
.nav a{
    margin:5px 10px;
    color:#3498db;
    text-decoration:none;
}
.nav a:hover{
    text-decoration:underline;
    }
</style>
</head>
<body>
<div class="container">
<h1>Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($user['username']); ?> <span class="admin-badge"><?php echo $user['role']=='admin'?'Admin':'';?></span></p>

<div class="dashboard-cards">
<div class="card">
<h3>Profile</h3>
<p>Update your personal information</p>
<form method="POST" action="update_profile.php">
    <input type="hidden" name="old_email" value="<?php echo $user['email']; ?>">
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>">
    </div>
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">
    </div>
    <button type="submit">Update Profile</button>
</form>
</div>

<div class="card">
<h3>Security</h3>
<p>Change your password</p>
<form method="POST" action="change_password.php">
    <div class="form-group">
        <label>Current Password</label>
        <input type="password" name="old_password">
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new_password">
    </div>
    <button type="submit">Change Password</button>
</form>
</div>

<div class="card">
<h3>Contact</h3>
<p>Send us a message</p>
<form id="contactForm">
<div class="form-group">
    <textarea id="c_message" rows="5" placeholder="Type your message here..."></textarea>
</div>
<button type="submit">Send Message</button>
</form>
</div>
</div>

<!-- Admin Section -->
<?php if($user['role']=='admin'): ?>
<div class="admin-section">
<h3>Admin Panel</h3>
<h4>User List</h4>
<ul class="user-list">
<?php foreach($_SESSION['users'] as $u): ?>
<li><?php echo $u['username'].' ('.$u['email'].') - '.$u['role'];?></li>
<?php endforeach;?>
</ul>
</div>
<?php endif;?>

<div class="nav">
<a href="logout.php">Logout</a>
</div>
</div>

<script>
// Show popup alert if message exists
<?php if($msg): ?>
alert("<?php echo addslashes($msg); ?>");
<?php endif; ?>

// Contact form JS alert
document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();
    const msg = document.getElementById('c_message').value.trim();
    if(msg===''){ alert('Please enter a message'); return; }
    alert('Message sent: '+msg);
    document.getElementById('c_message').value='';
});
</script>
</body>
</html>
