<?php

session_start();

if (isset($_SESSION['id'])){
	//Destroy the session ID, stored in a cookie
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	
	//Destroy the session
	session_destroy();
}

header("Location: index.php");

?>