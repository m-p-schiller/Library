<script>
(function download() {
    document.getElementById('dl').click();
})()
</script>
<?php
include 'db_connection.php';
$conn = OpenCon();

$downNum = 0;
$username= $_GET["username"];
$title = $_GET["title"];

$sql = "INSERT INTO downloads (Username, Title) VALUES ('$username', '$title')";
$conn->query($sql);

$sql = 'SELECT * FROM books WHERE DownloadTitle=\'' . $title . '\';';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();	
	
	$downNum = $row["DownloadNum"] + 1;
	echo '<p>' . $downNum . '</p>';	
	$sql = 'UPDATE books SET DownloadNum =\'' . $downNum . '\' WHERE DownloadTitle =\'' . $title . '\';';
	echo '<p>' . $sql . '</p>';
	$conn->query($sql);

}

CloseCon($conn);

header('location: http://24.57.198.146/library/BookPage.php?DTitle=' . $title);
	die;
?>


