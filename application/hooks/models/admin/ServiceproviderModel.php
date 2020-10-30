<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServiceproviderModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Users = 's_users';
	private $Category = 's_service_provider_category';
	private $Suggested_cat = 's_service_provider_suggested_cat';


	public function get_all_service_provider()
	{	
		$this->db->select('s_users.*');
		$this->db->order_by('s_users.user_id','desc');
		$this->db->from($this->Users);
		$this->db->where('s_users.user_type','Service Provider');
		
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_service_provider_suggested_category()
	{	
		$this->db->from($this->Suggested_cat);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	//service provider category

	public function get_all_service_provider_category()
	{	
		$this->db->from($this->Category);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_service_provider_category($params)
	{  
 		$res = $this->db->insert($this->Category, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_service_provider_category_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Category);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_service_provider_category_by_id($id,$params)
	{
		$res = $this->db->update($this->Category, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

//end
}


