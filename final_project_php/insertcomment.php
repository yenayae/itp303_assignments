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

    
    $uid = $_GET['uid'];
    $pid = $_GET['pid'];
    $comment = $_GET['input'];
	$sql = "insert into comments (user_id, post_id, comment) 
	                    values ($uid, $pid, '$comment');";
	
    echo $sql;
	
	$results = $mysqli->query($sql);
    
	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    


?>