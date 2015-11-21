<!DOCTYPE html5>

<!-- Sign-up page of Contentbook -->

<html>

<head>
	<title>Contentbook - Sign-up</title>
</head>

<body>
	<h1> Sign up to Contentbook </h1>
	<form id="signup" method="post" action="signup.php" >
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
			<select name="city"/> </select> </p>
		<hr />
		<input type="submit" value="Sign up" />
	</form>
</body>

</html>