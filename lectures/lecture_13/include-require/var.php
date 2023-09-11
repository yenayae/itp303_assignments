<?php 
	echo "Hello World!";

	echo "<hr>";

	$ADMIN_NAME = "Tommy Trojan";

	define('ADMIN_NAME','Tommy Trojan');


	var_dump($_GET);

	$_GET['page'] = 1;

	echo "<hr>";
	var_dump($_GET);

	$query = http_build_query($_GET);
	echo "<hr>";
	echo $query;

	echo "<hr>";
	echo $_SERVER['PHP_SELF'] . "?" . $query;

?>