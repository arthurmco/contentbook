
<?php

//Start a session and try to get the ID variable
session_start();

if (!isset($_SESSION['id'])){
	header("Location: index.php");
}

$userid = $_SESSION['id'];

$dblink = mysqli_connect("localhost", "contentbook_user", "1234567890", "contentbook");
		
if (!$dblink){
	die("Error " . mysqli_connect_errno() . " while trying to connect into database");
}

$query_str = "SELECT `userpassword`,`usertype`, `userformalname` ";
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
		<title> <?php echo $logged_user['userformalname']; ?> - Contentbook </title>
	</head>
	
	<body>
		<div id="menubar">
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#" id="searcharea"><input type="text" size="20" name="search" /></a></li>
					<li><a href="#">Setup</a></li>
					<li><a href="#">Exit</a></li>
				</ul>
			</nav>
		</div>
		<div id="profile_area">
			<h1> <?php echo $logged_user['userformalname']; ?></h1>
			<div id="user_description"></div>
			<div id="user_friends">
				<h1>Friends</h1>
			</div>
			<div id="user_posts">
			</div>
		</div>
	<?php include("include/footer.php"); mysqli_free_result($result); ?>
	</body>
</html>