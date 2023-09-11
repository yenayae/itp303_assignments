<?php
	// Check to see if any required fields are missing.
	// var_dump($_POST);
	if ( !isset($_POST['title']) || trim($_POST['title']) == '') {
		// One or more of the required fields is empty.
		$error = "Please fill out all required fields.";
	} else {
		// All required fields provided. Continue with the ADD workflow.

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
		$dvd_id = $_POST['dvd_title_id'];
		$title = $_POST['title'];
		
		
		if ( isset($_POST['release_date']) && trim($_POST['release_date']) != '' ) {
			$release_date = $_POST['release_date'];
		} else {
			$release_date = "null";
		}
		if ( isset($_POST['label']) && trim($_POST['label']) != '' ) {
			$label = $_POST['label'];
		} else {
			$label = "null";
		}
		if ( isset($_POST['sound']) && trim($_POST['sound']) != '' ) {
			$sound = $_POST['sound'];
		} else {
			$sound = "null";
		}
		if ( isset($_POST['genre']) && trim($_POST['genre']) != '' ) {
			$genre = $_POST['genre'];
		} else {
			$genre = "null";
		}
		if ( isset($_POST['rating']) && trim($_POST['rating']) != '' ) {
			$rating = $_POST['rating'];
		} else {
			$rating = "null";
		}
		if ( isset($_POST['format']) && trim($_POST['format']) != '' ) {
			$format = $_POST['format'];
		} else {
			$format = "null";
		}
		if ( isset($_POST['award']) && trim($_POST['award']) != '' ) {
			$award = $_POST['award'];
		} else {
			$award = "null";
		}
		
		$sql = "update dvd_titles
					set
						title = '$title',
						release_date = $release_date,
						label_id = $label,
						sound_id = $sound,
						genre_id = $genre,
						rating_id = $rating,
						format_id = $format,
						award = '$award'
					where dvd_title_id = $dvd_id;";


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
	<title>Edit Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php?dvd_title_id=<?php echo $dvd_id;?>">Details</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php?dvd_title_id=<?php echo $dvd_id;?>">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit a DVD</h1>
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

				<div class="text-success"><span class="font-italic"><?php echo $title; ?></span></span> was successfully edited.</div>
				<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?dvd_title_id=<?php echo $dvd_id;?>" role="button" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>