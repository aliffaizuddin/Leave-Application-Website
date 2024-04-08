<!DOCTYPE html>
<html>
<head>
  <title>Admin Page for Leave Application Management</title>
  <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
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
    <li class="sign-out"><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
  </ul>
  <div class="notification-bell">
    <i class="fas fa-bell icon"></i>
  </div>
  </div>
  <div class="content">
    <h1 class="page-title">Admin Page for Leave Application Management</h1>
    <!-- Content of the admin page goes here -->
  </div>
</body>
</html>
