<?php
session_start();

// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: Login_loginpage.php");
    exit();
}

// Check if the user has the correct level
if ($_SESSION["LEVEL"] == 3) {

    require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

    // Retrieve the applicationID from the database
    $username = $_SESSION["USER"];
    $sql = "SELECT * FROM application WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {    
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Leave Application Status for <?php echo $username; ?></title>
            <link rel="stylesheet" href="css/mainstyle.css">
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
            <!-- Sidebar content -->
            <div class="profile">
                <img src="css/img/staff.jpg" alt="Profile Picture">
                <span class="admin-name"><?php echo $username; ?></span>
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
            <h1>Leave Application Status for <?php echo $username; ?></h1>
            <table>
                <tr>
                    <th>Leave Type</th>
                    <th>Status</th>
                </tr>
                <?php
                // Fetch and display each leave application
                while ($row = mysqli_fetch_assoc($result)) {
                    $leaveType = $row["leaveType"];
                    $status = $row["status"];
                    ?>
                    <tr>
                        <td><?php echo $leaveType; ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>No leave applications found for $username</p>";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the user is not at the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='main.php'>Go back to main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>
