<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['user_id']) ||
        empty($_REQUEST['city_id']) ||
        empty($_REQUEST['payment_token']) ||
        empty($_REQUEST['grand_price']) ||
        empty($_REQUEST['address']) ||
        empty($_REQUEST['lat']) ||
        empty($_REQUEST['lon']) ||
        empty($_REQUEST['delivery_charge']) ||
        empty($_REQUEST['delivery_date']) ||
        empty($_REQUEST['delivery_time']) ||
        empty($_REQUEST['item_data']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

	include_once '../stripe/Stripe.php';

    // Get the post data
    $user_id = $_REQUEST['user_id'];
    $city_id = $_REQUEST['city_id'];
    $payment_token = $_REQUEST['payment_token'];
    $grand_price = $_REQUEST['grand_price'];
    $card_number = !empty($_REQUEST['card_number'])?$_REQUEST['card_number']:'';
    $exp_month = !empty($_REQUEST['exp_month'])?$_REQUEST['exp_month']:'';
    $exp_year = !empty($_REQUEST['exp_year'])?$_REQUEST['exp_year']:'';
    $address = $_REQUEST['address'];
    $lat = $_REQUEST['lat'];
    $lon = $_REQUEST['lon'];
    $delivery_charge = $_REQUEST['delivery_charge'];
    $delivery_date = $_REQUEST['delivery_date'];
    $delivery_time = $_REQUEST['delivery_time'];
    $promocode = $_REQUEST['promocode'];
    $promocode_price = $_REQUEST['promocode_price']; 
    $item_data = json_decode($_REQUEST['item_data'], TRUE);
    $notes = $_REQUEST['notes']; 

    $is_stripe = getSetting('is_stripe');
    if($is_stripe == 'Live'){
        $stripe_pk = getSetting('stripe_pk_live');
        $stripe_sk = getSetting('stripe_sk_live');
    }else{
        $stripe_pk = getSetting('stripe_pk_test');
        $stripe_sk = getSetting('stripe_sk_test');
    } 

    // Payment
	try {
 
        Stripe::setApiKey($stripe_sk);
        
        $charge = Stripe_Charge::create(array(
        	"amount" => $grand_price * 100,
        	"currency" => "usd",
        	"source" => $payment_token,
        	"description" => APP_NAME." Payment")
    	);

        
        $result = "success";

	} catch (Stripe_CardError $e) {
		$error = $e->getMessage();
		$result = "Card Error";
	} catch (Stripe_InvalidRequestError $e) {
		$result = $e;
	} catch (Stripe_AuthenticationError $e) {
		$result = "Stripe Authentication Error";
	} catch (Stripe_ApiConnectionError $e) {
		$result = "Stripe ApiConnection Error";
	} catch (Stripe_Error $e) {
		$result = "Stripe Error";
	} catch (Exception $e) {
        
    }

    if (@$result->success || $result == "success"){
        
        // Card Details
        $card_prm = array(
            'user_id'=> $user_id,
            'card_number'=> $card_number,
            'exp_month'=> $exp_month,
            'exp_year'=> $exp_year
        );
        $card = getRow("SELECT * FROM tbl_card_detail WHERE user_id=:user_id",array("user_id"=>$user_id));
        if(!empty($card)){
            $card_id = updateRow('tbl_card_detail', $card_prm, array('card_id'=>$card['card_id']));
        }else{
            if(!empty($card_number)){
                $card_id = insertRow('tbl_card_detail', $card_prm); 
            }
        }

        // Order
        $order = getRow('SELECT  MAX(order_no) order_no FROM tbl_orders');
        if(!empty($order['order_no'])){
            $order_no = $order['order_no'] + 1;
        }else{
            $order_no = 10000;
        }

        $order_prm = array(
            'user_id' => $user_id,
            'city_id' => $city_id,
            'order_no' => $order_no,
            'order_date' => date('Y-m-d'),
            'order_time' => date('h:i A'),
            'address' => $address,
            'lat' => $lat,
            'lon' => $lon,
            'delivery_charge' => $delivery_charge,
            'delivery_date' => $delivery_date,
            'delivery_time' => $delivery_time,
            'promocode' => $promocode,
            'promocode_price' => $promocode_price,
            'grand_price' => $grand_price,
            'notes' => $notes
        );
        $order_id = insertRow("tbl_orders",$order_prm);

        if($order_id){

            // Add transaction
            $txn_prm = array();
            $txn_prm['txn_id'] = $charge->id;
            $txn_prm['status'] = $charge->status;
            $txn_prm['last4'] = $charge->payment_method_details->card->last4;
            $txn_prm['brand'] = $charge->payment_method_details->card->brand;
            $txn_prm['exp_month'] = $charge->payment_method_details->card->exp_month;
            $txn_prm['exp_year'] = $charge->payment_method_details->card->exp_year;
            $txn_prm['country'] = $charge->payment_method_details->card->country;
            $txn_prm['card_type'] = $charge->payment_method_details->card->funding;
            $txn_prm['payment_date'] = date("Y-m-d");
            $txn_prm['payment_time'] = date("h:i A");
            $payment_id = insertRow('tbl_payment',$txn_prm);


            $distance = getSetting('distance'); 
            // $sql = "SELECT db.db_id, db.device_token, (SELECT COUNT(db_id) total FROM tbl_orders WHERE db.db_id!=0 AND db_id = db.db_id) total FROM tbl_delivery_boy db WHERE status = 'Active' ORDER BY total ASC  LIMIT 2";
            $sql = "SELECT db_id,device_token,(6371*acos(cos(radians(".$lat."))*cos(radians(lat))*cos(radians(lon)-radians(".$lon."))+sin(radians(".$lat."))*sin(radians(lat)))) AS distance FROM tbl_delivery_boy WHERE is_online=1 AND status='Active' HAVING distance<=:distance ORDER BY distance ASC LIMIT 2";
            $drivers = getRows($sql,array('distance'=>$distance));
            if(!empty($drivers)){
                foreach ($drivers as $idx => $driver) {
                    $params = array();
                    $params['order_id']=$order_id;
                    if($idx == 0){
                        $params['status']='send'; 
                        $msg = array(
                            "body"=>"New request has been created near by you.",
                            "sound"=>"default",
                            "content-available"=>1,
                            "code" => "101",
                            "order_id"=>$order_id
                        );
                        push_notification($driver['device_token'],$msg); 
                        // Add notification
                        $notify_prm = array(
                            'db_id' => $driver['db_id'],
                            'order_id' => $order_id,
                            'message' => 'New request has been created near by you.',
                            'type' => 1
                        );
                        $notify_id = insertRow('tbl_notification_list', $notify_prm);
                    }
                    $params['db_id']=$driver['db_id'];
                    $request_id = insertRow('tbl_db_temp_request',$params);
                }
            }
            // Send admin request
            $request_id = insertRow('tbl_db_temp_request',array("order_id"=>$order_id));
            
            $sub_total = 0;
            foreach ($item_data as $key => $item) {
                $sub_total += $item['price'] * $item['item_count'];
                $item['order_id'] = $order_id;
                $item_id = insertRow('tbl_order_item',$item);
            }

            // Status History
            $order_status_prm = array(
                'order_id'=>$order_id,
                'status_id' => 1
            );
            $status_history_id = insertRow('tbl_order_status_history', $order_status_prm);


            // Remove Cart
            deleteRows('tbl_cart',array("user_id"=>$user_id,"city_id"=>$city_id));

            // Send notification
            $user = getRow("SELECT * FROM tbl_users WHERE user_id=:user_id",array("user_id"=>$user_id));
            $message = "Thanks ".$user['first_name']."! Your order id #".$order_no." has been placed successfully.";
            $msg = array(
                "body"=>$message,
                "sound"=>"default",
                "content-available"=>1,
                "code"=>"102", 
                "order_id"=>$order_id
            );
            push_notification($user['device_token'],$msg); 

            // Add notification
            $notify_prm = array(
                'user_id' => $user_id,
                'order_id' => $order_id,
                'message' => $message,
                'type' => 0
            );
            $notify_id = insertRow('tbl_notification_list', $notify_prm);

            // Update Order
            updateRow('tbl_orders',array('sub_total'=>$sub_total),array("order_id"=>$order_id));
            echo json_encode(array("success" =>1,"message"=>$message));
            exit; 
        }

    }else{
        echo json_encode(array("success" =>0,"message"=>"Payment has been failed."));
        exit;
    }


}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();