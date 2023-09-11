<?php 
    
        
	if ( empty($_FILES["file_name"]) ) {
		$error = "Missing file";
	} else if ($_FILES['file_name']['error'] > 0) {
		$error = "File upload error # " . $_FILES['file_name']['error'];
	} else {
		// No error


		$source = $_FILES['file_name']['tmp_name'];
		$destination = "img/uploads/" . uniqid() . $_FILES['file_name']["name"];
        $imgAddress = $destination;
		$destination = preg_replace('/\s/', '_', $destination);

		move_uploaded_file($source, $destination);

        //connect to database
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
        
        $caption =  $_POST["caption-content"];
        $userid = $_COOKIE["userid"];
        $sql = "insert into posts (image, likes, caption, user_id)
                    values ('$imgAddress', 0, '$caption', $userid);";
        
        $mysqli->query($sql);


        // Close MySQL Connection
        $mysqli->close();




	}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Posted!</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post successful! Go check it out!">
    <link rel="stylesheet" href="postForm.css">
    <link rel="stylesheet" href="postConfirmation.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>
    </style>
</head>

<body>
    <div class="navbar">
        <a class="def-button" href="about.php">
                about
            </a>

            <a class="def-button" href="gallery.php">
                gallery
            </a>
            <a class="def-button" href="blog.php">
               blog
            </a>

        </div>
    <div class="main">

        <h1>post confirmed!</h1>
        <span>back to <a href="blog.php">blog</a> &#187;</span>
        <img src="img/tutorial/two-sky-kids-png.webp" alt="">
    </div>

    <!-- Footer -->
    <div class="footer">
        <!-- <div class = "center">seeing if stuff goes here</div> -->
    </div>

    <script src="postForm.js"></script>


</body>

</html>