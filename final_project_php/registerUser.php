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
    $email = $_GET['em'];

    //check for unique username
    $sqlUser = "select * from users
	            where username = '$username';";

    //check for unique email
    $sqlEmail = "select * from users
                    where email = '$email';";

    $resultsUser = $mysqli->query($sqlUser);
    $resultsEmail = $mysqli->query($sqlEmail);

    $checkUser = $resultsUser->fetch_assoc();
    $checkEmail = $resultsEmail->fetch_assoc();

    if ($checkUser == NULL && $checkEmail == NULL) {
        //everything unique, valid
        $sql = "insert into users (username, password, email)
        values ('$username', '$password', '$email');";
        $mysqli->query($sql);
        
        echo "success";


    }

    else if ($checkUser == NULL) {
        //email exists
        echo "email";
    }

    else {
        //user exists
        echo "user";
        
    }
    
	if ( !$resultsUser || $resultsEmail) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    


?>