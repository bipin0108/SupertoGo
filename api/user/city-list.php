<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$result = getRows("SELECT * FROM tbl_city");
	if(!empty($result)){
	 	echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$result));
        exit;   
	}else{
		echo json_encode(array("success" =>0,"message"=>"Data not found."));
		exit;
	}
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();