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
	$sql = "delete from liked_posts
	    where user_id = $uid and post_id = $pid;";
	
    echo $sql;
	$results = $mysqli->query($sql);
    
    $getlikessql = "select * from posts
                        where post_id = $pid";
    $getLikesResults = $mysqli->query($getlikessql);
    $getlikes = $getLikesResults->fetch_assoc();
    $likes =  $getlikes['likes'] - 1;
    echo $likes;
    if ($likes != -1) {
        $numSql = "update posts
                    set likes = $likes
                    where post_id = $pid;";
        $mysqli->query($numSql);
    }
    
	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    


?>