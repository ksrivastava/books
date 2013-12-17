<?php
	$conn = null;
	$db = null;
	function openConnection() {
		global $conn, $db;
		$conn = new MongoClient();
		$db = $conn->books;
	}

	function closeConnection() {
		global $conn;
		if ($conn) {
			$conn->close();
		}
		$conn = null;
	}

?>