<?php

require_once("config.php");

$sql = "CREATE TABLE application (
  applicationID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100),
  FOREIGN KEY (username) REFERENCES user(username),
  leaveType VARCHAR(50),
  fromDate DATE,
  untilDate DATE,
  description VARCHAR(100),
  status VARCHAR(100) DEFAULT 'pending'
)";

if (mysqli_query($conn, $sql)) {
  echo "<br>Table application created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>