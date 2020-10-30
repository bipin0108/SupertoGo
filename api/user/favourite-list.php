<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( empty($_REQUEST['user_id']) || 
		empty($_REQUEST['city_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id    = $_REQUEST['user_id'];
    $city_id    = $_REQUEST['city_id'];


    $result = getRows("
    	SELECT s.*, IF(f.isfavourite IS NULL, 0, f.isfavourite) isfavourite  
    	FROM tbl_favourite f
    	LEFT JOIN tbl_store s ON f.store_id = s.store_id 
    	WHERE f.isfavourite=1 AND f.user_id=:user_id AND f.city_id=:city_id",array("user_id"=>$user_id,"city_id"=>$city_id));
    $output = array();
    if(!empty($result)){
		foreach ($result as $idx => $row) {
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