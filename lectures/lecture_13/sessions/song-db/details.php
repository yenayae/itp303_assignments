<?php

	require '../../config/config.php';

	if ( !isset($_GET['track_id']) || trim($_GET['track_id']) == '') {
		$error = "Invalid Track ID.";
	}	else {
		// $host = "304.itpwebdev.com";
		// $user = "";
		// $pass = "";
		// $db = "";

		// DB Connection.
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$track_id = $_GET['track_id'];

		$sql = "SELECT tracks.name AS track, composer
						FROM tracks
						WHERE track_id = $track_id;";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$row = $results->fetch_assoc();

		$mysqli->close();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Details | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include 'nav.php'; ?>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Song Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if ( isset($error) && trim($error) != '' ) : ?>

				<div class="text-danger">
					<?php echo $error; ?>
				</div>

			<?php else : ?>
				
				<table class="table table-responsive">
					<tr>
						<th class="text-right">Track Name:</th>
						<td><?php echo $row['track']; ?></td>
					</tr>
					<tr>
						<th class="text-right">Artist Name:</th>
						<td>Artist Name</td>
					</tr>
					<tr>
						<th class="text-right">Composer:</th>
						<td><?php echo $row['composer']; ?></td>
					</tr>
					<tr>
						<th class="text-right">Album:</th>
						<td>Album</td>
					</tr>
					<tr>
						<th class="text-right">Genre:</th>
						<td>Genre</td>
					</tr>
					<tr>
						<th class="text-right">Milliseconds:</th>
						<td>Milliseconds</td>
					</tr>
					<tr>
						<th class="text-right">Bytes:</th>
						<td>Bytes</td>
					</tr>
					<tr>
						<th class="text-right">Price:</th>
						<td>Price</td>
					</tr>
				</table>

			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>