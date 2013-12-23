<?php
require_once('lib/inc.php');
require_once('lib/func.php');
require_once('lib/db.php');

$username = get("username", false);
$password = get("password", false); // encrypted
$username_exists = checkExists($username);

if (!$username_exists) {
	echo $username + " Not found";
	http_response_code(406);
	die();
}

$status = deleteUser($username, $password);
if ($status) {
	echo "OK";
}

?>