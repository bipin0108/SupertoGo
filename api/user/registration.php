<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( empty($_REQUEST['first_name']) ||
        empty($_REQUEST['last_name']) ||
        empty($_REQUEST['mobile']) ||
        empty($_REQUEST['email']) ||
        empty($_REQUEST['password']) ||
        empty($_REQUEST['device_id']) ||
        empty($_REQUEST['device_token']) ||
        empty($_REQUEST['device_type']) ||
        empty($_REQUEST['timezone']) ){
        echo json_encode(array("success"=>0,"message"=>"Required argument missing."));
		exit;
    }

	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$mobile = $_REQUEST['mobile'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$device_id = $_REQUEST['device_id'];
	$device_token = $_REQUEST['device_token'];
	$device_type = $_REQUEST['device_type'];
	$timezone = $_REQUEST['timezone'];	
	$check = getRow("SELECT * FROM `tbl_users` WHERE ( email=:email OR mobile=:mobile )",array("email"=>$email,"mobile"=>$mobile));
	if($check){
		echo json_encode(array("success"=>0,"message"=>"Already exist email or mobile."));
		exit;
	}else{

		$data['first_name']=$first_name;
		$data['last_name']=$last_name;
		$data['mobile']=$mobile;
		$data['email']=$email;
		$data['password']=$password;
		$data['device_id']=$device_id;
		$data['device_token']=$device_token;
		$data['device_type']=$device_type;
		$data['timezone']=$timezone;
		if(!empty($_FILES["avatar"]["name"])){
			$targetDir = "../../uploads/profiles/";
			$fileName = basename($_FILES["avatar"]["name"]);
			$targetFilePath = $targetDir . $fileName;
			$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			$allowTypes = array('jpg','png','jpeg');
			if(!in_array($fileType, $allowTypes)){
				echo json_encode(array("success"=>0,"message"=>"Sorry, only JPG, JPEG, PNG files are allowed to upload."));
				exit;
			}
			$path = "../upload/profile";
			move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath);
			$data['avatar']=$fileName;
		}
		$user_id = insertRow("tbl_users",$data);
		if($user_id){
			$result =  getRow("SELECT * FROM tbl_users WHERE user_id=:user_id",array("user_id"=>$user_id));
			unset($result['password']);

			$to = $email;
			$subject = ' Welcome to '.APP_NAME;
			$from = 'info@supertogo.online';
			 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= 'From: '.APP_NAME.' <'.$from.'>'."\r\n".
			    'Reply-To: '.APP_NAME.' <'.$from.'>'."\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			
			$message  = "Dear ".$result['first_name']." ".$result['last_name']." <br/><br/>";

			$message .= "Welcome to SupertoGo! <br/>"; 
			
			$message .= "We're excited to help you get started with your new SupertoGo account. Enjoy your daily needs like grocery and much more.<br/><br/>";

			$message .= "Regards,<br/>";
			$message .= APP_NAME." Team<br/>";	

			if(@mail($to, $subject, $message, $headers)){
				if(!empty($result['avatar'])){
					$result['avatar'] = $siteURL."uploads/profiles/".$result['avatar'];
				}
				echo json_encode(array("success"=>1,"message"=>"Thanks! You have registered successfully.","post_data"=>$result));
				exit;
			}else{
				echo json_encode(array("success"=>0,"message"=>"Failed."));
				exit;
			}
		}else{
			echo json_encode(array("success"=>0,"message"=>"Failed."));
			exit;
		}
	}
}else{
	echo json_encode(array("success"=>0,"message"=>"Request method invalid."));
	exit;
}
db_close();
