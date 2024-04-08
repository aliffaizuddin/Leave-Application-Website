<?php
session_start(); // Start up your PHP Session
if ($_SESSION["Login"] != "YES") // If the user is not logged in or has been logged out
    header("Location: Login_loginpage.php");

if ($_SESSION["LEVEL"] != 3) { // Only users with access level 1 and 2 can view
?>

<html>
<head>
    <title>APPROVED LEAVE HISTORY</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }
        .sidebar {
      width: 200px;
      background-color: #00b4db;
      padding: 20px;
      position: fixed;
      height: 100%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
      top: 0; /* Extend sidebar to the top */
        }

        /* Table Styles */
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
            text-align: left;
            border:none;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
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
    <h1>APPROVED LEAVE HISTORY</h1>
    <h3>LEAVE HISTORY</h3>

    <?php
    require("config.php"); // Read up on PHP includes https://www.w3schools.com/php/php_includes.asp

    // Retrieve the applicationID from the database

    $sql = "SELECT * FROM application WHERE status = 'approved'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        ?>

        <!-- Start table tag -->
        <form name="form1" method="post" action="MANAGER_viewAll.php">
            <table width="600" border="1" cellspacing="0" cellpadding="3">

                <!-- Print table heading -->
                <tr>
                    <th><strong>ID</strong></th>
                    <th><strong>Username</strong></th>
                    <th><strong>leaveType</strong></th>
                    <th><strong>fromDate</strong></th>
                    <th><strong>UntilDate</strong></th>
                    <th><strong>Status</strong></th>
                </tr>

                <?php
                // Output data of each row
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr>
                        <td><?php echo $rows['applicationID']; ?></td>
                        <td><?php echo $rows['username']; ?></td>
                        <td><?php echo $rows['leaveType']; ?></td>
                        <td><?php echo $rows['fromDate']; ?></td>
                        <td><?php echo $rows['untilDate']; ?></td>
                        <td><?php echo $rows['status']; ?></td>

                    </tr>

                    <?php
                }

                ?>
            </table>
        </form>

        <?php
    } else {
        echo "<h3>There are no records to show</h3>";
    }

    mysqli_close($conn);
    ?>
    </table>

    <?php if ($_SESSION["LEVEL"] == 1) { ?>
        <br><br>
        <a href="student_form.php">Click here to insert student</a><?php } ?>

</div>
</body>
</html>

<?php
} // If the user is not correct level
else if ($_SESSION["LEVEL"] == 3) {

    echo "<p>Wrong User Level! You are not authorized to view this page</p>";


    echo "<p><a href='logout.php'>LOGOUT</a></p>";

}
?>
