<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['user_id']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $user_id    = $_REQUEST['user_id'];
    $date = date('Y-m-d');
    $output = array();
    
    //  time slot
    $time_slot = getRows("SELECT * FROM tbl_time_slot WHERE slot_date>=:slot_date ORDER BY slot_date",array("slot_date"=>$date));
    $output['time_slot'] = array();
    $timeslot = array();
    foreach ($time_slot as $slot) {
    	if($slot['slot_date'] == date('Y-m-d')){
    		$end_time = $slot['slot_date'].' '.$slot['to_hour'].':'.$slot['to_min'].' '.$slot['after_midday'];
    		$second = strtotime($end_time) - 2 * (60 * 60);
    		if($second > time()){
    			$timeslot[$slot['slot_date']][] = $slot;
    		}
    	}else{
    		$timeslot[$slot['slot_date']][] = $slot;
    	}
    }

    $i = 0;
    foreach ($timeslot as $idx => $row) {
        $output['time_slot'][$i]['date'] = date('l d M', strtotime($idx));
        $output['time_slot'][$i]['simple_date'] = $idx;
        foreach ($row as $ix => $rw) {
            $output['time_slot'][$i]['time_list'][$ix]['slot_id'] = $rw['slot_id'];
            $output['time_slot'][$i]['time_list'][$ix]['time'] = $rw['full_time'];
        }
        $i++;
    }


    // Card Details
    $card = getRow("SELECT * FROM tbl_card_detail WHERE user_id=:user_id",array("user_id"=>$user_id));
    if(!empty($card)){
    	$card_details['card_number']  = $card['card_number'];
	    $card_details['exp_month'] = $card['exp_month'];
	    $card_details['exp_year'] = $card['exp_year'];
    }else{
    	$card_details['card_number']  = '';
	    $card_details['exp_month'] = '';
	    $card_details['exp_year'] = '';
    }
	$output['card_details'] =  $card_details; 
    $output['delivery_charge'] = getSetting('delivery_charge');
    $output['min_cart_price'] = getSetting('min_cart_price');
    $output['currency'] = getSetting('currency');

    $is_stripe = getSetting('is_stripe');
    if($is_stripe == 'Live'){
        $stripe_pk = getSetting('stripe_pk_live');
        $stripe_sk = getSetting('stripe_sk_live');
    }else{
        $stripe_pk = getSetting('stripe_pk_test');
        $stripe_sk = getSetting('stripe_sk_test');
    }
    $output['stripe_publish_key'] = $stripe_pk;

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