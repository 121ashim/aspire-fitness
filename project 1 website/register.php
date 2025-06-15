<?php
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$phoneno = $_POST['phoneno'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
    $gender = $_POST['gender'];
    $type = $_POST['type'];
	// Database connection
	$conn = new mysqli('localhost','root','','website');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(fullname, username, email, phoneno, password, confirmpassword, gender, type) values(?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssissss", $fullname, $username, $email, $phoneno, $password, $confirmpassword, $gender, $type);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
	
?>