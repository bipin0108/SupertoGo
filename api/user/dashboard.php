<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if( empty($_REQUEST['user_id']) ||
		empty($_REQUEST['city_id']) ||
		empty($_REQUEST['device_token']) ||
		empty($_REQUEST['device_type']) ||
		empty($_REQUEST['app_version']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    $user_id = $_REQUEST['user_id'];
    $city_id = $_REQUEST['city_id'];
    $device_token = $_REQUEST['device_token'];
    $device_type = $_REQUEST['device_type'];
    $appversion = $_REQUEST['app_version'];

    // Update Token
    updateRow('tbl_users',array('device_token'=>$device_token),array('user_id'=>$user_id));

	$output = array();
	$output['banner'] = array();
	$banner = getRows("SELECT * FROM tbl_banner");
	if(!empty($banner)){
		foreach ($banner as $i => $b) {
			$output['banner'][$i] = $b;
			$output['banner'][$i]['image'] = !empty($b['image'])?$siteURL.'uploads/banner/'.$b['image']:'';
		}
	}
	
	$output['store'] = array();
	$store = getRows("
		SELECT s.*, if(f.isfavourite IS NULL, 0, f.isfavourite) AS isfavourite
		FROM tbl_store s
		LEFT JOIN tbl_favourite f ON f.store_id = s.store_id AND f.user_id=:user_id
		WHERE FIND_IN_SET(:city_id, s.city_ids)",array("user_id"=>$user_id,"city_id"=>$city_id));
	if(!empty($store)){
		foreach ($store as $j => $s) {
			$output['store'][$j]['store_id'] = $s['store_id'];
			$output['store'][$j]['store_name'] = $s['name'];
			$output['store'][$j]['store_icon'] = !empty($s['store_icon'])?$siteURL.'uploads/store/'.$s['store_icon']:'';
			$output['store'][$j]['store_banner'] = !empty($s['store_banner'])?$siteURL.'uploads/store/'.$s['store_banner']:'';
			$output['store'][$j]['isfavourite'] = $s['isfavourite'];
			$day = date('D',time());
			$store_time = getRow("SELECT * FROM tbl_store_time WHERE day=:day AND store_id=:store_id",array("day"=>$day,"store_id"=>$s['store_id']));
			$output['store'][$j]['open_time'] = $store_time['open_time'];
			$output['store'][$j]['close_time'] = $store_time['close_time'];
			if($store_time['status'] == 1){
				$output['store'][$j]['status'] = 'Open';
			}else{
				$output['store'][$j]['status'] = 'Close';
			}
		}
	}

	// Cart count
	$item_count = 0;
	$results = getRows("
    	SELECT s.*, p.*, pi.item_id, pi.brand_id, pi.weight, pi.unit, pi.price, c.cart_id, c.qty item_count
    	FROM tbl_cart c
        LEFT JOIN tbl_product_item pi ON c.item_id = pi.item_id
        LEFT JOIN tbl_store s ON pi.store_id = s.store_id
        LEFT JOIN tbl_product p ON pi.product_id = p.product_id
    	WHERE c.user_id=:user_id AND c.city_id=:city_id",array("user_id"=>$user_id,"city_id"=>$city_id));
	if(!empty($results)){
		$item_count = count($results);
	}
	$output['item_count'] = (string) $item_count;
	
	if(!empty($output)){
		if($device_type == "android"){
			$app_version = getSetting('android_version_user');
		}else if($device_type == "ios"){
			$app_version = getSetting('ios_version_user');
		}
		if($appversion < $app_version){
			echo json_encode(array(
				"success" =>2,
				"message"=>"Success.",
				"emergency_message"=>getSetting('emergency_message'),
				"post_data"=>$output)
			);
        	exit;   
		}else{
			echo json_encode(array(
				"success" =>1,
				"message"=>"Success.",
				"emergency_message"=>getSetting('emergency_message'),
				"post_data"=>$output)
			);
        	exit;  
		}
	}else{
		echo json_encode(array("success" =>0,"message"=>"Data not found."));
		exit;
	}
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();