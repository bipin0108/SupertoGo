<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( empty($_REQUEST['user_id']) || 
		empty($_REQUEST['store_id']) ||
		empty($_REQUEST['city_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id    = $_REQUEST['user_id'];
    $store_id    = $_REQUEST['store_id'];
    $city_id    = $_REQUEST['city_id'];

    // Params
    $data = array(
    	'user_id'=>$user_id,
    	'store_id'=>$store_id,
    	'city_id'=>$city_id,
    );

    $result = getRow("SELECT * FROM tbl_favourite WHERE user_id=:user_id AND store_id=:store_id",array("user_id"=>$user_id,"store_id"=>$store_id));
    if(!empty($result)){
    	if($result['isfavourite'] == 1){
    		$data['isfavourite'] = 0;
    	}else{
    		$data['isfavourite'] = 1;
    	}
    	$favourite_id = $result['favourite_id'];
    	updateRow('tbl_favourite',$data,array("favourite_id"=>$favourite_id));
    }else{
        $data['isfavourite'] = 1;
    	$favourite_id = insertRow('tbl_favourite',$data);
    }

    $output = getRow("SELECT isfavourite FROM tbl_favourite WHERE favourite_id=:favourite_id",array("favourite_id"=>$favourite_id));
    echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$output));
	exit; 

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();