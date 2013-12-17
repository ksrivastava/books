<?php
	
	require_once('header/lookup.php');

	function displayWelcome($username, $user_id) {
		echo "<html>";
		echo "<head>";
		echo "<title> Welcome " . $username . "</title>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/profile.css\">";
		echo "</head><body>";
		echo "Welcome! Here are your books: " . "</br>";
		global $db;
		$query = array("user_id" => $user_id);
		$col = $db->userBooks;
		$cursor = $col->find($query);
		foreach ($cursor as $book) {
   			var_dump($book);
		}

		echo "<p>Insert new book:"


		echo "</body></html>";
	}

	function listBooks($username, $user_id) {
		echo "(json)";
		global $db;
		$query = array("user_id" => $user_id);
		$col = $db->userBooks;
		$cursor = $col->find($query);
		foreach ($cursor as $book) {
   			$result = array();
			getBook($book["isbn"], $result);
			echo json_encode($result);
		}
	}

?>