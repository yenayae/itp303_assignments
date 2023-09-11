<?php

/********************
 *
 * JSON in PHP
 *
 ********************/


$personJson = '{
		"firstName": "Tommy",
		"lastName": "Trojan",
		"age": 18,
		"friends": [
			{
				"firstName": "Traveler",
				"lastName": "van Horse"
			},
			{
				"firstName": "Jane",
				"lastName": "Doe"
			}
		]
	}';

	// var_dump($personJson);

	// echo "<hr>";

	// $personObject = json_decode($personJson);

	// var_dump($personObject);

	// echo "<hr>";

	// var_dump($personObject->lastName);

	// echo "<hr>";



	// $personArray = json_decode($personJson, true);

	// var_dump($personArray);

	// echo "<hr>";

	// var_dump($personArray['lastName']);

/********************
 *
 * cURL & iTunes API
 *
 ********************/
	define("ITUNES_API_ENDPOINT", "https://itunes.apple.com/search?");


	$queryData = [
		"term" => "kanye",
		"limit" => 5
	];

	// term=kanye&limit=5
	var_dump(http_build_query($queryData));

	// Initializes a curl object
	$ch = curl_init();


	// Set curl options

	curl_setopt($ch, CURLOPT_URL, ITUNES_API_ENDPOINT . http_build_query($queryData));

	// Do not require us to tun HTTPS
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	// var_dump($response);

	$response = json_decode($response);

	var_dump($response);


?>