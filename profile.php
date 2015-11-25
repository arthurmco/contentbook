
<?php

//Start a session and try to get the ID variable
session_start();

include("include/database.php");

if (!isset($_SESSION['id'])){
	header("Location: index.php");
}

$userid = $_SESSION['id'];

$dblink = mysqli_connect(db_host, db_user, db_pass, db_name);		

if (!$dblink){
	die("Error " . mysqli_connect_errno() . " while trying to connect into database");
}

$query_str = "SELECT * ";
$query_str .= "FROM `users`";
$query_str .= " WHERE userid = '" . $userid . "';";

$result = mysqli_query($dblink, $query_str);

if (!$result){
	die("Error " . mysqli_errno($dblink) . " while trying to retrieve user from database");
}

$logged_user = mysqli_fetch_assoc($result);

if (!$logged_user){
	header("Location: index.php?reason=n00bhacker");
}

?>
<!DOCTYPE html5>

<!-- Main page of Contentbook -->

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="profile.css" />
		<link rel="stylesheet" type="text/css" href="menubar.css" />
		
		<script type="text/javascript">
			function search_keypress(e){
				//Detect if we got an Enter key
				if (e.keyCode == 13){
					var searchbox = document.getElementById("search");
					window.location = "search.php?s=" + searchbox.value;
				}
			}
		</script>
	
		<title> <?php echo $logged_user['userformalname']; ?> - Contentbook </title>
	</head>
	
	<body>
		<div id="menubar">
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#" id="searcharea">
						<input type="text" size="20" name="search" 
							id="search" onKeyPress="search_keypress(event)" />
					</a></li>
					<li><a href="#">Setup</a></li>
					<li><a href="logout.php">Exit</a></li>
				</ul>
			</nav>
		</div>
		<div id="profile_area">
			<h1 id="username" > <?php echo $logged_user['userformalname']; ?></h1>
			<div id="user_description">
				description
			</div>
			<div id="user_information">
				<p>  </p>
				<p>Gender: 
					<?php echo (($logged_user['usersex'] == 0) ? "Male" : "Female"); ?>
				</p>
				<p>City: <?php echo $logged_user['usercity'] ?> </p>
				<p>Birth date: <?php echo $logged_user['userbirthdate'] ?></p>
			</div>
			<div id="user_friends">
				<h1>Friends</h1>
			</div>
			<div id="user_posts">
				
			
			</div>
		</div>
	<?php include("include/footer.php"); mysqli_free_result($result); ?>
	</body>
</html>