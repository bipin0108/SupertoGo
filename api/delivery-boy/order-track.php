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
    $output = array();
    $order_status = getRows("SELECT * FROM `tbl_order_status` ORDER BY `status_id` ASC");
    foreach ($order_status as $i => $rw) {
        $output[$i]['status_id'] = $rw['status_id'];
        $output[$i]['status_name'] = $rw['status_name'];
        $output[$i]['status_date'] = '-';
        $output[$i]['status_time'] = '-';
    }
    $result = getRows('
        SELECT * 
        FROM tbl_order_status_history osh
        LEFT JOIN tbl_order_status os ON osh.status_id = os.status_id 
        WHERE osh.order_id=:order_id ORDER BY osh.status_history_id ASC ',array('order_id'=>$order_id));
    if(!empty($result)){
        foreach ($result as $idx => $row) { 
            $output[$idx]['status_date'] = date('Y-m-d',strtotime($row['created_at']));
            $output[$idx]['status_time'] = date('H:i A',strtotime($row['created_at']));
        }
    }

    // Driver
    $order = getRow("SELECT * FROM tbl_orders WHERE order_id=:order_id",array('order_id'=>$order_id));
    $user = getRow("SELECT user_id, CONCAT(first_name,' ',last_name) name, mobile, avatar  FROM tbl_users WHERE user_id=:user_id",array('user_id'=>$order['user_id']));
    if(!empty($user)){
        $user['avatar'] = !empty($user['avatar'])?$siteURL.'uploads/profiles/'.$user['avatar']:'';
    } 
    
    if(!empty($output)){
        echo json_encode(
            array(
                "success" =>1,
                "message"=>"Success.",
                "user"=>$user,
                "order_no"=>$order['order_no'],
                "post_data"=>$output
            )
        );
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