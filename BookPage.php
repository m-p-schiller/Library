<!DOCTYPE html>
<?php
include 'db_connection.php';
$conn = OpenCon();
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
      <div class="header-image"><img src="logo.png" alt=""></div>
			<div class="intro-heading "><h1><span>Welcome to</span> Unicorn BookStore</h1></div>
		</div>
</header>
<div class="topMenu">
	<a href="Index.php">Home</a>
	<a href="Genre.php">Genre</a>
	<a href="About.html">About</a>
	<a href="Login.php">My Account</a>
	<a href="#">My Books</a>
	<div class="search-box">
		<input type="text" autocomplete="off" placeholder="Search title..." />
		<div class="result"></div>
	</div>	
</div>

<body>
<?php
//echo '<h1>' . $_GET["DTitle"] . '</h1>';

$sql = 'SELECT * FROM books WHERE DownloadTitle=\'' . $_GET["DTitle"] . '\';';
$result = $conn->query($sql);

if ($result->num_rows == 0) {
	echo 'Sorry, we have no books by that name.';
}

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo '<h1 style="margin-left: 25;">' . $row["Title"] . '</h1>';
	echo '<h3 style="margin-left: 25;">'. $row["Author"]. '</h3>';
	echo '<img src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg" style="width:20%; height:auto; margin-left: 25;"><br/><br/>';	
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
