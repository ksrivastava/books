<?php

function get($key, $nullable) {
	if (!isset($_GET[$key])) {
		http_response_code(400);
		die();
	}
	if (!$nullable and trim($_GET[$key]) === "") {
		http_response_code(400);
		die();
	}
	else return $_GET[$key];
}

?>