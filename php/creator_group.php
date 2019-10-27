<?php 
require_once('connect.php');
	$json = json_decode(file_get_contents('php://input'), true);
	$id = $json["GroupID"];
	$query = $conn->prepare("SELECT * FROM Users WHERE ID IN (SELECT CreatedByID FROM `Groups` WHERE ID = :id)");
	
	$pass = $query->execute(array(
		"id" => $id
	));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>
