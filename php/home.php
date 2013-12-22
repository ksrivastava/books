<?php
require_once('lib/inc.php');
require_once('lib/func.php');
require_once('lib/db.php');
require_once('lib/lookup.php');

$username = get("username", false);
$password = get("password", false); // encrypted


$user_id = authenticate($username, $password);
if ($user_id === null) {
	http_response_code(401);
	die();
}

$isbn_array = array();
getUserBooks($user_id, $isbn_array);

foreach ($isbn_array as $isbn) {
	$result = array();
	getBook($isbn, $result);
	echo json_encode($result);
}

?>