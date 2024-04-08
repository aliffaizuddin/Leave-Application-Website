<?php
// Establish database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staffName = $_POST["staff_name"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $reason = $_POST["reason"];

    // Insert data into the database
    $query = "INSERT INTO leave_applications (staff_name, start_date, end_date, reason, status)
              VALUES ('$staffName', '$startDate', '$endDate', '$reason', 'Pending')";

    if (mysqli_query($connection, $query)) {
        echo "Leave application submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!-- HTML form for leave submission -->
<form method="POST" action="submit_leave.php">
    <!-- Form fields for staff name, start date, end date, and reason -->
    <!-- Submit button -->
</form>
