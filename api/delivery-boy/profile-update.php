<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if( empty($_REQUEST['db_id']) ||
		empty($_REQUEST['first_name']) ||
		empty($_REQUEST['last_name']) ||
		empty($_REQUEST['mobile']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }

    // Get the post data
    $db_id = $_REQUEST['db_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $mobile = $_REQUEST['mobile'];

    $data['first_name']=$first_name;
	$data['last_name']=$last_name;
	$data['mobile']=$mobile;

	$check = getRow("SELECT * FROM tbl_delivery_boy WHERE mobile=:mobile AND db_id!=:db_id",array("mobile"=>$mobile,"db_id"=>$db_id));
	if($check){
		echo json_encode(array("success"=>0,"message"=>"Mobile already exist ."));
		exit;
	}

	
    if(!empty($_FILES["avatar"]["name"])){
    	$user =  getRow("SELECT * FROM tbl_delivery_boy WHERE db_id=:db_id",array("db_id"=>$db_id));
    	if(!empty($user['avatar'])){
    		@unlink('../../uploads/profiles/'.$user['avatar']);
    	}
		$targetDir = "../../uploads/profiles/";
		$fileName = time().uniqid(rand()).basename($_FILES["avatar"]["name"]);
		$targetFilePath = $targetDir . $fileName;
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		$allowTypes = array('jpg','png','jpeg');
		if(!in_array($fileType, $allowTypes)){
			echo json_encode(array("success"=>0,"message"=>"Sorry, only JPG, JPEG, PNG files are allowed to upload."));
			exit;
		}
		move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath);
		$data['avatar']=$fileName;
	}

	updateRow("tbl_delivery_boy",$data,array('db_id'=>$db_id));
	$result =  getRow("SELECT * FROM tbl_delivery_boy WHERE db_id=:db_id",array("db_id"=>$db_id));
	unset($result['password']);
	if(!empty($result['avatar'])){
		$result['avatar'] = $siteURL."uploads/profiles/".$result['avatar'];
	}
    echo json_encode(array("success" =>1,"message"=>"Success.","post_data"=>$result));
    exit; 
    
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();