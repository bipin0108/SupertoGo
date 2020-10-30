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
	$output = array();
	$store = getRow("SELECT * FROM tbl_store WHERE store_id=:store_id",array("store_id"=>$store_id));
	if(!empty($store)){
		$output['store_id'] = $store['store_id'];
		$output['store_name'] = $store['name'];
		$output['store_icon'] = !empty($store['store_icon'])?$siteURL.'uploads/store/'.$store['store_icon']:'';
		$output['store_banner'] = !empty($store['store_banner'])?$siteURL.'uploads/store/'.$store['store_banner']:'';
	}

	$output['category'] = array();
	$category = getRows("
		SELECT c.* 
		FROM tbl_category c
		LEFT JOIN tbl_product p ON c.cat_id = p.cat_id
		WHERE FIND_IN_SET(:store_id, p.store_ids) GROUP BY c.cat_id",
		array("store_id"=>$store_id));
	if(!empty($category)){
		foreach ($category as $idx => $cat) {
			$output['category'][$idx] =  $cat;
			$output['category'][$idx]['image'] = !empty($cat['image'])?$siteURL.'uploads/category/'.$cat['image']:'';
		}
	}
 	echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$output));
    exit;   

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();