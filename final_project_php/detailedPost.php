<?php

    if ( !isset($_GET['post_id']) || trim($_GET['post_id']) == '' ) {
    $error = "Invalid URL.";
    }
    else {
      
    $id = $_GET['post_id'];
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
                where p.post_id =$id;";
	// echo $sql;
	$results = $mysqli->query($sql);
    $details = $results->fetch_assoc();
    
    
    $sqlComments = "select u.username, c.comment
                from comments c
                    left join users u
                        on c.user_id = u.user_id
                where c.post_id =$id ;";

    $comments = $mysqli->query($sqlComments);

    $pid = $_GET['post_id'];
    $uid = $_COOKIE["userid"];
    $sqlLiked = "select * from liked_posts
	            where user_id = $uid and post_id = $pid;";
    $checkLiked = $mysqli->query($sqlLiked);
    $cL = $checkLiked->fetch_assoc();

    $liked = "liked";
    if ($checkLiked->lengths == null) {
        $liked = "not";
    }




	if ( !$results || !$comments) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

    
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title>Sky Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Detailed information about a post shared by @<?php echo $username; ?>.
        Leave a comment or like!">
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="detailedPost.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>
    </style>
</head>

<body>
    <a href="postForm.html">
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

    <div class="main"  onclick= "bodyClick();">
        

        <div id = "p-stream" class="post-stream">

            <div class="post">
                <div class="info">
                    <div class="user">
                        <div class="profile-pic">
                            <img src="img/gray-empty-cat-img.jpg" alt="">
                        </div>

                        <div class="username"><?php echo $details['username']; ?></div>
                    </div>
                </div>

                <img class="post-image" src="<?php echo $details['image']; ?>" alt="">

                <div class="post-content">
                    <div class="reactions">
                        <!-- like png -->
                        <img id = "he<?php echo $details['post_id']; ?>" class="post-icon" onclick= "toggleLike('<?php echo $details['post_id']; ?>')" src="img/icon-png/like.png" alt="">
                        <img id = "hf<?php echo $details['post_id']; ?>" class="post-icon hidden filled" onclick= "toggleLike('<?php echo $details['post_id']; ?>')" src="img/icon-png/like-filled.png" alt="">
                        <!-- comment png -->
                        <!-- <img class="post-icon comment-png" src="img/icon-png/comment.png" alt=""> -->
                    </div>
                </div>
                <div class="text-content">
                    <p id = "likes<?php echo $details['post_id']; ?>" class="likes"><?php echo $details['likes']; ?> like(s)</p>
                    <p class="description"><?php echo $details['caption']; ?></p>



                    <?php if ($details['user_id'] == $_COOKIE['userid']) : ?>
                    
                    <div class="delete">
                        <button class="delete-button" onclick="deletePost();">delete</button>
                    </div>
                    <?php endif; ?>



                </div>

                <div class = "comment-input">
                    <form id = "comment-form" action="">
                        <div class="input-box">
                            <input type="text" placeholder="What comment would you like to leave?" id="comment" name="comment">
                        </div>


                    </form>
                    
                </div>

                <div class = "comment-stream">
                   <dl id = "comment-list">
                   <?php while ( $row = $comments->fetch_assoc() ) : ?>
                       <dt>
                        <div class="comment-pic">
                            <img src="img/gray-empty-cat-img.jpg" alt="">
                        </div>
                        <div class = "comment-box">
                        
                            <div class = "comment-user"><?php echo $row['username']; ?></div>
                            <div class = "comment-content"><?php echo $row['comment']; ?></div>
                            
                        </div>

                       </dt>
                       <?php endwhile; ?>
                       
                   </dl>



                </div>





            </div>


           


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
    <script src="blog.js"></script>
    <script src="detailedPost.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="sitewide.js"></script>
    <script type="text/javascript">
        var postId = <?php echo $details['post_id']; ?>;
        var likedStatus = "<?php echo $liked; ?>";
        console.log(likedStatus);
        console.log(postId);
        
        if (likedStatus == "liked") {
            console.log("change");
            document.querySelector("#he" + postId).classList.toggle("hidden");
            document.querySelector("#hf" + postId).classList.toggle("hidden");
        }

        document.querySelector("#comment-form").onsubmit = function () {
            const comment = document.querySelector("#comment").value.trim();
            
            console.log(comment);

            if ((/^$/.test(comment))) {
                alert("invalid comment input");
            }
            else {
                //add to frontend
                const user = getCookie();
                console.log(user);
                //add to backend
                $.ajax({
                    url: "insertcomment.php",
                    data: {pid: postId, uid: user, input: comment},
                    success: function(result){
                    console.log(result);
                    }
                });
                location.reload();


            }
            return false;

        }
        




        
    </script>

</body>

</html>