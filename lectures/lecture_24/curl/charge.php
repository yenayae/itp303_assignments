<?php
	require 'config.php';

	if ( !isset($_POST['full-name']) || trim($_POST['full-name'] == '')
		|| !isset($_POST['amount']) || trim($_POST['amount']) == ''
		|| !isset($_POST['card-num']) || trim($_POST['card-num'] == '')
		|| !isset($_POST['exp-month']) || trim($_POST['exp-month'] == '')
		|| !isset($_POST['exp-year']) || trim($_POST['exp-year'] == '')
		|| !isset($_POST['cvc']) || trim($_POST['cvc']) == '' ) {
		$error = "Please fill out all required fields.";
	} else {
		// All fields are filled

		$header = [ "Authorization: Bearer " . STRIPE_API_KEY ];

		$token_data = [
			"card" => [
				'name' => $_POST['full-name'],
				'number' => $_POST['card-num'],
				'exp_month' => $_POST['exp-month'],
				'exp_year' => $_POST['exp-year'],
				'cvc' => $_POST['cvc']
			]
		];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, STRIPE_TOKENS_ENDPOINT);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));

		$token_response = curl_exec($ch);
		$token_response = json_decode($token_response);

		var_dump($token_response);

		echo "<hr>";

		if (isset($token_response->id)) {
			// valid payment method. Received token

			$charge_data = [
				'amount' => ($_POST['amount'] * 100),
				'currency' => 'usd',
				'source' => $token_response->id
			];

			curl_setopt($ch, CURLOPT_URL, STRIPE_CHARGES_ENDPOINT);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($charge_data));

			$response = curl_exec($ch);
			var_dump($response);

		} else {
			// invalid payment method
			$error = $token_response->error->message;
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation | USC Donations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && trim($error) != '' ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success">Success</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="donation_form.php" role="button" class="btn btn-primary">Submit Another Donation</a>
			</div> <!-- .col -->
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>