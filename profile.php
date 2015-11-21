
<?php

//Get the variable ID.
if (!$_GET || !$_GET["id"]){
	//If it is invalid, use users instead.
	$userid = 0;
} else {
	$userid = $_GET["id"];
}

?>
<!DOCTYPE html5>

<!-- Main page of Contentbook -->

<html>
	<head>
		<title> %1 - Contentbook </title>
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
			<h1>%1</h1>
			<div id="user_description"></div>
			<div id="user_friends">
				<h1>Friends</h1>
			</div>
			<div id="user_posts">
			</div>
		</div>
	<?php include("include/footer.php") ?>
	</body>
</html>