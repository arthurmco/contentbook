<?php
session_start();

include("include/database.php");

if (!isset($_SESSION['id'])){
	header("Location: index.php");
}

if (!isset($_GET) || !isset($_GET['s'])) {
    header("Location: profile.php");
}

$userid = $_SESSION['id'];

//Filter search string
$str = htmlspecialchars(filter_input(INPUT_GET, 's'));

$dblink = mysqli_connect(db_host, db_user, db_pass, db_name);		

if (!$dblink){
	die("Error " . mysqli_connect_errno() . " while trying to connect into database");
}

$query_str = "SELECT * ";
$query_str .= "FROM `users`";
$query_str .= " WHERE userformalname LIKE '$str%'";

$result = mysqli_query($dblink, $query_str);

if (!$result){
	die("Error " . mysqli_errno($dblink) . " while trying to retrieve user from database");
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
                                        var form = document.getElementById("frmSearch");
                                        form.submit();
					
				}
			}
		</script>
	
		<title> Search </title>
	</head>
	
	<body>
		<div id="menubar">
			<nav>
				<ul>
					<li><a href="profile.php">Home</a></li>
					<li id="searcharea">
						<form id="frmSearch" style="display: inline" 
                                                      action="search.php" method="get">
                                                <input type="text" size="20" name="s" 
							id="search" onKeyPress="search_keypress(event)" />
					</li>
					<li><a href="#">Setup</a></li>
					<li><a href="logout.php">Exit</a></li>
				</ul>
			</nav>
		</div>
            <article>
                <h1>Results</h1>
                <section id="search_res">
                    <ul>
                        <?php
                            while ($users = mysqli_fetch_assoc($result)) {
                        ?>
                        <li><a href="profile.php?id=<?php echo $users['userid'] ?>">
                            <?php echo $users['userformalname']?>
                            </a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </section>
            </article>
	<?php include("include/footer.php"); mysqli_free_result($result); ?>
	</body>
</html>

