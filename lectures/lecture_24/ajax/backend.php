<?php

	require 'config.php';

	$personArray = [
		"firstName" => "Tommy",
		"lastName" => "Trojan",
		"age" => 18,
		"friends" => [
			[
				"firstName" => "Traveler",
				"lastName" => "van Horse"
			],
			[
				"firstName" => "Jane",
				"lastName" => "Doe"
			],
		]
	];

	// var_dump($personArray);

	// echo "<hr>";

	// $personJson = json_encode($personArray);

	// var_dump($personJson);

	// echo "<hr>";

	// echo $personJson;


	

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	$sql = "SELECT tracks.name AS track, genres.name AS genre
					FROM tracks
					LEFT JOIN genres
						ON tracks.genre_id = genres.genre_id
					WHERE 1 = 1";

	if ( isset($_GET['track_name']) && !empty($_GET['track_name']) ) {
		$track_name = $_GET['track_name'];
		$track_name = $mysqli->escape_string($track_name);
		$sql = $sql . " AND tracks.name LIKE '%$track_name%'";
	}

	if ( isset( $_GET['genre_id'] ) && !empty( $_GET['genre_id'] ) ) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND tracks.genre_id = $genre_id";
	}

	$sql = $sql . " LIMIT 0, 10";

	$sql = $sql . ";";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$mysqli->close();

	$all_rows = $results->fetch_all(MYSQLI_ASSOC);

	// var_dump($all_rows);

	// echo "<hr>";

	// var_dump(json_encode($all_rows));

	echo json_encode($all_rows);



?>