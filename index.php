<!DOCTYPE html5>

<!-- Index page of Contentbook -->

<html>

<head>
	<title>Contentbook</title>
</head>

<body>
	<h1>Welcome to Contentbook!</h1>
	<p>Contentbook is a social network focused in content producing, independently if it is visual, audio or textual</p>
	<p>You can log in using your username and password</p>
	
	<form id="form_login" method="post" action="login.php">
		<label for="username">Username: </label>
		<input type="text" size="12" name="username" id="username" />
		<br />
		<label for="password">Password: </label>
		<input type="password" size="12" name="password" id="password" />
		<input type="submit" value="Log in" />
		<span id="signup">Doesn't have an account? <a href="signup.php">Sign up then!</a>
	</form>
	
	<?php include("include/footer.php") ?>
</body>

</html>