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
		
		$hall_name=$_POST['Hall_name'];
		$event_name=$_POST['Event_name'];
		$guest=$_POST['Guest'];
		$event_date=$_POST['Event_date'];
		$start_time=$_POST['Start_time'];
		$end_time=$_POST['End_time'];

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
				$res=$conn->query($query1);//performs a query on database
				$rows=$res->num_rows;//return no of rows present in result set
				// query in $query1 is fired on connection $conn 

				$q = "SELECT price FROM event where event_name = '$event_name'";
				$result = mysqli_query($conn,$q);
                $row = mysqli_fetch_assoc($result);
				$amount = $row['price'];

				if($rows>0)
				{
				//echo"verification done";

				$query2="INSERT INTO event_book(User_Id,Hall_name,Event_name,Guest,Event_date,Start_time,End_time,Amount) VALUES('$user_id','$hall_name','$event_name','$guest','$event_date','$start_time','$end_time','$amount')";

					if(mysqli_query($conn,$query2))
					{
						//echo"insertion done";
						header("Location: ../home.html");
						exit();
					
				
	?>
				
	<?php
					}

				}
				else
				{
	?>
			<center>
			<h1 style=" font-family:mt script; color:white;">Holiday Hotels</h1><br/><br/>
	<?php 
			echo("Unable to Book Event Hall Please check if you provide right details or try again.....<br/><br/>");
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