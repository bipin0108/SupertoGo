<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $date= date("Y-m-d");
	$result = getRows("SELECT * FROM tbl_promocode WHERE status=1 ORDER BY promo_id DESC");
	$output = array();
	if(!empty($result)){
		$idx=0;
		foreach ($result as $row) {
			if((strtotime($date) >= strtotime($row['start_date'])) and (strtotime($date) <= strtotime($row['end_date']))){
				$output[$idx]['promo_id'] = $row['promo_id'];
				$output[$idx]['promocode'] = $row['promocode'];
				$output[$idx]['description'] = $row['description'];
				if($row['discount_type'] == 1){
					$output[$idx]['discount'] = $row['discount']."%";
				}else{
					$output[$idx]['discount'] = getSetting('currency').$row['discount'];
				}
				$idx++;
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