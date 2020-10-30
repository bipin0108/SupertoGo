<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['page_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $page_id = $_REQUEST['page_id'];

	$result = getRow("SELECT * FROM tbl_pages WHERE page_id=:page_id",array("page_id"=>$page_id));
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