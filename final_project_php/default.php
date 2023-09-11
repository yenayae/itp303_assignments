<!DOCTYPE html>
<html>

<head>
    <title>Log In / Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Log in or Sign up for Sky: Children of the Light">
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="sitewide.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>

    </style>
</head>

<body>

    <div class="default">
        <div class="main">
            <!-- logo -->
            <div class="center">
                <img src="img/sky logo.png" alt="sky logo">
            </div>
                <div class = "login">
                    <span id = "login-error" class = "error hidden"></span>
                    <form id = "login-form" >

                        <div class="inputs">

                                <input type="text" placeholder="Username" id = "username-login" name="username-login" required>

                                <input type="password" placeholder="Password" id = "password-login" name="password-login" required>

                        </div>
                        <button class="submit-button" type="submit">Log In</button>
                    </form>
                    <div class = "su-redirect">
                        New to Sky?
                        <button onclick= "toggleRegistration()" >Sign up!</button>
                    </div>

                </div>

                <div class = "signup hidden">
                    <span id = "signup-error" class = "error hidden"></span>
                    <form id = "signup-form" action="">
                        
                        <div class="inputs">
                                <input type="text" placeholder="Email" id = "email" name="email" required>
                                <input type="text" placeholder="Username" id = "username-signup" name="username-signup" required>

                                <input type="password" placeholder="Password" id = "password-signup" name="password-signup" required>

                        </div>
                        <button class="submit-button" type="submit">Sign Up</button>
  


                    </form>
                    <div class = "su-redirect">
                        Already have an account?
                        <button onclick= "toggleRegistration()" >Log in</button>
                    </div>
                </div>

   



            
        </div>

        
    </div>

    <!-- Footer -->
    <script src="default.js"></script>
    <script src="sitewide.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        
        document.querySelector("#login-form").onsubmit = function () {
            const username = document.querySelector("#username-login").value.trim();
            const password = document.querySelector("#password-login").value.trim();
            const error = document.querySelector("#login-error");
            
            if ((/^$/.test(username) || (/^$/.test(password)))) {
                console.log("empty");
                error.innerHTML = "can't have empty fields!"
                error.classList.remove("hidden");
            }

            else {
                //valid form
                
                //check valid login -- login user and password exists
                $.ajax({
                    url: "checkLogin.php",
                    data: {user: username, pw: password},
                    success: function(result){
                        console.log(result);
                        if (result == "user") {
                            error.innerHTML = "username doesn't exist!"
                            error.classList.remove("hidden");
                        }

                        else if (result == "pw") {
                            error.innerHTML = "invalid login credentials!"
                            error.classList.remove("hidden");
                        }

                        else if (result.includes("success")) {
                            //successful login
                            
                            document.cookie = "userid=" + parseInt(result.match(/\d+/)[0]);
                            error.classList.add("hidden");
                            
                            document.location.href = "about.php";
                        }
                    }
                });



            }


            return false;
        } 

        document.querySelector("#signup-form").onsubmit = function () {
            const email = document.querySelector("#email").value.trim();
            const username = document.querySelector("#username-signup").value.trim();
            const password = document.querySelector("#password-signup").value.trim();

            const error = document.querySelector("#signup-error");

            // console.log(email + " " + username + " " + password);
            //validate user input
            if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)) {
                error.innerHTML = "that's not an email"
                error.classList.remove("hidden");
            }

            else if (!/\d{1}/.test(password) || !/[a-z]{1}/.test(password) || !/[A-Z]{1}/.test(password)
                || !/!|@|#|\$|%|\^|&|\*/.test(password)) {
                console.log("insecure");
                error.innerHTML = "insecure password";
                error.classList.remove("hidden");
            }

            else {
                //valid form
                console.log("valid form");
                
                //check valid signup -- unique username
                $.ajax({
                    url: "registerUser.php",
                    data: {user: username, pw: password, em: email},
                    success: function(result){
                        console.log(result);
                        if (result == "user") {
                            error.innerHTML = "username already exists";
                            error.classList.remove("hidden");
                        }

                        else if (result == "email") {
                            error.innerHTML = "email already exists";
                            error.classList.remove("hidden");
                        }

                        else if (result == "success") {
                            error.classList.add("hidden");
                            document.location.href = "default.php";
                        }
                    }
                });
            }

            return false;
        } 

    </script>

</body>

</html>