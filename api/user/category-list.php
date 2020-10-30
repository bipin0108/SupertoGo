<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['store_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }
	
	$store_id = $_REQUEST['store_id'];
	$store = getRow("SELECT * FROM tbl_store WHERE store_id=:store_id",array("store_id"=>$store_id));
	$output = array();
	if(!empty($store)){
		$output['store_id'] = $store['store_id'];
		$output['store_name'] = $store['name'];
		$output['store_icon'] = !empty($store['store_icon'])?$siteURL.'uploads/store/'.$store['store_icon']:'';
		$output['store_banner'] = !empty($store['store_banner'])?$siteURL.'uploads/store/'.$store['store_banner']:'';
	}

	$result = getRows("SELECT * FROM tbl_category");
	$output['category'] = array();
	if(!empty($result)){
		foreach ($result as $idx => $row) {
			$output['category'][$idx] = $row;
			$output['category'][$idx]['image'] = !empty($row['image'])?$siteURL.'uploads/category/'.$row['image']:'';
		}
	 	echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$output));
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