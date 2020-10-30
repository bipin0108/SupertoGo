<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( empty($_REQUEST['email']) ||
        empty($_REQUEST['password']) ||
        empty($_REQUEST['device_id']) ||
        empty($_REQUEST['device_token']) ||
        empty($_REQUEST['device_type']) ||
        empty($_REQUEST['timezone']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$device_id = $_REQUEST['device_id'];
	$device_token = $_REQUEST['device_token'];
	$device_type = $_REQUEST['device_type'];
	$timezone = $_REQUEST['timezone'];
	$query=$con->prepare("SELECT * FROM `tbl_users` WHERE email=:email and password=:password");
	$query->bindParam("email", $email);
	$query->bindParam("password", $password);
	$query->execute();
	if($query->rowCount()>0){
		$result=$query->fetch(PDO::FETCH_ASSOC);
		unset($result['password']);
		if($result['status'] == 'Active'){
			$data['device_id']=$device_id;
			$data['device_token']=$device_token;
			$data['device_type']=$device_type;
			$data['timezone']=$timezone;
			$id = updateRow("tbl_users",$data,array('user_id'=>$result['user_id']));
			$results =  getRow("SELECT * FROM tbl_users WHERE user_id=:user_id",array("user_id"=>$result['user_id']));
			unset($results['password']);
			if(!empty($results['avatar'])){
				$results['avatar'] = $siteURL."uploads/profiles/".$results['avatar'];
			}
            echo json_encode(array("success" =>1,"message"=>"Login Successful.","post_data"=>$results));
            exit;
        }else{
            echo json_encode(array("success" =>0,"message"=>"Contact to Administrator for login."));
            exit;
        }
	}else{
		echo json_encode(array("success" =>0,"message"=>"Username or Password not valid."));
		exit;
	}
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();
