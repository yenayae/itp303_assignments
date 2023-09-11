<?php

	if ( !isset($_GET['dvd_title_id']) || trim($_GET['dvd_title_id']) == '' ) {
		$error = "Invalid URL.";
	} else {

	$host = "303.itpwebdev.com";
	$user = "alee2167_db_user";
	$pass = "Choianna0430@";
	$db = "alee2167_dvd_db";
		
		// Establish MySQL Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);
			$mysqli->set_charset('utf8');
		// Check for any Connection Errors.
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		$dvd_id = $_GET['dvd_title_id'];
		
		$sql = "select d.dvd_title_id, d.title, d.release_date, d.award, l.label, s.sound, g.genre, r.rating, f.format
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
		$row = $results->fetch_assoc();
		if (empty($row)) {
			$error = "Invalid URL.";
		}
		
		
		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();

	}
	

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger font-italic">
						<!-- Show Error Messages Here. -->
						<?php echo $error; ?>
					</div>
				
				<?php else : ?>

					<table class="table table-responsive">

						<tr>
							<th class="text-right">Title:</th>
							<td><?php echo $row['title']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Release Date:</th>
							<td><?php echo $row['release_date']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Genre:</th>
							<td><?php echo $row['genre']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Label:</th>
							<td><?php echo $row['label']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Rating:</th>
							<td><?php echo $row['rating']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Sound:</th>
							<td><?php echo $row['sound']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Format:</th>
							<td><?php echo $row['format']; ?></td>
						</tr>

						<tr>
							<th class="text-right">Award:</th>
							<td><?php echo $row['award']; ?></td>
						</tr>

					</table>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
				<a href="edit_form.php?dvd_title_id=<?php echo $_GET['dvd_title_id']; ?>" role="button" class="btn btn-warning">Edit this DVD</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>