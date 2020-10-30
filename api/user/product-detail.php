<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['store_id']) ||
		empty($_REQUEST['city_id']) ||
		empty($_REQUEST['product_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    $store_id = $_REQUEST['store_id'];
    $city_id = $_REQUEST['city_id'];
    $product_id = $_REQUEST['product_id']; 
	$output = array();
	$product = getRow("SELECT * FROM tbl_product WHERE product_id=:product_id",array("product_id"=>$product_id));
	if(!empty($product)){
		$output['product_id'] = $product_id;
		$output['name'] = $product['name'];
		$output['description'] = $product['description'];
		$brand = getRow("SELECT * FROM tbl_brand WHERE brand_id=:brand_id",array("brand_id"=>$product['brand_id']));
		$output['brand'] = !empty($brand['name'])?$brand['name']:'';
		$output['image'] = !empty($product['image'])?$siteURL.'uploads/product/'.$product['image']:'';
		$output['items'] =array();
		$items = getRows("SELECT * FROM tbl_product_item WHERE product_id=:product_id AND store_id=:store_id  AND city_id=:city_id",array("product_id"=>$product_id,"store_id"=>$store_id,"city_id"=>$city_id));
		if(!empty($items)){
			foreach ($items as $ix => $item) {
				$output['items'][$ix]['item_id'] =  $item['item_id'];
				$output['items'][$ix]['store_id'] =  $item['store_id'];
				$output['items'][$ix]['city_id'] =  $item['city_id'];
				$output['items'][$ix]['weight'] =  $item['weight'];
				$output['items'][$ix]['qty'] =  $item['qty'];
				$output['items'][$ix]['unit'] =  $item['unit'];
				$output['items'][$ix]['price'] =  $item['price'];
			}
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