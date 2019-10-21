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

<h1>Genres</h1>

<?php
include 'db_connection.php';
$conn = OpenCon();

$sql = "SELECT DISTINCT Genre FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo '<a href="FilterBooks.php?genre='.$row["Genre"].'">' . $row["Genre"]. "</a><br>";
    }
} else {
    echo "0 results";
}
?>

<div class="footer">
	
</div>

</body>
<?php
CloseCon($conn);
?>
</html>

