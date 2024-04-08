<?php
session_start();

// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: Login_loginpage.php");
    exit();
}

// Check if the user is the correct level
if ($_SESSION["LEVEL"] == 3) {

    require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

    // Retrieve the username from the session
    $username = $_SESSION["USER"];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data
        $leaveType = $_POST["leaveType"];
        $fromDate = $_POST["fromDate"];
        $untilDate = $_POST["untilDate"];
        $description = $_POST["description"];

        // Prepare the SQL statement using prepared statements
        $sql = "INSERT INTO application (username, leaveType, fromDate, untilDate, description, status) 
                VALUES (?, ?, ?, ?, ?, 'pending')";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $leaveType, $fromDate, $untilDate, $description);

        if (mysqli_stmt_execute($stmt)) {
            echo "<h3>New record created successfully</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Leave Application</title>
        <link rel="stylesheet" href="css/mainstyle.css">
    
        <style>
        /* Form Styles */
        form {
        margin-top: 20px;
        }

        table {
        width: 100%;
        background-color: #fff;
        border-collapse: collapse;
        border: none;
        margin-bottom: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
        padding: 10px;
        text-align: center;
        border: none;
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

        /* Form Input Styles */
        input[type="date"],
        textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        }

        select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #fff;
        font-family: Arial, sans-serif;
        }

        input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 12px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
        background-color: #45a049;
        }

        /* Other Styles */
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
                <a href="#"><i class="fas fa-calendar-alt icon"></i>Leave Application</a>
                <ul class="submenu">
                    <li><a href="STAFF_staff_form.php">Leave Application Form</a></li>
                    <li><a href="STAFF_viewApplication.php">Status Leave Application</a></li>
                </ul>
            </li>
            <li><a href="STAFF_viewstatus.php"><i class="fas fa-eye icon"></i>View All Leave Application</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i>Sign Out</a></li>
        </ul>
        <div class="notification-bell">
            <i class="fas fa-bell icon"></i>
        </div>
    </div>
    <div class="content">
        <h1>Leave Application Form</h1>
        <p>Please fill in the following information:</p>

        <form name="form1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table border="0">
                <tr>
                    <td>Leave Type</td>
                    <td>
                        <select name="leaveType">
                            <option value="">Select leave type..</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Medical Leave">Medical Leave</option>
                            <option value="Emergency Leave">Emergency Leave</option>
                            <option value="Restricted Holiday (RH)">Restricted Holiday (RH)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>From Date</td>
                    <td><input type="date" name="fromDate"></td>
                </tr>
                <tr>
                    <td>Until Date</td>
                    <td><input type="date" name="untilDate"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" rows="4" cols="50"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left"><br/><input type="submit" name="button1" value="Submit"></td>
                </tr>
            </table>
        </form>
    </div>
    </body>
    </html>
<?php
    // Close the database connection
    mysqli_close($conn);
} else {
    // If the user is not at the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='main.php'>Go back to main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>
