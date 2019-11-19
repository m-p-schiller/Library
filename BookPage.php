<?php
session_start();
include 'db_connection.php';
$conn = OpenCon();
?>
<!DOCTYPE html>
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

$searchTitle = $_GET["DTitle"];
if(strlen($searchTitle) < 2){
	echo "Please enter a longer search value";
	
} else {
	$sql = 'SELECT * FROM books WHERE DownloadTitle=\'' . $searchTitle . '\';';
	$result = $conn->query($sql);

	if ($result->num_rows == 0) {
		echo '<title>Search</title>';
		$newSql = "SELECT * FROM books";
		$newResult = $conn->query($newSql);
		$count = 0;
	
		while($row = $newResult->fetch_assoc()) {
			if((levenshtein(strtolower($row["Title"]), strtolower($searchTitle)) < 3) || (strpos(strtolower($row["Title"]), strtolower($searchTitle)) !== false)){
				$getLink = preg_replace('/[^a-z]+/i', '_', $row["Title"]); 
				echo '<div class="book">';
				echo '<a href="BookPage.php?DTitle=' .$getLink. '"><img src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg"></a>';
				echo '<div class="desc"><i>' . $row["Title"]. '</i> </br>' . $row["Author"] .'</div>';
				echo '</div>';
				$count++;
			}
		}
		if($count == 0){
			echo "Sorry, we have no book by that title";
		}
		
	}

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$title = $row["Title"];
		echo '<p>';
		echo '<title >' . $title  . '</title>';
		echo '<h1 style= "padding-left: 50px;" ">' . $row["Title"] . '</h1>';
		echo '<h3 style= "padding-left: 80px;" "> By '. $row["Author"]. '</h3>';
		if ($row["Genre2"]!=NULL){
			echo '<h3 style= "padding-left: 80px;"  style="margin-left: 25;">Genre: '. $row["Genre"] . ', ' .  $row["Genre2"] . '</h3>';
		} else {
			echo '<h3 style= "padding-left: 80px;"  style="margin-left: 25;">Genre: '. $row["Genre"] .'</h3>';	
		}
		echo '<img style= "float: left; padding-left: 50px; width:360px; height:499px; margin-left: 25; " src="/Library/BookArt/' . $row["DownloadTitle"] . '.jpg" >';	
		echo file_get_contents( '../Library/Text/' . $searchTitle . '.txt' ); // get the contents, and echo it out.
		echo '</p>';
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			$username = $_SESSION['username'];
			echo '<a href="/Library/BookFiles/' . $searchTitle .'.pdf" download>';
			echo '<button id="Dbutton" style="margin-left: 50;">Download</button>';
			echo '</a>';
			
			echo '<a style= "padding-left: 50px;" href="/Library/Download.php?title=' . $searchTitle . '&username=' . $username . '">';
			echo '<button id="Dbutton" style="margin-left: 50;">Add to My Books</button>';
			echo '</a>';					
		} else {
			echo '<a href="/Library/BookFiles/' . $searchTitle .'.pdf" download>';
			echo '<button id="Dbutton" style="margin-left: 50;">Download</button>';
			echo '</a>';
		}

	}
}
?>	

<br><br><br><br>
</body>
</html>

<?php
CloseCon($conn);
?>
