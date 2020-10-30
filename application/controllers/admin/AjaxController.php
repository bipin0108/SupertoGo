<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AjaxController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		header('Content-Type: application/json');
    }

    function getCityByStoreId($store_id){
    	$result = $this->m_general->getRows("
    		SELECT c.* 
			FROM tbl_store s 
			LEFT JOIN tbl_city c ON FIND_IN_SET(c.city_id, s.city_ids)
			WHERE s.store_id=?",
		array($store_id));	
		if(!empty($result)){
			$store = $this->m_general->getRow("SELECT * FROM tbl_store WHERE store_id=?",array($store_id));
			$output = array();
			$output['status'] = true;
	    	$output['data'] = $result;
	    	$output['store_name'] = $store['name'];
	    	$output['product_detail'] = array();
	    	$output['brand'] = $this->m_general->getRows("SELECT * FROM tbl_brand WHERE 1");
			if(!empty($_REQUEST['product_id'])){
				$product_detail = $this->m_general->getRows("
					SELECT pd.*,c.name city_name, s.name store_name
					FROM tbl_product_item pd
					LEFT JOIN tbl_city c ON pd.city_id = c.city_id
					LEFT JOIN tbl_store s ON pd.store_id = s.store_id
					WHERE pd.product_id=? AND pd.store_id=?",array($_REQUEST['product_id'],$store_id));
				if(!empty($product_detail)){
					foreach ($product_detail as $idx => $row) {
						$output['product_detail'][0][$row['store_name']][$row['city_name']][] = $row;
					}
				}
	    	}
			echo json_encode($output);
		}else{
			echo json_encode(array("status"=>false));
		}
    }

    function getBrand(){
    	$result = $this->m_general->getRows("SELECT * FROM tbl_brand WHERE 1");
		echo json_encode($result);
    }

    function addBrand($brand){
    	$data = array("name"=>$brand);
    	$brand_id = $this->m_general->insertRow("tbl_brand",$data);
    	if($brand_id){
    		echo json_encode(array("status"=>true,"brand_id"=>$brand_id));
    	}else{
    		echo json_encode(array("status"=>false));
    	}
    }

    function userActiveDeactiveStatus(){
    	$id = $_REQUEST['id'];
		$is_value = $_REQUEST['is_value'];
		if($is_value == 'Active'){
			$val = 'Inactive';
		}else{
			$val = 'Active';
		}
		$data = array('status'=>$val);
		$check = $this->m_general->updateRow("tbl_users",$data,array("user_id"=>$id));
		if($check)
		{
			echo true;
		}
    }

    function promocodeActiveDeactiveStatus(){
    	$id = $_REQUEST['id'];
		$is_value = $_REQUEST['is_value'];
		if($is_value == '1'){
			$val = '0';
		}else{
			$val = '1';
		}
		$data = array('status'=>$val);
		$check = $this->m_general->updateRow("tbl_promocode",$data,array("promo_id"=>$id));
		if($check)
		{
			echo true;
		}
    }

    function deliveryBoyActiveDeactiveStatus(){
    	$id = $_REQUEST['id'];
		$is_value = $_REQUEST['is_value'];
		if($is_value == 'Active'){
			$val = 'Inactive';
		}else{
			$val = 'Active';
		}
		$data = array('status'=>$val);
		$check = $this->m_general->updateRow("tbl_delivery_boy",$data,array("db_id"=>$id));
		if($check)
		{
			echo true;
		}
    }
    
}