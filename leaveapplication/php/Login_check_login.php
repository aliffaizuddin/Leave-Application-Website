<?php
session_start();
require('config.php');

// username and password sent from form
$myusername = $_POST["username"];
$mypassword = $_POST["password"];

$sql = "SELECT * FROM user WHERE username='$myusername' and password='$mypassword'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($result);

$user_name = $rows["username"];
$user_password = $rows["password"];
$user_level = $rows["level"];

$count = mysqli_num_rows($result);

if ($count == 1) {
  $_SESSION["Login"] = "YES";
  $_SESSION["USER"] = $user_name;
  $_SESSION["ID"] = $rows["ID"];
  $_SESSION["LEVEL"] = $user_level;

  $message = "";
  $siteLink = "";
  if ($user_level == 1) {
    $message = "You are now logged in as admin with access level 1";
    $siteLink = "main_admin.php";
  } elseif ($user_level == 2) {
    $message = "You are now logged in as manager with access level 2";
    $siteLink = "main_manager.php?ID=" . $_SESSION["ID"]; // Append the ID to the URL
  } elseif ($user_level == 3) {
    $message = "You are now logged in as staff with access level 3";
    $siteLink = "main_staff.php";
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Confirmation</title>
  <script>
    // Display the error message in a pop-up
    window.onload = function() {
      alert("<?php echo $message; ?>");
      window.location.href = "<?php echo $siteLink; ?>"; // Redirect to the login page
    };
  </script>
</head>
<body>
</body>
</html>

<?php
} else {
  $_SESSION["Login"] = "NO";
  $errorMessage = "Your username or password is incorrect.";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Failed</title>
  <script>
    // Display the error message in a pop-up
    window.onload = function() {
      alert("<?php echo $errorMessage; ?>");
      window.location.href = "Login_loginpage.php"; // Redirect to the login page
    };
  </script>
</head>
<body>
</body>
</html>

<?php
  exit();
}
?>