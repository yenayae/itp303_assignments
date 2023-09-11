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
    <title>Sky Gallery</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gallery of images taken from the game Sky: Children of the Light. Take
        a peek at all the 7 realms and concept arts behind them!">
    <link rel="stylesheet" href="gallery.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <script src="sitewide.js"></script>
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


        <div class="header-banner">
            <h2 class="title">Realms of Sky</h2>
            <div class="arrows">
                <div class="arrow-down"></div>
                <div class="arrow-down"></div>
            </div>
        </div>




        <div class="realms">
            <div id="isle-banner" class="realm-banner">
                <div class="realm-description isle-description">
                    <h3>Isle of Dawn</h3>
                    <p>Isle of Dawn is the first realm that you will visit when you first start the game. It will be the
                        only Portal available to you from Home. This is where you will encounter your first
                        Winged Light and receive your cape. A tutorial will take you through how to find Spirits, more
                        Winged Light to grow your fight power, and teach you how to fly.
                        Isle is based on the concept of birth, and the original name for this realm was Dawn.</p>
                </div>
            </div>
            <div id="prarie-banner" class="realm-banner">
                <div class="realm-description prarie-description">
                    <h3>Daylight Prairie</h3>
                    <p>Daylight Prairie is the second realm you'll come across in your adventures. Here is where you
                        begin your adventure proper, and on first playing the game, is likely where you will encounter
                        other players for the first time. Sky is an online multiplayer experience, and the strangers
                        that you meet are real players from around the globe.
                        Daylight Prairie is based on the concept of childhood. Its original name was Cloudy Day.</p>
                    </p>
                </div>

            </div>
            <div id="forest-banner" class="realm-banner">
                <div class="realm-description forest-description">
                    <h3>Hidden Forest</h3>
                    <p>Hidden Forest is the third Realm along your journey, and here is the first time you may
                        encounter creatures or environmental factors that can harm you. Rain can drain your cape energy
                        and cause your light to go out, and Dark Crabs can knock you down and potentially cause you to
                        lose Winged Light. This realm is based on the concept of teenage years, and its original name
                        was Rain.</p>
                </div>

            </div>
            <div id="valley-banner" class="realm-banner">
                <div class="realm-description valley-description">
                    <h3>Valley of Triumph</h3>
                    <p>Valley of Triumph is the fourth realm you will find to explore, and will take you through the
                        remnants of ancient cities. One route through the Realm will take you through a sliding race;
                        another route through a flying race. Both races end in the same Coliseum, beyond which is the
                        Temple where you will meet the twin Valley Elders.
                        Valley of Triumph is built around the concept of adulthood, and its original name was Sunset.
                    </p>
                </div>

            </div>
            <div id="wasteland-banner" class="realm-banner">
                <div class="realm-description wasteland-description">
                    <h3>Golden Wasteland</h3>
                    <p>Golden Wasteland is the fifth realm you will come across. This is the first realm where you
                        encounter Dark Dragons, as well as an abundant amount of Dark Crabs. You'll also find polluted
                        water, a harmful substance that will slowly drain your light if you stand in it. This Realms has
                        several offshoot areas to explore.
                        Golden Wasteland is based off the concept of middle years, and its original name was Dusk.</p>
                </div>

            </div>
            <div id="vault-banner" class="realm-banner">
                <div class="realm-description vault-description">
                    <h3>Vault of Knowledge</h3>
                    <p>Vault of Knowledge is the sixth realm you'll encounter. This Realm consists of several levels as
                        well as several offshoot areas. There are a number of puzzles to complete in order to make your
                        way up the Vault floor by floor. Two large doors require four players to open and one area
                        requires a special cape in order to enter it.
                        Vault of Knowledge is based on the concept of ageing/old age, and it's original name was Night.
                    </p>
                </div>

            </div>


        </div>
        <!-- realms end -->

        <div class="header-banner">
            <h2 class="title">Concept Art</h2>
            <p>credit to <a href="https://www.tomzhao.com">tom zhao</a></p>
            <div class="arrows">
                <div class="arrow-down"></div>
                <div class="arrow-down"></div>
            </div>
        </div>

        <div class="concept-art">
            <div class="card1">
                <div class="art1">
                    <img src="img/concept-art/c2/006_Sky.jpeg" alt="">
                </div>
                <div class="art2"><img src="img/concept-art/c2/009b_Sky.jpeg" alt=""></div>
            </div>
            <div class="card2">
                <div class="art3"><img src="img/concept-art/c2/012_Sky.jpeg" alt=""></div>
                <div class="art4"><img src="img/concept-art/c2/011_Sky.jpeg" alt=""></div>
            </div>

            <div class="card3">
                <div class="art5"><img src="img/concept-art/c3/044_Sky.jpeg" alt=""></div>
            </div>

            <div class="card4">
                <div class="art6"><img src="img/concept-art/c3/042_Sky.jpeg" alt=""></div>
                <div class="art6"><img src="img/concept-art/c3/043_Sky.jpeg" alt=""></div>
            </div>

            <div class="card2">
                <div class="art4"><img src="img/concept-art/c3/033_Sky.jpeg" alt=""></div>
                <div class="art3"><img src="img/concept-art/c4/052_Sky.jpeg" alt=""></div>

            </div>

            <div class="card4">
                <div class="art6"><img src="img/concept-art/c4/056_Sky.jpeg" alt=""></div>
                <div class="art6"><img src="img/concept-art/c4/057_Sky.jpeg" alt=""></div>
            </div>

            <div class="card6">
                <div class="art8"><img src="img/concept-art/c5/148_Sky.jpeg" alt=""></div>
                <div class="art9"><img src="img/concept-art/115_Sky.jpeg" alt=""></div>
            </div>

            <div class="card-auto">
                <div class="art5"><img src="img/concept-art/126_Sky.jpeg" alt=""></div>
            </div>

            <div class="card7">
                <div class="art3"><img src="img/concept-art/c6/113_Sky.jpeg" alt=""></div>
                <div class="art4"><img src="img/concept-art/c6/205_Sky.jpeg" alt=""></div>
            </div>

            <div class="card7">
                <div class="art14"><img src="img/concept-art/c1/088_Sky.jpeg" alt=""></div>
                <div class="art13"><img src="img/concept-art/c1/064_Sky.jpeg" alt=""></div>

            </div>

            <div class="card3" id="last-banner">
                <div class="art5"><img src="img/concept-art/101_Sky.jpeg" alt=""></div>
            </div>
        </div> <!-- concept art end -->
    </div>



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
        <div class = "bottom-text">
            <p class = "tgc">University of Southern California &copy; 2023</p>
        </div>
    </div>

    <script>
// Tabbed Menu

    </script>

</body>

</html>