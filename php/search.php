<?php

require_once('lib/inc.php');
require_once('lib/func.php');
require_once('lib/lookup.php');

$isbn = get("isbn", false);
$result = array();
getBook($isbn, $result);
echo json_encode($result);

?>