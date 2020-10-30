<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['order_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $order_id = $_REQUEST['order_id'];

    // Params
    $data = array(
    	'is_cancel'=>1,
    	'cancel_by'=>'Cancelled by User'
    );

    // Order cancel
    updateRow('tbl_orders', $data, array('order_id'=>$order_id));

    echo json_encode(array("success" =>1,"message"=>"Order has been cancelled.","post_data"=>$data));
    exit; 
 
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();