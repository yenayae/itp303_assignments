<?php

	require '../../config/config.php';

	// $host = "304.itpwebdev.com";
	// $user = "";
	// $pass = "";
	// $db = "";

	// Establish MySQL Connection.
	// $mysqli = new mysqli($host, $user, $pass, $db);
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	// Retrieve all genres from the DB.
	$sql_genre = "SELECT * FROM genres;";

	$results_genre = $mysqli->query( $sql_genre );

	// Check for SQL Errors.
	if ( !$results_genre ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Retrieve all media types from the DB.
	$sql_media = "SELECT * FROM media_types;";

	$results_media = $mysqli->query( $sql_media );

	// Check for SQL Errors.
	if ( !$results_media ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection.
	$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include 'nav.php'; ?>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item active">Search</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre_id" id="genre-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>Rock</option>
						<option value='2'>Jazz</option>
						<option value='3'>Metal</option>
						<option value='4'>Alternative & Punk</option>
						<option value='5'>Rock And Roll</option> -->

						<?php while ( $row = $results_genre->fetch_assoc() ) : ?>
							<option value="<?php echo $row['genre_id']; ?>">
								<?php echo $row['name']; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type_id" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option> -->

						<?php while ( $row = $results_media->fetch_assoc() ) : ?>
							<option value="<?php echo $row['media_type_id']; ?>">
								<?php echo $row['name']; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>