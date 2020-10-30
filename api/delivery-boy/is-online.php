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
    $is_online = !empty($_REQUEST['is_online'])?$_REQUEST['is_online']:0; 


    // Params
    $data = array(  
        'is_online'=>$is_online
    );

    // Update driver info
    updateRow('tbl_delivery_boy',$data,array('db_id'=>$db_id));
    echo json_encode(array("success"=>1,"message"=>"Success.","post_data"=>$data));
    exit; 
     

}else{
    echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
    exit;
}
db_close();