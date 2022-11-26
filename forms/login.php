<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
$conn=mysqli_connect("localhost","root","","hotel");

	$email = $_POST['Email'];  
	$password = $_POST['Password'];
	
	if(!$conn)   
    {
        echo"connection failed";
    }
    else
    {
        $loginquery ="SELECT * FROM register WHERE Email ='$email' and Password=$password"; //selecting matching records
	    $result= mysqli_query($conn, $loginquery); //executing
        $row=mysqli_fetch_array($result);
	
    }
	
	
	if(mysqli_num_rows($result) === 1) 
	{
        $_SESSION["user_id"] = $row['User_Id'];
		header("Location: ../home.html");
		exit();
	} 
    else
    {
        
        header("Location: ./login.html?error=Incorrect User name or password");
        exit();
        
        

    }
    

	
?>
</body>
</html>