<?php
include 'db_connection.php';
$conn = OpenCon();
?>
<html>
<head>
	<link rel="stylesheet" href="MainStyle.css">
</head>
<body>

<div class="topMenu">
	<a href="Index.php">Liber</a>
	<a href="Genre.php">Genre</a>
	<a href="About.html">About</a>
	<a href="#">My Account</a>
	<a href="#">My Books</a>
</div>

<?php
//echo '<h1>' . $_GET["DTitle"] . '</h1>';

$sql = 'SELECT * FROM books WHERE DownloadTitle=\'' . $_GET["DTitle"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo '<h1 style="margin-left: 25;">' . $row["Title"] . '</h1>';
	echo '<h3 style="margin-left: 25;">'. $row["Author"]. '</h3>';
	echo '<img src="bookArt.png" style="width:20%; height:auto; margin-left: 25;"><br/><br/>';	
	if ($row["Genre2"]!=NULL){
		echo '<h3 style="margin-left: 25;">Genre: '. $row["Genre"] . ', ' .  $row["Genre2"] . '</h3>';
	} else {
		echo '<h3 style="margin-left: 25;">Genre: '. $row["Genre"] .'</h3>';	
	}
	echo '<a href="/Library/BookFiles/' . $row["DownloadTitle"] .'.pdf" download>';
	echo '<button type="button" style="margin-left: 50;">Download</button>';
	echo '</a>';
}
?>	

<div class="footer">
	
</div>

</body>
</html>

<?php
CloseCon($conn);
?>
