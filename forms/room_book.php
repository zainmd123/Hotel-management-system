<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Room Booking Form</title>
</head>
<body style="background-image: url(images/phpbg.png);">
	<?php
		
		$room_name=$_POST['Room_name'];
		$arrival=$_POST['Arrival'];
		$departure=$_POST['Departure'];
		$rooms=$_POST['Rooms'];
		$adults=$_POST['Adults'];
		$children=$_POST['Children'];

		// to make connection
		$conn=mysqli_connect("localhost","root","","hotel");
		function dateDiffInDays($date1, $date2) 
  		{
      		// Calculating the difference in timestamps
      		$diff = strtotime($date2) - strtotime($date1);
  
      		// 1 day = 24 hours
      		// 24 * 60 * 60 = 86400 seconds
      		return abs(round($diff / 86400));
 	 	}

		//check if connection is done
		if(!$conn)  
			{
				echo"connection failed";
			}
		else
			{
				//echo"connection done";
				$dateDiff = dateDiffInDays($arrival, $departure);
				//query stored in $query variable 
				$user_id = $_SESSION["user_id"];
				$query1="SELECT * FROM register WHERE User_Id ='$user_id' ";
				$q = "SELECT price FROM room where room_name = '$room_name'";
				$result = mysqli_query($conn,$q);
                $row = mysqli_fetch_assoc($result);
				$amount = $row['price']*$rooms*$dateDiff;
	
				


				$res=$conn->query($query1);//performs a query on database
				$rows=$res->num_rows;//return no of rows present in result set
				// query in $query1 is fired on connection $conn 
				if($rows>0)
				{
				//echo"verification done";

				$query2="INSERT INTO room_book(User_Id,Room_name,Arrival,Departure,Rooms,Adults,Children,Amount) VALUES('$user_id','$room_name','$arrival','$departure','$rooms','$adults','$children','$amount')";

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
			echo("Unable to Book Room Please check if you provide right details or try again.....<br/><br/>");
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