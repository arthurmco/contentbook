<?php	

$id = -1;
$password = 0;
$password_check = 0;
if ($_POST && $_POST['id'] > (time(NULL) - 1800)){
	
	//Shall be SHA256 instead of SHA1. Need to change this.
	$password = md5(sha1($_POST['password']));
	$password_check = md5(sha1($_POST['password_check']));
	
	if (($password === $password_check)){
		//Continue to get other fields.
		
		$username = $_POST['username'];
		$gender = 0;
		if ($_POST['gender'] === "male"){
			$gender = 0;
		} else if ($_POST['gender'] === "female"){
			$gender = 1;
		}
		
		$birthdate = $_POST['birth-date'];
		
	}
	
	
	
	
} else if ($_POST && $_POST['id'] < (time(NULL) - 1800)){
	//You have a 30-min time window to fill the form, for safeness
	die("Session expired");
}

?>

<!DOCTYPE html5>

<!-- Sign-up page of Contentbook -->

<html>

<head>
	<title>Contentbook - Sign-up</title>
	
</head>
<body>
	<h1> Sign up to Contentbook </h1>
	<form id="signup" method="post" action="signup.php" onSubmit="signup_submit()">
		<span id="user_alert">
			<?php 
				if (!($password === $password_check)){
					echo "Passwords do not match!";
				}
			?>
		<span>
		<input type="hidden" name="id" value="<?php echo time(NULL) ?>" />
		<p>
		<label for="username">Username: </label>
		<input type="text" size="12" name="username" id="username" />
		</p>
		<p>
		<label for="password">Password: </label>
		<input type="password" size="12" name="password" id="password" />
		</p>
		<p>
		<label for="password_check">Retype your password: </label>
		<input type="password" size="12" name="password_check" id="password_check" />
		</p>
		<hr />
		<p>
		<label for="name">Name: </label>
		<input type="text" size="32" name="name" id="name" />
		</p>
		<p>
		Sex:
		<input type="radio" name="gender" value="male" />Male
		<input type="radio" name="gender" value="female" />Female
		</p>
		<p> Birth date:
			<input type="date" name="birth-date" /> </p>
			
		<p> Country:
			<select name="country" /> </select>
		<p> City
			<input type="text" name="city"/>  </p>
		<hr />
		<input type="submit" value="Sign up" />
	</form>
	<?php include("include/footer.php") ?>

</body>

</html>