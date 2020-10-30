<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if( empty($_REQUEST['db_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $db_id = $_REQUEST['db_id']; 

    // Complete Order 
    $output = array();
    $orders = getRows("SELECT * 
        FROM tbl_orders 
        WHERE db_id=:db_id AND status_id=5 ORDER BY order_id DESC",array("db_id"=>$db_id));
    if(!empty($orders)){
    	foreach ($orders as $idx => $row) {
    		$output[$idx]['order_id'] = $row['order_id'];
    		$output[$idx]['db_id'] = $row['db_id'];
    		$output[$idx]['order_no'] = "#".$row['order_no'];
    		$output[$idx]['order_date'] = $row['order_date'];
    		$output[$idx]['order_time'] = $row['order_time'];
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