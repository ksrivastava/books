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

session_start();

if (isset($_SESSION["session_id"])) {
	echo $_SESSION["session_id"];
	//unset($_SESSION["cookie"]);
}
else
{
	echo "Generate";
	generateSession($username);
}

?>