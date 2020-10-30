<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['user_id']) || 
		empty($_REQUEST['action']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

	// Get the post data
	$user_id   = !empty($_REQUEST['user_id'])?$_REQUEST['user_id']:0;
	$house_no  = !empty($_REQUEST['house_no'])?$_REQUEST['house_no']:'';
	$apartment = !empty($_REQUEST['apartment'])?$_REQUEST['apartment']:'';
	// $street    = !empty($_REQUEST['street'])?$_REQUEST['street']:'';
	// $city      = !empty($_REQUEST['city'])?$_REQUEST['city']:'';
	// $zipcode   = !empty($_REQUEST['zipcode'])?$_REQUEST['zipcode']:'';
	$address   = !empty($_REQUEST['address'])?$_REQUEST['address']:'';
	$type      = !empty($_REQUEST['type'])?$_REQUEST['type']:'';
	$lat       = !empty($_REQUEST['lat'])?$_REQUEST['lat']:'';
	$lon       = !empty($_REQUEST['lon'])?$_REQUEST['lon']:'';
	$action    = $_REQUEST['action'];

	// $street  = addslashes($street);
 //    $address = $house_no.', '.$apartment.', '.$street.', '.$city.'-'.$zipcode;
 //    $address = addslashes($address);

    // Params
    $data =  array(
    	'user_id' => $user_id,
    	'house_no' => $house_no,
    	'apartment' => $apartment,
    	// 'street' => $street,
    	// 'city' => $city,
    	// 'zipcode' => $zipcode,
    	'type' => $type,
    	'lat' => $lat,
    	'lon' => $lon,
    	'address' => $address,
    );

    // Check
    if($action == 1){

    	if( empty($_REQUEST['house_no']) || 
			empty($_REQUEST['apartment'])|| 
			empty($_REQUEST['address'])|| 
			empty($_REQUEST['lat'])|| 
			empty($_REQUEST['lon']) /*|| 
			empty($_REQUEST['street']) || 
			empty($_REQUEST['city']) || 
			empty($_REQUEST['zipcode'])*/ ){
	        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
			exit;
	    }

	    $result = getRow("SELECT * FROM tbl_delivery_address WHERE user_id=:user_id AND type=:type",array("user_id"=>$user_id,"type"=>$type));
	    if(!empty($result)){
	    	updateRow("tbl_delivery_address",$data,array("user_id"=>$user_id));
	    }else{
			insertRow("tbl_delivery_address",$data);
	    }
    }
    
    // Home
    $output = array();
    $home = getRow("SELECT * FROM tbl_delivery_address WHERE user_id=:user_id AND type=0",array("user_id"=>$user_id));
    if(!empty($home)){
    	$home_address['house_no']  = $home['house_no'];
	    $home_address['apartment'] = $home['apartment'];
	    // $home_address['street']    = $home['street'];
	    // $home_address['city']      = $home['city'];
	    // $home_address['zipcode']   = $home['zipcode'];
	    $home_address['address']   = $home['address'];
	    $home_address['lat']   	   = $home['lat'];
	    $home_address['lon']       = $home['lon'];
    }else{
    	$home_address['house_no']  = '';
	    $home_address['apartment'] = '';
	    // $home_address['street']    = '';
	    // $home_address['city']      = '';
	    // $home_address['zipcode']   = '';
	    $home_address['lat']       = '';
	    $home_address['lon']       = '';
    }
    $output['Home'] = $home_address;


    // Work
    $work = getRow("SELECT * FROM tbl_delivery_address WHERE user_id=:user_id AND type=1",array("user_id"=>$user_id));
    if(!empty($work)){
    	$work_address['house_no']  = $work['house_no'];
	    $work_address['apartment'] = $work['apartment'];
	    // $work_address['street']    = $work['street'];
	    // $work_address['city']      = $work['city'];
	    // $work_address['zipcode']   = $work['zipcode'];
	    $work_address['address']   = $work['address'];
	    $work_address['lat']       = $work['lat'];
	    $work_address['lon']       = $work['lon'];
    }else{
    	$work_address['house_no']  = '';
	    $work_address['apartment'] = '';
	    // $work_address['street']    = '';
	    // $work_address['city']      = '';
	    // $work_address['zipcode']   = '';
	    $work_address['address']   = '';
	    $work_address['lat']       = '';
	    $work_address['lon']       = '';
    }
    $output['Work'] = $work_address;


    // Work
    $other = getRow("SELECT * FROM tbl_delivery_address WHERE user_id=:user_id AND type=2",array("user_id"=>$user_id));
    if(!empty($other)){
    	$other_address['house_no']  = $other['house_no'];
	    $other_address['apartment'] = $other['apartment'];
	    // $other_address['street']    = $other['street'];
	    // $other_address['city']      = $other['city'];
	    // $other_address['zipcode']   = $other['zipcode'];
	    $other_address['address']   = $other['address'];
	    $other_address['lat']       = $other['lat'];
	    $other_address['lon']       = $other['lon'];
    }else{
    	$other_address['house_no']  = '';
	    $other_address['apartment'] = '';
	    // $other_address['street']    = '';
	    // $other_address['city']      = '';
	    // $other_address['zipcode']   = '';
	    $other_address['address']   = '';
	    $other_address['lat']       = '';
	    $other_address['lon']       = '';
    }
    $output['Other'] = $other_address;

    echo json_encode(array("success" =>1,"message"=>"Address added successfully.","post_data"=>$output));
	exit; 

}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();