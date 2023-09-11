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
    <title>ITP 303 Final Project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Create a post to share with others!">
    <link rel="stylesheet" href="postForm.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>
    </style>
</head>

<body>

    <div class="main">
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
        <h1>new post</h1>
        <form id = "post-form" action="postConfirmation.php" method="POST" enctype="multipart/form-data">
            <div class="form-input">
                <div class="img-preview">
                    <img id="img-file-preview">
                </div>
                <label for="img-file" required>Upload Image</label>
                <input type="file" id="img-file" name = "file_name" accept="image/*" onchange="showPreview(event);">

            </div>

            <div class="caption-form">

                <label for="caption" required>Caption</label>
                <!-- <input type="text" id="caption" name="caption-content" placeholder="What would you like to share?"> -->
                <textarea name="caption-content" id="caption" cols="30" rows="10" maxlength="1000"
                    placeholder="What would you like to share?"></textarea>


            </div>
            
            <button id = "submit" type= "submit" class="disabled-button" disabled>post!</button>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        <!-- <div class = "center">seeing if stuff goes here</div> -->
    </div>

    <script src="postForm.js"></script>
    <script>



    </script>


</body>

</html>