<?php
require_once("config.php");

// Function to fetch dashboard data from the database
function fetchDashboardData($conn, $status) {
  $sql = "SELECT COUNT(*) AS totalApplications FROM application";

  if ($status !== 'all') {
    $sql .= " WHERE status = '$status'";
  }

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalApplications = $row['totalApplications'];
    return $totalApplications;
  } else {
    return 0;
  }
}

// Fetch dashboard data for different statuses
$totalApplications = fetchDashboardData($conn, 'all');
$totalApproved = fetchDashboardData($conn, 'approved');
$totalNotApproved = fetchDashboardData($conn, 'Not Approved');
$totalWaiting = fetchDashboardData($conn, 'Waiting to be Approved');

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Page for Leave Application Management</title>
  <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Existing CSS styles */

    /* ... */

    /* New styles for the dashboard functionality */
    .dashboard-section {
      margin-top: 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .dashboard-item {
      background-color: #005ca9;
      border-radius: 4px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: calc(50% - 10px);
      max-width: 300px;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      height: 200px; /* Set a fixed height for all boxes */
    }

    .dashboard-item h3 {
      font-size: 20px;
      margin-top: 0;
      margin-bottom: 5px;
      line-height: 1.2;
    }

    .dashboard-item p {
      font-size: 72px;
      margin: 0;
      font-weight: bold;
      line-height: 1;
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
    <h1 class="page-title">Admin Page for Leave Application Management</h1>
    <!-- Content of the admin page goes here -->
    <div class="dashboard-section">
      <div class="dashboard-item">
        <h3>Total Applications</h3>
        <p><?php echo $totalApplications; ?></p>
      </div>
      <div class="dashboard-item">
        <h3>Total Approved Applications</h3>
        <p><?php echo $totalApproved; ?></p>
      </div>
    </div>
    <div class="dashboard-section">
      <div class="dashboard-item">
        <h3>Total Applications with Status 'Not Approved'</h3>
        <p><?php echo $totalNotApproved; ?></p>
      </div>
      <div class="dashboard-item">
        <h3>Total Applications with Status 'Waiting to be Approved'</h3>
        <p><?php echo $totalWaiting; ?></p>
      </div>
    </div>

  </div>
</body>
</html>