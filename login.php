<?php

include("include/database.php");

if (!$_POST){
	//No POST data, return to home page
	header("Location: index.php");
}

if (!isset($_POST['username']) && !isset($_POST['password'])){
	//No login data, return to home page
	
	header("Location: index.php");	
}

$username = $_POST['username'];
$password = md5(sha1($_POST['password']));

////Get the password ID, password and usertype.

//Tries to connect into the database
		$dblink = mysqli_connect(db_host, db_user, db_pass, db_name);
		
		if (!$dblink){
			die("Error " . mysqli_connect_errno() . " while trying to connect into database");
		}
		
		$query_str = "SELECT `userid`,`userpassword`,`usertype` FROM `users`";
		$query_str .= " WHERE username = '" . htmlspecialchars($username) . "';";
		
		$result = mysqli_query($dblink, $query_str);
		
		if (!$result){
			die("Error " . mysqli_errno($dblink) . " while trying to retrieve user from database");
		}
		
		$result_row = mysqli_fetch_assoc($result);
		if (!$result_row){
			//There's no user with this name on the database.
			header("Location: index.php?reason=899");
		}
		
		$dbpass = $result_row['userpassword'];
		
		if (strcmp($password, $dbpass)){
			//Wrong password
			
			header("Location: index.php?reason=745");
			die();
		}

		echo "Logging...";
		echo $password;
		echo "<hr/>";
		echo $dbpass;
		
		
		$userid = $result_row['userid'];
		mysqli_free_result($result);
		
		
		//Start a session and add the userid to it.
		session_start();		
		$_SESSION["id"] = $userid;
		
		header("Location: profile.php");

		die();

?>