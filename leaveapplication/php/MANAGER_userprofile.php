<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

<?php

require("config.php");

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
} elseif (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}


// Assign default values to variables
$first_name = "";
$last_name = "";
$gender = "";
$dob = "2023-01-01";
$address = "";
$email = "";
$mobile_number = "";

?>

<h1>My Profile</h1>
<form method="POST" action="MANAGER_updateProfile.php">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" value="<?php echo $first_name; ?>" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" value="<?php echo $last_name; ?>" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="">Select gender...</option>
        <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>
            Male
        </option>
        <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>
            Female
        </option>
        <option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>
            Other
        </option>
    </select>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

    <label for="mobileNumber">Mobile Number:</label>
    <input type="tel" id="mobileNumber" name="mobileNumber" value="<?php echo $mobile_number; ?>" required>

    <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">

    <input type="submit" value="Update">
</form>


</body>
</html>

