<?php
include_once '../db.php';
header('Content-Type: application/json');
db_connect();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( empty($_REQUEST['email']) ){
        echo json_encode(array("success" =>0,"message"=>"Required argument missing."));
		exit;
    }
	$email = $_REQUEST['email'];
	$query=$con->prepare("SELECT * FROM `tbl_delivery_boy` WHERE email=:email");
	$query->bindParam("email", $email);
	$query->execute();
	if($query->rowCount()>0){
		$result=$query->fetch(PDO::FETCH_ASSOC);
	
		$to = $email;
		$subject = APP_NAME.' forgot password';
		$from = 'info@supertogo.online';
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.APP_NAME.' <'.$from.'>'."\r\n".
		    'Reply-To: '.APP_NAME.' <'.$from.'>'."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		
		$message  = "-------------------------------------------<br/>";
		$message .= " supertogo.online : Old Password <br/>";
		$message .= "-------------------------------------------<br/><br/>";
		
		$message .= "Dear ".$result['first_name']." ".$result['last_name']." <br/><br/>";
		
		$message .= "Please check your old password of your ".APP_NAME." delivery account,<br/><br/>";
		
		$message .= "For your information,<br/>";
		$message .= "<b>Email:</b> ".$result['email']."<br/>";
		$message .= "<b>Password:</b> ".$result['password']."<br/><br/>";

		$message .= "Sincerely,<br/>";
		$message .= APP_NAME." Team<br/>";
		$message .= "https://supertogo.online";

		if(@mail($to, $subject, $message, $headers)){
		    unset($result['password']);
		    if(!empty($result['avatar'])){
				$result['avatar'] = $siteURL."uploads/profiles/".$result['avatar'];
			}
		    echo json_encode(array("success" =>1,"message"=>"Your password has been sent on your email.","post_data"=>$result));
            exit;    
		}else{
			echo json_encode(array("success"=>0,"message"=>"Failed."));
			exit;
		}
	}else{
		echo json_encode(array("success" =>0,"message"=>"Your email is Wrong, please try again later."));
		exit;
	}
}else{
	echo json_encode(array("success" =>0,"message"=>"Request method invalid."));
	exit;
}
db_close();
