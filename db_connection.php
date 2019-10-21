<?php

function OpenCon(){
	$dbhost = "localhost";
	$dbuser = "team";
	$dbpass = "agile";
	$db = "library";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db, "3306") or die("Connect failed: %s\n". $conn -> error);
 
	return $conn;
}
 
function CloseCon($conn){
	$conn -> close();
}
   
?>