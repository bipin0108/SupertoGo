<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['db_id']) ||
		empty($_REQUEST['order_id']) ||
		empty($_REQUEST['action']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $db_id = !empty($_REQUEST['db_id'])?$_REQUEST['db_id']:0;
    $order_id = $_REQUEST['order_id'];
    $action = $_REQUEST['action'];

    // Get order
    $order = getRow("SELECT * FROM tbl_orders WHERE order_id=:order_id",array('order_id'=>$order_id));
    

    if($action == 'accept'){
    	// Delete temp request
    	deleteRows('tbl_db_temp_request',array('order_id'=>$order_id));

    	// assign driver
        $order_assign_prm = array('db_id'=>$db_id,'status_id'=>2);
    	updateRow('tbl_orders',$order_assign_prm,array('order_id'=>$order_id));

        // Status History
        $order_status_prm = array(
            'order_id'=>$order_id,
            'status_id' => 2
        );
        $check = getRow("SELECT * FROM tbl_order_status_history WHERE order_id=:order_id AND status_id=:status_id",$order_status_prm);
        if(empty($check)){
            $status_history_id = insertRow('tbl_order_status_history', $order_status_prm);
        }

        // Send user notification
        $driver = getRow("SELECT * FROM tbl_delivery_boy WHERE status='Active' AND db_id=:db_id",array('db_id'=>$db_id));
        $driver_name = $driver['first_name'];
        $user = getRow("SELECT * FROM tbl_users WHERE user_id=:user_id",array('user_id'=>$order['user_id']));
        $msg = array(
            "body"=>"Your order has been accepted by $driver_name.",
            "code" => "101",
            "sound"=>"default",
            "content-available"=>1,
            "order_id"=>$order_id
        );
        push_notification($user['device_token'],$msg); 

        // Add notification
        if(!empty($user)){
            $notify_prm = array(
                'user_id' => $user['user_id'],
                'order_id' => $order_id,
                'message' => "Your order has been accepted by $driver_name.",
                'type' => 0
            );
            $notify_id = insertRow('tbl_notification_list', $notify_prm);
        }

        // Result
        $status = getRow('SELECT * FROM `tbl_order_status` WHERE status_id=2');
        $output['status_id'] = $status['status_id'];
        $output['order_status'] = $status['status_name'];
    	echo json_encode(array("success" =>1,"message"=>"Order has been accept successfully.","post_data"=>$output));
    	exit; 
    }

    if($action == 'reject'){
    	// Delete temp request
    	deleteRows('tbl_db_temp_request',array('order_id'=>$order_id,'db_id'=>$db_id));

    	// Send next request
    	$request = getRow("SELECT * FROM tbl_db_temp_request WHERE status='pending' AND db_id!=0 AND order_id=:order_id",array('order_id'=>$order_id));
    	if(!empty($request)){
    		$db_id = $request['db_id'];
    		$params['status']='send'; 
    		updateRow('tbl_db_temp_request',$params,array('order_id'=>$order_id,'db_id'=>$db_id));
            $driver = getRow("SELECT * FROM tbl_delivery_boy WHERE status='Active' AND db_id=:db_id",array('db_id'=>$db_id));
    		$msg = array(
                "body"=>"New request has been created near by you.",
                "code" => "101",
                "sound"=>"default",
                "content-available"=>1,
                "order_id"=>$order_id
            );
            push_notification($driver['device_token'],$msg);
            // Add notification
            $notify_prm = array(
                'db_id' => $driver['db_id'],
                'order_id' => $order_id,
                'message' => "New request has been created near by you.",
                'type' => 1
            );
            $notify_id = insertRow('tbl_notification_list', $notify_prm);
    	}

    	echo json_encode(array("success" =>1,"message"=>"Order has been reject successfully."));
    	exit; 
    }

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();