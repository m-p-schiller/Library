<?php
include 'db_connection.php';
$conn = OpenCon();

$username=$_POST["username"];
$password=$_POST["password"];
$password2=$_POST["passwordVer"];

$sql="INSERT INTO accounts (Username, Password, TimeAdded) VALUES ('$username', '$password', current_timestamp())";
if ($conn->query($sql) === TRUE) {
	session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
	header('location: http://24.57.198.146/library/MyAccount.php');
	die;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	


CloseCon($conn);
?>