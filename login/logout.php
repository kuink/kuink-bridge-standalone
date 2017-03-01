<?php

	session_start();
	
	$_SESSION['kuink.logged'] = 0;
	header("Location: /kuink/view.php");
	die();	
	
?>
