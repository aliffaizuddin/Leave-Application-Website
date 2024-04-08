<?php
require_once('config.php');

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve user information from the database
    $adminSql = "SELECT * FROM admin_profile WHERE ID = '$userId'";
    $managerSql = "SELECT * FROM manager_profile WHERE ID = '$userId'";
    $staffSql = "SELECT * FROM staff_profile WHERE ID = '$userId'";

    $adminResult = mysqli_query($conn, $adminSql);
    $managerResult = mysqli_query($conn, $managerSql);
    $staffResult = mysqli_query($conn, $staffSql);

    // Check if the user ID exists in any of the three tables
    if (mysqli_num_rows($adminResult) > 0) {
        $row = mysqli_fetch_assoc($adminResult);
        $profileType = 'Admin';
    } elseif (mysqli_num_rows($managerResult) > 0) {
        $row = mysqli_fetch_assoc($managerResult);
        $profileType = 'Manager';
    } elseif (mysqli_num_rows($staffResult) > 0) {
        $row = mysqli_fetch_assoc($staffResult);
        $profileType = 'Staff';
    } else {
        $profileType = 'Unknown';
    }

    // Display user information in a table
    echo '<h2>User Profile</h2>';
    echo '<h3>Profile Type: ' . $profileType . '</h3>';
    
    if (isset($row)) { // Check if $row is defined
        echo '<table>';
        echo '<tr><th>ID</th><td>' . $userId . '</td></tr>';
        echo '<tr><th>First Name</th><td>' . $row['first_name'] . '</td></tr>';
        echo '<tr><th>Last Name</th><td>' . $row['last_name'] . '</td></tr>';
        echo '<tr><th>Gender</th><td>' . $row['gender'] . '</td></tr>';
        echo '<tr><th>Date of Birth</th><td>' . $row['dob'] . '</td></tr>';
        echo '<tr><th>Address</th><td>' . $row['address'] . '</td></tr>';
        echo '<tr><th>Email</th><td>' . $row['email'] . '</td></tr>';
        echo '<tr><th>Mobile Number</th><td>' . $row['mobile_number'] . '</td></tr>';
        echo '</table>';
    } else {
        echo 'User ID not found.';
    }

} else {
    echo 'User ID is missing in the URL.';
}

// Close the database connection
mysqli_close($conn);
?>