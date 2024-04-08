<?php
session_start(); // Start up your PHP Session

echo $_SESSION["Login"]; // for session tracking purpose, can delete
echo $_SESSION["LEVEL"]; // for session tracking purpose, can delete

if ($_SESSION["Login"] != "YES") // if the user is not logged in or has been logged out
    header("Location: index.php"); // send user to login page

if ($_SESSION["LEVEL"] == 2) { // only user level 1 can access
    require("config.php"); // read up on php includes https://www.w3schools.com/php/php_includes.asp

	
	if (isset($_POST['Submit'])) {

		$status = $_POST['status'];
		$applicationID = $_POST['applicationID'];
	
		// Update the status for the specified approvalID
		$sql = "UPDATE application SET status = '$status' WHERE applicationID = '$applicationID'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record updated successfully');</script>";
            echo "<script>window.location.href = 'MANAGER_viewApplication.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } 
	else {
        echo "<p>No status value provided.</p>";
    }
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {

    echo "<p>Wrong User Level! You are not authorized to view this page</p>";

    echo "<p><a href='main.php'>Go back to main page</a></p>";

    echo "<p><a href='logout.php'>LOGOUT</a></p>";

}
?>
