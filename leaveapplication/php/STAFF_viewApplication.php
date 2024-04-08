<?php
session_start();

// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: Login_loginpage.php");
    exit();
}

// Retrieve the username of the logged-in user
if (isset($_SESSION["USER"])) {
    $username = $_SESSION["USER"];
} else {
    // Handle the case when 'username' key is not set in the session
    // Redirect the user to the login page or display an error message
    header("Location: Login_loginpage.php");
    exit();
}

require("config.php"); // Include the database configuration

// Retrieve the application data for the logged-in user
$sql = "SELECT * FROM application WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>All Leave Application</title>
    <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
    <style>
      table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            border:none;
            margin-bottom: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border:none;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
        background-color: #f2f2f2;

        }
        table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Adjustments */
        .content {
            margin-left: 240px; /* Adjusted to account for sidebar width */
        }
    </style>
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
                    <li><a href="STAFF_viewstatus.php">Status Leave Application</a></li>
                </ul>
            </li>
            <li><a href="STAFF_viewApplication.php"><i class="fas fa-eye icon"></i>View All Leave Application</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
        </ul>
        <div class="notification-bell">
            <i class="fas fa-bell icon"></i>
        </div>
    </div>

    <div class="content">
        <h1 class="page-title">All Leave Application</h1>
        <table>
            <tr>
                <th>Application ID</th>
                <th>Leave Type</th>
                <th>Description/reason</th>
            </tr>
            <?php
            // Fetch and display each leave application for the logged-in user
            while ($row = mysqli_fetch_assoc($result)) {
                $applicationID = $row["applicationID"];
                $leaveType = $row["leaveType"];
                $description = $row["description"];
            ?>
            <tr>
                <td><?php echo $applicationID; ?></td>
                <td><?php echo $leaveType; ?></td>
                <td><?php echo $description; ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
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

<?php
// Close the database connection
mysqli_close($conn);
?>
