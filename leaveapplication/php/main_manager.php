<!DOCTYPE html>
<html>
<head>
  <title>Manager Page for Leave Application Management</title>
  <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
  
</head>
<body>
  <div class="sidebar">
    <div class="profile">
      <img src="css/img/manager.png" alt="Profile Picture">
      <span class="admin-name">Manager</span>
    </div>
    <ul>
    <li><a href="MANAGER_profilepage.php"><i class="fas fa-user icon"></i>My Profile</a></li>
    <li class = submenu-item>
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
    <h1 class="page-title">Manager Page for Leave Application Management</h1>
  </div>
</body>

</html>
