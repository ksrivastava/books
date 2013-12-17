<?php
	require_once('inc/inc.php');
	require_once('inc/db.php');

	function checkExists($username) {
		global $db;
		$found = false;
		$col = $db->users;
		$cursor = $col->find();
		//echo "All users: " . "</br>";
		foreach ($cursor as $entry) {
			if ($entry["username"] == $username) {
				$found = true;
			}
			//echo $entry["username"] . " " . $entry["password"] . "</br>";
		}
		return $found;
	}

	function insertUser($username, $password) {
		global $db;
		$col = $db->users;
		$entry = array("username" => $username, "password" => $password);
		$status = $col->insert($entry);
		return $status;
	}

	function showLogin($username, $password) {
		echo "
			<form name=\"login\" action=\"login.php\" method=\"GET\">
			<input type=\"hidden\" name=\"username\" value=\"".$username."\"> </br>
			<input type=\"hidden\" name=\"password\" value=\"".$password."\"> </br>
			<input type=\"submit\" value=\"Login\">	
		</form>";
	}

	function createUser($username, $password) {
		$username_exists = checkExists($username);
		if (!$username_exists) {
			$inserted = insertUser($username, $password);
			if ($inserted) {
				echo "<p>Welcome " . $username . "</p></br>";
				showLogin($username, $password);
			}
			else {
				echo "<p>Sorry! Try again.</p></br>";
				echo "<a href=\"../\">Back</a>";
			}
		}
		else {
			echo "<p> " . $username . " already exists! Try again.</p></br>";
			echo "<a href=\"../\">Back</a>";
		}
	}

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

	$username = $_GET['username'];
	$password = $_GET['password'];

	openConnection();

	if (isset($_GET['action']) and $_GET['action'] == "create") {
		createUser($username, $password);
	}

	closeConnection();

?>