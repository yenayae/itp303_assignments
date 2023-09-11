<?php

	// $host = "304.itpwebdev.com";
	// $user = "";
	// $pass = "";
	// $db = "";

	// // Establish MySQL Connection.
	// $mysqli = new mysqli($host, $user, $pass, $db);
	
	require '../../config/config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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

	$total_results = $results->num_rows;
	$results_per_page = 10;

	$last_page = ceil($total_results / $results_per_page);

	// $current_page = 1;

	if ( isset($_GET['page']) && trim($_GET['page']) != '' ) {
		$current_page = $_GET['page'];
	} else {
		$current_page = 1;
	}

	if ($current_page < 1 || $current_page > $last_page) {
		$current_page = 1;
	}

	$start_index = ($current_page - 1) * $results_per_page;


	// echo "<hr>$sql<hr>";

	$sql = rtrim($sql, ';');

	// echo "<hr>$sql<hr>";

	$sql = $sql . " LIMIT $start_index, $results_per_page";

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
	<?php include 'nav.php'; ?>
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
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">First</a>
						</li>
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page - 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Previous</a>
						</li>
						<li class="page-item active">
							<a class="page-link" href=""><?php echo $current_page; ?></a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page + 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Next</a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $last_page;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Last</a>
						</li>
					</ul>
				</nav>
			</div> <!-- .col -->

			<div class="col-12">

				<?php if ( $total_results == 0 ) : ?>

					Search returned 0 results.

				<?php else : ?>

					Showing 
					<?php echo $start_index + 1; ?>
					-
					<?php echo $start_index + $results->num_rows; ?>
					of 
					<?php echo $total_results; ?> 
					result(s).

				<?php endif; ?>

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
								<th></th>
							<?php endif ; ?>
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

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
	<td>
		<a href="delete.php?track_id=<?php echo $row['track_id']; ?>&track_name=<?php echo $row['track']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete \'<?php echo $row['track']; ?>\'?');">
			Delete
		</a>
	</td>
<?php endif ; ?>
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

		<div class="col-12">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">First</a>
						</li>
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page - 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Previous</a>
						</li>
						<li class="page-item active">
							<a class="page-link" href=""><?php echo $current_page; ?></a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page + 1;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Next</a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $last_page;
								echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
							?>">Last</a>
						</li>
					</ul>
				</nav>
			</div> <!-- .col -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
	
</body>
</html>