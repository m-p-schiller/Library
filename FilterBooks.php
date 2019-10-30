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
echo '<h1>' . $_GET["genre"] . '</h1>';

$sql = 'SELECT * FROM books WHERE Genre=\'' . $_GET["genre"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row	
    while($row = $result->fetch_assoc()) {
		$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
		echo '<div class="book">';
		echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="bookArt.png"></a>';
		echo '<div class="desc"><i>' . $row["Title"]. '</i> </br>' . $row["Author"] .'</div>';
		echo '</div>';
    }
} else {
  // echo "0 results";
}

$sql = 'SELECT * FROM books WHERE Genre2=\'' . $_GET["genre"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row	
    while($row = $result->fetch_assoc()) {
		$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
		echo '<div class="book">';
		echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="bookArt.png"></a>';
		echo '<div class="desc"><i>' . $row["Title"]. '</i> </br>' . $row["Author"] .'</div>';
		echo '</div>';
    }
} else {
    //echo "0 results";
}

?>



</body>
</html>

<?php
CloseCon($conn);
?>
