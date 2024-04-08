<?php
// Establish database connection

// Retrieve leave applications from the database
$query = "SELECT * FROM leave_applications";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    // Display leave applications in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Staff Name</th><th>Start Date</th><th>End Date</th><th>Reason</th><th>Status</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["staff_name"] . "</td>";
        echo "<td>" . $row["start_date"] . "</td>";
        echo "<td>" . $row["end_date"] . "</td>";
        echo "<td>" . $row["reason"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No leave applications found.";
}
?>
