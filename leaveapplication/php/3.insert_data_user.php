<?php
 
require_once("config.php");


$sql = "INSERT INTO user (ID, username, password, level)
VALUES ('userID', 'admin', 'user1', 1);";
$sql .= "INSERT INTO user (ID, username, password, level)
VALUES ('userID', 'manager', 'user2', 2);";
$sql .= "INSERT INTO user (ID, username, password, level)
VALUES ('userID', 'staff', 'password_3', 3)";

if (mysqli_multi_query($conn, $sql)) {
    echo "<h3>New records created successfully</h3>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
