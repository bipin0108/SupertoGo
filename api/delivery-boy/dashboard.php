<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if( empty($_REQUEST['db_id']) ||
		empty($_REQUEST['device_id']) ||
		empty($_REQUEST['device_token']) ||
		empty($_REQUEST['device_type']) ||
		empty($_REQUEST['timezone']) ||
		empty($_REQUEST['lat']) ||
		empty($_REQUEST['lon']) ||
		empty($_REQUEST['app_version']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $db_id = $_REQUEST['db_id'];
    $device_id = $_REQUEST['device_id'];
    $device_token = $_REQUEST['device_token'];
    $device_type = $_REQUEST['device_type'];
    $timezone = $_REQUEST['timezone'];
    $lat = $_REQUEST['lat'];
    $lon = $_REQUEST['lon'];
    $appversion = $_REQUEST['app_version'];

    // Params
    $data = array( 
        'device_id'=>$device_id,
        'device_token'=>$device_token,
        'device_type'=>$device_type,
        'timezone'=>$timezone,
        'lat'=>$lat,
        'lon'=>$lon
    );

    // Update driver info
    updateRow('tbl_delivery_boy',$data,array('db_id'=>$db_id));

    // Runnig Order 
    $output = array();
    $orders = getRows("SELECT o.*, if(dbtr.created_at IS NULL,'',dbtr.created_at) request_time FROM tbl_orders o LEFT JOIN tbl_db_temp_request dbtr ON o.order_id = dbtr.order_id WHERE (o.db_id=:db_id OR ( dbtr.db_id=:db_id AND dbtr.status='send' AND TIMESTAMPDIFF(MINUTE,o.created_at,CURRENT_TIMESTAMP) <= 1)) AND o.status_id!=5 GROUP BY o.order_id ORDER BY o.order_id DESC",array("db_id"=>$db_id));
    if(!empty($orders)){
    	foreach ($orders as $idx => $row) {

            $seconds = 0;
            if(!empty($row['request_time'])){
                $seconds = time() - strtotime('+1 minutes',strtotime($row['request_time']));
                $days = floor($seconds / 86400); 
                $seconds %= 86400;

                $hours = floor($seconds / 3600);
                $seconds %= 3600;

                $minutes = floor($seconds / 60);
                $seconds %= 60;
            }

    		$output[$idx]['order_id'] = $row['order_id'];
    		$output[$idx]['db_id'] = $row['db_id'];
    		$output[$idx]['order_no'] = "#".$row['order_no'];
    		$output[$idx]['order_date'] = $row['order_date'];
    		$output[$idx]['order_time'] = $row['order_time'];
            $output[$idx]['request_time'] = !empty($row['request_time'])?$row['request_time']:'';
            $output[$idx]['seconds'] = abs($seconds);
            $output[$idx]['address'] = $row['address'];
            $output[$idx]['lat'] = $row['lat'];
    		$output[$idx]['lon'] = $row['lon'];
    		$output[$idx]['delivery_charge'] = $row['delivery_charge'];
    		$output[$idx]['promocode'] = $row['promocode'];
    		$output[$idx]['promocode_price'] = $row['promocode_price'];
    		$output[$idx]['sub_total'] = number_format($row['sub_total'],2);
    		$output[$idx]['grand_price'] = number_format($row['grand_price'],2);
            $items = getRows("SELECT * FROM tbl_order_item WHERE order_id=:order_id",array("order_id"=>$row['order_id']));
            $output[$idx]['item_count'] = count($items);
    		$order_status = getRow("SELECT * FROM tbl_order_status WHERE status_id=:status_id",array("status_id"=>$row['status_id']));
            $output[$idx]['delivery_date'] = $row['delivery_date'];
            $output[$idx]['delivery_time'] = $row['delivery_time'];
            $output[$idx]['status_id'] = $order_status['status_id'];
    		$output[$idx]['order_status'] = $order_status['status_name'];
    		$output[$idx]['is_cancel'] = $row['is_cancel'];
            $output[$idx]['cancel_by'] = $row['cancel_by'];
    		$output[$idx]['currency'] = getSetting('currency');
    	}
    }

    // Get Driver
    $driver = getRow("SELECT * FROM tbl_delivery_boy WHERE db_id=:db_id",array("db_id"=>$db_id));

    if(!empty($output)){
        if($device_type == "android"){
            $app_version = getSetting('android_version_driver');
        }else if($device_type == "ios"){
            $app_version = getSetting('ios_version_driver');
        }
        if($appversion < $app_version){
            echo json_encode(array("success" =>2,"message"=>"Success.","is_online"=>$driver['is_online'],"post_data"=>$output));
            exit;   
        }else{
            echo json_encode(array("success" =>1,"message"=>"Success.","is_online"=>$driver['is_online'],"post_data"=>$output));
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