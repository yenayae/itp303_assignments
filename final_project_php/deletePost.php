<?php

	$host = "303.itpwebdev.com";
	$user = "alee2167_db_user";
	$pass = "Choianna0430@";
	$db = "alee2167_sky";
	// Establish MySQL Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	
	$mysqli->set_charset('utf8');
	// Retrieve results from the DB.
    $pid = $_GET['pid'];


    $sql1 = "delete from comments where post_id = $pid;";
	$sql2 = "delete from liked_posts where post_id = $pid;";
	$sql3 = "delete from posts where post_id = $pid;";
	

    $mysqli->query($sql1);
	$mysqli->query($sql2);
	$mysqli->query($sql3);
	// echo $sql1;

	echo $mysqli->error;

	// Close MySQL Connection
	$mysqli->close();

    


?>