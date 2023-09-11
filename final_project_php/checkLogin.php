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

    
    $username = $_GET['user'];
    $password = $_GET['pw'];

   
	$sqlUser = "select * from users
	            where username = '$username';";
	
    $sqlPW = "select * from users
	            where username = '$username' and password = '$password';";
	
	$resultsUser = $mysqli->query($sqlUser);
    $checkUser = $resultsUser->fetch_assoc();


    $resultsPW = $mysqli->query($sqlPW);
    $checkPW = $resultsPW->fetch_assoc();


    if ($checkUser == NULL) {
        //no user exists
        echo "user";
    }

    else if ($checkPW == NULL) {
        //wrong pw
        echo "pw";
    }

    else {
        //login exists

        echo $checkUser['user_id'];
        setcookie("userid", $check['user_id'], time() + (86400 * 30), "/");
        echo "success";
    }


    
	if ( !$resultsUser || $resultsPW) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    


?>