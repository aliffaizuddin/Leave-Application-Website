<?php
require_once('config.php');

// Retrieve not approved leave forms from the database
$sql = "SELECT * FROM Application WHERE status = 'Not approved'";
$result = mysqli_query($conn, $sql);
$leaveForms = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Not Approved Leave Forms</title>
    <link rel="stylesheet" href="css/mainstyle.css">
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

        /* Table Styles */
        table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Adjustments */
        .content {
    margin-left: 240px; /* Adjust the margin to create space for the sidebar */
    padding: 20px;
    background-color: #f5f5f5;
    min-height: 100vh;
  }

        table {
            margin-bottom: 0; /* Remove margin-bottom to align with the top of the table */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <!-- Sidebar content -->
    <div class="profile">
        <img src="css/img/manager.png" alt="Profile Picture">
        <span class="admin-name">Manager</span>
    </div>
    <ul>
        <li><a href="MANAGER_profilepage.php"><i class="fas fa-user icon"></i>My Profile</a></li>
        <li class="submenu-item">
            <a href="MANAGER_viewAll.php"><i class="fas fa-clipboard icon"></i>All Leaves Application Form</a>
            <ul class="submenu">
                <li><a href="MANAGER_viewPending.php">Pending Leaves</a></li>
                <li><a href="MANAGER_viewApproved.php">Approved Leaves</a></li>
                <li><a href="MANAGER_viewnotApproved.php">Not Approved Leaves</a></li>
            </ul>
        </li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
    </ul>
    <div class="notification-bell">
        <i class="fas fa-bell icon"></i>
    </div>
</div>
<div class="content">
    <h1>NOT APPROVED LEAVE HISTORY</h1>
    <h3>LEAVE HISTORY</h3>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Leave Type</th>
            <th>From Date</th>
            <th>Until Date</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($leaveForms as $leaveForm) : ?>
            <tr>
                <td><?php echo $leaveForm["applicationID"]; ?></td>
                <td><?php echo $leaveForm["username"]; ?></td>
                <td><?php echo $leaveForm["leaveType"]; ?></td>
                <td><?php echo $leaveForm["fromDate"]; ?></td>
                <td><?php echo $leaveForm["untilDate"]; ?></td>
                <td><?php echo $leaveForm["description"]; ?></td>
                <td><?php echo $leaveForm["status"]; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
