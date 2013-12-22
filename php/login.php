<?php
require_once('lib/inc.php');
require_once('lib/func.php');
require_once('lib/db.php');

$username = get("username", false);
$password = get("password", false); // encrypted


$user_id = authenticate($username, $password);
if ($user_id === null) {
	http_response_code(401);
	die();
}

echo "OK";

?>