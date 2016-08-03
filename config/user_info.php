<?php

require '../internals/User.php';

//Start a session and try to get the ID variable
session_start();

include("../include/database.php");

/* If we have a user ID to show, show it */
if (isset($_GET['id'])) {
    $showUser = null;
    $userid = $_GET['id'];
    $isOtherUser = true;
} else {
    /* Else, show the logged one */
    if (!isset($_SESSION['id'])){
            header("Location: index.php");
    }
    $userid = $_SESSION['id'];
    $showUser = User::GetLoggedUser();
    $isOtherUser = false;
}

if ($showUser == null) {
    /* No logged user? Get it from the database */


    $dblink = mysqli_connect(db_host, db_user, db_pass, db_name);

    if (!$dblink){
            die("Error " . mysqli_connect_errno() . " while trying to connect into database");
    }

    $showUser = User::GetUserFromID($dblink, $userid);
    if (!$showUser) {
        die ("Error: " . mysqli_connect_errno() . " while trying to get user data");
    }

    if ($isOtherUser === false)
        User::SetLoggedUser($showUser);
}

?>
<!DOCTYPE html5>

<!-- Main page of Contentbook -->

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../profile.css" />
		<link rel="stylesheet" type="text/css" href="../menubar.css" />

		<script type="text/javascript">
			function search_keypress(e){
				//Detect if we got an Enter key
				if (e.keyCode == 13){
                    var form = document.getElementById("frmSearch");
                    form.submit();

				}
			}
		</script>

		<title> <?php echo $showUser->formalname; ?> - Contentbook </title>
	</head>

	<body>
		<div id="menubar">
			<nav>
				<ul>
					<li><a href="../profile.php">Home</a></li>
					<li id="searcharea">
                        <form id="frmSearch" style="display: inline"
                            action="../search.php" method="get">
                        <input type="text" size="20" name="s"
							id="search" onKeyPress="search_keypress(event)" />
                        </form>
					</li>
					<li><a href="../setup.php">Setup</a></li>
					<li><a href="../logout.php">Exit</a></li>
				</ul>
			</nav>
		</div>
        <article>
		    <h1>Set user information</h1>
            <form action="">

            </form>


        </article>
	<?php include("include/footer.php");?>
	</body>
</html>
