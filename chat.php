<?php

$db = new mysqli("localhost", "root", "", "simplechat");
if($db->connect_error){
	die("Connection failed: " . $db->connect_error);
}

$result = array();

//Operator ?? only in PHP7
$message = $_POST['message'] ?? null;
$from = $_POST['from'] ?? null;
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