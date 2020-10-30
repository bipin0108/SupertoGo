<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if( empty($_REQUEST['user_id']) ||  
		empty($_REQUEST['city_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id    = $_REQUEST['user_id'];
    $city_id    = $_REQUEST['city_id'];

    // Params
    $params = array(
    	'user_id'=> $user_id,
    	'city_id'=> $city_id
    );

    // View Cart
    $results = getRows("
    	SELECT s.*, p.*, pi.item_id, pi.brand_id, pi.weight, pi.unit, pi.price, c.cart_id, c.qty item_count
    	FROM tbl_cart c
        LEFT JOIN tbl_product_item pi ON c.item_id = pi.item_id
        LEFT JOIN tbl_store s ON pi.store_id = s.store_id
        LEFT JOIN tbl_product p ON pi.product_id = p.product_id
    	WHERE c.user_id=:user_id AND c.city_id=:city_id",$params);

    $arr = array();
    foreach ($results as $idx => $row) {
        $arr['store'][$row['store_id']]['product'][] = $row;
    }
 
    $output = array();
    $item_count = 0;
    $sub_total = 0;
    $output['store'] = array();
    if(!empty($arr)){
        $arr_key = array_keys($arr['store']);
        foreach ($arr_key as $ix => $store_id) {
            $store = getRow("SELECT * FROM tbl_store WHERE store_id=:store_id",array("store_id"=>$store_id)); 
            $output['store'][$ix]['store_id'] = $store['store_id'];
            $output['store'][$ix]['name'] = $store['name'];
            $output['store'][$ix]['store_icon'] = !empty($store['store_icon'])?$siteURL.'uploads/store/'.$store['store_icon']:'';
            $products = $arr['store'][$store_id]['product'];

            foreach ($products as $idx => $product) {
                $item_count += 1;
                $total_price = number_format(($product['price'] * $product['item_count']),2);
                $sub_total += $total_price;
                $output['store'][$ix]['product'][$idx]['cart_id'] = $product['cart_id'];
                $output['store'][$ix]['product'][$idx]['product_id'] = $product['product_id'];
                $output['store'][$ix]['product'][$idx]['name'] = $product['name'];
                $brand = getRow("SELECT * FROM tbl_brand WHERE brand_id=:brand_id",array("brand_id"=>$product['brand_id']));
                $output['store'][$ix]['product'][$idx]['brand'] = !empty($brand['name'])?$brand['name']:'';
                $output['store'][$ix]['product'][$idx]['image'] = !empty($product['image'])?$siteURL.'uploads/product/'.$product['image']:'';
                $output['store'][$ix]['product'][$idx]['item_id'] = $product['item_id'];
                $output['store'][$ix]['product'][$idx]['weight'] = $product['weight'];
                $output['store'][$ix]['product'][$idx]['unit'] = $product['unit'];
                $output['store'][$ix]['product'][$idx]['price'] = number_format($product['price'], 2);
                $output['store'][$ix]['product'][$idx]['item_count'] = $product['item_count'];
                $output['store'][$ix]['product'][$idx]['total_price'] = $total_price;
                $output['store'][$ix]['product'][$idx]['currency'] = getSetting('currency');
            }
        }
    }
    $output['item_count'] = (string) $item_count;
    $output['sub_total'] = number_format($sub_total,2);
    $output['delivery_charge'] = getSetting('delivery_charge');
    $output['min_cart_price'] = getSetting('min_cart_price');
    $output['currency'] = getSetting('currency');

    echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$output));
	exit;  

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();