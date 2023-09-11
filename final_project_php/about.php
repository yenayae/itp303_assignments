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
	// Close MySQL Connection
	$mysqli->close();

    


?>


<!DOCTYPE html>
<html>

<head>
    <title>About Sky</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to the enchanting world of Sky, a pleasant puzzle-adventure game. Spread Light through the desolate 
    kingdom and return the fallen Stars to their constellations.">  
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <script src="sitewide.js"></script>
    <style>
        @media (max-width: 1623px) {

            .header-description {
                top: 55%;

            }

        }
    </style>
</head>

<body>
    <div class="navbar">
        <a class="def-button d-color" href="about.php">
            about
        </a>

        <a class="def-button d-color" href="gallery.php">
            gallery
        </a>
        <a class="def-button d-color" href="blog.php">
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


        <div class="center">
            <img src="img/sky logo.png" alt="sky logo">

            <h4>children of the light</h4>
            <span class="main-desc">Welcome to the enchanting world of Sky, a pleasant puzzle-adventure game. Spread
                Light through the desolate kingdom and return the fallen Stars to their
                constellations. </span>
        </div>

        <div class="contents">
            <!-- <img class = "icon-img" src="img/defaultpg/Manta_Pin.webp" alt=""> -->
            <!-- <span>featured trailer! </span> -->


            <iframe src="https://www.youtube.com/embed/IsbrHWMZXn4" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

            <h5>"When fears are grounded, dreams take flight"</h5>
            <span class="sum">From the award-winning creators behind Journey (2012 Game of The Year) and the
                highly-acclaimed
                Flower, comes a ground-breaking social adventure that is set to warm players hearts. Welcome to the
                enchanting world of Sky, a beautifully-animated kingdom waiting to be explored by you and your loved
                ones. In Sky, we arrive as Children of the Light, spreading hope through the desolate kingdoms. The
                world of Sky: Children of the Light allows the player to explore a fantasy-based Kingdom, using
                free-roaming experience and a magical Cape that grants players the ability to fly. There are seven
                unique Realms to visit, and each one is themed around a different stage in life.</span>
            <img class="icon-img" src="img/defaultpg/Lightseeker_Cape_Pin.png" alt="">
            <!-- <img class = "icon-img manta" src="img/defaultpg/Manta_Pin.webp" alt=""> -->
            <!-- <img class = "icon-img" src="img/defaultpg/Lightseeker_Cape_Pin.png" alt=""> -->
            <div class="quote">


                <img class="banner " src="img/defaultpg/try.jpeg" alt="">
                <div class="tut">
                    <div class="tut-title">unravel the mystery</div>
                    <span class="tut-desc">explore the realms of Sky to uncover the history of the world.</span>

                </div>



                <!-- <div class = "fade"></div> -->
                <img class="banner " src="img/defaultpg/12.jpeg" alt="">
                <div class="tut">
                    <div class="tut-title">free the spirits</div>
                    <span class="tut-desc">return your ancestors' spirits to the sky to complete the constellation
                        for each realm.</span>

                </div>



                <img class="banner " src="img/defaultpg/plrv3kge5eh71.jpeg" alt="">
                <div class="tut">
                    <div class="tut-title">make friends</div>
                    <span class="tut-desc">become a part of a loving community within the realms of Sky.</span>

                </div>

                <img class="banner " src="img/defaultpg/EdPqwy3UYAEdI3H.png-large.png" alt="">
                <div class="tut">
                    <div class="tut-title">ascend to the Storm</div>
                    <span class="tut-desc">gather your friends and deliver winged light through Eden to fulfill
                        your destiny.</span>

                </div>




            </div>


            <span class = "underline">available on the following platforms:</span>
            <div class="platforms">

                <div class="logo-platform">
                    <a href="https://apps.apple.com/us/app/sky-children-of-the-light/id1462117269">
                        <img src="img/logos/icons8-apple-logo-500.png" alt="apple">
                    </a>
                </div>
                <div class="logo-platform">
                    <a href="https://play.google.com/store/apps/details?id=com.tgc.sky.android&hl=en_US&gl=US">
                        <img src="img/logos/icons8-google-play-500.png" alt="google play">
                    </a>
                </div>
                <div class="logo-platform">
                    <a href="https://www.nintendo.com/store/products/sky-children-of-the-light-switch/">
                        <img src="img/logos/icons8-nintendo-switch-logo-500.png" alt="nintendo switch">
                    </a>
                </div>
                <div class="logo-platform">
                    <a href="https://store.playstation.com/en-us/concept/10004206">
                        <img src="img/logos/icons8-playstation-480.png" alt="play station">
                    </a>
                </div>


            </div>
            <!-- platforms end -->


        </div>











        <img class = "soul-img" src="img/defaultpg/Soulmates_in_Sky_Pins.webp" alt="">
    </div>
    <hr>
    
    <!-- Footer -->
    <div class="footer ">
        <div class="icons">
            <a class="icon facebook" href="https://www.facebook.com/thatskygame/">
                <img src="img/logos/facebook-white.png" alt="">
            </a>
            <a class="icon twitter" href="https://twitter.com/thatskygame?lang=en">
                <img src="img/logos/twitter-white.png" alt="">
            </a>
            <a class="icon instagram" href="https://www.instagram.com/thatskygamejp/">
                <img src="img/logos/instagram-white.png" alt="">
            </a>
            <a class="icon discord" href="https://discord.com/invite/thatskygame">
                <img src="img/logos/disc-white.png" alt="">
            </a>
        </div>
        <div class="bottom-text">
            <p>University of Southern California &copy; 2023</p>
        </div>
    </div>


    <script>
// Tabbed Menu

    </script>

</body>

</html>