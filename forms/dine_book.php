<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Event Booking Form</title>
</head>
<body style="background-image: url(images/phpbg.png);">
	<?php
		
		$table_name=$_POST['Table_name'];
		$guest=$_POST['Guest'];
		$dine_date=$_POST['Date'];
		$dine_time=$_POST['Time'];
		$request=$_POST['Request'];
		
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
				$user_id = $_SESSION['user_id'];
				$query1="SELECT * FROM register WHERE User_Id ='$user_id'";

				$q = "SELECT price FROM dine where dine_name = '$table_name'";
				$result = mysqli_query($conn,$q);
                $row = mysqli_fetch_assoc($result);
				$amount = $row['price'];


				

				$res=$conn->query($query1);//performs a query on database
				$rows=$res->num_rows;//return no of rows present in result set
				// query in $query1 is fired on connection $conn 
				if($rows>0)
				{
				//echo"verification done";

				$query2="INSERT INTO dine_book(User_Id,Table_name,Guest,Event_date,Event_time,Request,Amount) VALUES('$user_id','$table_name','$guest','$dine_date','$dine_time','$request','$amount')";

					if(mysqli_query($conn,$query2))
					{
						//echo"insertion done";
						
						header("Location: ../home.html");
						exit();
					}
					
				
	?>
	<?php
				}

				
				else
				{
	?>
			<center>
			<h1 style=" font-family:mt script; color:white;">Holiday Hotels</h1><br/><br/>
	<?php 
			echo("Unable to Book Dine Table Please check if you provide right details or try again.....<br/><br/>");
		 	die("Connection failed: " . mysqli_connect_error());
	?>
			</center>
	<?php 

				}			
			}	

		mysqli_close($conn);
	?>
	
</body>
</html>	