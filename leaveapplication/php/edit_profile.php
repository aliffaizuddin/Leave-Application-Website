<?php
session_start(); // Start the PHP session

// Check if the user is logged in and has the correct level
if ($_SESSION["Login"] != "YES" || $_SESSION["LEVEL"] != 1) {
    header("Location: Login_loginpage.php"); // Redirect to the login page if not logged in or not at the correct level
    exit();
}

require('config.php'); // Include the database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $userId = $_GET['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

    // Update the admin profile in the admin_profile table
    $sql = "UPDATE admin_profile SET
                first_name = '$first_name',
                last_name = '$last_name',
                gender = '$gender',
                dob = '$dob',
                address = '$address',
                email = '$email',
                mobile_number = '$mobile_number'
            WHERE ID = '$userId'";

    if (mysqli_query($conn, $sql)) {
        echo "Admin profile updated successfully.";
    } else {
        echo "Error updating admin profile: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
