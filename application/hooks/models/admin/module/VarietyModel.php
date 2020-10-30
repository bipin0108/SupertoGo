<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VarietyModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Variety = 's_variety';

	public function get_all_variety_forcrop($crop_id)
	{
		$this->db->select('*');
		$this->db->from($this->Variety);
		$this->db->where("crop_id",$crop_id);
		$this->db->order_by('variety_id','desc');
		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return  array();
		 }
	}

	public function add_variety($params)
	{  
 		$res = $this->db->insert($this->Variety, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_variety_by_id($variety_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Variety);
		$this->db->where("variety_id",$variety_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}
	public function update_variety_by_id($variety_id,$params)
	{
		$res = $this->db->update($this->Variety, $params ,['variety_id' => $variety_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function check_unique_variety($field_name,$field_val,$crop_id)
	{
		$this->db->select('*');
		$this->db->from($this->Variety);
		$this->db->where("crop_id",$crop_id);
		$this->db->where($field_name,$field_val);
  		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }

	}

	public function check_unique_edit_variety($field_name,$field_val,$crop_id,$id)
	{
		$this->db->select('*');
		$this->db->from($this->Variety);
		$this->db->where("crop_id",$crop_id);
		$this->db->where($field_name,$field_val);
		$this->db->where('variety_id != ',$id,FALSE);
  		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

//end	
}
