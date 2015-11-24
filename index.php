<!DOCTYPE html5>

<!-- Index page of Contentbook -->

<html>

<head>
	<link rel="stylesheet" type="text/css" href="index.css" />

	<title>Contentbook</title>
	
	<script>
		function login_submit(){
			user = document.getElementById("username");
			pass = document.getElementById("password");
			
			if (user.value == ""){
				alert("Please type your username");
				return false;				
			}
			
			
			if (pass.value == ""){
				alert("Please type your password");
				return false;				
			}
			
			return true;
		}
	</script>
</head>

<body>
	<h1>Welcome to Contentbook!</h1>
	<p>Contentbook is a social network focused in content producing, independently if it is visual, audio or textual</p>
	<p>You can log in using your username and password</p>
	
	<form id="form_login" onSubmit="return login_submit()" method="post" action="login.php">
	<span id="field-username">
		<label for="username">Username: </label>
		<input type="text" size="12" name="username" id="username" />
	</span>
	<span id="field-password">		
		<label for="password">Password: </label>
		<input type="password" size="12" name="password" id="password" />
	</span>
		<input type="submit" value="Log in" />
		<span id="signup">Doesn't have an account? <a href="signup.php">Sign up then!</a>
	</form>
	
	<?php 
		if (isset($_GET['reason'])){
			$reason = $_GET['reason'];
			
			switch ($reason){
				case 42
					?>
				<p><span id="bottom-box" style="border: 1px solid blue; background-color: #a8e5ff"> 
					The answer to life, universe and everything
				</span></p>
					<?php
					break;
				
				case 900:
					//User created
					?>
				<p><span id="bottom-box"  style="border: 1px solid orange; background-color: #FFE5A8"> 
					Please log in with your just created user name and password
				</span></p>
					<?php
					
				break;
			}
		
		}
	?>
	
	<?php include("include/footer.php") ?>
</body>

</html>