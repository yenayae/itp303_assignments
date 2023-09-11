<?php 
	$name = "Tommy Trojan";
	$age = 21;
	$courses = [3, 'itp300', 'itp301', 'itp460'];
	$courseNames = [
		'itp104' => 'Web Publishing',
		'itp300' => 'Database Web Development',
		'itp301' => 'Interactive Web Development',
		'itp460' => 'Web Application Project'
	];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

			<div class="col-12">
				<!-- Display Test Output Here -->
				<?php
					echo "Hello World!";

					echo "<hr>";

					echo $name;
					echo "<hr>";

					echo $age;
					echo "<hr>";

					var_dump($name);
					echo "<hr>";

					var_dump($age);
					echo "<hr>";

					echo "My name is " . $name . " and I am " . $age . " years old.";
					echo "<hr>";

					echo "Double quotes: $name, $age";
					echo "<hr>";

					echo 'Single quotes: $name, $age';
					echo "<hr>";

					echo "<pre>";

					// echo $courses;
					var_dump($courses);

					echo "</pre>";

					echo $courses[1];
					echo "<hr>";

					for ($i = 0; $i < sizeof($courses); $i++) {
						echo $courses[$i];
						echo "<hr>";
					}

					echo $courseNames['itp301'];
					echo "<hr>";

					foreach ($courseNames as $key => $value) {
						echo "$key: $value";
						echo "<hr>";
					}

					echo "<pre>";
					var_dump($_SERVER);
					echo "</pre>";

					echo "<hr>";
					echo $_SERVER['DOCUMENT_ROOT'];

					echo "<hr>";

					echo "<pre>";
					var_dump($_POST);
					echo "</pre>";

					echo "<pre>";
					var_dump($_GET);
					echo "</pre>";

					$flag = true;

					if ($flag) {
						echo "true";
					} else {
						echo "false";
					}
					echo "<hr>";
				?>

				<?php if ($flag) { ?>
					true
				<?php } else { ?>
					false
				<?php } ?>
			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

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

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

						<tr>
							<td>Put The Finger On You</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

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