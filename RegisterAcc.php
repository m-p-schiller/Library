<?php
include 'db_connection.php';
$conn = OpenCon();

$username=$_POST["username"];
$password=$_POST["password"];
$password2=$_POST["passwordVer"];
$Name=$_POST["name"];
$Email=$_POST["email"];

//inserts new account into database
$sql="INSERT INTO accounts (Username, Password, Name, Email, TimeAdded) VALUES ('$username', '$password', '$Name', '$Email', current_timestamp())";
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