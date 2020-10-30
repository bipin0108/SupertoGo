<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['user_id']) ||
		empty($_REQUEST['store_id']) ||
		empty($_REQUEST['cat_id']) ||
		empty($_REQUEST['city_id'])  ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    $user_id = $_REQUEST['user_id'];
    $store_id = $_REQUEST['store_id'];
    $cat_id = $_REQUEST['cat_id'];
    $city_id = $_REQUEST['city_id'];
	$output = array();
	$store = getRow("SELECT * FROM tbl_store WHERE store_id=:store_id",array("store_id"=>$store_id));
	if(!empty($store)){
		$output['store_id'] = $store['store_id'];
		$output['store_name'] = $store['name'];
		$output['store_icon'] = !empty($store['store_icon'])?$siteURL.'uploads/store/'.$store['store_icon']:'';
		$output['store_banner'] = !empty($store['store_banner'])?$siteURL.'uploads/store/'.$store['store_banner']:'';
	}

	$output['product'] = array();
	$products = getRows("
		SELECT p.*
		FROM tbl_product p 
		WHERE p.product_id IN ( 
			SELECT pi.product_id 
			FROM tbl_product_item pi 
			WHERE pi.store_id=:store_id 
			AND pi.city_id=:city_id 
		) AND p.cat_id=:cat_id",array("store_id"=>$store_id,"city_id"=>$city_id,"cat_id"=>$cat_id));
	if(!empty($products)){
		foreach ($products as $idx => $product) {
			$product_id = $product['product_id'];
			$output['product'][$idx]['product_id'] = $product_id;
			$output['product'][$idx]['name'] = $product['name'];
			$output['product'][$idx]['description'] = $product['description'];
			$brand = getRow("SELECT * FROM tbl_brand WHERE brand_id=:brand_id",array("brand_id"=>$product['brand_id']));
			$output['product'][$idx]['brand'] = !empty($brand['name'])?$brand['name']:'';
			$output['product'][$idx]['image'] = !empty($product['image'])?$siteURL.'uploads/product/'.$product['image']:'';
			$output['product'][$idx]['items'] =array();
			$items = getRows("SELECT * FROM tbl_product_item WHERE product_id=:product_id AND store_id=:store_id AND city_id=:city_id",array("product_id"=>$product_id,"store_id"=>$store_id,"city_id"=>$city_id));
			if(!empty($items)){
				foreach ($items as $ix => $item) {

					$cart_item = getRow("SELECT * FROM tbl_cart WHERE user_id=:user_id AND city_id=:city_id AND item_id=:item_id",array("user_id"=>$user_id,"item_id"=>$item['item_id'],"city_id"=>$item['city_id']));
					$output['product'][$idx]['items'][$ix]['item_id'] =  $item['item_id'];
					$output['product'][$idx]['items'][$ix]['product_id'] =  $item['product_id'];
					$output['product'][$idx]['items'][$ix]['store_id'] =  $item['store_id'];
					$output['product'][$idx]['items'][$ix]['city_id'] =  $item['city_id'];
					$brand = getRow("SELECT * FROM tbl_brand WHERE brand_id=:brand_id",array("brand_id"=>$item['brand_id']));
					$output['product'][$idx]['items'][$ix]['brand'] = !empty($brand['name'])?$brand['name']:'';
					$output['product'][$idx]['items'][$ix]['weight'] =  $item['weight'];
					$output['product'][$idx]['items'][$ix]['qty'] =  $item['qty'];
					$output['product'][$idx]['items'][$ix]['item_count'] = "0";
					if(!empty($cart_item)){
						$output['product'][$idx]['items'][$ix]['item_count'] =  $cart_item['qty'];
					}
					$output['product'][$idx]['items'][$ix]['unit'] =  $item['unit'];
					$output['product'][$idx]['items'][$ix]['price'] =  number_format($item['price'], 2);
					$output['product'][$idx]['items'][$ix]['currency'] = getSetting('currency');
				}
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