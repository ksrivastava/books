<?php
	function openConnection() {
		return new MongoClient();
	}

	function checkExists($username) {
		$conn = openConnection();
		$col = $conn->books->users;
		$query = array('username' => $username);
		$cursor = $col->find($query);
		$found = $cursor->hasNext();
		$conn->close();
		return $found;
	}

	function insertUser($username, $password) {
		$conn = openConnection();
		$col = $conn->books->users;
		$entry = array("username" => $username, "password" => $password);
		$status = $col->insert($entry);
		$conn->close();
		return $status;
	}

	function insertUserBooks($user_id, $isbn) {
		$conn = openConnection();
		$col = $conn->books->userBooks;
		$entry = array("user_id" => $user_id, "isbn" => $isbn);
		$status = $col->insert($entry);
		$conn->close();
		return $status;
	}

	function getUserBooks($user_id, &$isbn_array) {
		$conn = openConnection();
		$col = $conn->books->userBooks;
		$query = array("user_id" => $user_id);
		$cursor = $col->find($query);
		$cursor->sort(array('isbn' => 1));
		foreach ($cursor as $entry) {
			$isbn_array[] = $entry['isbn'];
		}
		$conn->close();
	}

	function authenticate($username, $password) {
		$conn = openConnection();
		$col = $conn->books->users;

		$query = array('username' => $username, 'password' => $password);
		$cursor = $col->find($query);
		if($cursor->hasNext()) {
			$entry = $cursor->getNext();
			$conn->close();
			return $entry["_id"];
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