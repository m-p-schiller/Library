<?php
include 'db_connection.php';
$conn = OpenCon();

$username=$_POST["username"];
$password=$_POST["password"];

//finds all usernames, and checks if given username is in there
$sql="SELECT * FROM accounts WHERE Username='$username'";
$result=$conn->query($sql);
if($result->num_rows == 1){
	//successful login
	session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
	header('location: http://24.57.198.146/library/MyAccount.php');
	die;
} else {
	//failed login
	header('location: http://24.57.198.146/library/Login.php');
	die;
}

CloseCon($conn);
?>