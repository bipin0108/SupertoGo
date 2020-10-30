<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if( empty($_REQUEST['db_id']) || 
        empty($_REQUEST['device_token']) || 
        empty($_REQUEST['lat']) ||
        empty($_REQUEST['lon']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
        exit;
    }

    // Get the post data
    $db_id = $_REQUEST['db_id']; 
    $device_token = $_REQUEST['device_token'];
    $lat = $_REQUEST['lat'];
    $lon = $_REQUEST['lon']; 

    // Params
    $data = array(  
        'device_token'=>$device_token, 
        'lat'=>$lat,
        'lon'=>$lon
    );

    // Update driver info
    updateRow('tbl_delivery_boy',$data,array('db_id'=>$db_id));
    echo json_encode(array("success"=>1,"message"=>"Success."));
    exit; 
     

}else{
    echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
    exit;
}
db_close();