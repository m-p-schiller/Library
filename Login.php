<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('location: http://24.57.198.146/library/MyAccount.php');
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
<!-- Top Menu -->
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

<!-- Login form -->
<h1 style= "padding-left: 50px;"  class="title">Login</h1>
<form style= "padding-left: 50px;"  method="post" action="CheckLogin.php">
    <input type="text" name="username"> Username<br/>
    <input type="password" name="password"> Password<br/>
    <input type="submit">
</form>
<div style= "padding-left: 50px;"  class="footerL"><a href="Register.php" style="font-size:16px;">Don't have a account yet?</a></div>

</body>
</html>