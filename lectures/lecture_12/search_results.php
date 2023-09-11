<?php

	$host = "303.itpwebdev.com";
	$user = "";
	$pass = "";
	$db = "";
	// Establish MySQL Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// Retrieve results from the DB.
	$sql = "SELECT tracks.name AS track, genres.name AS genre, media_types.name AS media_type, track_id
					FROM tracks
					LEFT JOIN genres
						ON tracks.genre_id = genres.genre_id
					LEFT JOIN media_types
						ON tracks.media_type_id = media_types.media_type_id
					WHERE 1 = 1";

	if ( isset($_GET['track_name']) && trim($_GET['track_name']) != '' ) {
		$track_name = $_GET['track_name'];
		$sql = $sql . " AND tracks.name LIKE '%$track_name%'";
	}

	if ( isset( $_GET['genre_id'] ) && trim( $_GET['genre_id'] ) != '' ) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND tracks.genre_id = $genre_id";
	}

	if ( isset( $_GET['media_type_id'] ) && trim( $_GET['media_type_id'] ) != '' ) {
		$media_type_id = $_GET['media_type_id'];
		$sql = $sql . " AND tracks.media_type_id = $media_type_id";
	}

	$sql = $sql . ";";

	// echo "<hr>$sql<hr>";

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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<!-- <tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr> -->

						<?php while ( $row = $results->fetch_assoc() ) : ?>
							<tr>
								<td>
									<a href="delete.php?track_id=<?php echo $row['track_id']; ?>&track_name=<?php echo $row['track']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this track?');">
										Delete
									</a>
								</td>
								<td>
									<a href="edit_form.php?track_id=<?php echo $row['track_id']; ?>" class="btn btn-outline-warning">
										Edit
									</a>
								</td>
								<td>
									<a href="details.php?track_id=<?php echo $row['track_id']; ?>">
										<?php echo $row['track']; ?>
									</a>
								</td>
								<td><?php echo $row['genre']; ?></td>
								<td><?php echo $row['media_type']; ?></td>
							</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>