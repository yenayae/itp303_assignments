<?php

	$host = "303.itpwebdev.com";
	$user = "alee2167_db_user";
	$pass = "Choianna0430@";
	$db = "alee2167_dvd_db";
	// Establish MySQL Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	
	$mysqli->set_charset('utf8');
	// Retrieve results from the DB.
	$sql = "select d.dvd_title_id, d.title, d.release_date, g.genre, r.rating
			from dvd_titles d
    			left join genres g
					on g.genre_id = d.genre_id
				left join ratings r
					on r.rating_id = d.rating_id
				where 1 = 1";
				
	if ( isset($_GET['title']) && trim($_GET['title']) != '' ) {
		$dvd_title = $_GET['title'];
		$sql = $sql . " AND d.title LIKE '%$dvd_title%'";
	}
	
	if ( isset( $_GET['genre_id'] ) && trim( $_GET['genre_id'] ) != '' ) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND d.genre_id = $genre_id";
	}
	
	if ( isset( $_GET['rating_id'] ) && trim( $_GET['rating_id'] ) != '' ) {
		$rating_id = $_GET['rating_id'];
		$sql = $sql . " AND d.rating_id = $rating_id";
	}
	
	if ( isset( $_GET['label_id'] ) && trim( $_GET['label_id'] ) != '' ) {
		$label_id = $_GET['label_id'];
		$sql = $sql . " AND d.label_id = $label_id";
	}
	
	if ( isset( $_GET['format_id'] ) && trim( $_GET['format_id'] ) != '' ) {
		$format_id = $_GET['format_id'];
		$sql = $sql . " AND d.format_id = $format_id";
	}
	
	if ( isset( $_GET['sound_id'] ) && trim( $_GET['sound_id'] ) != '' ) {
		$sound_id = $_GET['sound_id'];
		$sql = $sql . " AND d.sound_id = $sound_id";
	}
	if ( isset( $_GET['award'] ) && trim( $_GET['award'] ) != '' ) {
		$award = $_GET['award'];
	
		if ($award == "yes") {
			$sql = $sql . " AND d.award is not null";
		}
		if ($award == "no") {
			$sql = $sql . " AND d.award is null";
		}
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4">
			<div class="col-12 mt-4">
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
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results->fetch_assoc() ) : ?>
							<tr>
								<td>
									<a href="delete.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>&dvd_title=<?php echo $row['title']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete the DVD?');">
										Delete
									</a>
								</td>
								<td>
									<a href="edit_form.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>" class="btn btn-outline-warning">
										Edit
									</a>
								</td>
								<td>
									<a href="details.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>">
										<?php echo $row['title']; ?>
									</a>
								</td>
								<td><?php echo $row['release_date']; ?></td>
								<td><?php echo $row['genre']; ?></td>
								<td><?php echo $row['rating']; ?></td>
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