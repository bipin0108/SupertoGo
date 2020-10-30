<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if( empty($_REQUEST['city_id']) || 
		empty($_REQUEST['search']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data 
    $city_id = $_REQUEST['city_id']; 
    $search  = '%'.$_REQUEST['search'].'%'; 
    $output = array(); 

    // Get Store
    $stores = getRows("SELECT store_id,name FROM tbl_store WHERE FIND_IN_SET(:city_id, city_ids) AND name LIKE :search",array("city_id"=>$city_id,"search"=>$search));
    foreach ($stores as $idx => $row) {
        $row['type'] = 'store';
        $output[] = $row;
    }

    $store = getRow("SELECT GROUP_CONCAT(store_id) store_ids FROM tbl_store WHERE FIND_IN_SET(:city_id, city_ids)",array("city_id"=>$city_id));

    // Get Product
    $products = getRows("SELECT product_id,name FROM tbl_product WHERE name LIKE :search",array("search"=>$search));
    foreach ($products as $rw) {
        $rw['type'] = 'product';
        $output[] = $rw;
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