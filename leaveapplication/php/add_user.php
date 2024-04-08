<?php
session_start();
require_once('config.php');

// Check if user is logged in and has admin level
if (!isset($_SESSION["Login"]) || $_SESSION["LEVEL"] != 1) {
    header("Location: Login_loginpage.php"); 
    exit();
}

// Add User
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $level = $_POST["level"];

    // Insert user into the database
    $sql = "INSERT INTO user (username, password, level) VALUES ('$username', '$password', '$level')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_user.php
        header("Location: manage_user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <style>
    /* General Styles */
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      background-color: #f8f9fa;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 200px;
      background-color: #00b4db;
      padding: 20px;
      position: fixed;
      height: 100%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .profile {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .profile img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .admin-name {
      font-size: 18px;
      font-weight: bold;
      color: #fff;
    }

    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    ul li {
      margin-bottom: 10px;
    }

    ul li a {
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      font-size: 16px;
    }

    .icon {
      margin-right: 10px;
    }

    .submenu {
      display: none;
      padding-left: 30px;
      margin-top: 5px;
      background-color: ##00b4db;
      border-radius: 4px;
    }

    .submenu-item:hover .submenu {
      display: block;
    }

    .notification-bell {
      position: absolute;
      bottom: 20px;
      left: 20px;
    }

    .content {
      margin-left: 200px;
      padding: 20px;
      background-image: url("img/mountains2.jpg");
      min-height: 100vh;
    }

    /* Add User Form Styles */
    .add-user-form {
      margin: auto;
      margin-top: 200px;
      max-width: 500px;
      
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      text-align: center; /* Center the container horizontally */
      
    }

    .add-user-form h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .add-user-form table {
      width: 100%;
      margin-bottom: 20px;
    }

    .add-user-form th,
    .add-user-form td {
      padding: 10px;
      text-align: left;
      vertical-align: middle;
    }

    .add-user-form th {
      width: 100px;
    }

    .add-user-form input[type="text"],
    .add-user-form input[type="password"],
    .add-user-form select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    .add-user-form button[type="submit"] {
      padding: 12px 24px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .add-user-form button[type="submit"]:hover {
      background-color: #0056b3;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: static;
        box-shadow: none;
        padding-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <!-- Sidebar content -->
    <div class="profile">
      <img src="css/img/admin.png" alt="Profile Picture">
      <span class="admin-name">Admin</span>
    </div>
    <ul>
      <li><a href="ADMIN_profilepage.php"><i class="fas fa-user icon"></i>My Profile</a></li>
      <li><a href="Dashboard.php"><i class="fas fa-chart-line icon"></i>Dashboard</a></li>
      <li class="submenu-item">
        <a href="#staff"><i class="fas fa-users icon"></i>User</a>
        <ul class="submenu">
          <li><a href="add_user.php">Add User</a></li>
          <li><a href="manage_user.php">Manage User</a></li>
        </ul>
      </li>
      <li class="submenu-item">
        <a href="#"><i class="fas fa-calendar-alt icon"></i>Leave Management</a>
        <ul class="submenu">
          <li><a href="all_leaves.php">All Leaves</a></li>
          <li><a href="pending_leaves.php">Pending Leaves</a></li>
          <li><a href="approved_leaves.php">Approved Leaves</a></li>
          <li><a href="not_approved_leaves.php">Not Approved Leaves</a></li>
        </ul>
      </li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
    </ul>
    <div class="notification-bell">
      <i class="fas fa-bell icon"></i>
    </div>
  </div>
  <div class="content">
    <div class="add-user-form">
      <h1>Add User</h1>
      <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="text-align: center;">
        <table>
          <tr>
            <th>Username:</th>
            <td><input type="text" id="username" name="username" required></td>
          </tr>
          <tr>
            <th>Password:</th>
            <td><input type="password" id="password" name="password" required></td>
          </tr>
          <tr>
            <th>Level:</th>
            <td>
              <select id="level" name="level">
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Staff</option>
              </select>
            </td>
          </tr>
        </table>
        <button type="submit" name="add_user">Add User</button>
      </form>
    </div>
  </div>
</body>
</html>
