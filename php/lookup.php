<?php
	require_once('inc/inc.php');
	require_once('header/lookup.php');
	require_once('views/info.php');

	$json_only = false;

	if(!isset($_GET["isbn"]) or trim($_GET["isbn"]) === '') {
		echo "<p>Please enter an ISBN</p></br>";
		echo "<a href=\"../\">Back</a>";
		die();
	}
	if (isset($_GET["format"])) {
		if ($_GET["format"] == "json") {
			$json_only = true;
		}
		else if (trim($_GET["format"]) != '') {
			echo "<p>Format not recognized</p></br>";
			echo "<a href=\"../\">Back</a>";
			die();
		}
	}
	$isbn = $_GET["isbn"];
	logger($isbn);

	$result = array();
	getBook($isbn, $result);
	$result_json = json_encode($result);
	if ($json_only) {
		echo $result_json;
		die();
	}
	else {
		displayBookInfo($result);
	}
?>
