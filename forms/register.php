<!DOCTYPE html>
<html>

<body>

	<?php

		$name=$_POST['Name'];
		$gender=$_POST['Gender'];
		$mob_no=$_POST['Phone'];
		$email=$_POST['Email_id'];
		$password=$_POST['Password'];
		$age=$_POST['Age'];

		// to make connection
		$conn=mysqli_connect("localhost","root","","hotel");

		//check if connection is done
		if(!$conn)  
			{
				echo"connection failed";
			}
		else
			{
				//echo"connection done";
				
				//query stored in $query variable 
				$query1="INSERT INTO Register(User_Id,Name,Gender,Mob_no,Email,Password,Age) VALUES('','$name','$gender','$mob_no','$email','$password','$age')";
				//print_r($_POST); //to print all elements in post array
			}

			// query in $query1 is fired on connection $conn 
		if(mysqli_query($conn,$query1))
			{
				header("Location: login.html");
				exit();

	?>

				
	<?php			
			}
		else
			{
	?>
		<center>
		<h1 style=" font-family:mt script; color:white;">Holiday Hotels</h1><br/><br/>
		<?php echo("Unable to Register Please check if are aldready a member or try using another Email Id....<br/><br/>");
		 die("Connection failed: " . mysqli_connect_error());
		?>
		</center>
	<?php 
			}		
				
		mysqli_close($conn);
	?>

</body>
</html>