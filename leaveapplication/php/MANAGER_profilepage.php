<?php
session_start(); // Start the PHP session

// Check if the user is logged in
if ($_SESSION["Login"] != "YES") {
    header("Location: Login_loginpage.php"); // Redirect to the login page if not logged in
    exit();
}

require('config.php'); // Include the database configuration

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $userId = $_SESSION["ID"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $mobileNumber = $_POST["mobileNumber"];

    // Perform the insert/update operation in the database
    $query = "INSERT INTO admin_profile (ID, first_name, last_name, gender, dob, address, email, mobile_number) VALUES ('$userId', '$firstName', '$lastName', '$gender', '$dob', '$address', '$email', '$mobileNumber') ON DUPLICATE KEY UPDATE first_name='$firstName', last_name='$lastName', gender='$gender', dob='$dob', address='$address', email='$email', mobile_number='$mobileNumber'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Display a success message
        echo "Profile updated successfully.";
    } else {
        // Display an error message
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Retrieve the profile information from the database
$userId = $_SESSION["ID"];
$query = "SELECT * FROM admin_profile WHERE ID = '$userId'";
$result = mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page for Leave Application Management</title>
    <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }


        .sidebar {
            width: 200px;
            background-color: #00b4db;
            padding: 20px;
            position: fixed;
            height: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Profile Styles */
        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .admin-name {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        /* Form Styles */
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #444;
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
        input,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        form {
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
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
            <h1>My Profile</h1>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                </tr>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["dob"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["mobile_number"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No profile information found.</td></tr>";
                }
                ?>
            </table>
            <h1>Edit My Profile</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select gender...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="mobileNumber">Mobile Number:</label>
                <input type="tel" id="mobileNumber" name="mobileNumber" required>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>
