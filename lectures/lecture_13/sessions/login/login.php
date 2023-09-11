<?php 
	session_start();

	// Check if user already logged in 
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		header("Location: ../song-db/main.php");
	}

	// Check if user submitted form
	if (isset($_POST['username']) && isset($_POST['password'])) {
		// Form submitted

		if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
			// Missing values
			$error = "Please enter username and password.";
		} elseif ( $_POST['username'] == 'tommy' &&  $_POST['password'] == 'trojan') {
			// Valid credentials
			$_SESSION['logged_in'] = true;
			$_SESSION['username'] = $_POST['username'];

			header("Location: ../song-db/main.php");
		} else {
			// Invalid credentials
			$error = "Invalid username or password.";
		}

	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Login</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="login.php" method="POST">

			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<?php 
						if (!empty($error)) {
							echo $error;
						}
					 ?>
				</div>
			</div> <!-- .row -->
			

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username-id" name="username">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
				</div>
			</div> <!-- .form-group -->
		</form>

	</div> <!-- .container -->
</body>
</html>