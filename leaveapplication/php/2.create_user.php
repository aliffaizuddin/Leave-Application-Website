<?php
 
require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE user
  (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     username varchar(100) UNIQUE,
     password varchar(12),
    level int(3)
  )";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table user created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>