<?php

$db = new mysqli("localhost", "root", "", "simplechat");
if($db->connect_error){
	die("Connection failed: " . $db->connect_error);
}

$result = array();

//Operator ?? only in PHP7
$message = $_POST['message'] ?? null;
$message = htmlentities($message, ENT_QUOTES, "UTF-8");
$message = trim($message);

$from = $_POST['from'] ?? null;
$from = htmlentities($from, ENT_QUOTES, "UTF-8");
$from = trim($from);

$getHours = $_POST['getHours'] ?? null;
$getMinutes = $_POST['getMinutes'] ?? null;

if(!empty($message) && !empty($from))
{
	$sql = "INSERT INTO users VALUES ('','".$from."','".$message."','".$getHours."','".$getMinutes."')";
	$result['send_status'] = $db->query($sql);
}

//Operator ?? only in PHP7
$start = $_GET['start'] ?? 0;
$items = $db->query("SELECT * FROM users WHERE id > " . $start);

while($row = $items->fetch_assoc()){
	$result['items'][] = $row;
}

$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);
?>
