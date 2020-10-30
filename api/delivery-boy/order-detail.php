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
    $order = getRow("SELECT * FROM tbl_orders WHERE order_id=:order_id",array("order_id"=>$order_id));
    if(!empty($order)){
		$output['order_id'] = $order['order_id'];
		$output['order_no'] = $order['order_no'];
		$output['order_date'] = $order['order_date'];
		$output['order_time'] = $order['order_time'];
		$output['address'] = $order['address'];
		$output['lat'] = $order['lat'];
		$output['lon'] = $order['lon'];
		$output['delivery_charge'] = $order['delivery_charge'];
		$output['promocode'] = $order['promocode'];
		$output['promocode_price'] = $order['promocode_price'];
		$output['sub_total'] = number_format($order['sub_total'],2);
		$output['grand_price'] = number_format($order['grand_price'],2);
		$items = getRows("SELECT * FROM tbl_order_item WHERE order_id=:order_id",array("order_id"=>$order['order_id']));
        $output['item_count'] = count($items);
		$order_status = getRow("SELECT * FROM tbl_order_status WHERE status_id=:status_id",array("status_id"=>$order['status_id']));
        $output['delivery_date'] = $order['delivery_date'];
        $output['delivery_time'] = $order['delivery_time'];
        $output['status_id'] = $order_status['status_id'];
		$output['order_status'] = $order_status['status_name'];
		$output['is_cancel'] = $order['is_cancel'];
		$output['cancel_by'] = $order['cancel_by'];
		$output['currency'] = getSetting('currency');
		$items = getRows("SELECT * FROM tbl_order_item WHERE order_id=:order_id",array("order_id"=>$order_id));
		
		$arr = array();
		foreach ($items as $item) {
			$product_item  = getRow("SELECT * FROM tbl_product_item WHERE item_id=:item_id",array("item_id"=>$item['item_id']));
			$item['product_id'] = $product_item['product_id'];
			$item['brand_id'] = $product_item['brand_id'];
			$item['weight'] = $product_item['weight'];
			$item['unit'] = $product_item['unit'];
			$arr[$item['store_id']][] = $item;	
		}

		
		$output['store'] = array();
    	if(!empty($arr)){
			$arr_key = array_keys($arr);
			$ix = 0;
			$sub_total = 0;
			foreach ($arr_key as $store_id) {
				$store = getRow("SELECT * FROM tbl_store WHERE store_id=:store_id",array("store_id"=>$store_id)); 
	            $output['store'][$ix]['store_id'] = $store['store_id'];
	            $output['store'][$ix]['name'] = $store['name'];
	            $output['store'][$ix]['store_icon'] = !empty($store['store_icon'])?$siteURL.'uploads/store/'.$store['store_icon']:'';
	            $products = $arr[$store_id];
	            foreach ($products as $idx => $rw) {
	                $total_price = number_format(($rw['price'] * $rw['item_count']),2);
	                $sub_total += $total_price;
	                $output['store'][$ix]['product'][$idx]['product_id'] = $rw['product_id'];
	                $output['store'][$ix]['product'][$idx]['name'] = $rw['name'];
	                $brand = getRow("SELECT * FROM tbl_brand WHERE brand_id=:brand_id",array("brand_id"=>$rw['brand_id']));
	                $output['store'][$ix]['product'][$idx]['brand'] = !empty($brand['name'])?$brand['name']:'';
	                $product = getRow("SELECT * FROM tbl_product WHERE product_id=:product_id",array("product_id"=>$rw['product_id']));
	                $image = !empty($product['image'])?$siteURL.'uploads/product/'.$product['image']:'';
	                $output['store'][$ix]['product'][$idx]['image'] = $image;
	                $output['store'][$ix]['product'][$idx]['item_id'] = $rw['item_id'];
	                $output['store'][$ix]['product'][$idx]['weight'] = $rw['weight'];
	                $output['store'][$ix]['product'][$idx]['unit'] = $rw['unit'];
	                $output['store'][$ix]['product'][$idx]['price'] = number_format($rw['price'], 2);
	                $output['store'][$ix]['product'][$idx]['item_count'] = $rw['item_count'];
	                $output['store'][$ix]['product'][$idx]['total_price'] = $total_price;
	                $output['store'][$ix]['product'][$idx]['currency'] = getSetting('currency');
	            }
			}
			$ix++;
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