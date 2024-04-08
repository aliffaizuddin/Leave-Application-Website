<!DOCTYPE html>
<html>
<head>
  <title>Staff Page for Leave Application Management</title>
  <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">-->
</head>
<body>
  <div class="sidebar">
    <div class="profile">
      <img src="css/img/staff.jpg" alt="Profile Picture">
      <span class="admin-name">Staff</span>
    </div>
    <ul>
    <li><a href="STAFF_profilepage.php"><i class="fas fa-user icon"></i>My Profile</a></li>
        <li class="submenu-item">
        <a href="STAFF_staff_form.php"><i class="fas fa-calendar-alt icon"></i>Leave Application</a>
        <ul class="submenu">
          <li><a href="STAFF_staff_form.php">Leave Application Form</a></li>
          <li><a href="STAFF_viewApplication.php">View All Leave Application</a></li>
        </ul>
      </li>
      <li><a href="STAFF_viewstatus.php"><i class="fas fa-eye icon"></i>Status Leave Application</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
    </ul>
    <div class="notification-bell">
      <i class="fas fa-bell icon"></i>
    </div>
  </div>
  <div class="content">
    <h1 class="page-title">Staff Page for Leave Application Management</h1>
    <!-- Content of the staff page goes here -->
  </div>

  <script>
  // Toggle submenu display
  var submenuItem = document.querySelector('.submenu-item');
  var submenu = submenuItem.querySelector('.submenu');

  submenuItem.addEventListener('click', function(e) {
    e.preventDefault();
    submenu.classList.toggle('active');
  });

  submenu.addEventListener('click', function(e) {
    e.stopPropagation();
  });

  document.addEventListener('click', function() {
    submenu.classList.remove('active');
  });
  </script>

</body>
</html>
