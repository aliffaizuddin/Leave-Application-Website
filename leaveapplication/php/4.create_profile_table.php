<?php
session_start(); // Start the PHP session

// Check if the user is logged in and has the correct level
if ($_SESSION["Login"] != "YES" || $_SESSION["LEVEL"] != 2) {
    header("Location: Login_loginpage.php"); // Redirect to the login page if not logged in or not at the correct level
    exit();
}

require('config.php'); // Include the database configuration

// SQL query to create the 'manager_profile' table
$sql = "CREATE TABLE IF NOT EXISTS manager_profile (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    dob DATE NOT NULL,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    role ENUM('manager') NOT NULL
)";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Table 'manager_profile' created successfully.";
} else {
    echo "Error creating table 'manager_profile': " . mysqli_error($conn);
}

// SQL query to create the 'admin_profile' table
$sql = "CREATE TABLE IF NOT EXISTS admin_profile (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    dob DATE NOT NULL,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    role ENUM('admin') NOT NULL
)";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Table 'admin_profile' created successfully.";
} else {
    echo "Error creating table 'admin_profile': " . mysqli_error($conn);
}

// SQL query to create the 'staff_profile' table
$sql = "CREATE TABLE IF NOT EXISTS staff_profile (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    dob DATE NOT NULL,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    role ENUM('staff') NOT NULL
)";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Table 'staff_profile' created successfully.";
} else {
    echo "Error creating table 'staff_profile': " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
