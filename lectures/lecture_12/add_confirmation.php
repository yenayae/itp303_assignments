<?php
	// Check to see if any required fields are missing.

	if ( !isset($_POST['track_name']) || trim($_POST['track_name']) == ''
		|| !isset($_POST['media_type_id']) || trim($_POST['media_type_id']) == ''
		|| !isset($_POST['genre_id']) || trim($_POST['genre_id']) == ''
		|| !isset($_POST['milliseconds']) || trim($_POST['milliseconds']) == ''
		|| !isset($_POST['price']) || trim($_POST['price']) == '' ) {
		// One or more of the required fields is empty.
		$error = "Please fill out all required fields.";
	} else {
		// All required fields provided. Continue with the ADD workflow.

		$host = "303.itpwebdev.com";
		$user = "";
		$pass = "";
		$db = "";

		// DB Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$track_name = $_POST['track_name'];
		$media_type_id = $_POST['media_type_id'];
		$genre_id = $_POST['genre_id'];
		$milliseconds = $_POST['milliseconds'];
		$price = $_POST['price'];


		// $bytes = 1 OR null
		if ( isset($_POST['bytes']) && trim($_POST['bytes']) != '' ) {
			$bytes = $_POST['bytes'];
		} else {
			$bytes = "null";
		}

		if ( isset($_POST['album_id']) && trim($_POST['album_id']) != '' ) {
			$album_id = $_POST['album_id'];
		} else {
			$album_id = "null";
		}

		// $composer = 'user input' OR null
		if ( isset($_POST['composer']) && trim($_POST['composer']) != '' ) {
			// $composer = 'USER INPUT'
			$composer = "'". $_POST['composer'] . "'";
		} else {
			$composer = "null";
		}


		$sql = "INSERT INTO tracks (name, media_type_id, genre_id, milliseconds, unit_price, album_id, composer, bytes)
						VALUES ('$track_name', $media_type_id, $genre_id, $milliseconds, $price, $album_id, $composer, $bytes);";

		// echo "<hr>$sql<hr>";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}


		$mysqli->close();

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger">
						<!-- Show Error Messages Here. -->
						<?php echo $error; ?>
					</div>

				<?php else : ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $track_name; ?></span> was successfully added.
					</div>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>