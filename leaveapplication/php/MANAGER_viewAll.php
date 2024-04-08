<?php
session_start();

require_once("config.php");

if ($_SESSION["Login"] != "YES") {
    header("Location: Login_loginpage.php");
    exit();
}

if ($_SESSION["LEVEL"] != 2) {
    header("Location: main_manager.php");
    exit();
}

$searchKeyword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])) {
    if (isset($_POST["searchKeyword"])) {
        $searchKeyword = $_POST["searchKeyword"];
    }

    if (isset($_POST["applicationID"]) && isset($_POST["status"])) {
        $applicationID = $_POST["applicationID"];
        $status = $_POST["status"];

        // Update the status in the database
        $updateSql = "UPDATE application SET status = '$status' WHERE applicationID = '$applicationID'";

        if (mysqli_query($conn, $updateSql)) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    }
}

$sql = "SELECT * FROM application";

if (!empty($searchKeyword)) {
    $sql .= " WHERE username LIKE '%$searchKeyword%'";
}

$result = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>All Leave History</title>
    <link rel="stylesheet" href="css/mainstyle.css">
    <style>
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
        h1{
            margin-top: 20px;

        }
        h3 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #ddd;
        }

        input[type="text"],
        select {
            padding: 5px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #4CAF50;
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
    <li class = submenu-item>
        <a href="MANAGER_viewAll.php"><i class="fas fa-clipboard icon"></i>All Leaves Application Form</a>
        <ul class="submenu">
          <li><a href="MANAGER_viewPending.php">Pending Leaves</a></li>
          <li><a href="MANAGER_viewApproved.php">Approved Leaves</a></li>
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
    <h1>All Leave History</h1>
    <h3>Leave History</h3>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="searchKeyword" placeholder="Search by username" value="<?php echo $searchKeyword; ?>">
        <input type="submit" name="Submit" value="Search">
    </form>

    <?php
    if (mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <tr>
                <th>Username</th>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>Until Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['leaveType']; ?></td>
                    <td><?php echo $row['fromDate']; ?></td>
                    <td><?php echo $row['untilDate']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="applicationID" value="<?php echo $row['applicationID']; ?>">
                            <select name="status">
                                <option value="approved" <?php if ($row['status'] == 'approved') echo 'selected'; ?>>
                                    Approved
                                </option>
                                <option value="not approved" <?php if ($row['status'] == 'not approved') echo 'selected'; ?>>
                                    Not Approved
                                </option>
                                <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>
                                    Pending
                                </option>
                            </select>
                            <input type="submit" name="Submit" value="Update">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "<h3>No records found.</h3>";
    }
    ?>
</div>
</body>
</html>
