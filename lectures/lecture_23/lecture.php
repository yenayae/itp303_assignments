<?php 
	// mail( destination, subject, message, [headers] );

	$destination = "hnguyen0@usc.edu";
	$subject = "Email from ITP 303";
	$message = '<h1>Hi</h1>
				This is a <a href="https://usc.edu">link to USC</a> website.';
	$headers = [
		"content-type" => "text/html",
		"from" => "ttrojan@usc.edu",
		"reply-to" => "no-reply@usc.edu"
	];

	if ( mail($destination, $subject, $message, $headers) ) {
		echo "Success";
	} else {
		echo "Error";
	}
?>