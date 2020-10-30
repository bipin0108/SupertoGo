<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['total_price']) || 
		empty($_REQUEST['promocode']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    $total_price = $_REQUEST['total_price'];
    $promocode = $_REQUEST['promocode'];
	$result = getRow("SELECT * FROM tbl_promocode WHERE promocode=:promocode AND status=1",array("promocode"=>$promocode));
	if(!empty($result)){
	    if($result['min_price'] <= $total_price){

	    	$currenDate = date('Y-m-d');
			$currenDate = date('Y-m-d', strtotime($currenDate));

			$startDate = date('Y-m-d', strtotime($result['start_date']));
			$endDate   = date('Y-m-d', strtotime($result['end_date']));

			if (($currenDate >= $startDate) && ($currenDate <= $endDate)){
			     $output = array();
	    		$output[0]['promocode'] = $result['promocode'];
	    		if($result['discount_type'] == 1){
	    			$output[0]['promocode_price'] = ($total_price*($result['discount']/100));
	    		}
	    		if($result['discount_type'] == 2){
	    			$output[0]['promocode_price'] = $result['discount'];
	    		}
	    		$output[0]['currency'] = getSetting('currency');

				echo json_encode(array("success" =>1,"message"=>"Apply promocode.","post_data"=>$output));
	        	exit;   
			}else{
			    echo json_encode(array("success" =>0,"message"=>"Your promo code has been expired. please try later."));
	        	exit; 
			}

    		

	    }else{
	    	echo json_encode(array("success" =>0,"message"=>"Low cart amount."));
			exit;
	    }
	}else{
		echo json_encode(array("success" =>0,"message"=>"Invalid promocode."));
		exit;
	}

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();