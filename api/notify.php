<?php
include_once 'db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['device_token']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    $device_token = $_REQUEST['device_token'];

	$msg = array(
	    "title"=>"New Request",
	    "body"=>"New request has been created near by you.",
	);
	
	$result = push_notification($device_token, $msg); 
	echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$result));
	exit;

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}