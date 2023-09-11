<?php
	require '../../config/config.php';

	// Check for required data.
	if ( !isset($_POST['track_name']) || trim($_POST['track_name']) == ''
		|| !isset($_POST['media_type']) || trim($_POST['media_type']) == ''
		|| !isset($_POST['genre']) || trim($_POST['genre']) == ''
		|| !isset($_POST['milliseconds']) || trim($_POST['milliseconds']) == ''
		|| !isset($_POST['price']) || trim($_POST['price']) == ''
		|| !isset($_POST['track_id']) || trim($_POST['track_id']) == ''
	) {
		$error = "Please fill out all required fields.";
	} else {

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

		$track_id = $_POST['track_id'];
		$track = $_POST['track_name'];
		$genre = $_POST['genre'];
		$media_type = $_POST['media_type'];
		$milliseconds = $_POST['milliseconds'];
		$price = $_POST['price'];

		if ( isset($_POST['album']) && trim($_POST['album']) != '') {
			$album = $_POST['album'];
		} else {
			$album = "null";
		}

		if ( isset($_POST['bytes']) && trim($_POST['bytes']) != '') {
			$bytes = $_POST['bytes'];
		} else {
			$bytes = "null";
		}

		if ( isset($_POST['composer']) && trim($_POST['composer']) != '') {
			$composer = "'" . $_POST['composer'] . "'";   // 'Tommy Trojan'
		} else {
			$composer = "null";	// null
		}

		$sql = "UPDATE tracks
						SET name = '$track',
						media_type_id = $media_type,
						genre_id = $genre,
						milliseconds = $milliseconds,
						unit_price = $price
						WHERE track_id = $track_id;";

		// $sql = "INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price) VALUES ('$track', $album, $media_type, $genre, $composer, $milliseconds, $bytes, $price);";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		// Close MySQL Connection
		$mysqli->close();

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include 'nav.php'; ?>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Confirmation</h1>
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

		<div class="text-success">
			<span class="font-italic"><?php echo $track; ?></span> was successfully edited.
		</div>

	<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Go to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>