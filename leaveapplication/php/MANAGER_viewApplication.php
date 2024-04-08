<?php
session_start(); // Start up your PHP Session
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: Login_loginpage.php");

if ($_SESSION["LEVEL"] != 3) {   //only user with access level 1 and 2 can view

?>
	 	
		 <html>
	<head><title> LEAVE HISTORY</title><head>
	<body>
		<?php
        
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

         // Retrieve the applicationID from the database

	     $sql = "SELECT * FROM application";
		 $result = mysqli_query($conn, $sql);
		 if (mysqli_num_rows($result) > 0) {    
                     
            ?>
		<!-- Start table tag -->
        <form name="form1" method="post" action="Manager_approve.php">
		<table width="600" border="1" cellspacing="0" cellpadding="3">
		 
		<!-- Print table heading -->
		<tr>
		<td align="center"><strong>Username</strong></td>
		<td align="center"><strong>leaveType</strong></td>
		<td align="center"><strong>fromDate</strong></td>
        <td align="center"><strong>UntilDate</strong></td>
        <td align="center"><strong>Status</strong></td>
		
		<?php if ($_SESSION["LEVEL"] == 2) {?>
		<td align="center"><strong>Action</strong></td>
		<td align="center"><strong>Submit</strong></td>
		<?php } ?>
		
		</tr> 
		
		<?php
			// output data of each row
			while($rows = mysqli_fetch_assoc($result)) {
		?>
		
	     <tr>
			<td><?php echo $rows['username']; ?></td>
			<td><?php echo $rows['leaveType']; ?></td>
			<td><?php echo $rows['fromDate']; ?></td>
            <td><?php echo $rows['untilDate']; ?></td>
			<td><?php echo $rows['status']; ?></td>
            
			
            <?php if ($_SESSION["LEVEL"] == 2) {?> 
    <!--only manager can approve and submit application-->
    <td align="center">
    <select name="status" >
        <option value="approved" <?php if ($rows['status'] == 'approved') echo 'selected'; ?>>
            Approved
        </option>
        <option value="Not Approved" <?php if ($rows['status'] == 'Not Approved') echo 'selected'; ?>>
            Not Approved
        </option>
    </select>
</td>
    <td align="center">
    <input type="hidden" name="applicationID" id ="applicationID" value="<?php echo $rows['applicationID']; ?>">
        <input type="submit" name="Submit" value="Submit">
    </td>    
</tr> 



        

		<?php }
		
			}
		} else {
			echo "<h3>There are no records to show</h3>";
			}

	     mysqli_close($conn);
	   ?>
	    
	    </table>
        </form>
		
		

 
 	<?php } // If the user is not correct level
	else if ($_SESSION["LEVEL"] == 3) {
	
	echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
	echo "<p><a href='main.php'>Back to main page</a></p>";
	
	echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
   }
 
  ?>
	</body>
	</html>
	

