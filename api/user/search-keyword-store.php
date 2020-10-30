<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if( empty($_REQUEST['store_id']) || 
		empty($_REQUEST['user_id']) || 
		empty($_REQUEST['city_id']) || 
		empty($_REQUEST['type']) || 
		empty($_REQUEST['search']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data 
    $id = $_REQUEST['store_id'];
    $user_id = $_REQUEST['user_id'];
    $city_id = $_REQUEST['city_id'];
    $type = $_REQUEST['type']; 
    $search  = '%'.$_REQUEST['search'].'%'; 
    $output = array(); 

    if($type == 'store'){
    	$store = getRows("SELECT s.*, IF(f.isfavourite IS NULL, 0, f.isfavourite) isfavourite  
			FROM tbl_store s
			LEFT JOIN tbl_favourite f ON s.store_id = f.store_id AND f.user_id=:user_id 
			WHERE s.store_id=:store_id",array("user_id"=>$user_id,"store_id"=>$id));
		if(!empty($store)){
			foreach ($store as $idx => $row) {
				$output[$idx]['store_id'] = $row['store_id'];
				$output[$idx]['store_name'] = $row['name'];
				$output[$idx]['store_icon'] = !empty($row['store_icon'])?$siteURL.'uploads/store/'.$row['store_icon']:'';
				$output[$idx]['store_banner'] = !empty($row['store_banner'])?$siteURL.'uploads/store/'.$row['store_banner']:'';
				$output[$idx]['isfavourite'] = $row['isfavourite'];
				$day = date('D',time());
				$store_time = getRow("SELECT * FROM tbl_store_time WHERE day=:day AND store_id=:store_id",array("day"=>$day,"store_id"=>$row['store_id']));
				$output[$idx]['open_time'] = $store_time['open_time'];
				$output[$idx]['close_time'] = $store_time['close_time'];
				if($store_time['status'] == 1){
					$output[$idx]['status'] = 'Open';
				}else{
					$output[$idx]['status'] = 'Close';
				}
			}
		}
    }

    if($type == 'product'){
    	$product = getRow("SELECT * FROM tbl_product WHERE product_id=:product_id",array("product_id"=>$id));    	 
    	$store = getRows("SELECT s.*, IF(f.isfavourite IS NULL, 0, f.isfavourite) isfavourite  
			FROM tbl_store s
			LEFT JOIN tbl_favourite f ON s.store_id = f.store_id AND f.user_id=:user_id 
			WHERE FIND_IN_SET(s.store_id, :store_id) AND FIND_IN_SET(:city_id, s.city_ids)",
		array("user_id"=>$user_id,"store_id"=>$product['store_ids'],"city_id"=>$city_id));
		if(!empty($store)){
			foreach ($store as $idx => $row) {
				$output[$idx]['store_id'] = $row['store_id'];
				$output[$idx]['store_name'] = $row['name'];
				$output[$idx]['store_icon'] = !empty($row['store_icon'])?$siteURL.'uploads/store/'.$row['store_icon']:'';
				$output[$idx]['store_banner'] = !empty($row['store_banner'])?$siteURL.'uploads/store/'.$row['store_banner']:'';
				$output[$idx]['isfavourite'] = $row['isfavourite'];
				$day = date('D',time());
				$store_time = getRow("SELECT * FROM tbl_store_time WHERE day=:day AND store_id=:store_id",array("day"=>$day,"store_id"=>$row['store_id']));
				$output[$idx]['open_time'] = $store_time['open_time'];
				$output[$idx]['close_time'] = $store_time['close_time'];
				if($store_time['status'] == 1){
					$output[$idx]['status'] = 'Open';
				}else{
					$output[$idx]['status'] = 'Close';
				}
			}
		}
    }

    if(!empty($output)){
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