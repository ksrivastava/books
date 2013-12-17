<?php
	require_once('inc/inc.php');
	require_once('inc/db.php');

	function checkUser($username, $password, &$id) {
		global $db;
		$valid = false;
		$col = $db->users;
		$cursor = $col->find();
		foreach ($cursor as $entry) {
			if ($entry["username"] == $username && $entry["password"] == $password) {
				$valid = true;
				$id = $entry["_id"];
			}
			//echo $entry["username"] . " " . $entry["password"] . "</br>";
		}
		return $valid;
	}

	function invalidLogin() {
		echo "<p>Invalid login!</p></br>";
		echo "<a href=\"../\">Back</a>";
		die();
	}

	// Main

	if (!isset($_GET['username']) or trim($_GET['username']) === '') {
		echo "<p>Please enter a valid username</p></br>";
		echo "<a href=\"../\">Back</a>";
		die();
	}
	else if (!isset($_GET['password']) or trim($_GET['password']) === '') {
		echo "<p>Please enter a valid password</p></br>";
		echo "<a href=\"../\">Back</a>";
		die();
	}
	else if (!isset($_GET['format'])) {
		echo "<p>Please enter a valid format</p></br>";
		echo "<a href=\"../\">Back</a>";
		die();
	}

	$username = $_GET['username'];
	$password = $_GET['password'];
	$format = $_GET['format'];

	openConnection();

	$valid = checkUser($username, $password, $id);
	if ($valid) {
		include('home.php');
		if ($format == "json") {
			listBooks($username, $id);
		}
		else {
			displayWelcome($username, $id);
		}
	}
	else {
		invalidLogin();
	}
	
	closeConnection();

?>