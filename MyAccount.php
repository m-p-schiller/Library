<?php
session_start();
include 'db_connection.php';
$conn = OpenCon();
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account</title>
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
	<div  class="search-box">
		<input type="text" autocomplete="off" placeholder="Search title..." />
		<div class="result"></div>
	</div>
	
</div>

<?php
$username =	$_SESSION['username'];
echo "<p style= 'padding-left: 50px;' style='font-size:24px;'>Hello " . $username . "</p>";
$sql = 'SELECT * FROM accounts WHERE Username =\'' . $username . '\';';
$result = $conn->query($sql);

if ($result!=null) {
	$row = $result->fetch_assoc();
	echo '<p style= "padding-left: 50px;" >Username: ' . $row["Username"] . '</p>';
	echo '<p style= "padding-left: 50px;" >Name: ' . $row["Name"] . '</p>';
	echo '<p style= "padding-left: 50px;" >Email: ' . $row["Email"] . '</p>';
}

CloseCon($conn);
?>
<body>
<br>
<a style= "padding-left: 50px;" href="Logout.php" style="font-size:16px;">Logout</a>
</body>


