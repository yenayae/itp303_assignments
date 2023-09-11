<?php
	require '../../config/config.php';

	if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
		header('Location: main.php');
	}

	if ( !isset($_GET['track_id']) || trim($_GET['track_id']) == ''
		|| !isset($_GET['track_name']) || trim($_GET['track_name']) == ''
	) {
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

		$sql = "DELETE
						FROM tracks
						WHERE track_id = $track_id;";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		// $row = $results->fetch_assoc();

		$mysqli->close();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete a Song | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include 'nav.php'; ?>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Delete</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Delete a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if (isset($error) && trim($error) != '') : ?>
			
				<div class="text-danger">
					<?php echo $error; ?>
				</div>

			<?php else : ?>

				<div class="text-success"><span class="font-italic"><?php echo $_GET['track_name']; ?></span> was successfully deleted.</div>

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