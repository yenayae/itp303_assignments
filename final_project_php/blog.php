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

    if(!isset($_COOKIE["userid"])) {
        //userid is not set
        header("Location: default.php");
    }
    else {
        //userid is set
        $userid = $_COOKIE["userid"];

        if ($userid == 0) {
            header("Location: default.php");
        }

        $usersql = "select * from users
                        where user_id = $userid;";
       
        $userResults = $mysqli->query($usersql);
        $ur = $userResults->fetch_assoc();
        $username = $ur['username'];
        
    }



	$sql = "select p.post_id, p.image, p.likes, p.caption, u.username, p.user_id
                from posts p
                    left join users u
                        on p.user_id = u.user_id
            order by post_id desc;";
	

	
    

	$results = $mysqli->query($sql);


    
	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    


?>

<!DOCTYPE html>
<html>

<head>
    <title>Sky Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Share your experiences from Sky: Children of the Light! A simple
    and fun way to find new people in the community.">
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>
    </style>
    <script src="sitewide.js"></script>
    
</head>

<body>
    <a href="postForm.php">
        <button class="def-button" id="post-button">+</button>
    </a>
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
                <button class="log-button" id="logout-button" onclick= "accountTable()">
                    <img src="img/icon-png/Elder-Mask-Icon-Forest-Morybel-0146.webp" alt="profile button">
                </button>

                <div class = "account-table hidden">
                    <div class = "account" >
                        <div class="account-pic">
                                <img src="img/gray-empty-cat-img.jpg" alt="">
                        </div>
                        <div class = "acc-username" ><?php echo $username; ?></div>
                    </div>
                    <div class = "af" onclick= "logOut()">log out</div>
                <!-- <div class = "af">test</div> -->

                </div>
        </div>
    <div class="main" onclick= "bodyClick();">

    
        <div id = "p-stream" class="post-stream" >
        <?php while ( $row = $results->fetch_assoc() ) : ?>
            <div id = "post<?php echo $row['post_id']; ?>" class="post">
                <div class="info">
                    <div class="user">
                        <div class="profile-pic">
                            <img src="img/gray-empty-cat-img.jpg" alt="profile picture">
                        </div>

                        <div class="username"><?php echo $row['username']; ?></div>
                    </div>
                </div>

                <img class="post-image" src="<?php echo $row['image']; ?>" alt="">

                <div class="post-content">
                    <div class="reactions">
                        <!-- like png -->

                        <?php  
                            $mysqli = new mysqli($host, $user, $pass, $db);

                            // Check for any Connection Errors.
                            if ( $mysqli->connect_errno ) {
                                echo $mysqli->connect_error;
                                exit();
                            }
                            
                            $mysqli->set_charset('utf8');
                            echo '<script type="text/javascript">',
                            'getCookie();',
                            '</script>';
                            

                            $pid = $row['post_id'];
                            $uid = $_COOKIE["userid"];
                            

                            $sqlLiked = "select * from liked_posts
                                        where user_id = $uid and post_id = $pid;";
                            $checkLiked = $mysqli->query($sqlLiked);
                            $cL = $checkLiked->fetch_assoc();
                            // var_dump($cL);
                            // echo count($cL);
                            
                            
                            if ($cL == null) {
                                //unliked
                                $liked = 'not';
                                ?>
                                <img id = "he<?php echo $row['post_id']; ?>" class="post-icon" onclick= "toggleLike(<?php echo $row['post_id']; ?>)" src="img/icon-png/like.png" alt="">
                                <img id = "hf<?php echo $row['post_id']; ?>" class="post-icon filled hidden" onclick= "toggleLike(<?php echo $row['post_id']; ?>)" src="img/icon-png/like-filled.png" alt="">
                            
                                <?php 
                            }

                            else {
                                //liked
                                $liked = 'liked';
                                ?>
                                
                                <img id = "he<?php echo $row['post_id']; ?>" class="post-icon hidden" onclick= "toggleLike(<?php echo $row['post_id']; ?>)" src="img/icon-png/like.png" alt="">
                                <img id = "hf<?php echo $row['post_id']; ?>" class="post-icon filled" onclick= "toggleLike(<?php echo $row['post_id']; ?>)" src="img/icon-png/like-filled.png" alt="">
                            
                                <?php 
                            }

                            $mysqli->close();
                            
                            ?>
                        
                        <!-- comment png -->
                        <a class="post-icon comment-png" href="detailedPost.php?post_id=<?php echo $row['post_id']; ?>">
                            <img class="post-icon" src="img/icon-png/comment.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="text-content">
                    <p id = "likes<?php echo $row['post_id']; ?>" class="likes"><?php echo $row['likes']; ?> like(s)</p>
                    
                    <?php if ($row['caption'] != "") : ?>
                    <p class="description"> <strong><?php echo $row['username']; ?> </strong>  <?php echo $row['caption']; ?></p>
                    <?php endif; ?>

                    <?php if ($row['user_id'] == $_COOKIE['userid']) : ?>
                    
                    <div class="delete">
                        <button class="delete-button" onclick="deletePost('<?php echo $row['post_id']; ?>');">delete</button>
                    </div>
                    <?php endif; ?>

                </div>

            </div>
            <?php endwhile; ?>


           

        </div>
        <!-- end post-stream -->


    </div>

    <div class="bottom">
        <hr>

        <!-- Footer -->
        <div class="footer ">
            <div class="icons">
                <a class="icon facebook" href="https://www.facebook.com/thatskygame/">
                    <img src="img/logos/facebook-blue.png" alt="">
                </a>
                <a class="icon twitter" href="https://twitter.com/thatskygame?lang=en">
                    <img src="img/logos/twitter-blue.png" alt="">
                </a>
                <a class="icon instagram" href="https://www.instagram.com/thatskygamejp/">
                    <img src="img/logos/instagram-blue.png" alt="">
                </a>
                <a class="icon discord" href="https://discord.com/invite/thatskygame">
                    <img src="img/logos/discord-blue.png" alt="">
                </a>
            </div>
            <div class="bottom-text">
                <p class="tgc">University of Southern California &copy; 2023</p>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="blog.js"></script>
    
    <script>
        let menu = false;
        // console.log("userid " + getCookie());
        var likedStatus = "<?php echo $liked; ?>";
        console.log(likedStatus);


        
    </script>

</body>

</html>