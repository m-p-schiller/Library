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
<div class="container">
      <div class="header-image"><img src="logo.png" alt=""></div>
			<div class="intro-heading "><h1><span>Welcome to</span> Unicorn BookStore</h1></div>
		</div>
</header>
<div class="topMenu">
	<a href="Index.php">Home</a>
	<a href="Genre.php">Genre</a>
	<a href="About.html">About</a>
	<a href="Register.php">My Account</a>
	<a href="#">My Books</a>
	<div class="search-box">
		<input type="text" autocomplete="off" placeholder="Search title..." />
		<div class="result"></div>
	</div>	
</div>
<body>


<h1>Genres</h1>

<?php
include 'db_connection.php';
$conn = OpenCon();

$sql = "SELECT DISTINCT Genre FROM books";
$result = $conn->query($sql);

$sql2 = "SELECT DISTINCT Genre2 FROM books WHERE Genre2 NOT IN (SELECT Genre FROM books)";
$result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "<br><br>". '<a href="FilterBooks.php?genre='.$row["Genre"].'">' . $row["Genre"]. "</a><br>";
    }
} else {
   // echo "0 results";
}



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
	echo '<a href="FilterBooks.php?genre='.$row["Genre2"].'">' . $row["Genre2"]. "</a><br><br><br>";
    }
} else {
   // echo "0 results";
}


?>

<div class="footer">
	
</div>

</body>
<?php
CloseCon($conn);
?>
</html>

