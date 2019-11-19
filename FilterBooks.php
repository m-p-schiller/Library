<!DOCTYPE html>
<?php
include 'db_connection.php';
$conn = OpenCon();
echo '<title>' . $_GET["genre"] . '</title>';
?>
<html>
<head>
	<link rel="stylesheet" href="MainStyle.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("livesearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});


$(document).on("keypress", "input", function(e){
    if(e.which == 13){
        var inputVal = $(this).val();
		inputVal = inputVal.replace(/\s/g, '_');
		inputVal = inputVal.replace(/'/g, '_');		
		inputVal = inputVal.replace(/[^\w\s]/g, "");
        window.location.href = "http://24.57.198.146/library/BookPage.php?DTitle=" + inputVal;
    }
});
</script>
</head>
<header>
	<div class="container">
      <div class="header-image"><a href="Index.php"><img src="logo.png" alt=""></a></div>
			<div class="intro-heading "><h1><span>Welcome to</span> Unicorn BookStore</h1></div>
		</div>
</header>
<div class="topMenu">
	<a href="Index.php">Home</a>
	<a href="Genre.php">Genre</a>
	<a href="About.html">About</a>
	<a href="Login.php">My Account</a>
	<a href="MyBooks.php">My Books</a>
	<div class="search-box">
		<input type="text" autocomplete="off" placeholder="Search title..." />
		<div class="result"></div>
	</div>	
</div>

<body>

<?php
echo '<h1 style= "padding-left: 50px;" >' . $_GET["genre"] . '</h1>';

$sql = 'SELECT * FROM books WHERE Genre=\'' . $_GET["genre"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row	
    while($row = $result->fetch_assoc()) {
		$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
		echo '<div class="book">';
		echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg"></a>';
		echo '<div class="desc"><i>' . $row["Title"]. '</i> </br>' . $row["Author"] .'</div>';
		echo '</div>';
    }
} else {
	if($_GET["genre"] == "All"){
		$sql = 'SELECT * FROM books';
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc()) {
			$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
			echo '<div class="book">';
			echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg"></a>';
			echo '<div class="desc"><i>' . $row["Title"]. '</i> </br>' . $row["Author"] .'</div>';
			echo '</div>';
		}
	}
}

$sql = 'SELECT * FROM books WHERE Genre2=\'' . $_GET["genre"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row	
    while($row = $result->fetch_assoc()) {
		$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
		echo '<div class="book">';
		echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg"></a>';
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
