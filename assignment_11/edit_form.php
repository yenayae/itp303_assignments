<?php

if ( !isset( $_GET['dvd_title_id'] ) || trim( $_GET['dvd_title_id'] ) == '' ) {
	// Track ID is missing.
	$error = "Invalid URL";
	exit();
}

	$host = "303.itpwebdev.com";
	$user = "alee2167_db_user";
	$pass = "Choianna0430@";
	$db = "alee2167_dvd_db";

// DB Connection.
$mysqli = new mysqli($host, $user, $pass, $db);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

// Track Information:

$dvd_id = $_GET['dvd_title_id'];
$sql = "select d.dvd_title_id, d.title, d.release_date, d.award, l.label, s.sound, g.genre, r.rating, f.format, d.label_id, d.sound_id, d.genre_id, d.rating_id, d.format_id
					from dvd_titles d
					left join labels l
						on l.label_id = d.label_id
					left join sounds s
						on s.sound_id = d.sound_id
					left join genres g
						on g.genre_id = d.genre_id
					left join ratings r
						on r.rating_id = d.rating_id
					left join formats f
						on f.format_id = d.format_id
					where dvd_title_id = $dvd_id;";

$results = $mysqli->query($sql);
if (!$results) {
	echo $mysqli->error;
	$mysqli->close();
	exit();
}


		
	$row_track = $results->fetch_assoc();
	
	$label_select = $row_track['label'];
	$sound_select = $row_track['sound'];
	$genre_select = $row_track['genre'];
	$rating_select = $row_track['rating'];
	$format_select = $row_track['format'];
	
	if ($row_track['label'] == NULL) {
		$label_select = "-- Select One --";
	}
	if ($row_track['sound'] == NULL) {
		$sound_select = "-- Select One --";
	}
	if ($row_track['genre'] == NULL) {
		$genre_select = "-- Select One --";
	}
	if ($row_track['rating'] == NULL) {
		$rating_select = "-- Select One --";
	}
	if ($row_track['format'] == NULL) {
		$format_select = "-- Select One --";
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
	
	//retrieving rating
	$sql_rating = "select * from ratings";
	$results_ratings = $mysqli->query ($sql_rating);
	if (!$results_ratings) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}
	
	//retriving labels
	$sql_labels = "select * from labels";
	$results_labels = $mysqli->query ($sql_labels);
	if (!$results_labels) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}
	
	//retrieving formats
	$sql_formats = "select * from formats";
	$results_formats = $mysqli->query ($sql_formats);
	if (!$results_formats) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}
	
	//retrieving sounds
	$sql_sounds = "select * from sounds";
	$results_sounds = $mysqli->query ($sql_sounds);
	if (!$results_sounds) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}



// Close DB Connection
$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Form | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php?dvd_title_id=<?php echo $_GET['dvd_title_id']; ?>">Details</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
			<?php if ( isset($error) && trim($error) != '' ) : ?>
			<div class="col-12 text-danger">
				

					<div class="text-danger font-italic">
						<!-- Show Error Messages Here. -->
						<?php echo $error; ?>
					</div>
				
				
			</div>
			<?php else : ?>
			<form action = "edit_confirmation.php" method = "POST">

				<div class="form-group row">
					<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input type="hidden" name="dvd_title_id" value="<?php echo $dvd_id; ?>">
						<input type="text" class="form-control" id="title-id" name="title" value = "<?php echo $row_track['title']; ?>">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="release-date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" id="release-date-id" name="release_date" value = "<?php echo $row_track['release_date']; ?>">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
					<div class="col-sm-9">
						<select name="label" id="label-id" class="form-control">
							<option value="<?php echo $row_track['label_id']; ?>" selected><?php echo $label_select; ?></option>
						<?php while ( $row = $results_labels->fetch_assoc() ) : ?>
							<option value="<?php echo $row['label_id']; ?>">
								<?php echo $row['label']; ?>
							</option>
						<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
					<div class="col-sm-9">
						<select name="sound" id="sound-id" class="form-control">
							<option value="<?php echo $row_track['sound_id']; ?>" selected><?php echo $sound_select; ?></option>
						<?php while ( $row = $results_sounds->fetch_assoc() ) : ?>
							<option value="<?php echo $row['sound_id']; ?>">
								<?php echo $row['sound']; ?>
							</option>
						<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
					<div class="col-sm-9">
						<select name="genre" id="genre-id" class="form-control">
							<option value="<?php echo $row_track['genre_id']; ?>" selected><?php echo $genre_select; ?></option>
						<?php while ( $row = $results_genre->fetch_assoc() ) : ?>
							<option value="<?php echo $row['genre_id']; ?>">
								<?php echo $row['genre']; ?>
							</option>
						<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
					<div class="col-sm-9">
						<select name="rating" id="rating-id" class="form-control">
							<option value="<?php echo $row_track['rating_id']; ?>" selected><?php echo $rating_select; ?></option>
						<?php while ( $row = $results_ratings->fetch_assoc() ) : ?>
							<option value="<?php echo $row['rating_id']; ?>">
								<?php echo $row['rating']; ?>
							</option>
						<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
					<div class="col-sm-9">
						<select name="format" id="format-id" class="form-control">
							<option value="<?php echo $row_track['format_id']; ?>" selected><?php echo $format_select; ?></option>
						<?php while ( $row = $results_formats->fetch_assoc() ) : ?>
							<option value="<?php echo $row['format_id']; ?>">
								<?php echo $row['format']; ?>
							</option>
						<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
					<div class="col-sm-9">
						<textarea name="award" id="award-id" class="form-control" value = ""><?php echo $row_track['award']; ?></textarea>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="ml-auto col-sm-9">
						<span class="text-danger font-italic">* Required</span>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-light">Reset</button>
					</div>
				</div> <!-- .form-group -->

			</form>
			<?php endif; ?>
	</div> <!-- .container -->
</body>
</html>