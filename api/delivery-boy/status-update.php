<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['db_id']) ||
        empty($_REQUEST['order_id']) ||
		empty($_REQUEST['status_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $db_id = $_REQUEST['db_id'];
    $order_id = $_REQUEST['order_id'];
    $status_id = $_REQUEST['status_id'];

    // Get order
    $order = getRow("SELECT * FROM tbl_orders WHERE db_id=:db_id AND order_id=:order_id",array('db_id'=>$db_id,'order_id'=>$order_id));
    if(empty($order)){
        echo json_encode(array("success" =>0,"message"=>"Order status has been not chang successfully."));
        exit;
    }

    // Status History
    $order_status_prm = array(
        'order_id'=>$order_id,
        'status_id' => $status_id
    );
    $check = getRow("SELECT * FROM tbl_order_status_history WHERE order_id=:order_id AND status_id=:status_id",$order_status_prm);
    if(empty($check)){
        $status_history_id = insertRow('tbl_order_status_history', $order_status_prm);
    }
     
    // Update status
    $data = array('status_id'=>$status_id);
    updateRow("tbl_orders",$data,array('order_id'=>$order_id));
	
    // Get status
    $order_status = getRow("SELECT * FROM tbl_order_status WHERE status_id=:status_id",array("status_id"=>$status_id));

    // Send notification
    $user = getRow("SELECT * FROM tbl_users WHERE user_id=:user_id",array("user_id"=>$order['user_id']));
    $status = $order_status['status_name'];
    $message = "Your $status order id #".$order['order_no'].".";
    $msg = array(
        "body"=>$message,
        "sound"=>"default",
        "content-available"=>1,
        "code"=>"101", 
        "order_id"=>$order_id
    );
    push_notification($user['device_token'],$msg);
    // Add notification
    $notify_prm = array(
        'user_id' => $user['user_id'],
        'order_id' => $order_id,
        'message' => $message,
        'type' => 0
    );
    $notify_id = insertRow('tbl_notification_list', $notify_prm);

	echo json_encode(array("success" =>1,"message"=>"Order status has been changed successfully.","post_data"=>$order_status));
	exit; 
    
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();