<?php

define("PATH", dirname($_SERVER['SCRIPT_FILENAME']) . "/downloadedImages/");
define("SERVER_PATH", dirname($_SERVER['SCRIPT_NAME']) . "/downloadedImages/");

$response = [];

$field = $_POST['file'];

$name = $_FILES[$field]['name'];
if (!empty($name)) {
	$img = "";
	if (move_uploaded_file($_FILES[$field]['tmp_name'], PATH . $name))
		$img = SERVER_PATH . $name;
	$response[$field . "-path"] = $img;
}

echo json_encode($response);

?>