<?php
$proj_dir="SuperToGo/";
$siteURL="http://{$_SERVER['HTTP_HOST']}/{$proj_dir}";
$adminURL="http://{$_SERVER['HTTP_HOST']}/{$proj_dir}admin/";
$emailURL="http://{$_SERVER['HTTP_HOST']}/{$proj_dir}email/";
define("APP_NAME","SupertoGo!");

define("MODE_PRODUCTION",1);
define("MODE_DEVLOPMENT",0);
define("STRIPE_PRODUCTION",1);
define("STRIPE_SANDBOX",0);
define("SESSION_USER","Superto_Go_Secure_Session");

$APP_MODE=MODE_DEVLOPMENT;	////Change project mode to show/hide error messages.

$con;
function db_connect(){
	global $con;

	$dbhost = "localhost";	////Database Host
	$dbuser = "root";		////Database User Name
	$dbpassword = "";	////Database Password
	$database = "supertogo";	////Database Name
	
	$con = new PDO ( "mysql:host=$dbhost;dbname=$database;charset=utf8", "$dbuser", "$dbpassword" ) or die ( 'error' );
	$con->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

function db_close(){
	global $con;
	$con=null;
}

$upload_path="images/icons";

date_default_timezone_set('America/Chihuahua');	////TimeZone

$SMTP_HOST="smtp.gmail.com";	////SMTP EMAIL SETTINGS
$SMTP_USER="";
$SMTP_PASSWORD="";
$SMTP_FROM="Destim";
$SMTP_FROM_EMAIL="";
$SMTP_PORT=587;

///----------------------------------------------------------------------///
///Configuration finished////
///----------------------------------------------------------------------///
if(empty($_SESSION)){
	session_start();
}

function phpNow(){
	return date("Y-m-d H:i:s",time());
}

if($APP_MODE==MODE_PRODUCTION){
	error_reporting(0);
	ini_set('display_errors', 0);
}else{
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

/*PDO FUNCTIONS*/
function getRows($sql,$params=false){
	global $con;
	$query=$con->prepare($sql);
	if($params){
		foreach($params as $k=>$v){
			$query->bindValue(":$k",$v."");
		}
	}
	$query->execute();
	if($query->rowCount()==0){
		return array();
	}else{
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
function getRow($sql,$params=false){
	global $con;
	$query=$con->prepare($sql);
	if($params){
		foreach($params as $k=>$v){
			$query->bindValue(":$k",$v."");
		}
	}
	$query->execute();
	if($query->rowCount()==0){
		return false;
	}else{
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}
function insertRow($table,$data){
	global $con;
	$columns=array_keys($data);
	$cols=implode(",",$columns);
	$params=":".implode(",:",$columns);
	$sql="insert into $table ($cols) values($params) ";
	$query=$con->prepare($sql);
	foreach($data as $k=>$v){
		$query->bindParam(":$k",$data[$k]);
	}
	$query->execute();
	return $con->lastInsertId();
}
function updateRow($table,$data,$where=false){
	global $con;
	$sql="update $table set ";
	$first=true;
	foreach($data as $k=>$v){
		if($first){
			$sql.=" $k=:$k ";
			$first=false;
		}else{
			$sql.=", $k=:$k ";
		}
	}
	if($where){
		$sql.=" where 1 ";
		foreach($where as $w=>$wv){
			if($where[$w]==null){
				$sql.=" and $w is null ";
			}else{
				$sql.=" and $w=:$w ";
			}
		}
	}
	$query=$con->prepare($sql);
	foreach($data as $k=>$v){
		$query->bindParam(":$k",$data[$k]);
	}
	if($where){
		foreach($where as $k=>$v){
			if($where[$k]==null){
				//$query->bindValue(":$k",null);
			}else{
				$query->bindParam(":$k",$where[$k]);
			}
		}
	}
	$query->execute();
	return $query->rowCount();
}
function deleteRows($table,$where=false){
	global $con;
	$sql="delete from $table ";
	if($where){
		$sql.=" where 1 ";
		foreach($where as $w=>$wv){
			$sql.=" and $w=:$w ";
		}
	}
	$query=$con->prepare($sql);
	if($where){
		foreach($where as $k=>$v){
			$query->bindParam(":$k",$where[$k]);
		}
	}
	$query->execute();
	return $query->rowCount();
}
///END PDO

function getSetting($key){
	global $con;
	$query=$con->prepare("SELECT `val`
			FROM `tbl_setting`
			WHERE `key`=:key");
	$query->bindParam(":key", $key);
	$query->execute();
	if($query->rowCount()>0){
		$row=$query->fetch(PDO::FETCH_ASSOC);
		return $row['val'];
	}else{
		return false;
	}
}

function setSetting($key,$val)
{
	global $con;
	$sql = $con->prepare("UPDATE `tbl_setting` SET `val`=:val WHERE `key`=:key" );
	$sql->bindParam ( ":val", $val);
	$sql->bindParam ( ":key", $key);
	$sql->execute ();
}

function generateRandomCode() {
	$alphabet = "0123456789";
	$pass = array (); // remember to declare $pass as an array
	$alphaLength = strlen ( $alphabet ) - 1; // put the length -1 in cache
	for($i = 0; $i < 5; $i ++) {
		$n = rand ( 0, $alphaLength );
		$pass [] = $alphabet [$n];
	}
	return implode ( $pass ); // turn the array into a string
}

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'CARS11_Secret_KEY';
    $secret_iv = 'CARS11_Secret_IV';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = @openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = @base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = @openssl_decrypt(@base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


function push_notification($fcm_id, $fcmMsg){
	$fcm_api_key = getSetting('fcm_api_key');
    $fcmFields = array(
        'to' => $fcm_id,
        'priority' => 'high',
        'notification' => $fcmMsg
    );

    $headers = array(
        'Authorization: key='.$fcm_api_key,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec( $ch );
    curl_close( $ch );
    //return $result . "\n\n";
}

function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second');

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}