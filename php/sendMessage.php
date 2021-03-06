<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $sending = $json["SenderID"];
    $receiving = $json["ReceiverID"];
    $body = $json["Body"];

    date_default_timezone_set('America/Los_Angeles');
    $date = date('m/d/Y h:i:s a', time());
    $date = date("Y-m-d h:i:s");

    $query = $conn->prepare("INSERT INTO `Messages`(`SenderID`, `ReceiverID`, `Body`, `Date`) 
            VALUES(:sending, :receiving, :body, :date)");
    $pass = $query->execute(array(
        "sending" => $sending,
        "receiving" => $receiving,
        "body" => $body,
        "date" => $date
    ));

    /*$query = $conn->prepare("SELECT `FirstName`, `LastName` FROM `Users` WHERE ID = :receiving");
    $pass = $query->execute(array(
        "receiving" => $receiving
    ));*/

    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "Message sent to " , $fetch[0][FirstName] , " " , $fetch[0][LastName];
?>