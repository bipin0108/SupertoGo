<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if( empty($_REQUEST['user_id']) ||     
		empty($_REQUEST['city_id']) ||
		empty($_REQUEST['item_id']) ||
		empty($_REQUEST['action']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id    = $_REQUEST['user_id'];
    $city_id    = $_REQUEST['city_id'];
    $item_id 	= $_REQUEST['item_id'];
    $action     = $_REQUEST['action'];


    // Params
    $params = array(
    	'user_id' => $user_id,
    	'city_id' => $city_id,
    	'item_id' => $item_id
    );

    $item = getRow("SELECT * FROM tbl_cart WHERE user_id=:user_id AND city_id=:city_id AND item_id=:item_id",$params);

    // Item Add (qty)
    if($action == 'plus'){
    	if(!empty($item)){
    		$params['qty'] = $item['qty'] + 1;
    		updateRow('tbl_cart',$params,array('cart_id'=>$item['cart_id']));
    	}else{
            $params['qty'] = 1;
    		insertRow('tbl_cart',$params);
    	}
    }

    // Item Remove (qty)
    if($action == 'minus'){
    	if(!empty($item)){
    		$qty = $item['qty'] - 1;
    		if(!empty($qty)){
    			$params['qty'] = $qty;
    			updateRow('tbl_cart',$params,array('cart_id'=>$item['cart_id']));
    		}else{
    			deleteRows('tbl_cart',array('cart_id'=>$item['cart_id']));
    		}
    	}else{
            $params['qty'] = 1;
    		insertRow('tbl_cart',$params);
    	}
    }

    // Remove Cart
    if($action == 'delete'){
    	deleteRows('tbl_cart',array('cart_id'=>$item['cart_id']));
    }

    $post_data['item_count'] = 0;
    $result = getRow("SELECT * FROM tbl_cart WHERE user_id=:user_id AND city_id=:city_id AND item_id=:item_id",array("user_id"=>$user_id,"city_id"=>$city_id,"item_id"=>$item_id));
    if(!empty($result)){
        $post_data['item_count'] = (string) $result['qty'];
    }

    $item_count = 0;
    $sub_total = 0;
    $items = getRows("SELECT c.*, pi.price 
        FROM tbl_cart c
        LEFT JOIN tbl_product_item pi ON c.item_id = pi.item_id
        WHERE c.user_id=:user_id AND c.city_id=:city_id",array('user_id'=>$user_id,'city_id'=>$city_id));
    if(!empty($items)){ 
        foreach ($items as $idx => $row) {
            $item_count += 1;
            $sub_total  += ($row['qty'] * $row['price']);
        }
    }

    $output['success'] =  1;
    $output['message'] = "Success.";
    $output['post_data'] = $post_data;
    $output['item_count'] = (string) $item_count;
    $output['sub_total'] = number_format($sub_total,2);
    $output['currency'] = getSetting('currency');

    echo json_encode($output);
	exit;  

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();