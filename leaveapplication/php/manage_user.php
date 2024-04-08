<?php
session_start();
require_once('config.php');

// Check if user is logged in and has admin level
if (!isset($_SESSION["Login"]) || $_SESSION["LEVEL"] != 1) {
    header("Location: login.php"); // Redirect to the login page or any other desired page
    exit();
}

// Edit User
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
    $userId = $_POST["user_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $level = $_POST["level"];

    // Update user in the database
    $sql = "UPDATE user SET username = '$username', password = '$password', level = '$level' WHERE id = '$userId'";
    mysqli_query($conn, $sql);

    header("Location: manage_user.php");
    exit();
}

// Delete User
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
    $userId = $_POST["user_id"];

    // Delete user from the database
    $sql = "DELETE FROM user WHERE id = '$userId'";
    mysqli_query($conn, $sql);

    header("Location: manage_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Users</title>
  <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
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

  /* Content Styles */
  .content {
    margin-left: 240px; /* Adjust the margin to create space for the sidebar */
    padding: 20px;
    background-color: #f5f5f5;
    min-height: 100vh;
  }

  .user-table {
    width: 100%;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px; /* Add margin at the bottom to create space between the table and the following element */
  }

    .user-table th,
    .user-table td {
      padding: 10px;
      text-align: left;
      vertical-align: middle;
    }

    .user-table th {
      background-color: #f5f5f5;
      font-weight: bold;
    }

    .user-table td button {
      padding: 6px 12px;
      background-color: #dc3545;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .user-table td button:hover {
      background-color: #c82333;
    }

    .edit-user-form {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .edit-user-form input[type="text"],
    .edit-user-form input[type="password"],
    .edit-user-form select {
      width: 100%;
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .edit-user-form button[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 6px 12px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .edit-user-form button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .back-link {
      display: inline-block;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #0056b3;
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
    <h1>Manage Users</h1>
    <table class="user-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Password</th>
          <th>Level</th>
          <th>Actions</th>
          <th>View User Page</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['ID'];
            $username = $row['username'];
            $password = $row['password'];
            $level = $row['level']
            ?>
            <tr>
              <td><?php echo $userId; ?></td>
              <td><?php echo $username; ?></td>
              <td><?php echo $password; ?></td>
              <td><?php echo $level; ?></td>
              <td>
                <form class="edit-user-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                  <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                  <input type="text" name="username" value="<?php echo $username; ?>">
                  <input type="password" name="password" value="<?php echo $password; ?>">
                  <select name="level">
                    <option value="1" <?php if ($level == 1) echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if ($level == 2) echo 'selected'; ?>>Manager</option>
                    <option value="3" <?php if ($level == 3) echo 'selected'; ?>>Staff</option>
                    
                  </select>
                  <button type="submit" name="edit_user">Save</button>
                </form>
              </td>
              <td>
                <a href="view_userprofile.php?id=<?php echo $userId; ?>">View</a>
              </td>
              <td>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                  <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                  <button type="submit" name="delete_user">Delete</button>
                </form>
              </td>
            </tr>
            <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>

