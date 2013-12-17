<?php
	function openConnection() {
		return new MongoClient();
	}

	function checkExists($username) {
		$conn = openConnection();
		$db = $conn->books;
		
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
		$conn->close();
		return $found;
	}

	function insertUser($username, $password) {
		$conn = openConnection();
		$db = $conn->books;

		$col = $db->users;
		$entry = array("username" => $username, "password" => $password);
		$status = $col->insert($entry);
		$conn->close();
		return $status;
	}

	function authenticate($username, $password) {
		$conn = openConnection();
		$db = $conn->books;

		$col = $db->users;
		$cursor = $col->find();
		foreach ($cursor as $entry) {
			if ($entry["username"] == $username && $entry["password"] == $password) {
				 $conn->close();
				 return $entry["_id"];
			}
			//echo $entry["username"] . " " . $entry["password"] . "</br>";
		}
		$conn->close();
		return null;
	}

	function generateSession($username) {
		$start_time = time();
		$expiry_time = $start_time + 60;
		$session_id = strlen($username);
		// $conn = openConnection();
		// $db = $conn->books;
		// $col = $db->sessions;

		// $session_id = new rand();

		// $entry = array("username" => $username, "session_id" => $session_id, "expiry" => $expiry_time);
		// $col->insert($entry);
		// $conn->close();
		//$_SESSION["session_id"] = $session_id;
	}

?>