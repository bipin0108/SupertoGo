<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['user_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id = $_REQUEST['user_id'];

    $output = array();
    $result = getRows("SELECT * FROM tbl_notification_list WHERE user_id=:user_id ORDER BY created_at",array("user_id"=>$user_id));
    if(!empty($result)){
    	foreach ($result as $idx => $row) {
    		$output[$idx]['notify_id'] = $row['notify_id'];
    		$output[$idx]['message'] = $row['message'];
            $output[$idx]['status'] = $row['status'];
            $output[$idx]['time'] = humanTiming(strtotime($row['created_at'])).' ago';
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