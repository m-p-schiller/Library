<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="MainStyle.css">
    <link rel="stylesheet" href="LogStyle.css">
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
<body>
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
	<a href="Register.php">My Account</a>
	<a href="#">My Books</a>
	<div class="search-box">
		<input type="text" autocomplete="off" placeholder="Search title..." />
		<div class="result"></div>
	</div>	
</div>
<div class="card">
  <h1 class="title">Register
  </h1>
  <form>
    <div class="input-container">
      <input type="#{type}" id="#{label}" required="required"/>
      <label for="#{label}">Username</label>
      <div class="bar"></div>
    </div>
    <div class="input-container">
      <input type="#{type}" id="#{label}" required="required"/>
      <label for="#{label}">Password</label>
      <div class="bar"></div>
    </div>
    <div class="input-container">
      <input type="#{type}" id="#{label}" required="required"/>
      <label for="#{label}">Repeat Password</label>
      <div class="bar"></div>
    </div>
    <div class="button-container">
      <button><span>Next</span></button>
    </div>
  </form>
</div>

</body>
</html>
