<?php
include 'db_connection.php';
$conn = OpenCon();

$username=$_POST["username"];
$password=$_POST["password"];

$sql="SELECT * FROM accounts WHERE Username='$username'";
$result=$conn->query($sql);
if($result->num_rows == 1){
	session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
	header('location: http://24.57.198.146/library/MyAccount.php');
	die;
}

CloseCon($conn);
?>